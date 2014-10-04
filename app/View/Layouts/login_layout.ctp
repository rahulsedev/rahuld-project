<?php echo $this->Html->docType('html5'); ?>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo Configure::read('SITE_SETTINGS.Name'); ?> <?php echo __(':: Administrator Panel ::'); ?> <?php echo $title_for_layout ?></title>
        <?php
        echo $this->Html->meta(
            'favicon.ico', '/favicon.ico', array('type' => 'icon')
        );       
        echo $this->fetch('meta');
        echo $this->Html->css(array(
            'style.css',
            'bootstrap-select.css',
            'bootstrap.min.css',
            'non-responsive.css',
            'prettyCheckable.css',
            'pnotify/jquery.pnotify.default',
            'pnotify/jquery.pnotify.default.icons',
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
            'bootstrap.min.js',
            'prettyCheckable.js',
            'pnotify/jquery.pnotify',
            'jquery.validate'
        ));
        ?>
        <script>
            $(document).ready(function() {
                $('input.check').prettyCheckable({
                    color: 'blue'
                });
            });
        </script>
        <?php
        echo $this->fetch('script');
        ?>
    </head>
    <body class="login-page">
        <?php echo $this->fetch('content'); ?>
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