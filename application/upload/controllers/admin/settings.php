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

class Settings extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->model('global_model');

    }

    /*** Business Settings ***/
    public function business_profile($val = null)
    {
        $this->settings_model->_table_name = 'tbl_business_profile';
        $this->settings_model->_order_by = 'business_profile_id';

        $result = $this->settings_model->get_by(array('business_profile_id' => 1), true);
        if ($result) {
            $data['business_info'] = $result;
        }

        // view page
        $data['title'] = 'Business Profile';
        $data['subview'] = $this->load->view('admin/settings/business_profile', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Business Information ***/
    public function save_business_profile($id = null)
    {
        $this->settings_model->_table_name = 'tbl_business_profile';
        $this->settings_model->_primary_key = 'business_profile_id';
        $data = $this->settings_model->array_from_post(array('company_name', 'email', 'address', 'phone', 'currency'));

        //logo Upload
        if ($_FILES['logo']['name']) { // logo name is exist
            $old_path = $this->input->post('old_path');
            if ($old_path) {
                unlink($old_path);
            }
            $val = $this->settings_model->uploadImage('logo'); // upload the image
            $val == true || redirect('admin/dashboard/general_settings');
            $data['logo'] = $val['path'];
            $data['full_path'] = $val['fullPath'];
        }
        $this->settings_model->save($data, $id); // save
        // redirect with msg
        $type = 'success';
        $message = 'Business Information Successfully Save!';
        set_message($type, $message);
        redirect('admin/settings/business_profile');
    }

    /*** New Tax Rule ***/
    public function tax($id = null)
    {
        $this->tbl_tax('tax_id');
        $data['tax_info'] = $this->global_model->get();

        if (!empty($id)) { //condition check
            $where = array('tax_id' => $id);
            $data['tax'] = $this->settings_model->check_by($where, 'tbl_tax');

            if (empty($data['tax'])) {
                // massage
                $type = 'error';
                $message = 'No Record Found';
                set_message($type, $message);
                redirect('admin/settings/tax');
            }
        }

        //view page
        $data['title'] = 'Manage Tax Rules';
        $data['subview'] = $this->load->view('admin/settings/tax', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save tax rule ***/
    public function save_tax($id = null)
    {
        $this->tbl_tax('tax_id');
        $data = $this->settings_model->array_from_post(array('tax_title', 'tax_rate', 'tax_type'));

        // update root category
        $where = array('tax_title' => $data['tax_title']);
        // duplicate value check
        if (!empty($id)) {
            $tax_id = array('tax_id !=' => $id);
        } else {
            $tax_id = null;
        }

        // duplicate value check
        $check_category = $this->settings_model->check_update('tbl_tax', $where, $tax_id);
        if (!empty($check_category)) {
            $type = 'error';
            $message = 'Tax Rule Already Exist!';
        } else { // save and update
            $this->global_model->save($data, $id);
            // massage
            $type = 'success';
            $message = 'Tax Rule Saved Successfully!';
        }
       
        set_message($type, $message);
        redirect('admin/settings/tax');
    }

    /*** Delete Tax Rule ***/
    public function delete_tax($id=null){
        $this->tbl_tax('tax_id');
        $this->global_model->delete($id);
        $this->message->delete_success('admin/settings/tax');
    }



    public function localisation(){
        $data['title'] = 'Localisation Settings';

        $data['localization']   = $this->db->get_where('tbl_localization', array(
            'localization_id' => 1
        ))->row();

        $data['timezoneList'] =$this->timezoneList();
        $data['subview'] = $this->load->view('admin/settings/localisation', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    
    /*** New Alert Rule ***/
    public function alert($id = null)
    {
        $this->tbl_alerts_config('alert_id');
        $data['alert_info'] = $this->global_model->get();

        if (!empty($id)) { //condition check
            $where = array('alert_id' => $id);
            $data['alert'] = $this->settings_model->check_by($where, 'tbl_alerts_config');

            if (empty($data['alert'])) {
                // massage
                $type = 'error';
                $message = 'No Record Found';
                set_message($type, $message);
                redirect('admin/settings/alert');
            }
       }

        //view page
        $data['title'] = 'Manage Alert Rules';
        $data['subview'] = $this->load->view('admin/settings/alert', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save alert rule ***/
    public function save_alert($id = null)
    {
        $this->tbl_alerts_config('alert_id');
        $data = $this->settings_model->array_from_post(array('days','alert_type'));

        // update root category
        $where = array('days' => $data['days'],'alert_type'=>$data['alert_type']);
        
        $where2 = array('alert_type' => $data['alert_type']);
        // duplicate value check
        if (!empty($id)) {
            $alert_id = array('alert_id !=' => $id);
        } else {
            $alert_id = null;
        }

        // duplicate value check
        $check_category = $this->settings_model->check_update('tbl_alerts_config', $where, $alert_id);
        $check_category2 = $this->settings_model->check_update('tbl_alerts_config', $where2, $alert_id);
        
        if (!empty($check_category)||!empty($check_category2)) {
            $type = 'error';
            $message = 'Alert Rule Already Exist!';
        } else { // save and update
        	
            $this->global_model->save($data, $id);
            // massage
            $type = 'success';
            $message = 'Alert Rule Saved Successfully!';
        }
        set_message($type, $message);
        
       redirect('admin/settings/alert');
    }

    /*** Delete alert Rule ***/
    public function delete_alert($id=null){
        $this->tbl_alerts_config('alert_id');
        $this->global_model->delete($id);
        $this->message->delete_success('admin/settings/alert');
    }
    
 

    public function save_localization($id = null){
        $data = $this->settings_model->array_from_post(array('timezone', 'country', 'date_format','currency_format','currency','language'));

        if($id==null){
            $this->db->insert('tbl_localization', $data);
        }else{
            $this->db->where('localization_id', $id);
            $this->db->update('tbl_localization', $data);
        }
        $this->message->save_success('admin/settings/localisation');
    }
    
    /*** Create branch ***/
    public function branch($id = null)
    {
        $this->settings_model->_table_name = 'tbl_branch';
        $this->settings_model->_order_by   = 'branch_id';
        $data['all_branch']                = $this->settings_model->get();
        // edit operation of branch
        if (!empty($id)) { // if branch id exist
            $where            = array(
                'branch_id' => $id
            );
            $data['branch_info'] = $this->settings_model->check_by($where, 'tbl_branch');
            if (empty($data['branch_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/settings/branch');
            }
        }
        //view page
        $data['title']   = 'Create Branch';
        $data['subview'] = $this->load->view('admin/settings/branch', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
    public function save_branch($id = null)
    {
        $this->settings_model->_table_name  = 'tbl_branch';
        $this->settings_model->_primary_key = 'branch_id';
        $data['branch_name']              = $this->input->post('branch_name', true);
        $data['branch_location']              = $this->input->post('branch_location', true);
        // update branch
        $where                                = array(
            'branch_name' => $data['branch_name']
        );
        // duplicate check
        if (!empty($id)) {
            $branch_id = array(
                'branch_id !=' => $id
            );
        } else {
            $branch_id = null;
        }
        $check_branch = $this->settings_model->check_update('tbl_branch', $where, $branch_id);
        if (!empty($check_branch)) { // if exist
            $type    = 'error';
            $message = 'Branch Information Already Exist';
        } else { // save and update query
            $this->settings_model->save($data, $id); //save and update
            // massage for employee
            $type    = 'success';
            $message = 'Branch Information Successfully Saved';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/settings/branch');
    }


    /**
     * Return an array of timezones
     *
     * @return array
     */
    function timezoneList()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));

        $tempTimezones = array();
        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);

            $tempTimezones[] = array(
                'offset' => (int)$currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            );
        }

        
    function sorter($a, $b) {
            return ($a['offset'] == $b['offset'])
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        }
        
        
       // Sort the array by offset,identifier ascending
        usort($tempTimezones, "sorter");
        

        $timezoneList = array();			
        foreach ($tempTimezones as $tz) {
            $sign = ($tz['offset'] > 0) ? '+' : '-';
            $offset = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
                $tz['identifier'];
        }

        return $timezoneList;
    }



}