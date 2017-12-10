<?php
/**
 * Created by PhpStorm.
 * User: hmtmc
 * Date: 08/12/2017
 * Time: 06:56 PM
 */

namespace App\Service;

class HttpRequest {

    public $url = null;
    public $params = array();
    public $method = null;
    public $isFile = false;
    public $downloadLocation = null;

    public static function instance(){
        return new HttpRequest();
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }


    public function isFile()
    {
        return $this->isFile;
    }

    public function setIsFile($isFile)
    {
        $this->isFile = $isFile;
        return $this;
    }

    public function getDownloadLocation()
    {
        return $this->downloadLocation;
    }

    public function setDownloadLocation($downloadLocation)
    {
        $this->downloadLocation = $downloadLocation;
        return $this;
    }
}

class HttpResponse {

    public $httpCode;
    public $responseData;
    public $isSuccess;
    public $message;


    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getResponseData()
    {
        return $this->responseData;
    }

    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
        return $this;
    }

    public function isSuccess()
    {
        return $this->isSuccess;
    }

    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }


    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}




class HttpConnectionService
{

    public $headers = null;
    public $timeout = 60;
    const POST = "POST";
    const GET = "GET";
    const DELETE = "DELETE";

    public function DOWNLOAD($url, $saveLocation, $method = self::GET){
        $response = $this->httpRequest(
            HttpRequest::instance()
                ->setUrl($url)
                ->setMethod($method)
        );

        $file = fopen($saveLocation, "w+");
        fputs($file, $response->getResponseData());
        fclose($file);
    }

    public function POST($url, $params){
        return $this->httpRequest(
            HttpRequest::instance()
                ->setUrl($url)
                ->setParams($params)
                ->setMethod(self::POST)
        );
    }

    public function GET($url, $params = null){
        return $this->httpRequest(
            HttpRequest::instance()
                ->setUrl($url)
                ->setParams($params)
                ->setMethod(self::GET)
        );
    }

    public function DELETE(){}

    private function httpRequest(HttpRequest $httpRequest){
        $httpResponse = new HttpResponse();
        $httpResponse->isSuccess(false);
        $curl = curl_init();
        $params = "";
        if ($httpRequest->getParams() !== null && $httpRequest->getParams() !== "" && !empty($httpRequest->getParams())){
            foreach ($httpRequest->getParams() as $key => $value){
                $params .= "$key=$value&";
            }
            rtrim($params, "&");
        }

        if ($httpRequest->method === self::GET){
            $httpRequest->url .= "?$params";
        }elseif ($httpRequest->method === self::POST){
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }elseif ($httpRequest->method === self::DELETE){

        }else{
            $httpResponse->setMessage("Invalid HTTP Method");
            return $httpResponse;
        }
        curl_setopt($curl, CURLOPT_URL, $httpRequest->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);

        if($this->headers !== null && is_array($this->headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        }

        $response = curl_exec($curl);
        if((curl_errno($curl) == 60)) {
            /* Invalid or no certificate authority found - Retrying without ssl */
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }

        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if( curl_errno($curl) ) {
            $response = curl_error($curl);
        }
        curl_close($curl);
        $httpResponse->setIsSuccess(true);
        $httpResponse->setHttpCode($httpStatus);
        $httpResponse->setResponseData($response);
        return $httpResponse;
    }

    public static function downloadFile(){
        $source = "https://api.bitbucket.org/2.0/repositories/hmtmcse/hmtmcse_com/src/master/1.java/1.bismillah/1.introduction.md";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization: Basic '. base64_encode(":")
        ));
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec ($ch);


        $error = curl_error($ch);
        curl_close ($ch);


        print_r($error);

        $destination = PathResolver::getUpdateTemp() . "/1.introduction.md";
        $file = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);
    }
}