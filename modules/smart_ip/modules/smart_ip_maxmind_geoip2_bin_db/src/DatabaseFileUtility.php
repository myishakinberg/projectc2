<?php

/**
 * @file
 * Contains \Drupal\smart_ip_maxmind_geoip2_bin_db\DatabaseFileUtility.
 */

namespace Drupal\smart_ip_maxmind_geoip2_bin_db;

use Drupal\smart_ip_maxmind_geoip2_bin_db\EventSubscriber\SmartIpEventSubscriber;
use Drupal\smart_ip\DatabaseFileUtilityBase;
use \Drupal\Component\Utility\UrlHelper;

/**
 * Utility methods class wrapper.
 *
 * @package Drupal\smart_ip_maxmind_geoip2_bin_db
 */
class DatabaseFileUtility extends DatabaseFileUtilityBase {
  /**
   * Get MaxMind GeoIP2 binary database filename.
   *
   * @param string $version
   * @param string $edition
   * @param bool $withExt
   * @return string
   */
  public static function getFilename($version = SmartIpEventSubscriber::LITE_VERSION, $edition = SmartIpEventSubscriber::CITY_EDITION, $withExt = TRUE) {
    if ($version == SmartIpEventSubscriber::LINCENSED_VERSION && $edition == SmartIpEventSubscriber::COUNTRY_EDITION) {
      $file = SmartIpEventSubscriber::FILENAME_LINCENSED_COUNTRY;
    }
    elseif ($version == SmartIpEventSubscriber::LINCENSED_VERSION && $edition == SmartIpEventSubscriber::CITY_EDITION) {
      $file = SmartIpEventSubscriber::FILENAME_LINCENSED_CITY;
    }
    elseif ($version == SmartIpEventSubscriber::LITE_VERSION && $edition == SmartIpEventSubscriber::COUNTRY_EDITION) {
      $file = SmartIpEventSubscriber::FILENAME_LITE_COUNTRY;
    }
    else {
      $file = SmartIpEventSubscriber::FILENAME_LITE_CITY;
    }
    if ($withExt) {
      return $file . SmartIpEventSubscriber::FILE_EXTENSION;
    }
    return $file;
  }

  /**
   * Download MaxMind GeoIP2 binary database file and extract it.
   * Only perform this action when the database is out of date or under specific
   * direction.
   */
  public static function downloadDatabaseFile() {
    $config     = \Drupal::config(SmartIpEventSubscriber::configName());
    $version    = $config->get('version');
    $edition    = $config->get('edition');
    $sourceId   = SmartIpEventSubscriber::sourceId();
    $file       = self::getFilename($version, $edition);
    $url        = '';
    if ($version == SmartIpEventSubscriber::LINCENSED_VERSION) {
      $url = SmartIpEventSubscriber::LINCENSED_DL_URL;
      $url .= '?' . UrlHelper::buildQuery([
        'license_key' => $config->get('license_key'),
        'edition_id'  => self::getFilename($version, $edition, FALSE),
        'suffix' => 'tar.gz',
      ]);
    }
    elseif ($version == SmartIpEventSubscriber::LITE_VERSION) {
      $url = SmartIpEventSubscriber::LITE_DL_URL;
      $url .= "/$file.gz";
    }
    if (parent::requestDatabaseFile($url, $file, $sourceId)) {
      \Drupal::state()->set('smart_ip_maxmind_geoip2_bin_db.last_update_time', REQUEST_TIME);
    }
  }
}