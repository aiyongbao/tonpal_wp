<?php
namespace library\controller;

class RestController extends BaseController
{

    protected $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }

    function object_array($array) {  
        if(is_object($array)) {  
            $array = (array)$array;  
         } if(is_array($array)) {  
             foreach($array as $key=>$value) {  
                 $array[$key] = $this->object_array($value);  
                 }  
         }  
         return $array;  
    }

    //模拟请求
    public function callBackRequest($callback, $params, $method = 'POST')
    {
        $wp_http = new \WP_Http;
        $params['token'] = 'E10ADC3949BA59ABBE56E057F20F883E';
        $result = $wp_http->request( $callback , array( 'method' => $method, 'body' =>  $params ) );
        $res = json_decode($result['body'],true);
        if($res['code'] != 200)
        {
            exit($result['body']);
        }
        else{
            return true;
        }
    }
}