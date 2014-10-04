<div class="modal fade" id="ViewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/html" id='ViewCategoryTemplate'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">View Category Details</h4>
			</div>
			<div class="modal-body">
				<center>
					<div class="input-group">
						<span class="input-group-addon">Category Name</span>
						<input type="text" id="CategoryName" class="form-control" maxlength="255" readonly="readonly" value="<%= category_data.Category.name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Description</span>
						<textarea id="CategoryDescription" class="form-control" readonly="readonly"><%= category_data.Category.description %></textarea>
					</div><br>
                    <div class="input-group">
                        <span class="input-group-addon">Stock Type</span>
                        <input type="text" id="CategoryStockType" class="form-control" maxlength="100" readonly="readonly" value="<%= category_data.Category.stockType %>" />
                    </div><br>
                    <% if(category_data.Category.stock_type == 1) { %>
                        <div class="input-group">
                            <span class="input-group-addon">Kg.(1/4)%</span>
                            <input type="text" id="CategoryQuarterPer" class="form-control" maxlength="10" readonly="readonly" value="<%= category_data.Category.qrt_per %>" />
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Kg.(1/2)%</span>
                            <input type="text" id="CategoryHalffKGPer" class="form-control" maxlength="10" readonly="readonly" value="<%= category_data.Category.half_per %>" />
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Kg.(3/4)%</span>
                            <input type="text" id="CategoryThreeFourthPer" class="form-control" maxlength="10" readonly="readonly" value="<%= category_data.Category.three_forth_per %>" />
                        </div><br>
                    <% } %>
					<div class="input-group">
						<span class="input-group-addon">Status</span>
						<input type="text" id="CategoryStatus" class="form-control" maxlength="10" readonly="readonly" value="<%= category_data.Category.current_status %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Added By</span>
						<input type="text" id="CategoryCreatedBy" class="form-control" maxlength="100" readonly="readonly" value="<%= category_data.AddedBy.first_name + ' ' + category_data.AddedBy.last_name %>" />
					</div><br>
					<div class="input-group">
						<span class="input-group-addon">Modified By</span>
						<input type="text" id="CategoryModifiedBy" class="form-control" maxlength="100" readonly="readonly" value="<%= category_data.ModifiedBy.first_name + ' ' + category_data.ModifiedBy.last_name %>" />
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
        $(".viewCategoryRow").click(function(event) {
            event.preventDefault();
            var urlLoc = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(urlLoc, function(data) {
                var template = $("#ViewCategoryTemplate").html();
                $("#ViewCategoryModal").html(_.template(template, {category_data: data.categoryData, PopupTitle: data.PopupTitle}));
                $('#ViewCategoryModal').modal('show');
            });
        });
    });
</script>