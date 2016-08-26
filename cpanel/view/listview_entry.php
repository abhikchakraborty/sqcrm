<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 
/**
* View modal for the list view of crm module data
* Included in the module/list.php file
* Get the filed information of module for the list view and generate the header for the datatable display
* Sets the fields information in the object member list_view_field_information and sets the object in the persistent session
* @author Abhik Chakraborty
*/

$lp = 'n';
$lp_object = '';
$method = '';
$method_param = '';
$lp_mid = '';
?>
<link href="/js/plugins/DataTables/datatables.min.css" rel="stylesheet">
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	//Setting a nosort columns
	var dontSort = [];
	$('#sqcrmlist thead th').each( function() {
		if ($(this).hasClass('no_sort')) {
			dontSort.push({"bSortable": false});
		} else {
			dontSort.push(null);
		}
	});
	// no sort columns setting ends here

    oTable = $('#sqcrmlist').dataTable({
		responsive: true,
		stateSave: true,
		"oLanguage":{
			"sProcessing": "<img src=\"/themes/images/ajax-loader1.gif\" border=\"0\" />",
				"sLengthMenu": "<?php echo _('Show _MENU_ records per page');?>",
				"sZeroRecords": "<?php echo _('No record found');?>",
				"sInfo" : "<?php echo _('Showing _START_ to _END_ of _TOTAL_ records');?>",
				"sInfoEmpty": "<?php echo _('Showing 0 to 0 of 0 records');?>",
				"sInfoFiltered": "<?php echo _('(filtered from _MAX_ total records)');?>",
				"sSearch" : "<?php echo _('Search on all columns');?>",
				"oPaginate": {
					"sFirst": "<?php echo _('First');?>",
					"sPrevious": "<?php echo _('Previous');?>",
					"sNext": "<?php echo _('Next');?>",
					"sLast": "<?php echo _('Last');?>"
				}
		},
		"pageLength": <?php echo '50' ;?>,
		"aoColumns":dontSort,
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "full_numbers",
		"bAutoWidth": false,
		"sAjaxSource": "/cpanel/listdata.php?m=<?php echo $module;?>&mid=<?php echo $module_id;?>&module_namespace=<?php echo $module_namespace;?>&lp=<?php echo $lp;?>&lp_mid=<?php echo $lp_mid ;?>&lp_object=<?php echo $lp_object;?>&method=<?php echo $method;?>&method_param=<?php echo $method_param;?>&custom_view_id=<?php echo $custom_view_id;?>",
		"fnServerParams": function ( aoData ) {
			aoData.push( { "name": "more_data", "value": "my_value" } );
		}
	});        
});
</script>

<div class="datadisplay-outer">
<table class="datadisplay dt-responsive" id="sqcrmlist" cellspacing="0" width="100%">
	<thead>
		<tr>
		<?php
			foreach ($fields_info as $field=>$info) {
				echo '<th width="10%">'.$info["field_label"].'</th>';
			}
			if ($lp == 'y') {
				echo '<th width="1%" class="no_sort">&nbsp;</td>';
			} else {
				echo '<th width="10%" class="no_sort">&nbsp;</td>';
			}
		?>
		</tr>
	</thead>
</table>
</div>