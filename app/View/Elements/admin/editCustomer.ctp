<div id="editCustomerModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('User', array('type' => 'POST', 'action' => 'editCustomer', 'name' => 'editCustomer', 'id' => 'editCustomer', 'class' => 'form-horizontal styleThese', 'role' => 'form', '')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/html" id='editTemplate'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Customer</h4>
            </div>		
            <div class="modal-body">
                <input type="hidden" id="CustomerId" name="data[Customer][id]"  value="<%= user.id %>" /> 
                
                <div class="form-group">
                    <label for="CustomerFirstName" class="col-sm-2 control-label">Service Type<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerCustomerType" disabled="disabled" placeholder="Service Type" class="form-control" required="required" maxlength="50" name="service_type" value="">        
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerFirstName" class="col-sm-2 control-label">First Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerFirstName" placeholder="First Name" class="form-control" required="required" maxlength="50" name="data[Customer][first_name]" value="<%= user.first_name %>">        
                    </div>
                </div>	    
                
                <div class="form-group">
                    <label for="CustomerLastName" class="col-sm-2 control-label">Last Name<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerLastName" placeholder="Last Name" class="form-control" required="required" maxlength="50" name="data[Customer][last_name]" value="<%= user.last_name %>">       
                    </div>    
                </div>
                
                <div class="form-group">
                    <label for="CustomerEmail" class="col-sm-2 control-label">Email<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" id="CustomerEmail" remote="<?php echo $this->webroot; ?>users/ajax_check_customer_email/<%= user.id %>" placeholder="Example : example@example.com" class="form-control" email="1" required="required" maxlength="100" name="data[Customer][email]" value="<%= user.email %>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="CustomerAddressLine1" class="col-sm-2 control-label">Address #1<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="CustomerAddressLine1" required="required" placeholder="Address Line 1" class="form-control" maxlength="100" name="data[Customer][address1]" value="<%= user.address1 %>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="CustomerAddressLine2" class="col-sm-2 control-label">Address #2</label>            
                    <div class="col-sm-10">
                        <input type="text" id="CustomerAddressLine2" placeholder="Address Line 2" class="form-control" maxlength="100" name="data[Customer][address2]" value="<%= user.address2 %>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerCity" class="col-sm-2 control-label">City<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="CustomerCity" required="required" placeholder="City" class="form-control" maxlength="20" name="data[Customer][city]" value="<%= user.city %>">        
                    </div>
                </div>
                <!--- Country state --> 
                <div class="form-group">
                    <label for="CustomerCountry" class="col-sm-2 control-label">Country<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <select name="data[Customer][country]" required="required" class="form-control" required="required" onChange="fetchStates(this.value, '')" id="CustomerCountry">
                        <option value="">---Select Country---</option>
                        <?php if(!empty($listCountries)) { ?>
                            <?php foreach($listCountries as $ki=>$data) { ?>
                                    <option value="<?php echo $ki;?>"><?php echo $data;?></option>
                            <?php } ?>                        
                        <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerState" required="required" class="col-sm-2 control-label">State<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <select name="data[Customer][state]" class="form-control" required="required" id="CustomerState">
                            <option value="">---Select State---</option>
                        </select>        
                    </div>
                </div>
                <!--- Country state -->
                
                <div class="form-group">
                    <label for="CustomerZip" class="col-sm-2 control-label">Postal Code/Zip<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="CustomerZip" required="required" number="1" placeholder="Postal Code/Zip" class="form-control" maxlength="10" name="data[Customer][zip]" value="<%= user.zip %>">        
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerPhone" class="col-sm-2 control-label">Phone<span class="star">*</span></label>            
                    <div class="col-sm-10">
                        <input type="text" id="CustomerPhone" required="required" number="1" placeholder="Example : +1-646-222-9999" class="form-control" maxlength="20" name="data[Customer][phone]" value="<%= user.phone %>">        
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerUsername" class="col-sm-2 control-label">Username<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerUsername" minlength="2" remote="<?php echo $this->webroot; ?>users/ajax_check_customer_username/<%= user.id %>" placeholder="Please enter username" class="form-control" required="required" maxlength="30" name="data[Customer][username]" value="<%= user.username %>"> 
                    </div>
                </div>                
                
                <div class="form-group">
                    <label for="CustomerPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerPassword" minlength="6" placeholder="Please enter password" class="form-control" maxlength="30" name="data[Customer][password]" value=""> 
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerCPassword" class="col-sm-2 control-label">Re-Enter Password</label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerCPassword" minlength="6" placeholder="Please enter Re-enter password" class="form-control" maxlength="30" name="data[Customer][cpassword]" value=""> 
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="CustomerSecurityQuestion" class="col-sm-2 control-label">Security Question</label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerSecurityQuestion" minlength="2" placeholder="Please enter Security Question" class="form-control"  maxlength="200" name="data[Customer][security_question]" value="<%= user.security_question %>"> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="CustomerSecurityAnswer" class="col-sm-2 control-label">Security Answer</label>
                    <div class="col-sm-10">
                        <input type="text" id="CustomerSecurityAnswer" minlength="2" placeholder="Please enter Security Answer" class="form-control" maxlength="200" name="data[Customer][security_answer]" value="<%= user.security_answer %>"> 
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
        }, "Customername must contain only letters, numbers, or dashes.");
        $("#editCustomer").validate();
        var editUrl = $('#editCustomer').attr('action');
        $(".editRow").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(url, function(data) {
                $('#editCustomer').attr('action', editUrl + '/' + data.customers.Customer.id);
                var template = $("#editTemplate").html();
                $("#editCustomer").html(_.template(template, {user: data.customers.Customer, PopupTitle: data.PopupTitle}));
                $('#editCustomerModel').modal('show');
                $("#CustomerCountry").val(data.customers.Customer.country);
                fetchStates(data.customers.Customer.country, data.customers.Customer.state)
                if (data.customers.Customer.service_type=="d") {
                    $("#CustomerCustomerType").val("Day Trading");
                }else{
                    $("#CustomerCustomerType").val("Short-Term Trading");
                }
            });
        });
    });
</script>
<script type="text/javascript">
function fetchStates(country, state){
    var selState = '';
    if (state!='') {
	selState = state;
    }
    if (country!=""&& typeof country !="undefined") {
	jQuery.ajax({
	    type:'GET',
	    url:'<?php echo $this->Html->url(array('controller'=>'homes', 'action'=>'getStates', 'admin'=>false))?>/'+country+'/'+selState,
	    success:function(response){
		jQuery('#CustomerState').html(response);
	    }
	});
    }
}
</script>