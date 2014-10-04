<div class="modal fade" id="ViewUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/html" id='ViewUserTemplate'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">View Master Details</h4>
			</div>
			<div class="modal-body">
				<center>
                    <div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('client name'));?></span>
						<input type="text" id="UserType" class="form-control" maxlength="10" readonly="readonly" value="<%= admin_data.Client.name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('material'));?></span>
						<input type="text" id="UserLastName" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.ClientMaster.material %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('quantity'));?></span>
						<input type="text" id="UserUsername" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.ClientMaster.quantity %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('amount'));?></span>
						<input type="text" id="UserPhone" class="form-control" maxlength="100" readonly="readonly" value="<%= admin_data.ClientMaster.amount %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('added date'));?></span>
						<input type="text" id="UserAddressLine1" class="form-control" maxlength="255" readonly="readonly" value="<%= admin_data.ClientMaster.added_date %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('invoice no'));?></span>
						<input type="text" id="UserAddressLine2" class="form-control" maxlength="255" readonly="readonly" value="<%= admin_data.ClientMaster.invoice_no %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><?php echo __(ucwords('added by'));?></span>
						<input type="text" id="UserStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= admin_data.User.full_name+" ("+admin_data.UserType.name+")" %>" />
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