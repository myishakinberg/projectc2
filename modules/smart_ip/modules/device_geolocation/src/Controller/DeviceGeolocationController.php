<?php

/**
 * @file
 * Contains \Drupal\device_geolocation\Controller\DeviceGeolocationController.
 */

namespace Drupal\device_geolocation\Controller;

use Drupal\device_geolocation\DeviceGeolocation;
use Drupal\smart_ip\SmartIp;
use Drupal\smart_ip\SmartIpEvents;
use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Ajax callback handler for Device Geolocation module.
 *
 * @package Drupal\device_geolocation\Controller
 */
class DeviceGeolocationController extends ControllerBase {
  /**
   * Google Geocoding ajax callback function data handler.
   */
  public function saveLocation(Request $request) {
    $post = $request->request->all();
    if (isset($post['latitude']) && isset($post['longitude'])) {
      $data= [];
      SmartIp::setSession('device_geolocation', NULL);
      foreach ($post as $label => $address) {
        if (!empty($address)) {
          $label = Html::escape($label);
          $data[$label] = Html::escape($address);
          SmartIp::setSession('device_geolocation', TRUE);
        }
      }
      if (!empty($data)) {
        /** @var \Drupal\smart_ip\GetLocationEvent $event */
        $event     = \Drupal::service('smart_ip.get_location_event');
        $location  = $event->getLocation();
        $ipAddress = $location->get('ipAddress');
        $ipVersion = $location->get('ipVersion');
        $timeZone  = $location->get('timeZone');
        $location->delete()
          ->setData($data)
          ->set('originalData', $data)
          ->set('ipAddress', $ipAddress)
          ->set('ipVersion', $ipVersion)
          ->set('timeZone', $timeZone)
          ->set('timestamp', REQUEST_TIME);
        // Allow other modules to modify the acquired location from client side
        // via Symfony Event Dispatcher.
        \Drupal::service('event_dispatcher')->dispatch(SmartIpEvents::DATA_ACQUIRED, $event);
        $location->save();
      }
    }
  }

  /**
   * Check for Geolocation attempt.
   */
  public function check(Request $request) {
    if (SmartIp::checkAllowedPage() && DeviceGeolocation::isNeedUpdate()) {
      $json = ['askGeolocate' => TRUE];
    }
    else {
      $json = ['askGeolocate' => FALSE];
    }
    return new JsonResponse($json);
  }
}