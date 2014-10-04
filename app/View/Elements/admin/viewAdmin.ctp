<div class="modal fade" id="ViewUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/html" id='ViewUserTemplate'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">View Administrator Details</h4>
			</div>
			<div class="modal-body">
				<center>
                    <div class="input-group">
						<span class="input-group-addon">User Type</span>
						<input type="text" id="UserType" class="form-control" maxlength="10" readonly="readonly" value="<%= admin_data.UserType.name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">First Name</span>
						<input type="text" id="UserFirstName" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.User.first_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Last Name</span>
						<input type="text" id="UserLastName" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.User.last_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" id="UserUsername" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.User.user_name %>" />
					</div><br>
                    <div class="input-group">
						<span class="input-group-addon">Email</span>
						<input type="text" id="UserEmail" class="form-control" maxlength="255" readonly="readonly" value="<%= admin_data.User.email %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Phone</span>
						<input type="text" id="UserPhone" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.User.phone %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address 1</span>
						<input type="text" id="UserAddressLine1" class="form-control" maxlength="255" readonly="readonly" value="<%= admin_data.User.address_line1 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address 2</span>
						<input type="text" id="UserAddressLine2" class="form-control" maxlength="255" readonly="readonly" value="<%= admin_data.User.address_line2 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Status</span>
						<input type="text" id="UserStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= admin_data.User.current_status %>" />
					</div><br>
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".viewUserRow").click(function(event) {
            event.preventDefault();
            var urlLoc = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(urlLoc, function(data) {
                var template = $("#ViewUserTemplate").html();
                $("#ViewUserModal").html(_.template(template, {admin_data: data.adminData, PopupTitle: data.PopupTitle}));
                $('#ViewUserModal').modal('show');
            });
        });
    });
</script>