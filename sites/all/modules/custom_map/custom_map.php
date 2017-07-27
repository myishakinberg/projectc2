<?php
/**
 * Gets country details for the given ip by calling hostip api.
 *
 * Takes ($ip)
 *
 * @param valid ip addess to get country details for specific ip address otherwise
 * it returns country details for the user
 */
function hostip_get_iptocountry_info($ip = '') {
    $ip = $ip ? $ip : \Drupal::request()->getClientIp();
    //$ip = '170.149.100.10';
    if (!hostip_is_valid_ip($ip)) {
        return array();
    }
    // HTML Format
    /*$url = "http://api.hostip.info/get_html.php?ip=$ip&position=true";
    $ip_details = drupal_http_request($url);
    $output = nl2br($ip_details->data);
    return $output;*/

    // XML Format.
    $url = "http://api.hostip.info/?ip=$ip&position=true";

    // TODO: https://www.drupal.org/node/1862446, we may Guzzle HTTP client library.
    $ip_details = hostip_curl($url);
    if (empty($ip_details)) {
        return array();
    }
    /*if (empty($ip_details->data)) {
      return array();
    }*/
    $ip_details_array = hostip_xml2array($ip_details);
    if (empty($ip_details_array['HostipLookupResultSet'])) {
        return array();
    }

    $data['country'] = String::checkPlain($ip_details_array['HostipLookupResultSet']['gml:featureMember']['Hostip']['countryName']['value']);
    $data['countrycode'] = String::checkPlain($ip_details_array['HostipLookupResultSet']['gml:featureMember']['Hostip']['countryAbbrev']['value']);
    $data['city'] = String::checkPlain($ip_details_array['HostipLookupResultSet']['gml:featureMember']['Hostip']['gml:name']['value']);
    if (!empty($ip_details_array['HostipLookupResultSet']['gml:featureMember']['Hostip']['ipLocation'])) {
        $map_info = explode(',', $ip_details_array['HostipLookupResultSet']['gml:featureMember']['Hostip']['ipLocation']['gml:pointProperty']['gml:Point']['gml:coordinates']['value']);
        $data['longitude'] = String::checkPlain($map_info[0]);
        $data['latitude'] = String::checkPlain($map_info[1]);
    }
   // echo("<script>console.log('PHP: ".$data."');</script>");
    return $data;
}
