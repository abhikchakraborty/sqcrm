<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 

/**
* reports view entry per folder
* @author Abhik Chakraborty
*/
?>
<p><?php echo $folder_name; ?></p>
<table class="datadisplay">  
	<thead>  
		<tr>  
			<th>#</th>  
			<th><?php echo _('Report Name');?></th>  
			<th><?php echo _('Description');?></th>  
			<th><?php echo _('Action')?></th>  
		</tr>  
	</thead>
<?php
if (count($reports) > 0) {
	$cnt = 0;
?>
	<tbody>
		<?php
		foreach ($reports as $k=>$v) { ?>
		<tr>  
			<td width="5%"><?php echo ++$cnt;?></td>  
			<td width="30%">
				<a href="<?php echo NavigationControl::getNavigationLink($module,"run_report",$v["idreport"])?>">
				<?php echo $v["name"];?>
				</a>
			</td>  
			<td width="50%"><?php echo nl2br($v["description"]);?></td>
			<td width="15%">
				<a href="<?php echo NavigationControl::getNavigationLink($module,"edit",$v["idreport"])?>" class="btn btn-primary btn-xs">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
				</a>
				<a href="#" onclick = "del_report('<?php echo $v["idreport"];?>','<?php echo $val["idreport_folder"];?>','<?php echo $folder_name;?>')" class="btn btn-primary btn-xs" id="">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
			</td>  
		<?php
		}
		?>
	</tbody>
	<?php 
	} ?>
</table>