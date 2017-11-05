<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *	@author : Venance Edson
 *  @support: support@xchangewallet.com
 *	date	: dec, 2016
 *	TemboPos
 *	http://www.xchangewallet.com
 *  version: 1.0
 */

class Global_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public $_order = '';

    public function get_last_id($table, $key, $id)
    {
        $this->db->select_max($key);
        $Q = $this->db->get($table);
        $row = $Q->row_array();
        $last_id = $row[$id];

        return $last_id;
    }

    public function check_user_name($user_name, $user_id)
    {
        $this->db->select('tbl_user.*', false);
        $this->db->from('tbl_user');
        if ($user_id) {
            $this->db->where('user_id !=', $user_id);
        }
        $this->db->where('user_name', $user_name);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }
    
 public function check_alerts_config($type)
    {
        $this->db->select('tbl_alerts_config.*', false);
        $this->db->from('tbl_alerts_config');
        $this->db->where('alert_type', $type);
        //$this->db->limit(1);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }
}
