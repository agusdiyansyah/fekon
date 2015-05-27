<link href="<?php echo base_url();?>inventory/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>inventory/js/jquery.js" ></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".thumbnail").click(function(event) {
			event.preventDefault();
			var funcNum = getUrlParam('CKEditorFuncNum');
			var fileUrl = $(this).data('url');
			window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
			window.close();
		});
	});
	// Helper function to get parameters from the query string.
	function getUrlParam(paramName){
	  var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
	  var match = window.location.search.match(reParam) ;
	  return (match && match.length > 1) ? match[1] : '' ;
	}
</script>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Pilih Gambar</h3>
	  </div>
	  <div class="panel-body">
	  	<div class="row">
			<?php
				if (count($directory)>0) {
					$directory_image = base_url()."inventory/gambar/static_content/";					
					foreach ($directory as $record) {
						echo '<div class="col-sm-3 col-md-3">';
							$mime = get_mime_by_extension($record);
							if ($mime == "image/jpeg" or $mime == "image/png") {
								echo '<a href="#" class="thumbnail" data-url="'.$directory_image.$record.'">';
								echo "<img src='".$directory_image.$record."' width='250px' height='250px'>";
								echo '</a>';
							}
						echo '</div>';
					}
				}
			?>
	  	</div>
	  </div>
</div>	