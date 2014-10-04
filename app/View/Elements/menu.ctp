<?php
$controller = $this->params['controller'];
$action = $this->params['action'];
switch ($controller) {   
}
$home=$admins=$products=$aboutus=$reports=$vm=$cm=$cmspages=$lc=$lv="";
switch ($action) {
    case 'dashboard':
        $home = 'active';
        break;
    case 'aboutus':
        $aboutus = 'active';
        break;
}
if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
    switch ($action) {
        case 'admin_dashboard':
        $home = 'active';
        break;
        case 'admin_listadmins':
            $admins = 'active';
            break;
        case 'admin_listproducts':
            $products = 'active';
            break;
        case 'admin_listmasterspurchase':
        case 'admin_listmasters':
        case 'admin_listcmasters':
            $cm=$vm=$reports = 'active';
            break;
        case 'admin_listvendors':
            $lv = 'active';
            break;
        case 'admin_listclients':
            $lc = 'active';
            break;
    }
}

$userType = "";
if($this->Session->check('User.User.user_type_id') && $this->Session->read('User.User.user_type_id')){
    $userType = $this->Session->read('User.User.user_type_id');
}
?>
<div class="navbar  navbar-bg container-fluid" role="navigation">
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">        
        
        <ul class="nav navbar-nav">
            
            <li class="<?php echo $home; ?>">
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-dashboard icon-white"></span> Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => false), array('title' => 'Home Dashboard', 'escape' => false, 'class' => '', 'id' => '')); ?>
            </li>
            
            <?php if(!empty($userType) && $userType==1) { ?>
            <li class="<?php echo $admins; ?>">
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> Administrators', array('controller' => 'users', 'action' => 'listadmins', 'admin' => true), array('title' => 'List Admins', 'escape' => false, 'class' => '', 'id' => '')); ?>
            </li>
            <?php } ?>

            <?php if(!empty($userType)) { ?>
                <?php if(!empty($userType) && $userType==1) { ?>
                <li class="dropdown <?php echo $reports; ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-original-title="" title="">
                        <span class="glyphicon glyphicon-retweet icon-white"></span> Reports
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link('Accounts', array('controller' => 'vendors', 'action' => 'listmasters', 'admin' => true), array('title' => 'List Product', 'escape' => false, 'class' => '', 'id' => '')); ?>
                        </li>
                        <li class="divider"></li>		
                        <li>
                            <?php echo $this->Html->link('Purchases', array('controller' => 'vendors', 'action' => 'listmasterspurchase', 'admin' => true), array('title' => 'List Product', 'escape' => false, 'class' => '', 'id' => '')); ?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?php echo $this->Html->link('Logistics', array('controller' => 'clients', 'action' => 'listcmasters', 'admin' => true), array('title' => 'List Product', 'escape' => false, 'class' => '', 'id' => '')); ?>
                        </li>					       
                    </ul>
                </li>
                <?php } ?>
                <?php if(!empty($userType) && ($userType==3)) { $lnk = "Purchases";$act = "listmasterspurchase";}else{ $lnk = "Accounts";$act = "listmasters"; }?>
                
                <?php if(!empty($userType) && ($userType==2 || $userType==3)) { ?>
                <li class="<?php echo $vm; ?>">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-file icon-white"></span> '.$lnk, array('controller' => 'vendors', 'action' => $act, 'admin' => true), array('title' => 'List Vendor Master', 'escape' => false, 'class' => '', 'id' => '')); ?>
                </li>
                <?php } ?>
                <?php if(!empty($userType) && ($userType==4)) { ?>
                <li class="<?php echo $cm; ?>">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-file icon-white"></span> Logistics', array('controller' => 'clients', 'action' => 'listcmasters', 'admin' => true), array('title' => 'List Client Master', 'escape' => false, 'class' => '', 'id' => '')); ?>
                </li>
                <?php } ?>
                
            <?php } ?>
            <?php if(!empty($userType) && ($userType==1 || $userType==4)) { ?>
            <li class="<?php echo $lc; ?>">
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-file icon-white"></span> Client Master', array('controller' => 'clients', 'action' => 'listclients', 'admin' => true), array('title' => 'List Client Master', 'escape' => false, 'class' => '', 'id' => '')); ?>
            </li>            
            <?php } ?>
            
            <?php if(!empty($userType) && ($userType==1 || $userType==2 || $userType==3)) { ?>
            <li class="<?php echo $lv; ?>">
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-file icon-white"></span> Vendor Master', array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true), array('title' => 'List Client Master', 'escape' => false, 'class' => '', 'id' => '')); ?>
            </li>            
            <?php } ?>
            
        </ul>
        <?php if(!empty($userType)) { // logged in ?>        
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-original-title="" title="">
                    <i class="glyphicon glyphicon-user"></i>
                    <?php echo @$Name; ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-lock icon-white"></span>Change Password', array('controller' => 'users', 'action' => 'changepassword', 'admin' => true), array('escape' => false, 'class' => '', 'title' => 'Change Password', 'id' => 'changePasswordTo')); ?>				    
                    </li>
                    <li class="divider"></li>
                    <li>
                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out icon-white"></span> Logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true), array('escape' => false)); ?>                                
                    </li>
                </ul>
            </li>    
        </ul>
        <?php } else { // logged out ?>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> <strong>Login</strong>', array('controller' => 'users', 'action' => 'login', 'admin' => true), array('title' => 'List Static Pages', 'escape' => false, 'class' => '', 'id' => '')); ?>
            </li>
        </ul>    
        <?php } ?>
    </nav>
</div> <!-- navbar end -->
<div class="modal fade" id="changePasswordModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-focus-on="#AddUserPassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo $this->Form->create('users', array('type' => 'POST', 'action' => 'changepassword', 'name' => 'changePassword', 'id' => 'changePassword', 'class' => 'form-horizontal', 'role' => 'form')); ?>	
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="AddUserPassword" class="col-sm-2 control-label">Old Password<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('User.old_password', array('type' => 'password', 'id' => 'OldUserPassword', 'label' => false, 'div' => false, 'required' => true, 'class' => 'form-control', 'minlength' => '6', 'maxlength' => 50, 'remote' => $this->Html->url(array('controller' => 'Users', 'action' => 'ajax_check_oldpassword', 'admin' => false)))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="AddUserPassword" class="col-sm-2 control-label">New Password<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('User.password', array('type' => 'password', 'id' => 'AddCUserPassword', 'label' => false, 'div' => false, 'required' => true, 'class' => 'form-control', 'minlength' => '6', 'maxlength' => 50)); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="AddUserCpassword" class="col-sm-2 control-label">Confirm New Password<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('User.cpassword', array('type' => 'password', 'id' => 'AddUserCpassword', 'label' => false, 'div' => false, 'maxlength' => 50, 'required' => true, 'class' => 'form-control', 'equalTo' => '#AddCUserPassword')); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button type="submit" id="singlebutton" class="btn btn-primary">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<!-- Calculator -->
<?php $this->Html->script('jquery.validate', array('inline' => false)); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#changePassword").validate();
        $('.dropdown').hover(function() {
            $('.dropdown-menu', this).toggle();
        });
    });
    $("#changePasswordTo").click(function(event) {
        event.preventDefault();
        $('#changePasswordModel').modal('show');
    });
</script>
<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            if (charCode == 46) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
</script>