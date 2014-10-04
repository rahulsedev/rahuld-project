<style>
    .block-icon-default { color: #E34C3B !important; }
</style>
<div><br>
    <div class="col-lg-12 ch-heading">
        <div class="row">
            <div class="pull-left"><strong class="lead"><i class="glyphicon glyphicon-user"></i> Clients(Users)</strong></div>
            <div class="pull-right">
	    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Client', array('controller' => 'users', 'action' => 'addclient', 'superadmin' => true), array('escape' => false, 'class' => 'btn btn-primary', 'title' => 'Add New Client', 'id' => 'addClient')); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i> Trash', array('controller' => 'users', 'action' => 'trashclients', 'superadmin' => true), array('escape' => false, 'class' => 'btn btn-primary', 'title' => 'Deleted Users')); ?>
            </div>
        </div>
    </div>
    <br><br>
	<?php echo $this->Form->create('users', array('action' => 'listclients', 'type' => "GET"), array('class' => "control-group")); ?>
	<div class="input-group">
		<?php
		if (isset($_GET['search']) && trim($_GET['search']) != '') {
			$val = $_GET['search'];
		} else {
			$val = '';
		}
		echo $this->Form->input('User.search', array('type' => 'text', 'value' => $val, 'placeholder' => "Search Clients", 'class' => 'form-control', 'maxlength' => 100, 'label' => false, 'div' => false));
		?>
		<span class="input-group-btn">
			<button class="btn btn-primary" type="submit">
				Search!</button>
		</span>
	</div>
	<?php echo $this->Form->end(); ?>
    <br/>
    <div class="span7">   
        <div class="widget stacked widget-table action-table">
            <div class="widget-content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('first_name', 'First Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('last_name', 'Last Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('user_name', 'User Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('business_name', 'Business Name'); ?></th>
                            <!--<th>Associated Admin</th>-->
                            <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						if (isset($data) && !empty($data)) {
							foreach ($data as $clientdata) {
								?>
								<tr>
									<td><?php echo $clientdata['User']['first_name']; ?></td>
									<td><?php echo $clientdata['User']['last_name']; ?></td>
									<td><?php echo $clientdata['User']['user_name']; ?></td>
									<td><?php echo $clientdata['User']['business_name']; ?></td>
									<!--<td><a href="#" style="cursor:hand" title="Change Administrator" class="status" data-type="select" data-value="" data-id="" data-pk="<?php echo $clientdata['User']['id'] ?>" data-url="/users/change_client_admin" data-title="Select Administrator"><?php //echo $data['Department']['dept_name']       ?></a></td>-->
									<td><?php echo $clientdata['User']['email']; ?></td>
									<td> 

										<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'users', 'action' => 'editclient', base64_encode($clientdata['User']['id'])), array('escape' => false, 'class' => 'btn btn-sm btn-default editRowClient', 'title' => 'Edit Client')); ?>
										<?php
										if ($clientdata['User']['is_blocked'] == 0) {
											echo $this->Html->link('<b class="glyphicon glyphicon-ban-circle"></b>', array('controller' => 'users', 'action' => 'blockclient', base64_encode($clientdata['User']['id']), 'block'), array('data-username' => $clientdata['User']['user_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Block Client'));  
										} else {
											echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle block-icon-default"></i>', array('controller' => 'users', 'action' => 'blockclient', base64_encode($clientdata['User']['id']), 'unblock'), array('data-username' => $clientdata['User']['user_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default block', 'title' => 'Unblock Client'));  
										}?>
                                                                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', 'javascript:void(0)', array('data-name' => $clientdata['User']['first_name'] . ' ' . $clientdata['User']['last_name'], 'escape' => false, 'class' => 'btn btn-sm btn-default delete', 'title' => 'Delete Client(User)', 'data-href' => $this->Html->url(array('controller' => 'users', 'action' => 'deleteclient', base64_encode($clientdata['User']['id'])))));
										?> 

									</td> 
								</tr>
								<?php
							}
						} else {
							echo '<tr><td colspan="5"><div class="norecord">No Record Found</div></td></tr>';
						}
						?>		
                    </tbody>
                </table>

            </div> <!-- /widget-content -->
        </div> <!-- /widget -->
    </div>
    <center>
		<?php if ($this->Paginator->counter('{:pages}') > 1) { ?>
			<ul class="pagination">
				<?php
				echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
				echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
				echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
				?>
			</ul>
		<?php } ?>
	</center>
</div>
<!-- Modal Block/Unblock Client -->
<div id="BlockUnblock" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Block Client</h3>
            </div>
            <div class="modal-body">
                <center>Are you sure want to <span>block<span> "<strong>selected user</strong>" from client list?</center>
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
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3>Delete Admin</h3>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                Are you sure want to delete "<strong>selected user</strong>" from user list?
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

                            <!-- Modal Add Client -->
							<?php echo $this->Element('super_admin/addClient'); ?>
                            <!-- Modal Edit Client -->
							<?php echo $this->Element('super_admin/editClient'); ?>

                            <script type="text/javascript">
								$(document).ready(function() {
									//$('.checkbox').prettyCheckable();        
									$(".block").click(function(event) {
										event.preventDefault();
										if ($(this).children('i').hasClass('block-icon-default')) {
											var bl = 'unblock';
											var title = 'Unblock Client';
										} else {
											var bl = 'block';
											var title = 'Block Client';
										}
										$message = 'Are you sure want to ' + bl + ' "<strong>' + $(this).attr('data-username') + '</strong>" from client list?';
										$('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-body > center').html($message);
										$('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-header h3').html(title);
										$('#BlockUnblock > div.modal-dialog > div.modal-content > div.modal-footer > center > a.btn-primary').attr('href', $(this).attr('href'));
										$('#BlockUnblock').modal('show');
									});

									$(".delete").click(function(event) {
										event.preventDefault();
										$('#DeleteModel > div.modal-dialog > div.modal-content > div.modal-body > center > strong').html($(this).attr('data-name'));
										$('#DeleteModel > div.modal-dialog > div.modal-content > div.modal-footer > center > a.btn-primary').attr('href', $(this).attr('data-href'));
										$('#DeleteModel').modal('show');
									});

									$("#addClient").click(function(event) {
										event.preventDefault();
										$('#AddClientModel').modal('show');
									});
								});
                            </script>
