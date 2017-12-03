<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 03/12/2017
 * Time: 10:33 PM
 */

namespace App\Utils;


class HttpConnection
{

    public static function makeCurlCall($url, $method = "GET", $posts = null, $gets = null, $headers = null) {
        $ch = curl_init();
        if($gets != null && $method == "GET") {
            $url .= "?" . $gets;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        if($headers == null || !is_array($headers)) {
            $headers = array();
        }
        if($posts != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
        }
        if(count($headers) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
        } else if($method == "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        } else if($method == "HEAD") {
            curl_setopt($ch, CURLOPT_NOBODY, true);
        }
        if($headers != null && is_array($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        if((curl_errno($ch) == 60)) {
            /* Invalid or no certificate authority found - Retrying without ssl */
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
        }
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if( curl_errno($ch) ) {
            $response = curl_error($ch);
        }
        curl_close($ch);
        return array(
            "code" => $httpStatus,
            "response" => $response
        );
    }

}