<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt
/**
* Create report step2 view 
* @author Abhik Chakraborty
*/ 
$do_report_module_rel = new ReportModuleRel();
$primary_modules = $do_report_module_rel->get_primary_modules();
$selected_primary_module = 0 ;
if (isset($edit) && $edit == 1) {
	$do_report_module_rel = new ReportModuleRel();
	$report_modules = $do_report_module_rel->get_report_modules($sqcrm_record_id);
	$selected_primary_module = $report_modules["primary"]["idmodule"];
} elseif (isset($_SESSION["primary_module"]) && $_SESSION["primary_module"] != '') {
	$selected_primary_module = $_SESSION["primary_module"] ; 
}
$e_set_report_data = new Event("Report->eventSetReportData");
$e_set_report_data->addParam("step","2");
if (isset($edit) && $edit == 1) {
	$edit_msg = _('Update Report');
	$e_set_report_data->addParam("mode","edit");
	$e_set_report_data->addParam("sqrecord",$sqcrm_record_id);
} else {
	$edit_msg = _('Create Report');
	$e_set_report_data->addParam("mode","add");
}
echo '<form class="form-horizontal" id="Report__eventSetReportData" name="Report__eventSetReportData" action="/eventcontroler.php" method="post">';
echo $e_set_report_data->getFormEvent();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box_content">
				<p><strong><?php echo $edit_msg;?> > <?php echo _('Step 2');?></strong></p>
				<p class="lead"><?php echo _('Select primary module for the report')?></p> 
			</div>
			<div class="box_content">
				<div class="row">
					<div class="col-xs-6">
						<select name="primary_module" id="primary_module" class="form-control input-sm">
							<?php
							foreach ($primary_modules as $key=>$val) { ?>
							<option value="<?php echo $key?>" <?php if($selected_primary_module == $key) echo "SELECTED"; ?>><?php echo $val ;?></option>
							<?php }
							?>
						</select>
					</div>
				</div>
				<br />
				<hr class="form_hr">
				<?php
				if (isset($edit) && $edit == 1) {
				?>
				<a href="<?php echo NavigationControl::getNavigationLink($module,"edit?step=1&sqrecord=".$sqcrm_record_id);?>" class="btn btn-default active">
				<?php } else { ?>
				<a href="<?php echo NavigationControl::getNavigationLink($module,"add?step=1");?>" class="btn btn-default active">
				<?php } ?>
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> <?php echo _('Back');?></a>  
				<input type="submit" class="btn btn-primary" value="<?php echo _('Next');?>"/>
			</div>
			</form>
		</div>
	</div>
</div>