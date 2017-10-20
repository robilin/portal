<?php $this->load->view('admin/components/admin-header'); ?>
<body class="skin-blue" data-baseurl="<?php echo base_url(); ?>">
    <div class="wrapper">
        
    <?php $this->load->view('admin/components/user_profile'); ?>
       
        <!-- Left side column. contains the logo and sidebar -->


        <div class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <ol class="breadcrumb">
                    <?php echo $this->breadcrumbs->build_breadcrumbs(); ?>
                </ol>
            </section>

            <br/>
            <div class="container-fluid">
                <?php echo $subview ?>
            </div>

            <br />


        </div><!-- /.right-side -->

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
