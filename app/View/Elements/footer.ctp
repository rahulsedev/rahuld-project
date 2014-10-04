<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 JitTraders-text">
                <?php echo $this->html->link('tridevsolutions.com', Router::url('/', true), array('style' => 'color: #fff;', 'escape' => false, 'title' => Configure::read('SITE_SETTINGS.Name'))); ?>
            </div>
            <div class="col-sm-8 clearfix">    
                <div class="pull-right">
                    <?php echo Configure::read('SITE_SETTINGS.Copyright'); ?>
                </div>                                
            </div>
        </div>
    </div> <!-- container fluid end -->
</footer>