<div class="modal fade" id="ViewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/html" id='ViewCustomerTemplate'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">View Customer Details</h4>
			</div>
			<div class="modal-body">
				<center>
                    <div class="input-group">
						<span class="input-group-addon">Service Type</span>
						<input type="text" id="CustomerType" class="form-control" maxlength="10" readonly="readonly" value="" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Name</span>
						<input type="text" id="CustomerFirstName" class="form-control" maxlength="100" readonly="readonly" value="<%= customer_data.Customer.first_name %> <%= customer_data.Customer.last_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" id="CustomerLastName" class="form-control" maxlength="100" readonly="readonly" value="<%= customer_data.Customer.username %>" />
					</div><br>
                                        <div class="input-group">
						<span class="input-group-addon">Email</span>
						<input type="text" id="CustomerEmail" class="form-control" maxlength="255" readonly="readonly" value="<%= customer_data.Customer.email %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address #1</span>
						<input type="text" id="CustomerPhone" class="form-control" maxlength="100" readonly="readonly" value="<%= customer_data.Customer.address1 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Address #2</span>
						<input type="text" id="CustomerAddressLine1" class="form-control" maxlength="255" readonly="readonly" value="<%= customer_data.Customer.address2 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">City</span>
						<input type="text" id="CustomerAddressLine2" class="form-control" maxlength="255" readonly="readonly" value="<%= customer_data.Customer.address2 %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Country</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= customer_data.Customer.country_name %>" />
					</div><br>
                                        <div class="input-group">
						<span class="input-group-addon">State</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= customer_data.Customer.state_name %>" />
					</div><br>
                                        <div class="input-group">
						<span class="input-group-addon">Zip</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= customer_data.Customer.zip %>" />
					</div><br>
                                        <!--div class="input-group">
						<span class="input-group-addon">Client IP</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="" />
					</div><br>
                                        
                                        <div class="input-group">
						<span class="input-group-addon">Client Machine Info</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="" />
					</div><br-->
                                        <div class="input-group">
						<span class="input-group-addon">Payment Status</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= customer_data.Customer.payment_status %>" />
					</div><br>
                                        <div class="input-group">
						<span class="input-group-addon">Amount</span>
						<input type="text" id="CustomerStatus" class="form-control" maxlength="10" readonly="readonly" value="$<%= customer_data.Customer.amount %>" />
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
        $(".viewCustomerRow").click(function(event) {
            event.preventDefault();
            var urlLoc = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(urlLoc, function(data) {
                var template = $("#ViewCustomerTemplate").html();                
                $("#ViewCustomerModal").html(_.template(template, {customer_data: data.customerData, PopupTitle: data.PopupTitle}));
                $('#ViewCustomerModal').modal('show');
                if (data.customerData.Customer.service_type=="d") {
                    $("#CustomerType").val("Day Trading");
                }else{
                    $("#CustomerType").val("Short-Term Trading");
                }
            });
        });
    });
</script>