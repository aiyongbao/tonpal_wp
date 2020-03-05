<?php
namespace library;

use library\controller\BaseController;

class Db extends BaseController{

    protected $db,$sql;
    protected $name,$field,$condition;
    public function __construct($name)
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->name = $name;
    }
    
    public static function table($name = '')
    {
        $db = new db($name);
        return $db;
    }

    public static function name($name = '')
    {
        global $wpdb;
        $name = $wpdb->prefix.$name;
        $db = new db($name);
        return $db;
    }


    public function field($field)
    {
        $this->field = $field;
        return $this;
    }

    public function where($condition = '')
    {
        $this->condition = $condition;
        return $this;
    }

    public function select()
    {
        $field = isset($field) ? $this->field : '*' ;
        $table_name = $this->name;
        $sql = <<<EOT
        SELECT {$field} FROM {$table_name};
EOT;
        $result = $this->db->get_results($sql);
        $result = $this->object_array($result);
        return $result;
    }

    public function insert($data,$rule = [])
    {
        $result = $this->db->insert($this->name,$data,$rule);
        return $result;
    }

}