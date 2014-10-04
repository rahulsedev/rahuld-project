<div id="editAdminModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('User', array('type' => 'POST', 'action' => 'editadmin', 'name' => 'editAdmin', 'id' => 'editAdmin', 'class' => 'form-horizontal styleThese', 'role' => 'form', '')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/html" id='editTemplate'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Administrator</h4>
            </div>		
            <div class="modal-body">
                <input type="hidden" id="UserId" name="data[User][id]"  value="<%= user.id %>" /> 
                <div class="form-group">
                    <label for="UserFirstName" class="col-sm-2 control-label">First Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="UserFirstName" placeholder="First Name" class="form-control" required="required" maxlength="50" name="data[User][first_name]" value="<%= user.first_name %>">        
                    </div>
                </div>	    
                <div class="form-group">
                    <label for="UserLastName" class="col-sm-2 control-label">Last Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="UserLastName" placeholder="Last Name" class="form-control" required="required" maxlength="50" name="data[User][last_name]" value="<%= user.last_name %>">       
                    </div>    
                </div>
                <div class="form-group">
                    <label for="UserUserName" class="col-sm-2 control-label">User Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="UserUserName" minlength="2" loginregex="1" remote="<?php echo $this->webroot; ?>Users/ajax_check_username/<%= user.id %>" placeholder="Please enter username" class="form-control" required="required" maxlength="30" name="data[User][user_name]" value="<%= user.user_name %>"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="UserEmail" class="col-sm-2 control-label">Email<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" id="UserEmail" remote="<?php echo $this->webroot; ?>Users/ajax_check_email/<%= user.id %>" placeholder="Example : example@example.com" class="form-control" email="1" required="required" maxlength="100" name="data[User][email]" value="<%= user.email %>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="UserPhone" class="col-sm-2 control-label">Phone<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="UserPhone" number="1" placeholder="Example : +1-646-222-9999" class="form-control" maxlength="20" name="data[User][phone]" value="<%= user.phone %>">        
                    </div>
                </div>
                <div class="form-group switchMode">
                    <label for="AddBUserPassword" class="col-sm-2 control-label">Password<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input name="data[User][password]" id="AddBUserPassword" class="form-control" minlength="6" maxlength="50" type="password">
                    </div>
                </div>
                <div class="form-group switchMode">
                    <label for="AddUserCpassword" class="col-sm-2 control-label">Confirm Password<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input name="data[User][cpassword]" id="AddUserCpassword" maxlength="50" class="form-control" equalto="#AddBUserPassword" type="password">
                    </div>
                </div>                
                <div class="form-group">
                    <label for="UserAddressLine1" class="col-sm-2 control-label">Address1</label>            
                    <div class="col-sm-10">
                        <input type="text" id="UserAddressLine1" placeholder="Address Line 1" class="form-control" maxlength="100" name="data[User][address_line1]" value="<%= user.address_line1 %>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="UserAddressLine2" class="col-sm-2 control-label">Address2<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="UserAddressLine2" placeholder="Address Line 2" class="form-control" maxlength="100" name="data[User][address_line2]" value="<%= user.address_line2 %>">
                    </div>
                </div>		    
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button type="submit" id="singlebutton" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $.validator.addMethod("loginRegex", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");
        $("#editAdmin").validate();
        var editUrl = $('#editAdmin').attr('action');
        $(".editRow").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(url, function(data) {
                $('#editAdmin').attr('action', editUrl + '/' + data.users.User.id);
                var template = $("#editTemplate").html();
                $("#editAdmin").html(_.template(template, {user: data.users.User, PopupTitle: data.PopupTitle}));
                $('#editAdminModel').modal('show');
            });
        });
    });
</script>