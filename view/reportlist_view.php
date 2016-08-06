<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 

/**
* Report list view
* @author Abhik Chakraborty
*/  
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12"> 
					<div class="datadisplay-outer">
						<div id="message"></div>
						<div>
						<!-- add new button -->
						<?php 
						if ($_SESSION["do_crm_action_permission"]->action_permitted('add',$module_id) === true) {
						?>
						<a href="/modules/<?php echo $module?>/add" class="btn btn-primary btn-mini bs-prompt">
						<i class="icon-white icon-plus"></i> <?php echo _('add new');?>
						</a>
						<?php 
						} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12"> 
					<?php
					foreach ($left as $key=>$val) {
						$folder_name =  $val["name"];
					?>
					<div class="datadisplay-outer" id="report_folder_<?php echo $val["idreport_folder"];?>">
						<?php
						$reports = $do_report->get_reports_by_folder($val["idreport_folder"]);
						require('view/reportlist_view_entry.php');
						?>
					</div>
					<?php 
					} ?>	
				</div>
			</div>
		</div>	
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12"> 
					<?php
					foreach ($right as $key=>$val) {
						$folder_name =  $val["name"];
					?>
					<div class="datadisplay-outer" id="report_folder_<?php echo $val["idreport_folder"];?>">
						<?php
						$reports = $do_report->get_reports_by_folder($val["idreport_folder"]);
						require('view/reportlist_view_entry.php');
					?>
					</div>
					<?php 
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="report_delete_confirm">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3><span class="label label-warning"><?php echo _('WARNING')?></span></h3>
			</div>
			<div class="modal-body">
				<?php echo _('Are you sure you want to delete the record.');?>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> <?php echo _('Close');?></a>
				<input type="submit" class="btn btn-primary" value="<?php echo _('Delete')?>"/>
			</div>
		</div>
	</div>
</div>
<script>
function del_report(idreport,report_folder,folder_name) {
	$("#report_delete_confirm").modal('show');
	$("#report_delete_confirm .btn-primary").click(function() {
		$("#report_delete_confirm").modal('hide');
		$.ajax({
			type: "POST",
			<?php
			$e_del_single = new Event("CRMDeleteEntity->eventAjaxDeleteSingleEntity");
			$e_del_single->setEventControler("/ajax_evctl.php");
			$e_del_single->addParam('module',$module);
			$e_del_single->addParam('referrer','list');
			$e_del_single->setSecure(false);
			?>
			url: "<?php echo $e_del_single->getUrl(); ?>&sqrecord="+idreport,
			success:  function(html) {
				ret_data = html.trim();
				if (ret_data == '0') {
					var err_element = '<div class="alert alert-error sqcrm-top-message" id="sqcrm_auto_close_messages"><a href="#" class="close" data-dismiss="alert">&times;</a>' ;
					var err_msg = err_element+'<strong>'+UNAUTHORIZED_DELETE+'</strong></div>';
					$("#message").html(err_msg);
					$("#message").show();
				} else {
					$.ajax({
						type: "GET",
						url: "list",
						data : "ajaxreq="+true+"&folderid="+report_folder+"&foldername="+folder_name,
						success: function(result) { 
							var folder_block = 'report_folder_'+report_folder ;
							$('#'+folder_block).html(result);
							var succ_element = '<div class="alert alert-success sqcrm-top-message" id="sqcrm_auto_close_messages"><a href="#" class="close" data-dismiss="alert">&times;</a>' ;
							var succ_msg = succ_element+'<strong>'+DATA_DELETED_SUCCESSFULLY+'</strong></div>';
							$("#message").html(succ_msg);
							$("#message").show();
						}
					});
				}
			}
		});
	});
}
</script>