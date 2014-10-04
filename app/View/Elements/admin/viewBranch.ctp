<div class="modal fade" id="ViewBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/html" id='ViewBranchTemplate'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">View Branch Details</h4>
			</div>
			<div class="modal-body">
				<center>
                    <h3>Branch Manager</h3>
					<div class="input-group">
						<span class="input-group-addon">Branch Manager</span>
						<input type="text" id="BranchManager" class="form-control" maxlength="200" readonly="readonly" value="<%= branch_data.BranchManager.first_name + ' ' +branch_data.BranchManager.last_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Branch Manager Email</span>
						<input type="text" id="BranchManagerEmail" class="form-control" maxlength="200" readonly="readonly" value="<%= branch_data.BranchManager.email %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Branch Manager Phone</span>
						<input type="text" id="BranchManagerPhone" class="form-control" maxlength="20" readonly="readonly" value="<%= branch_data.BranchManager.phone %>" />
					</div><br>
                    <h3>Branch Detail</h3>
					<div class="input-group">
						<span class="input-group-addon">Branch Name</span>
						<input type="text" id="BranchName" class="form-control" maxlength="255" readonly="readonly" value="<%= branch_data.Branch.name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Email</span>
						<input type="text" id="BranchEmail" class="form-control" maxlength="200" readonly="readonly" value="<%= branch_data.Branch.email %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address 1</span>
						<input type="text" id="BranchAdress1" class="form-control" maxlength="255" readonly="readonly" value="<%= branch_data.Branch.address1 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address 2</span>
						<input type="text" id="BranchAdress2" class="form-control" maxlength="255" readonly="readonly" value="<%= branch_data.Branch.address2 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">City</span>
						<input type="text" id="BranchCity" class="form-control" maxlength="100" readonly="readonly" value="<%= branch_data.Branch.city %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Zip Code</span>
						<input type="text" id="BranchZipCode" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.zipcode %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Monday - Friday Timing </span>
						<div class="col-sm-10">
                            <input type="text" id="BranchMonFriFromtime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.mon_fri_fromtime %>" />
                            &nbsp;
                            <input type="text" id="BranchMonFriTotime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.mon_fri_totime %>" />
                        </div>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Saturday Timing</span>
						<div class="col-md-10">
                            <input type="text" id="BranchSatFromtime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.sat_fromtime %>" />
                            &nbsp;
                            <input type="text" id="BranchSatTotime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.sat_totime %>" />
                        </div>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Sunday Timing</span>
						<div class="col-md-10">
                            <input type="text" id="BranchSunFromtime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.sun_fromtime %>" />
                            &nbsp;
                            <input type="text" id="BranchSunTotime" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.sun_totime %>" />
                        </div>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Status</span>
						<input type="text" id="BranchStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= branch_data.Branch.current_status %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Added By</span>
						<input type="text" id="BranchCreatedBy" class="form-control" maxlength="100" readonly="readonly" value="<%= branch_data.AddedBy.first_name + ' ' + branch_data.AddedBy.last_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Modified By</span>
						<input type="text" id="BranchModifiedBy" class="form-control" maxlength="100" readonly="readonly" value="<%= branch_data.ModifiedBy.first_name + ' ' + branch_data.ModifiedBy.last_name %>" />
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
        $(".viewBranchRow").click(function(event) {
            event.preventDefault();
            var urlLoc = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(urlLoc, function(data) {
                var template = $("#ViewBranchTemplate").html();
                $("#ViewBranchModal").html(_.template(template, {branch_data: data.branchData, PopupTitle: data.PopupTitle}));
                $('#ViewBranchModal').modal('show');
            });
        });
    });
</script>