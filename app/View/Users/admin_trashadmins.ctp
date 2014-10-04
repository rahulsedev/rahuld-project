<div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
    <ul class="breadcrumb col-sm-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li class="active">Trashed Administrators </li>
    </ul>
</div> <!-- breadcrumbs end -->

<div class="clearfix"></div>	

<?php // listing code goes here,...?>


<div class="container-fluid"> <!-- container-fluid start -->

    <div class="pull-right user-btn">
        <?php echo $this->Html->link('Back', array('controller' => 'users', 'action' => 'listadmins', 'admin' => true), array('escape' => false, 'class' => 'btn btn-info', 'title' => 'Back', 'id' => 'Back')); ?>
    </div>
    <div class="clearfix"></div>	
    <div class="panel panel-default table-margin">
        <div class="panel-heading">
            <div class="pull-left panel-title text-user">
                Trash Administrators
            </div>

            <div class="pull-right">
            </div>
            <div class="clearfix"></div>

        </div>

        <div class="panel-body"> 
            <div class="table-responsive">                                                         
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->Paginator->sort('first_name', 'First Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('last_name', 'Last Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_name', 'Username'); ?></th>
                            <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
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
                                    <td><?php echo $processData['User']['first_name']; ?></td>
                                    <td><?php echo $processData['User']['last_name']; ?></td>
                                    <td><?php echo $processData['User']['user_name']; ?></td>
                                    <td><?php echo $processData['User']['email']; ?></td>
                                    <td><?php echo date(Configure::read('DISPLAY_DATETIME.DateTime'), strtotime($processData['User']['modified'])); ?></td>
                                    <td>
                                        <?php echo $this->Html->link('RESTORE', 'javascript:void(0)', array('data-name' => $processData['User']['first_name'] . ' ' . $processData['User']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-info act_go', 'title' => 'Restore Administrator', 'data-href' => $this->Html->url(array('controller' => 'users', 'action' => 'restoreadmin', base64_encode($processData['User']['id']))))); ?>
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

<!-- Modal Trash -->
<div id="GoModal" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Restore Administrator</h4>
            </div>
            <div class="modal-body">
                Are you sure want to restore "<strong>selected user</strong>" from administrator list?
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

<script type="text/javascript">
    $(document).ready(function() {
        //$('.checkbox').prettyCheckable();        
        $(".block").click(function(event) {
            event.preventDefault();
            if ($(this).children('i').hasClass('block-icon-default')) {
                var bl = 'unblock';
                var title = 'Unblock Administrator';
            } else {
                var bl = 'block';
                var title = 'Block Administrator';
            }
            $message = 'Are you sure want to ' + bl + ' "<strong>' + $(this).attr('data-username') + '</strong>" from administrator list?';
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-body > center').html($message);
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-header h4').html(title);
            $('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-footer > a.btn-primary').attr('href', $(this).attr('href'));
            $('#BlockUnblock').modal('show');
        });

        $(".act_go").click(function(event) {
            event.preventDefault();
            $('#GoModal > div.modal-dialog > div.modal-content > div.modal-body > strong').html($(this).attr('data-name'));
            $('#GoModal > div.modal-dialog > div.modal-content > div.modal-footer > a.btn-primary').attr('href', $(this).attr('data-href'));
            $('#GoModal').modal('show');
        });

        $("#addAdministrator").click(function(event) {
            event.preventDefault();
            $('#AddAdministratorModel').modal('show');
        });
    });
</script>