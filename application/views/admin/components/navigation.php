<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <?php $user_pic = $this->session->userdata('user_pic'); ?>
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php if(!empty($user_pic)){ ?>
                    <img src="<?php echo base_url() .$user_pic ?>" class="img-circle" alt="User Image" />
                    <?php }else{ ?>
                        <img src="<?php echo base_url()  ?>img/user.jpg" class="img-circle" alt="User Image" />
                    <?php }?>
                </div>
                <div class="pull-left info" style="padding-top: 15px">
                    <p><?php echo $this->session->userdata('name') ?></p>
                </div>
            </div>
            <?php echo $this->menu->dynamicMenu(); ?>
        </section>
    </aside>