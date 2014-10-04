<div id="editCategoryModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('Category', array('type' => 'POST', 'action' => 'editcategory', 'name' => 'editCategory', 'id' => 'editCategory', 'class' => 'form-horizontal styleThese', 'role' => 'form', '')); ?>	
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/html" id='editTemplate'>
	<div class="modal-dialog">
	<div class="modal-content">
	    
	<div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
	</div>		
	
	<div class="modal-body">
    
	 <input type="hidden" id="UserId" name="data[Category][id]" value="<%= cat.id %>" /> 
	    
	    <div class="form-group">
		  <label for="CategoryName" class="col-sm-2 control-label">Name<span class="star">*</span></label>
		  <div class="col-sm-10">
		    <input type="text" id="CategoryName" minlength="2" remote="<?php echo $this->webroot; ?>categories/ajax_check_cat_name/<%= cat.id %>" placeholder="Please enter category" class="form-control" required="required" maxlength="100" name="data[Category][name]" value="<%= cat.name %>">        
		  </div>
	    </div>	    
	    
	    
	    <div class="form-group">
		<label for="CategoryName" class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
		    <textarea rows='5' cols='30' id="CategoryDescription" placeholder="Description" class="form-control" maxlength="100" name="data[Category][description]" value="<%= cat.description %>"><%= cat.description %></textarea>       
		</div>    
	    </div>


	    <div class="form-group">
		<label for="CategoryStockTypeEDIT" class="col-sm-2 control-label">Stock Type<span class="star">*</span></label>
		<div class="col-sm-10 cstmWidth_Cat">
		    <select name="data[Category][stock_type]" class="form-control" required="required" onchange="return switchingMode(this.value);" id="CategoryStockTypeEDIT">
			<option value="">Please Select</option>
			<option value="1">Kg. Percentage</option>
			<option value="2">Number</option>
		    </select>
		</div>
		<label for="CategoryQrtPerEDIT" class="col-sm-2 control-label switchKG">Kg.(1/4)%<span class="star">*</span></label>
		<div class="col-sm-10 cstmWidth_Mgr_Cat  switchKG">
		    <input name="data[Category][qrt_per]" class="form-control" required="required" placeholder="Kg.(1/4)%" onkeypress="return isNumber(event)" maxlength="5" step="any" type="number" id="CategoryQrtPerEDIT" value="<%= cat.qrt_per %>"/>
		</div>			  			  			  
	    </div>
	    
	    <div class="form-group switchMode switchKG">
		<label for="CategoryHalfPerEDIT" class="col-sm-2 control-label">Kg.(1/2)%<span class="star">*</span></label>
		<div class="col-sm-10 cstmWidth_Cat">
		    <input name="data[Category][half_per]" class="form-control" required="required" placeholder="Kg.(1/2)%" onkeypress="return isNumber(event)" maxlength="5" step="any" type="number" id="CategoryHalfPerEDIT" value="<%= cat.half_per %>"/>
		</div>
		<label for="CategoryThreeForthPerEDIT" class="col-sm-2 control-label">Kg.(3/4)%<span class="star">*</span></label>
		<div class="col-sm-10 cstmWidth_Mgr_Cat">
		    <input name="data[Category][three_forth_per]" class="form-control" required="required" placeholder="Kg.(3/4)%" onkeypress="return isNumber(event)" maxlength="5" step="any" type="number" id="CategoryThreeForthPerEDIT" value="<%= cat.three_forth_per %>"/>
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
        $("#editCategory").validate();
        var editUrl = $('#editCategory').attr('action');
        $(".editRow").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(url, function(data) {
                $('#editCategory').attr('action', editUrl + '/' + data.categories.Category.id);
                var template = $("#editTemplate").html();
                $("#editCategory").html(_.template(template, {cat:data.categories.Category,PopupTitle:data.PopupTitle}));
		$("#CategoryStockTypeEDIT").val(data.categories.Category.stock_type);
		switchingMode(data.categories.Category.stock_type);
                $('#editCategoryModel').modal('show');
            });
        });

    });
</script>