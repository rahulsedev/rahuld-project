<?php //$this->Html->script('additional_method_validate', array('inline' => false)); //Attached it for use the jquery accept method for logo upload   ?>
<div class="span3 well"  style="background-image: url(<?php if ($usersession['User']['cover_photo'] == '') {
    echo Configure::read('FULL_BASE_URL.URL') . '/app/webroot/img/cover_photo/800_300_1.png';
} else {
    echo Configure::read('FULL_BASE_URL.URL') . '/app/webroot/img/cover_photo/' . $usersession['User']['cover_photo'];
} ?>); height: 100%; width: 100%;">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-user"></i>', 'javascript:void(0)', array('title' => 'Change Profile Photo', 'escape' => false, 'class' => 'btn btn-xs btn-primary', 'id' => 'ProfilePhoto')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-picture"></i>', 'javascript:void(0)', array('title' => 'Change Cover Photo', 'escape' => false, 'class' => 'btn btn-xs btn-primary', 'id' => 'CoverPhoto')); ?>
    <center>
        <?php
        if ($usersession['User']['profile_photo'] == '') {
            echo $this->Html->image('profile_photo/150x150.png', array('class' => 'img-rounded', 'style' => 'border:4px solid white'));
        } else {
            echo $this->Html->image('profile_photo/' . $usersession['User']['profile_photo'], array('class' => 'img-rounded', 'style' => 'border:4px solid white'));
        }
        ?>
        <h3><font color="white"><b>Welcome (<?php echo $Name; ?>) <small>You are logged in as (<?php echo $UserTypeName; ?>)</small></b></font></h3>
    </center>
</div>
<div class="modal fade" id="coverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Change Cover Photo - <small>Must be .PNG .JPG or .GIF</small></h4>
            </div>
            <?php echo $this->Form->create('User', array('type' => 'file', 'url' => Configure::read('FULL_BASE_URL.URL') . '/users/change_cover_photo', 'id' => 'change_cover_photo', 'class' => 'form-horizontal', 'role' => 'form')); ?>	
            <div class="modal-body">
                <center>
                    <div class="control-group">
                        <label class="control-label">Choose a photo</label>
                        <div class="controls">
                            <input type="file" name="data[User][cover_photo]" required="required" data-msg-required="Please upload cover photo.">
                        </div>
                    </div>
                    <br><h5>Just a tip, guys! For the best fit, your cover photo should be <strong>1143x278</strong> or larger.</h5>
                </center>
            </div>
            <div class="modal-footer">
                <center>
                    <button id="singlebutton" type="submit" name="singlebutton" class="btn btn-primary">Apply</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </center>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>	

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Change Profile Photo - <small>Must be .PNG .JPG or .GIF</small></h4>
            </div>
            <?php echo $this->Form->create('User', array('type' => 'file', 'url' => Configure::read('FULL_BASE_URL.URL') . '/users/change_profile_photo', 'id' => 'change_profile_photo', 'class' => 'form-horizontal', 'role' => 'form')); ?>	
            <div class="modal-body">
                <center>
                    <div class="control-group">
                        <label class="control-label">Choose a photo</label>
                        <div class="controls">
                            <input type="file" name="data[User][profile_photo]" required="required" data-msg-required="Please upload profile photo.">
                        </div>
                    </div>
                    <br><h5>Just a tip, guys! For the best fit, your profile photo should be <strong>150x150</strong>.</h5>
                </center>
            </div>
            <div class="modal-footer">
                <center>
                    <button id="singlebutton" type="submit"  name="singlebutton" class="btn btn-primary">Apply</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </center>
            </div>
<?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#ProfilePhoto").click(function(event) {
            event.preventDefault();
            $('#profileModal').modal('show');
        });
        $("#CoverPhoto").click(function(event) {
            event.preventDefault();
            $('#coverModal').modal('show');
        });
    });
</script>