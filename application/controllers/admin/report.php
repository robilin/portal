<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
date_default_timezone_set('Africa/Dar_es_Salaam');
/*
 *	@author : Venance Edson
 *  @support: support@xchangewallet.com
 *	date	: dec, 2016
 *	TemboPos
 *	http://www.xchangewallet.com
 *  version: 1.0
 */

class Report extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
        $this->load->model('global_model');
    }


    /*** Sales Report ***/
    public function sales_report()
    {
        $data['title'] = 'View Sales Report';

        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);

        // report date
        $data['start_date'] = date('Y-m-d', strtotime($start_date));
        $data['end_date'] = date('Y-m-d', strtotime($end_date));
        // invoice information
        $invoice = $this->report_model->get_invoice_by_date($data['start_date'], $data['end_date']);

        if (!empty($invoice)) {
            $this->tbl_order_details('order_details_id');
            foreach ($invoice as $v_invoice) {
                $data['invoice_details'][$v_invoice->invoice_no] = $this->global_model->get_by(array('order_id' => $v_invoice->order_id),
                    false);
                $data['order'][] = $v_invoice;
            }
        }

        $data['subview'] = $this->load->view('admin/report/sales_report', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Generate PDF Sales Report ***/
    public function pdf_sales_report()
    {
        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);


        $data['start_date'] = date('Y-m-d', strtotime($start_date));
        $data['end_date'] = date('Y-m-d', strtotime($end_date));
        // invoice information
        $invoice = $this->report_model->get_invoice_by_date($data['start_date'], $data['end_date']);

        if (!empty($invoice)) {
            $this->tbl_order_details('order_details_id');
            foreach ($invoice as $v_invoice) {
                $data['invoice_details'][$v_invoice->invoice_no] = $this->global_model->get_by(array('order_id' => $v_invoice->order_id),
                    false);
                $data['order'][] = $v_invoice;
            }
        }

        foreach ($data['invoice_details'] as $invoice => $v_order) {
            $buying_price = 0;
            foreach ($v_order as $v_order_details) {

                $buying_price += $v_order_details->buying_price;
            }
            $data['total_buying'][] = $buying_price;
        }

        $html = $this->load->view('admin/report/sales_report_pdf', $data, true);


        $filename = 'Sales_Report.pdf';
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822));
        $pdf->WriteHTML($html);
        $pdf->Output($filename, 'D');

    }

    /*** purchase Report ***/
    public function purchase_report()
    {
        $data['title'] = 'View Purchase Report';

        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);

        // report date
        $data['start_date'] = date('Y-m-d', strtotime($start_date));
        $data['end_date'] = date('Y-m-d', strtotime($end_date));
        // invoice information
        $invoice = $this->report_model->get_purchase_by_date($data['start_date'], $data['end_date']);


        if (!empty($invoice)) {
            $this->tbl_purchase_product('purchase_product_id');
            foreach ($invoice as $v_invoice) {
                $data['purchase_details'][$v_invoice->purchase_order_number] = $this->global_model->get_by(array('purchase_id' => $v_invoice->purchase_id),
                    false);
                $data['purchase'][] = $v_invoice;
            }
        }


        $data['subview'] = $this->load->view('admin/report/purchase_report', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** PDF Purchase Report ***/
    public function pdf_purchase_report()
    {
        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);


        $data['start_date'] = date('Y-m-d', strtotime($start_date));
        $data['end_date'] = date('Y-m-d', strtotime($end_date));

        $invoice = $this->report_model->get_purchase_by_date($data['start_date'], $data['end_date']);


        if (!empty($invoice)) {
            $this->tbl_purchase_product('purchase_product_id');
            foreach ($invoice as $v_invoice) {
                $data['purchase_details'][$v_invoice->purchase_order_number] = $this->global_model->get_by(array('purchase_id' => $v_invoice->purchase_id),
                    false);
                $data['purchase'][] = $v_invoice;
            }
        }



        $html = $this->load->view('admin/report/purchase_report_pdf', $data, true);


        $filename = 'Purchase_Report.pdf';
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
        $pdf->WriteHTML($html);
        $pdf->Output($filename, 'D');

    }



    function stock_report()
    {
        $data['title'] = 'Stock Summary Report';
        $data['stock'] = $this->db->select('tbl_product.*, tbl_inventory.product_quantity, tbl_product_price.buying_price')
            ->from('tbl_product')
            ->where('can_be_sold',1)
            ->join('tbl_inventory', 'tbl_inventory.product_id = tbl_product.product_id', 'left')
            ->join('tbl_product_price', 'tbl_product_price.product_id = tbl_product.product_id', 'left')
            ->get()
            ->result();


        $data['subview'] = $this->load->view('admin/report/stock', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    function material_report()
    {
        $data['title'] = 'Materials Summary Report';
        $data['stock'] = $this->db->select('tbl_product.*, tbl_inventory.product_quantity, tbl_product_price.buying_price')
            ->from('tbl_product')
            ->where('can_be_sold',0)
            ->join('tbl_inventory', 'tbl_inventory.product_id = tbl_product.product_id', 'left')
            ->join('tbl_product_price', 'tbl_product_price.product_id = tbl_product.product_id', 'left')
            ->get()
            ->result();


        $data['subview'] = $this->load->view('admin/report/material', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function sales_summery_report()
    {
        $data['title'] = 'Sales Summery Report';

        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);

        // report date
        $data['start_date'] = date('Y-m-d', strtotime($start_date));
        $data['end_date'] = date('Y-m-d', strtotime($end_date));

        // invoice information
        $invoice = $this->report_model->get_invoice_by_date($data['start_date'], $data['end_date']);


        if (!empty($invoice)) {
            $this->tbl_order_details('order_details_id');
            foreach ($invoice as $v_invoice) {
                $data['invoice_details'][$v_invoice->invoice_no] = $this->global_model->get_by(array('order_id' => $v_invoice->order_id),
                    false);
                $data['order'][] = $v_invoice;
            }
        }


        $data['subview'] = $this->load->view('admin/report/sales_summery_report', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }




}
