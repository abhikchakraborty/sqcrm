<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 

/**
* detail view page
* @author Abhik Chakraborty
*/  
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-12">
					<div class="datadisplay-outer">
						<?php 
						require("detail_view_toptabs.php");
						?>
						<div id="detail_view_section">
							<?php
							require("detail_view_entry.php");
							?>
						</div>
					</div>
				</div>
			</div><!--/row-->
		</div><!--/span-->
		<?php 
		require("detail_view_rightblock.php");
		?>
	</div><!--/row-->
</div>