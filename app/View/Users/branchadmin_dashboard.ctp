<div class="main-content"> <!-- main-cotent start -->                   
    <div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
        <ul class="breadcrumb col-sm-6">
            <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller'=>'users', 'action'=>'dashboard', 'branchadmin'=>true));?>
            </li>
            <li class="active">Dashboard</li>
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
                Dashboard
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
                            <th>News</th>
                            <th>Discussions</th>
                            <th>Messages</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $this->Html->link('View Latest News', array('controller' => 'news', 'action' => 'show_news', 'branchadmin' => true), array('escape' => false, 'class' => 'btn btn-info', 'title' => 'Click here to view news', 'id' => '')); ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link('View Discussion', array('controller' => 'discussions', 'action' => 'list_posts', 'branchadmin' => true), array('escape' => false, 'class' => 'btn btn-info', 'title' => 'View Discussion', 'id' => '')); ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link('View / Send Message', array('controller' => 'messages', 'action' => 'listmessages', 'branchadmin' => true), array('escape' => false, 'class' => 'btn btn-info', 'title' => 'Add/Update Branches', 'id' => '')); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>		
            </div>
            <div class="row clearfix">
                <div class="col-xs-12">
                    &nbsp;
                </div>
            </div>	    
        </div><!-- panel-body end -->
    </div>                                     
</div> <!-- container fluid end -->