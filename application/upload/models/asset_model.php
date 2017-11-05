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

class Asset_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    
    
    
 public function get_all_category()
    { 
        $this->db->select('tbl_asset_category.*', false);
        $this->db->from('tbl_asset_category');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
 public function get_all_brands()
    { 
        $this->db->select('tbl_asset_brand.*', false);
        $this->db->from('tbl_asset_brand');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }  
    
    public function get_all_vendors()
    { 
        $this->db->select('tbl_vendor.*', false);
        $this->db->from('tbl_vendor');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }  
    
    
    public function get_all_category_by_id($category_id)
    {
        $this->db->select('tbl_asset_category.*', false);
        $this->db->from('tbl_asset_category');
        $this->db->where('tbl_asset_category.category_id', $category_id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    

    // * me
    public function get_all_asset_info()
    {
        $this->db->select('tbl_asset.*', false);
        $this->db->from('tbl_asset');
        $this->db->order_by('tbl_asset.asset_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_asset_information_by_id($id)
    {
        $this->db->select('tbl_asset.*', false);
        $this->db->from('tbl_asset');
        $this->db->order_by('tbl_asset.asset_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_damage_asset($id)
    {
        $this->db->select('tbl_asset.*', false);
        $this->db->from('tbl_asset');
        $this->db->where('tbl_asset.asset_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }


    public function check_asset_code($asset_serial_number, $asset_id)
    {
        $this->db->select('tbl_asset.*', false);
        $this->db->from('tbl_asset');
        if ($asset_id) {
            $this->db->where('asset_id !=', $asset_id);
        }
        $this->db->where('asset_serial_number', $asset_serial_number);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }
    
    


}
