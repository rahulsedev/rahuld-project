<style>
input.calendercstm {
    border: 1px solid #D9D9D9;
    border-radius: 4px;
    color: #000000;
    float: left;
    font-size: 13px;
    height: 27px;
    padding: 3px 6px;
    position: relative;
    width: 185px;
}
</style>
<div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
    <ul class="breadcrumb col-sm-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li class="active"><?php echo $title_for_layout?></li>
    </ul>
</div> <!-- breadcrumbs end -->

<div class="clearfix"></div>	

<?php // listing code goes here,...?>
<div class="container-fluid"> <!-- container-fluid start -->
    <div class="pull-right user-btn">
        <?php echo $this->Html->link('Add New', array('controller' => 'vendors', 'action' => 'addmasterpurchase', 'admin' => true), array('escape' => false, 'class' => 'btn btn-info', 'title' => 'Add New User', 'id' => 'addAdmin')); ?>
    </div>
    <div class="clearfix"></div>	
    <div class="panel panel-default table-margin">
        <div class="panel-heading">
            <div class="pull-left panel-title text-user">
                <?php echo $title_for_layout?>
            </div>
            <div class="pull-right">
                <?php echo $this->Form->create('vendors', array('action' => 'listmasters', 'type' => "GET"), array('class' => "control-group")); ?>
                <?php
                if (isset($_GET['search']) && trim($_GET['search']) != '') {
                    $val = $_GET['search'];
                } else {
                    $val = '';
                }?>
                <div data-date-format="dd-mm-yyyy" data-date="" id="dp3" class="input-append date" style="display: inline;">
                    <?php
                        echo $this->Form->input('User.start_date', array('type' => 'text', 'value' => @$_GET['start_date'], 'placeholder' => "Start date", 'class' => 'calendercstm form-control datepicker_serach', 'maxlength' => 100, 'label' => false, 'div' => false, 'readonly'=>true));
                    ?>
                </div>
                
                <div data-date-format="dd-mm-yyyy" data-date="" id="dp4" class="input-append date" style="display: inline;">
                    <?php
                        echo $this->Form->input('User.end_date', array('type' => 'text', 'value' => @$_GET['end_date'], 'placeholder' => "End date", 'class' => 'calendercstm form-control datepicker_serach', 'maxlength' => 100, 'label' => false, 'div' => false, 'style'=>'margin-left:4px;', 'readonly'=>true));
                    ?>
                </div>                
                <?php
                echo $this->Form->input('User.search', array('type' => 'text', 'value' => $val, 'placeholder' => "Search Master", 'class' => 'search form-control', 'maxlength' => 100, 'label' => false, 'div' => false, 'style'=>'margin-left:4px;'));
                ?>
                <button type="submit" class="btn btn-primary search-btn" >Search</button>
                <?php echo $this->Form->end(); ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body"> 
            <div class="table-responsive">                                                         
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->Paginator->sort('Vendor.name', 'Vendor Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('expense_type', 'ExpenseT ype'); ?></th>
                            <th><?php echo $this->Paginator->sort('material', 'Material'); ?></th>
                            <th><?php echo $this->Paginator->sort('quantity', 'Quantity'); ?></th>
                            <th><?php echo $this->Paginator->sort('added_date', 'Date'); ?></th>
                            <th><?php echo $this->Paginator->sort('UserType.added_by', 'Added By'); ?></th>
                            <th><?php echo $this->Paginator->sort('created', 'Added On'); ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($data) && !empty($data)) {
                            foreach ($data as $key => $processData) {
                                ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $processData['Vendor']['name']; ?></td>
                                    <td><?php echo $processData['VendorMaster']['expense_type']; ?></td>
                                    <td><?php echo $processData['VendorMaster']['material']; ?></td>
                                    <td align="center"><?php echo $processData['VendorMaster']['quantity']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($processData['VendorMaster']['added_date'])); ?></td>
                                    <td><?php echo $processData['User']['full_name']."(".$processData['UserType']['name'].")"; ?></td>
                                    <!--td><?php // echo ($processData['VendorMaster']['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?></td-->
                                    <td><?php echo date(Configure::read('DISPLAY_DATETIME.DateTime'), strtotime($processData['VendorMaster']['created'])); ?></td>
                                    <td>
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-search text-color"></i>', array('controller' => 'vendors', 'action' => 'viewmaster', base64_encode($processData['VendorMaster']['id']), 'admin' => true), array('escape' => false, 'class' => 'btn btn-sm btn-default viewUserRow', 'title' => 'View master details',)); ?>
                                        <?php // echo $this->Html->link('<i class="glyphicon glyphicon-pencil text-color"></i>', array('controller' => 'users', 'action' => 'editadmin', base64_encode($processData['VendorMaster']['id'])), array('escape' => false, 'class' => 'btn btn-sm btn-default editRow', 'title' => 'Edit User')); ?>				
                                        <?php
                                        /*if ($processData['VendorMaster']['status'] == 1) {
                                            echo $this->Html->link('<i class="glyphicon glyphicon-ok-circle"></i>', array('controller' => 'users', 'action' => 'blockadmin', base64_encode($processData['VendorMaster']['id']), 'block'), array('data-username' => $processData['VendorMaster']['first_name'] . ' ' . $processData['VendorMaster']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Deactivate Administrator'));
                                        } else {
                                            echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i>', array('controller' => 'users', 'action' => 'blockadmin', base64_encode($processData['VendorMaster']['id']), 'unblock'), array('data-username' => $processData['VendorMaster']['first_name'] . ' ' . $processData['VendorMaster']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Activate Administrator'));
                                        }*/
                                        ?>
                                        <?php // echo $this->Html->link('<i class="glyphicon glyphicon-trash text-color"></i>', 'javascript:void(0)', array('data-name' => $processData['VendorMaster']['first_name'] . ' ' . $processData['VendorMaster']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default delete', 'title' => 'Delete User', 'data-href' => $this->Html->url(array('controller' => 'users', 'action' => 'deleteadmin', base64_encode($processData['VendorMaster']['id']))))); ?>
                                    </td> 
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="9"><div class="norecord">No Record Found</div></td></tr>';
                        }
                        ?>		
                    </tbody>
                </table>		

            </div>
            <div class="row clearfix">

                <div class="col-xs-12">
                    <?php if ($this->Paginator->counter('{:pages}') > 1) { ?>
                        <ul class="pagination pull-right">
                            <?php
                            echo $this->Paginator->prev(__('«'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                            echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                            echo $this->Paginator->next(__('»'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                            ?>
                        </ul>
                    <?php } ?>			  
                </div>
            </div>	    
        </div><!-- panel-body end -->
    </div>                                                  

</div> <!-- container fluid end -->


<?php // listing code goes here,...?>

<!-- Modal Block/Unblock Client -->
<div id="BlockUnblock" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Active/Inactive Administrator</h4>
            </div>
            <div class="modal-body">
                Are you sure want to <span>Active/Inactive</span> "<strong>selected record</strong>" from administrators list?	
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">NO</a>
                <a href="#" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Block/Unblock Client -->

<!-- Modal Delete -->

<!-- Modal Block/Unblock Client -->
<div id="TrustedUnTrusted" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Trusted/Untrusted Administrator</h3>
            </div>
            <div class="modal-body">
                <center>
                    Are you sure want to <span>trusted</span> "<strong>selected user</strong>" from administrators list?	
                </center>	
            </div>
            <div class="modal-footer">
                <center>
                    <a href="#" class="btn btn-default" data-dismiss="modal">NO</a>
                    <a href="#" class="btn btn-primary">Yes</a>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete -->

<div id="DeleteModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Administrator</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete "<strong>selected user</strong>" from administrators list?
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">NO</a>
                <a href="#" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Client -->
<div class="clearfix"></div>
<?php ?>

<?php echo $this->Element('admin/addVendorMasterAccount'); ?>
<!-- Modal Edit Client -->
<?php echo $this->Element('admin/viewVendorMasterAccount'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        //$('.checkbox').prettyCheckable();        
        $(".block").click(function(event) {
            event.preventDefault();
            if ($(this).children('i').hasClass('icon-color')) {
                var bl = 'activate';
                var title = 'Activate Administrator';
            } else {
                var bl = 'deactivate';
                var title = 'Deactivate Administrator';
            }
            $message = 'Are you sure want to ' + bl + ' "<strong>' + $(this).attr('data-username') + '</strong>" from administrators list?';
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-body').html($message);
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-header h4').html(title);
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-footer > a.btn-primary').attr('href', $(this).attr('href'));
            $('#BlockUnblock').modal('show');
        });

        $(".delete").click(function(event) {
            event.preventDefault();
            $('#DeleteModel > div.modal-dialog > div.modal-content > div.modal-body > strong').html($(this).attr('data-name'));
            $('#DeleteModel > div.modal-dialog > div.modal-content > div.modal-footer > a.btn-primary').attr('href', $(this).attr('data-href'));
            $('#DeleteModel').modal('show');
        });

        $(".trusted").click(function(event) {
            event.preventDefault();
            if ($(this).children('img').hasClass('open1')) {
                var bl = 'Regular(Less Privileges)';

            } else {
                var bl = 'Trusted(Full Privileges)';

            }
            $message = 'Are you sure want to make <strong>' + $(this).attr('data-username') + '</strong> as <strong>' + bl + '</strong> Admin ?';
            $('#TrustedUnTrusted > div.modal-dialog > div.modal-content > div.modal-body > center').html($message);
            $('#TrustedUnTrusted > div.modal-dialog > div.modal-content > div.modal-footer > center > a.btn-primary').attr('href', $(this).attr('href'));
            $('#TrustedUnTrusted').modal('show');
        });

        $("#addAdmin").click(function(event) {
            event.preventDefault();
            $('#AddAdminModel').modal('show');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker_serach').datepicker({format: 'dd/mm/yyyy'});
    });
</script>