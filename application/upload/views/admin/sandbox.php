 /*** asset activate ***/
    public function active_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] = 1;
            $this->tbl_collateral('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Your asset Active Successfully!');
    }
    
    //
   public function collateral_with_customer($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='In stock';
            $this->tbl_collateral('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Your asset Active Successfully!');
    }
    
 //
   public function Confiscated_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Confiscated';
            $this->tbl_collateral('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
 //
   public function collateral_with_branch($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='With Branch';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
 //
   public function mark_stolen_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Stolen';
            $this->tbl_collateral('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    
  public function mark_damaged_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Damaged';
            $this->tbl_collateral('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    