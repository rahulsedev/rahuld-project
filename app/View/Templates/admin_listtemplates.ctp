<!-- breadcrumbs start -->
<div id="breadcrumbs" class="breadcrumbs clearfix">
    <ul class="breadcrumb col-sm-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li class="active">Email Templates</li>
    </ul>
</div>
<!-- breadcrumbs end -->
<div class="clearfix"></div>

<?php // listing code goes here,...?>
<div class="container-fluid"> <!-- container-fluid start -->
    <div class="pull-right user-btn">&nbsp;</div>	    
    <div class="clearfix"></div>	
    <div class="panel panel-default table-margin">
        <div class="panel-heading">
            <div class="pull-left panel-title text-user">
                Email Templates
            </div>
            <div class="pull-right">
                <?php echo $this->Form->create('templates', array('action' => 'listtemplates', 'type' => "GET"), array('class' => "control-group")); ?>
                <?php
                if (isset($_GET['search']) && trim($_GET['search']) != '') {
                    $val = $_GET['search'];
                } else {
                    $val = '';
                }
                echo $this->Form->input('EmailTemplate.search', array('type' => 'text', 'value' => $val, 'placeholder' => "Search Templates", 'class' => 'search form-control', 'maxlength' => 100, 'label' => false, 'div' => false));
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
                            <th><?php echo $this->Paginator->sort('template_for', 'Template For'); ?></th>
                            <th><?php echo $this->Paginator->sort('mail_subject', 'Mail Subject'); ?></th>
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
                                    <td><?php echo $processData['EmailTemplate']['template_for']; ?></td>
                                    <td><?php echo $processData['EmailTemplate']['mail_subject']; ?></td>
                                    <td><?php echo date(Configure::read('DISPLAY_DATETIME.DateTime'), strtotime($processData['EmailTemplate']['modified'])); ?></td>								
                                    <td><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil text-color"></i>', array('controller' => 'templates', 'action' => 'edit_template', base64_encode($processData['EmailTemplate']['id'])), array('escape' => false, 'class' => 'btn btn-sm btn-default', 'title' => 'Edit Template')); ?>
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