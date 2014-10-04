<div id="manageBannerModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('Gallery', array('type' => 'POST', 'action' => 'manage_gallery', 'name' => 'manageBanner', 'id' => 'manageBanner', 'class' => 'form-horizontal styleThese', 'role' => 'form', 'type' => 'file')); ?>	
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/html" id='editTemplate'>
    <div class="modal-dialog" style="width: 1366px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Manage Banner</h4>
            </div>		
            <div class="modal-body">
                
                <input type="text" id="bannerId" name="data[Gallery][id]" value="<%= banner.id %>" /> 
                
                <div class="form-group">
                    <label for="ProductName" class="col-sm-2 control-label">Title<span class="star">*</span></label>
                    <div class="col-sm-10">
                        <input name="data[Gallery][title]" required="required" class="form-control" placeholder="Please enter title" minlength="2" maxlength="150" type="text" id="BannerTitle" value="<%= banner.title %>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="BannerImage" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">			    
                        <input name="data[Gallery][image]" onchange="return ckeckFileSize(this, 5)" id="BannerImage" type="file">				<span class="star">Allowed image types are : png, gif, jpg, jpeg</span><br>
<span class="star">Note : For better experience image dimension should be (1366X450)</span>
                    </div>
                </div>
                
                <div class="form-group switchImage">
                    <label for="ProductName" class="col-sm-2 control-label">Existing Image</label>
                    <div class="col-sm-10">			    
                        <img src="<?php echo Router::url('/', true) . '/img/banner/' ?><%= banner.image %>">
                    </div>
                </div>
                <input type="hidden" name="data[Gallery][old_image]" value="<%= banner.image %>" />
            
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
        $("#manageBanner").validate();
        var editUrl = $('#manageBanner').attr('action');
        $(".manage_banner").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            
            $('body').modalmanager('loading');
            
            $.getJSON(url, function(data) {
                
                $('#manageBanner').attr('action', editUrl + '/' + data.banners.Banner.id);
                
                var template = $("#editTemplate").html();
                
                $("#manageBanner").html(_.template(template, {banner: data.banners.Banner}));
                $('#manageBannerModel').modal('show');
                if(data.banners.Banner.is_on=='1'){
                    $("#BannerIsOn").attr("checked", "checked");
                }else{
                    $("#BannerIsOn").removeAttr("checked");
                }
                if (data.banners.Banner.image != '') {
                    $('.switchImage').show();
                } else {
                    $('.switchImage').hide();
                }
                if(data.banners.Banner.id==""){
                    $("#BannerImage").attr("required", "required");
                }
            });
        });
    });
    function ckeckFileSize(obj, siz) {
        if (obj.value != '') {
            var ext = obj.value.split('.').pop();
            if (ext == "" || ext == "png" || ext == "gif" || ext == "jpg" || ext == "jpeg") {
            } else {
                alert("Please select a valid file.");
                obj.value = "";
                return false;
            }
        } else {
            alert("Please select a valid file.");
            obj.value = "";
            return false;
        }

        var maxUploadSize = siz * 1024 * 1024;
        if (obj.files[0].size > maxUploadSize) {
            alert("Image size should be less than " + siz + " MB.");
            obj.value = "";
            return false;
        } else {
            return true;
        }
    }
</script>