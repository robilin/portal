 /*** Create budget ***/
    public function budget($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_order_by = 'money_manager_budget_id';
        $data['all_budget'] = $this->money_manager_model->get();
        // edit operation of budget
        if (!empty($id)) { // if budget id exist
            $where = array('money_manager_budget_id' => $id);
            $data['budget_info'] = $this->money_manager_model->check_by($where, 'tbl_money_manager_budget');

            if (empty($data['budget_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/money_manager/budget');
            }
        }

        //view page
        $data['title'] = 'Create money_manager budget';
  
        $data['subview'] = $this->load->view('admin/money_manager/budget', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save budget ***/
    public function save_budget($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_primary_key = 'money_manager_budget_id';

        $data['budget_name'] = $this->input->post('budget_name', true);

        // update budget
        $where = array('budget_name' => $data['budget_name']);
        // duplicate check
        if (!empty($id)) {
            $money_manager_budget_id = array('money_manager_budget_id !=' => $id);
        } else {
            $money_manager_budget_id = null;
        }

        $check_budget = $this->money_manager_model->check_update('tbl_money_manager_budget', $where, $money_manager_budget_id);
        if (!empty($check_budget)) { // if exist

            $type = 'error';
            $message = 'money_manager budget Information Already Exist';
        } else { // save and update query
            $this->money_manager_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'money_manager budget Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/budget');
    }

    /*** budget Delete ***/
    public function delete_budget($id)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_order_by = 'money_manager_budget_id';
        $where = array('money_manager_budget_id' => $id);
        $check_budget = $this->money_manager_model->get_by($where, false);

        if (empty($check_budget)) { // if exist
            $type = 'error';
            $message = 'budget Information does not exist :)';
        } else { // if empty
            $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
            $this->money_manager_model->_primary_key = 'money_manager_budget_id';
            $this->money_manager_model->delete($id);

            $type = 'success';
            $message = 'money_manager budget Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/budget');
    }