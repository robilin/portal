    public function save_branch($id = null)
    {
        $this->settings_model->_table_name  = 'tbl_branch';
        $this->settings_model->_primary_key = 'branch_id';
        $data['branch_name']              = $this->input->post('branch_name', true);
        $data['price']              = $this->input->post('price', true);
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
        $check_branch = $this->branch_model->check_update('tbl_branch', $where, $branch_id);
        if (!empty($check_branch)) { // if exist
            $type    = 'error';
            $message = 'branch branch Information Already Exist';
        } else { // save and update query
            $this->branch_model->save($data, $id); //save and update
            // massage for employee
            $type    = 'success';
            $message = 'branch Information Successfully Saved';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/settings/branch');
    }