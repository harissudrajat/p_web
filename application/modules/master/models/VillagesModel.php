<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: matius
 * Date: 08/04/18
 * Time: 20.55
 */

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class VillagesModel extends CI_Model 
{
    public function __construct()
    {
        
    }
    
    public function get($getRequest)
    {
        $data = [];
        $size = $getRequest['size'];
        $page = $getRequest['page'];
        $search = $getRequest['search'];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_address");
        $requestUri.= "/subDistrict?name=".$search."&size=".$size."&page=".$page;
        $data = $this->psdkp->getData($requestUri);
        return $data;
    }

    public function getById($id = "")
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_address");
        $requestUri.="/subDistrict?id=".$id;
        $data = $this->psdkp->getData($requestUri);
        return $data;
    }


    public function post($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_address");
        $requestUri.= "/subDistrict";
        $data = $this->psdkp->postData($requestUri, json_decode($payload));
        return $data;
    }

    public function put($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_address");
        $requestUri.="/subDistrict";
        $data = $this->psdkp->putData($requestUri, json_decode($payload));
        return $data;
    }

    public function delete($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_address");
        $requestUri.="/subDistrict/del";
        $data = $this->psdkp->deleteData($requestUri, json_decode($payload));
        return $data;
    }

}