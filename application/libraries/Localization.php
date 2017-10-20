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

class Localization
{

    public function currencyFormat($currency)
    {
        $localization = $_SESSION["localization"];
        if (!empty($localization->currency)) {
            $currencySymbol = $localization->currency;
        }else{
            $currencySymbol = '$';
        }

        if(!empty($localization)){

            $currency_format = $localization->currency_format;
            if($currency_format == 1){
                return $currencySymbol.' '.number_format($currency, 2, '.', '');
            }
            elseif($currency_format == 2)
            {
                return $currencySymbol.' '.number_format($currency, 2, '.', ',');
            }
            elseif($currency_format == 3)
            {
                return $currencySymbol.' '.number_format($currency, 2, ',', '');
            }
            elseif($currency_format == 4)
            {
                return $currencySymbol.' '.number_format($currency, 2, ',', '.');
            }else{
                return $currencySymbol.' '.number_format($currency);
            }

        }else{
            return $currencySymbol.' '.number_format($currency, 2, '.', ',');
        }

    }


    public function currency($currency)
    {
        $localization = $_SESSION["localization"];

        if(!empty($localization)){

            $currency_format = $localization->currency_format;
            if($currency_format == 1){
                return number_format($currency, 2, '.', '');
            }
            elseif($currency_format == 2)
            {
                return number_format($currency, 2, '.', ',');
            }
            elseif($currency_format == 3)
            {
                return number_format($currency, 2, ',', '');
            }
            elseif($currency_format == 4)
            {
                return number_format($currency, 2, ',', '.');
            }else{
                return number_format($currency);
            }

        }else{
            return number_format($currency, 2, '.', ',');
        }

    }


    public function dateFormat($date=null)
    {

        $localization = $_SESSION["localization"];
        if(!empty($localization)){
            $date_format = $localization->date_format;
            if(empty($date)){
                return $date_format;
            }

            if($date_format == 'dd/mm/yyyy'){
                return date('d/m/Y', strtotime($date));
            }elseif($date_format == 'dd.mm.yyyy'){
                return date('d.m.Y', strtotime($date));
            }elseif($date_format == 'dd-mm-yyyy'){
                return date('d-m-Y', strtotime($date));
            }elseif($date_format == 'mm/dd/yyyy'){
                return date('m/d/Y', strtotime($date));
            }elseif($date_format == 'yyyy/mm/dd'){
                return date('Y/m/d', strtotime($date));
            }elseif($date_format == 'yyyy-mm-dd'){
                return date('Y-m-d', strtotime($date));
            }elseif($date_format == 'M d yyyy'){
                return date('M d Y', strtotime($date));
            }else{
                return date('d M Y', strtotime($date));
            }
        }else{
            return date('Y/m/d', strtotime($date));
        }
    }

    public function currencySymbol()
    {
        $localization = $_SESSION["localization"];
        if (!empty($localization->currency)) {
            return $localization->currency;
        }

        return '$';
    }

    public function profile($prm)
    {
        $CI = &get_instance();
        $info = $CI->session->userdata('business_info');

        //logo
        if(!empty($info->logo)){
            $logo = base_url().$info->logo;
        }else{
            $logo = 'img/logo.png';
        }

        //company details
        if(!empty($info->company_name)){
            $company_name = $info->company_name;
        }else{
            $company_name = 'Your Company Name';
        }

        //company phone
        if(!empty($info->phone)){
            $company_phone = $info->phone;
        }else{
            $company_phone = 'Company Phone';
        }

        //company email
        if(!empty($info->email)){
            $company_email = $info->email;
        }else{
            $company_email = 'Company Email';
        }
        //company address
        if(!empty($info->address)){
            $address = $info->address;
        }else{
            $address = 'Company Address';
        }

        switch ($prm) {
            case "logo":
                return $logo;
                break;
            case "company_name":
                return $company_name;
                break;
            case "company_phone":
                return $company_phone;
                break;
            case "company_email":
                return $company_email;
                break;
            case "address":
                return $address;
                break;
        }
    }

    public function orderNo()
    {
        $CI = &get_instance();
        $sysOrdNo =1000;
        $CI->db->select_max('order_id');
        $lastId = $CI->db->get('tbl_order')->row()->order_id;
        return $orderNo = $sysOrdNo + $lastId + 1;

    }

    public function customerNo()
    {
        $CI = &get_instance();
        $CI->db->select_max('customer_id');
        $lastId = $CI->db->get('tbl_customer')->row()->customer_id;
        return $customerNo = 100 + $lastId + 1;

    }

    public function purchaseNo()
    {
        $CI = &get_instance();
        $CI->db->select_max('purchase_id');
        $lastId = $CI->db->get('tbl_purchase')->row()->purchase_id;
        return $purchaseNo = 100 + $lastId + 1;

    }

    public function settingsOption($prm)
    {
        $CI = &get_instance();

        $settings = $_SESSION["settings"];
        if($prm == 'ordPrefix'){
            return  $settings->ord_prefix;
        }elseif($prm == 'invPrefix'){
            return  $settings->inv_prefix;
        }elseif($prm == 'orderNo'){
            $sysOrdNo = $settings->inv_start;
            $CI->db->select_max('order_id');
            $lastId = $CI->db->get('tbl_order')->row()->order_id;
            return $orderNo = $sysOrdNo + $lastId + 1;
        }elseif($prm == 'logo'){
            return  $settings->logo;
        }
    }

}