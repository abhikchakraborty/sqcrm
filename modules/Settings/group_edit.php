<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 

/**
* Group add page
* @author Abhik Chakraborty
*/  

$do_group = new Group();
$do_group_user_rel = new GroupUserRelation();
$do_user = new User();
$do_group->getId($sqcrm_record_id);
$do_user->get_all_users();
$do_group_user_rel->get_users_related_to_group($sqcrm_record_id);

$group_to_users = array();
while ($do_group_user_rel->next()) {
	$group_to_users[$do_group_user_rel->iduser] = $do_group_user_rel->firstname.' '.$do_group_user_rel->lastname.' ('.$do_group_user_rel->user_name.')';
}
  
?>
<div class="container-fluid">
	<div class="row-fluid">
    <?php include_once("modules/Settings/settings_leftmenu.php");?>
		<div class="span9" style="margin-left:3px;">
			<div class="box_content">
				<h3><?php echo _('Settings');?> > <a href="<?php echo NavigationControl::getNavigationLink($module,"group_list")?>"><?php echo _('Group');?></a></h3>
				<p><?php echo _('Manage group and users related to the group')?></p> 
			</div>
			<div class="row-fluid">
				<?php
				$e_edit = new Event("Group->eventEditGroup");
				$e_edit->addParam("idgroup",$sqcrm_record_id);
				$e_edit->addParam("error_page",NavigationControl::getNavigationLink($module,"group_edit"));
				$e_edit->addParam("next_page",NavigationControl::getNavigationLink($module,"group_detail"));
				echo '<form class="form-horizontal" id="Group__eventEditGroup" name="Group__eventEditGroup" action="/eventcontroler.php" method="post">';
				echo $e_edit->getFormEvent();
				?>
				<div class="control-group">  
					<label class="control-label" for="group_name"><?php echo _('Group Name')?></label>  
					<div class="controls">  
						<input type="text" class="input-xlarge-100" id="group_name" name="group_name" value="<?php echo $do_group->group_name ;?>"> 
					</div>
				</div>
				<div class="control-group">  
					<label class="control-label" for="description"><?php echo _('Description');?></label>  
					<div class="controls">  
						<textarea class="input-xlarge" id="description" name="description" rows="3"><?php echo $do_group->description ;?></textarea>  
					</div>  
				</div> 
				<div class="control-group">  
					<div class="controls">  
						<table>
							<tr>
								<td>
									<label class="control-label" for=""><?php echo _('Available Members')?></label><br />
									<select name="select_from" id="select_from" multiple size = "5">
										<?php
										while ($do_user->next()) {
											if (!array_key_exists($do_user->iduser,$group_to_users)) {
												echo '<option value="'.$do_user->iduser.'">'.$do_user->firstname.' '.$do_user->lastname.' ('.$do_user->user_name.')</option>';
											}
										}
										?>
									</select>
								</td>
								<td width="50px;" align="center"><br />
									<a href="#" class="btn btn-success btn-mini-1" id="user_add_select"><i class="icon-white icon-arrow-right"></i></a>
									<br /><br />
									<a href="#" class="btn btn-success btn-mini-1" id="user_remove_select"><i class="icon-white icon-arrow-left"></i></a>
								</td>
								<td>
									<label class="control-label" for=""><?php echo _('Assigned Members')?></label><br />
									<select name="select_to[]" id="select_to" multiple size = "5">
										<?php
										foreach ($group_to_users as $key=>$val) {
											echo '<option value="'.$key.'" SELECTED>'.$val.'</option>';
										}
										?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="form-actions">  
					<a href="<?php echo NavigationControl::getNavigationLink($module,"group_list");?>" class="btn btn-inverse">
					<i class="icon-white icon-remove-sign"></i> <?php echo _('Cancel');?></a>  
					<input type="submit" class="btn btn-primary" value="<?php echo _('Save');?>"/>
				</div>
			</form>
		</div><!--/row-->
	</div><!--/span-->
</div><!--/row-->
</div>