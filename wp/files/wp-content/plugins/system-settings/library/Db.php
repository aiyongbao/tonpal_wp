<?php
namespace library;

use library\controller\BaseController;

class Db extends BaseController{

    protected $db,$sql;
    protected 
    $name,
    $field,
    $conditionArr,
    $condition = '',
    $alias,
    $joinTables = [],
    $joins = '';
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

    public function alias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function join($table,$condition,$type = 'INNER')
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $joinTables = $this->joinTables;
        $joinTables[] = "{$type} JOIN {$prefix}{$table} ON {$condition}";
        $this->joinTables = $joinTables;
        $this->joins = implode(' ',$this->joinTables);
        return $this;
    }

    public function field($field)
    {
        $this->field = $field;
        return $this;
    }

    public function where($field ,$condition = '', $value = null)
    {

        if(is_array($field))
        {
            foreach( $field as $key => $item )
            {
                foreach($item as $f => $v)
                {
                    $this->conditionArr[] = "`{$f}` = '{$v}'";
                }
            }
        }
        else{
            if($value == null)
            {
                $value = $condition;
            }
            $this->conditionArr[]  = "`{$field}` = '{$value}'";
        }

        $this->condition = 'where ' . implode(' AND ',$this->conditionArr);

        return $this;
    }

    public function select()
    {
        $field = isset($this->field) ? $this->field : '*' ;
        $table_name = $this->name;
        $sql = <<<EOT
        SELECT {$field} FROM {$table_name} {$this->alias} {$this->joins} {$this->condition};
EOT;
        $result = $this->db->get_results($sql);
        $result = $this->object_array($result);
        return $result;
    }

    public function find()
    {
        $field = isset($field) ? $this->field : '*' ;
        $table_name = $this->name;
        $sql = <<<EOT
        SELECT {$field} FROM {$table_name} {$this->condition} limit 1;
EOT;
        $result = $this->db->get_results($sql)[0];
        $result = $this->object_array($result);
        return $result;
    }

    public function update($data)
    {

        $field = [];

        $values = [];

        foreach( $data as $key => $value )
        {
            $type = gettype($value);
            
            switch($type)
            {
                case 'int':
                    $field[] = $key . ' = %d';
                    break;
                
                default:
                    $field[] = $key . ' = %s';
                    break;
            }

            array_push($values,$value);
        }
        
        $field = implode(',',$field);

        $table_name = $this->name;

        $result = $this->db->query(
            $this->db->prepare("UPDATE `{$table_name}` SET {$field} {$this->condition}", $values )
        );

        return $result;

    }

    public function insert($data,$rule = [])
    {
        $result = $this->db->insert($this->name,$data,$rule);
        return $result;
    }

    public function delete()
    {

        $table_name = $this->name;

        $result = $this->db->query("DELETE FROM `{$table_name}` {$this->condition}");
        return $result;
    }
}