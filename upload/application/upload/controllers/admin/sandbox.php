 public function collateral_assign($id)
    {
        $data['collateral'] = $this->collateral_model->get_collateral_information_by_id($id);
      
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by = 'user_id';
        $data['all_employee_info'] = $this->user_model->get();
        
        $data['title'] = 'View collateral';
        $data['collateral_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/collateral/_modal_assign_collateral', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

  /*** collateral deactivate ***/
    public function save_collateral_assign()
    {
    	
            $id = $this->input->post('collateral_id', true);
                        
            $data['collateral_assigned_date'] = $this->input->post('collateral_assigned_date', true);
            $data['collateral_assigned_to']=$this->input->post('collateral_assigned_to', true);
            $data['collateral_assignee'] = $this->session->userdata('name');

            //mark status in use
            $data['status'] ='In use';
            
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
                    
            $this->message->custom_success_msg('admin/collateral/manage_collateral', 'collateral assigned succesfully!');
    }