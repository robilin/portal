<?php $this->load->view('admin/components/header'); ?>
<style>
.content-wrapper,
.right-side {
  min-height: 100%;
  background-color: #7F858F;
  z-index: 800;
}

</style>
<body class="skin-green" data-baseurl="<?php echo base_url(); ?>">
    <div class="wrapper">
        
    <?php $this->load->view('admin/components/public_user_profile'); ?>
       
        <!-- Left side column. contains the logo and sidebar -->


        <div class="right-side">
            

            <br/>
            <div class="container-fluid">
                <?php echo $subview ?>
            </div>

            <br />


        </div><!-- /.right-side -->
</div>
        <?php $this->load->view('admin/_layout_modal'); ?>
        <?php $this->load->view('admin/_layout_modal_small'); ?>
        <?php $this->load->view('admin/components/footer'); ?>

        <script>
            $('.content-wrapper').css({"margin-left":"0px"});
            $('.right-side').css({"margin-left":"0px"});
            $('.main-footer').css({"margin-left":"0px"});
            $('.wrapper').css({"background":"#ECF0F5"});
            $('.skin-blue').css({"background":"#ECF0F5"});
        </script>
