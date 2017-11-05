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

class giftcard_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    

    // * me
    public function get_all_giftcard_info()
    {
        $this->db->select('tbl_giftcards.*', false);
        $this->db->from('tbl_giftcards');
        $this->db->order_by('tbl_giftcards.giftcard_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_giftcard_information_by_id($id)
    {
        $this->db->select('tbl_giftcards.*', false);
        $this->db->from('tbl_giftcards');
        $this->db->order_by('tbl_giftcards.giftcard_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

 

    public function check_giftcard_code($card_no, $giftcard_id)
    {
        $this->db->select('tbl_giftcards.*', false);
        $this->db->from('tbl_giftcards');
        if ($giftcard_id) {
            $this->db->where('giftcard_id !=', $giftcard_id);
        }
        $this->db->where('$card_no', $card_no);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }
    
    


}
