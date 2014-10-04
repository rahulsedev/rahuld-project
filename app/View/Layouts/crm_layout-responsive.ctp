<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo __('JitTraders Administrator Panel'); ?></title>
        <?php
        echo $this->Html->meta(
            'favicon.ico', '/favicon.ico', array('type' => 'icon')
        );

        echo $this->Html->css(array(
            'style.css',
            'bootstrap-select.css',
            'bootstrap.min.css', 'bootstrap.css',
            'prettyCheckable.css'
        ));
        echo $this->fetch('css');
        ?>        <!-- Bootstrap core CSS -->
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="dashboard"> <!-- dashboard start -->
            <nav class="navbar navbar-default" role="navigation">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="container-fluid"> <!-- container-fluid start -->
                    <div class="row"> <!-- row start -->

                        <div class="col-sm-2"> <!-- col-xs-2 start -->
                            <div class="navbar-header logo">
                                <img src="img/kazi.png" alt="logo" >
                            </div> <!-- navbar-header end -->
                        </div> <!-- col-xs-2 end -->

                        <div class="col-sm-10 clearfix">                       
                            <div class="text-center welcome-setting pull-right"> <!-- welcome start -->

                                Welcome <strong>User</strong> ! You are logged into 
                                <span>Kazi<strong>Brothers</strong></span> Admin Panel.

                            </div>    <!-- welcome end -->                   
                        </div>

                    </div>  <!-- row end -->          

                </div> <!-- container-fluid end -->
            </nav> 
            <div class="navbar  navbar-bg container-fluid" role="navigation">

                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">

                        <li class="active">
                            <a href="javascript:void(0)" data-original-title="" title="">
                                <span class="glyphicon glyphicon-dashboard icon-white"></span> Dashboard
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-original-title="" title="">
                                <span class="department-icon icon-white"></span> Administrator
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">Add New Admin</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">List Admins</a>
                                </li>                                                                     
                            </ul>
                        </li>


                        <li>
                            <a href="#" title="">
                                <span class="glyphicon glyphicon-envelope icon-white"></span> Email Templates
                            </a>
                        </li>

                        <li class="dropdown">
                            <a  href="javascript:void(0)" data-original-title="" title="">
                                <span class="glyphicon glyphicon-log-out icon-white"></span> Categories

                            </a>

                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-original-title="" title="">
                                <span class="glyphicon glyphicon-retweet icon-white"></span> Products
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">List Products</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">Add New Products</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">Price Formulas</a>
                                </li>

                            </ul>
                        </li>



                    </ul> 

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" data-original-title="" title="">
                                <i class="glyphicon glyphicon-user"></i>
                                Brandon
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">
                                        <span class="glyphicon glyphicon-lock icon-white"></span> Change Password
                                    </a>
                                </li>

                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0)" data-original-title="" title="">
                                        <span class="glyphicon glyphicon-log-out icon-white"></span> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>    
                    </ul>
                </nav>
            </div> <!-- navbar end -->

            <div class="main-content"> <!-- main-cotent start -->                   
                <div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
                    <ul class="breadcrumb col-sm-6">
                        <li>
                            <i class="glyphicon glyphicon-home home-icon"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul>



                </div> <!-- breadcrumbs end -->

                <div class="clearfix"></div>

                <div class="container-fluid"> <!-- container-fluid start -->

                    <div class="pull-right user-btn">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#adduser">Add User</button>	
                    </div>
                    <div class="clearfix"></div>	
                    <div class="panel panel-default table-margin">
                        <div class="panel-heading">
                            <div class="pull-left panel-title text-user">
                                Users
                            </div>
                            <div class="pull-right">

                                <input class="search form-control" type="text"> 
                                <button type="button" class="btn btn-primary search-btn">Search</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body"> 
                            <div class="table-responsive">                                                         
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> NFirstame</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Business Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            <td>edosoft company</td>
                                            <td>
                                                <span class="label label-success">Active</span>
                                            </td>
                                            <td>
                                                <a class="active-btn" href="javascript:void(0)" title="active">
                                                    <i class="glyphicon glyphicon-plus text-color"></i>
                                                </a>
                                                <a class="user-btn" href="javascript:void(0)" title="active">
                                                    <i class="glyphicon glyphicon-user text-color"></i>
                                                </a>
                                                <a class="user-btn" href="javascript:void(0)" title="active">
                                                    <i class="glyphicon glyphicon-user icon-color"></i>
                                                </a>
                                                <a class="edit-btn" href="javascript:void(0)" title="edit" data-toggle="modal" data-target="#edit">
                                                    <i class="glyphicon glyphicon-pencil text-color"></i>
                                                </a>
                                                <a class="delete-btn" href="javascript:void(0)" title="delete" data-toggle="modal" data-target="#delete">
                                                    <i class="glyphicon glyphicon-trash text-color"></i>
                                                </a>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row clearfix">

                                <div class="col-xs-12">
                                    <ul class="pagination pull-right">
                                        <li class="disabled">
                                            <a href="javascript:void(0)">«</a>
                                        </li>
                                        <li class="active">
                                            <a href="javascript:void(0)">
                                                1
                                                <span class="sr-only">(current)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-color">2</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-color">3</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-color">4</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-color">5</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-color">»</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>


                        </div><!-- panel-body end -->
                    </div>                                                  

                </div> <!-- container fluid end -->
            </div><!-- main content end -->                

        </div> <!-- dashboard end -->

        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 JitTraders-text">
                        JitTraders.com                               
                    </div>
                    <div class="col-sm-8 clearfix">    
                        <div class="pull-right"> 
                            All Rights Reserved. Copyright &copy; JitTraders 2014 
                        </div>                                
                    </div>
                </div>
            </div> <!-- container fluid end -->
        </footer> 

        <!-- model edit start -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Client</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure want to edit "ashishDb" from user list? 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model edit end -->

        <!-- model delete start -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Delete Client</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete "ashishDb" from user list? 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>			   

        <!-- model delete end -->

        <!-- add user Modal start -->
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Client</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Last Name*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Phone*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Address*</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Country*</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker input-select" name="area">
                                        <option value="">Please select</option>
                                        <option value="1">United States</option>
                                        <option value="2">United Kingdom</option>
                                        <option value="3">Canada</option>
                                        <option value="4">Australia</option>
                                        <option value="4">Afghanistan</option>
                                        <option value="4">Albania</option>
                                        <option value="4">Algeria</option>
                                        <option value="4">Andorra</option>
                                        <option value="4">Angola</option>
                                        <option value="4">Anguilla</option>
                                        <option value="4">Austria</option>
                                        <option value="4">Bangladesh</option>
                                        <option value="4">Barbados</option>
                                        <option value="4">Belarus</option>
                                        <option value="4">Belgium</option>
                                        <option value="4">Belize</option>
                                        <option value="4">Benin</option>
                                        <option value="4">Bermuda</option>
                                        <option value="4">Bosnia and Herzegovina</option>
                                        <option value="4">Canada</option>
                                        <option value="4">Cape Verde</option>
                                        <option value="4">China</option>
                                        <option value="4">Colombia</option>
                                        <option value="4">Cook Islands</option>
                                        <option value="4">Dominican Republic</option>
                                        <option value="4">Ecuador</option>
                                        <option value="4">Egypt</option>
                                        <option value="4">El Salvador</option>
                                        <option value="4">Equatorial Guinea</option>
                                        <option value="4">Eritrea</option>
                                        <option value="4">Estonia</option>
                                        <option value="4">Ethiopia</option>
                                        <option value="4">Fiji</option>
                                        <option value="4">Finland</option>
                                        <option value="4">France</option>
                                        <option value="4">French Guiana</option>
                                        <option value="4">Germany</option>
                                        <option value="4">Ghana</option>
                                        <option value="4">Gibraltar</option>
                                        <option value="4">Greece</option>
                                        <option value="4">Greenland</option>
                                        <option value="4">Guadeloupe</option>
                                        <option value="4">Haiti</option>
                                        <option value="4">Honduras</option>
                                        <option value="4">Hong Kong</option>
                                        <option value="4">Hungary</option>
                                        <option value="4">Iceland</option>
                                        <option value="4">India</option>
                                        <option value="4">Indonesia</option>
                                        <option value="4">Ireland</option>
                                        <option value="4">Yemen</option>
                                        <option value="4">Western Sahara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Zip code *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" value=""/>								  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-2">Gender* </div>
                                <div class="col-xs-10">
                                    <div class="radio">	<input type="radio" name="optionsRadios"  class="radio-btn" value="option1" checked>			
                                        <label>										
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios"  class="radio-btn" value="option2">
                                            Female
                                        </label>
                                    </div>								
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-2">Tell us about yourself *</label>
                                <div class="col-xs-10">

                                    <textarea name="profile" class="col-xs-12 form-control" cols="20" rows="10"></textarea>
                                </div>
                            </div>								
                            <p>



                            </p>
                        </form>							

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add user Modal end -->		

        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            // enable tooltips
            $(".tip").tooltip();
        </script>
    </body>
</html>
