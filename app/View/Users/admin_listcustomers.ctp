<div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
    <ul class="breadcrumb col-sm-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li class="active"><?php echo $title_for_layout;?></li>
    </ul>
</div> <!-- breadcrumbs end -->

<div class="clearfix"></div>	

<?php // listing code goes here,...?>
<div class="container-fluid"> <!-- container-fluid start -->
    <div class="pull-right user-btn">&nbsp;</div>
    <div class="clearfix"></div>	
    <div class="panel panel-default table-margin">
        <div class="panel-heading">
            <div class="pull-left panel-title text-user">
                <?php echo $title_for_layout;?>
            </div>
            <div class="pull-right">
                <?php echo $this->Form->create('users', array('action' => 'listcustomers', 'type' => "GET"), array('class' => "control-group")); ?>
                <?php
                if (isset($_GET['search']) && trim($_GET['search']) != '') {
                    $val = $_GET['search'];
                } else {
                    $val = '';
                }
                echo $this->Form->input('Customer.search', array('type' => 'text', 'value' => $val, 'placeholder' => "Search Customers", 'class' => 'search form-control', 'maxlength' => 100, 'label' => false, 'div' => false));
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
                            <th><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
                            <th><?php echo $this->Paginator->sort('service_type', 'Service Type'); ?></th>
                            <th><?php echo $this->Paginator->sort('payment_status', 'Payment Status'); ?></th>
                            <th><?php echo $this->Paginator->sort('last_login', 'Last Login'); ?></th>
                            <th><?php echo $this->Paginator->sort('status', 'Status'); ?></th>	    
                            <th><?php echo $this->Paginator->sort('modified', 'Last Modified'); ?></th>
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
                                    <td><?php echo $processData['Customer']['full_name']; ?></td>
                                    <td><?php echo $processData['Customer']['email']; ?></td>
                                    <td><?php echo $processData['Customer']['service_type']=="d"?"Day Trading":"Short-Term Trading"; ?></td>
                                    <td><?php echo $processData['Customer']['payment_status']!=""?$processData['Customer']['payment_status']:"-N/A-"; ?></td>
                                    <td><?php echo $processData['Customer']['last_login']!='0000-00-00 00:00:00'?date(Configure::read('DISPLAY_DATETIME.DateTime'), strtotime($processData['Customer']['last_login'])):'-'; ?></td>
                                    <td><?php echo ($processData['Customer']['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?></td>
                                    <td><?php echo date(Configure::read('DISPLAY_DATETIME.DateTime'), strtotime($processData['Customer']['modified'])); ?></td>
                                    <td>
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-search text-color"></i>', array('controller' => 'users', 'action' => 'viewCustomer', base64_encode($processData['Customer']['id']), 'admin' => true), array('escape' => false, 'class' => 'btn btn-sm btn-default viewCustomerRow', 'title' => 'View Customer Details',)); ?>
                                    
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil text-color"></i>', array('controller' => 'users', 'action' => 'editCustomer', base64_encode($processData['Customer']['id'])), array('escape' => false, 'class' => 'btn btn-sm btn-default editRow', 'title' => 'Edit Customer')); ?>				
                                        <?php
                                        if ($processData['Customer']['status'] == 1) {
                                            echo $this->Html->link('<i class="glyphicon glyphicon-ok-circle"></i>', array('controller' => 'users', 'action' => 'blockcustomer', base64_encode($processData['Customer']['id']), 'block'), array('data-username' => $processData['Customer']['first_name'] . ' ' . $processData['Customer']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Deactivate Customer'));
                                        } else {
                                            echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i>', array('controller' => 'users', 'action' => 'blockcustomer', base64_encode($processData['Customer']['id']), 'unblock'), array('data-username' => $processData['Customer']['first_name'] . ' ' . $processData['Customer']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Activate Customer'));
                                        }
                                        ?>
                                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-trash text-color"></i>', 'javascript:void(0)', array('data-name' => $processData['Customer']['first_name'] . ' ' . $processData['Customer']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default delete', 'title' => 'Delete Customer', 'data-href' => $this->Html->url(array('controller' => 'users', 'action' => 'deletecustomer', base64_encode($processData['Customer']['id']))))); ?>
                                    </td> 
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="8"><div class="norecord">No Record Found</div></td></tr>';
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
                <h4 class="modal-title" id="myModalLabel">Active/Inactive Customer</h4>
            </div>
            <div class="modal-body">
                Are you sure want to <span>Active/Inactive</span> "<strong>selected record</strong>" from customers list?	
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
                <h3>Trusted/Untrusted Customer</h3>
            </div>
            <div class="modal-body">
                <center>
                    Are you sure want to <span>trusted</span> "<strong>selected user</strong>" from customers list?	
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
                <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete "<strong>selected user</strong>" from customers list?
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

<?php echo $this->Element('admin/editCustomer'); ?>
<?php echo $this->Element('admin/viewCustomer'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        //$('.checkbox').prettyCheckable();        
        $(".block").click(function(event) {
            event.preventDefault();
            if ($(this).children('i').hasClass('icon-color')) {
                var bl = 'activate';
                var title = 'Activate Customer';
            } else {
                var bl = 'deactivate';
                var title = 'Deactivate Customer';
            }
            $message = 'Are you sure want to ' + bl + ' "<strong>' + $(this).attr('data-username') + '</strong>" from customers list?';
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