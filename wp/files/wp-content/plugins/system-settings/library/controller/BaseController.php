<?php
namespace library\controller;

class BaseController
{

    protected $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }

    function success($msg,$data = [])
    {
        $result = [
            'code' => 1,
            'msg' => $msg,
            'data' => $data
        ];
        return rest_ensure_response( $result );
    }

    function error($msg,$data = [])
    {
        $result = [
            'code' => 0,
            'msg' => $msg,
            'data' => $data
        ];
        return rest_ensure_response( $result );
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
}