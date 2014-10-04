<?php echo $this->Html->docType('html5'); ?>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo Configure::read('SITE_SETTINGS.Name'); ?> :: <?php echo ($this->Session->read('User.User.user_type_id') == 3) ? 'Branch Manager' : 'Administrator' ?> :: <?php echo $title_for_layout ?></title>
        <?php
        echo $this->Html->meta(
            'favicon.ico', '/favicon.ico', array('type' => 'icon')
        );
        echo $this->fetch('meta');
        echo $this->Html->css(array(
            'style',
            'style_custom',
            'pnotify/jquery.pnotify.default',
            'pnotify/jquery.pnotify.default.icons',
            'bootstrap-select',
            'bootstrap.min',
            'bootstrap',
            'prettyCheckable'
        ));
        echo $this->fetch('css');
        ?>
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="/CRM/js/html5shiv.js"></script>
            <script src="/CRM/js/respond.min.js"></script>
        <![endif]-->		
        <?php
        echo $this->Html->script(array(
            'jquery.js',
            'bootstrap.min',
            'underscore-min',
            'bootstrap/bootstrap-modalmanager',
            'bootstrap/bootstrap-modal',
            'prettyCheckable',
            'bootstrap-select',
            'pnotify/jquery.pnotify',
            'jquery.validate',
            'base',
        ));
        echo $this->fetch('script');
        ?>
        <?php
        echo $this->Html->css(array(
            'bootstrap/bootstrap-modal'
        ));
        ?>
    </head>
    <body>
        <div id="dashboard"> <!-- dashboard start -->
            <?php echo $this->Element('header'); ?>
            <?php echo $this->Element('menu'); ?>
            <!-- main-cotent start -->            
            <div class="main-content"> 
                <?php echo $this->fetch('content'); ?>
            </div>
            <!-- main content end -->                                
        </div> <!-- dashboard end -->
        <?php echo $this->Element('footer'); ?>
        <script type="text/javascript">
            $(document).ready(function() {
                <?php
                if ($this->Session->check('Message.flash')) {
                    if (!$this->Session->check('Message.flash.params')) {
                        $message = 'info';
                    } else {
                        $message = $this->Session->read('Message.flash.params');
                    }
                    switch ($message) {
                        case 'success':
                            echo "flash('success','{$this->Session->flash()}','Success');";
                            break;
                        case 'error':
                            echo "flash('error','{$this->Session->flash()}','Error');";
                            break;
                        case 'info':
                            echo "flash('info','{$this->Session->flash()}','Information');";
                            break;
                        case 'notice':
                            echo "flash('notice','{$this->Session->flash()}','Notice');";
                            break;
                        default:
                            echo "flash('info','{$this->Session->flash()}','Information');";
                            break;
                    }
                }
                ?>
            });
        </script>
    </body>
</html>