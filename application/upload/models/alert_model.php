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

class alert_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_new_alert_rate_info()
    {
        $post = new stdClass();
        $post->rate_name = '';
        $post->rate = '';

        return $post;
    }
    public function get_new_alert_rule_info()
    {
        $post = new stdClass();
        $post->alert_group_id = '';
        $post->alert_rate_id = '';
        $post->rule_name = '';

        return $post;
    }

    public function get_alert_rule_info($id = null)
    {
        // this function is to get all alert info if id exist then row wise else result

        $this->db->select('tbl_alert_rule.*', false);
        $this->db->select('tbl_alert_rate.*', false);
        $this->db->select('tbl_alert_group.*', false);
        $this->db->from('tbl_alert_rule');
        $this->db->join('tbl_alert_rate', 'tbl_alert_rate.alert_rate_id  =  tbl_alert_rule.alert_rate_id ', 'left');
        $this->db->join('tbl_alert_group', 'tbl_alert_group.alert_group_id  =  tbl_alert_rule.alert_group_id ', 'left');
        if (!empty($id)) { //specific alert rule information needed
            $this->db->where('tbl_alert_rule.alert_rule_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //all alert rule information needed
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
}
