<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 

/**
* Detail page 
* @author Abhik Chakraborty
*/  

$do_crmfields = new CRMFields();
$do_block = new Block();
$do_block->get_block_by_module($module_id);

$module_obj = new Calendar();
$module_obj->getId($sqcrm_record_id);

//updates detail, just add and last updated
$do_crmentity = new CRMEntity();
$update_history = $do_crmentity->get_last_updates($sqcrm_record_id,$module_id,$module_obj);

// Recurrent events info
$recurrent_events = new RecurrentEvents();
$recurrent_events_pattern = $recurrent_events->has_recurrent_events($sqcrm_record_id);
if (false !== $recurrent_events_pattern)
	$recurrent_events_pattern = json_decode($recurrent_events_pattern,true);
  
$text_options = $recurrent_events->get_text_options();
$days_in_week = $recurrent_events->get_days_in_week();

//event reminder info
$do_events_reminder = new EventsReminder() ;
$reminder = $do_events_reminder->get_event_reminder($sqcrm_record_id);

if (isset($_GET['ajaxreq']) && $_GET['ajaxreq'] == true) {
	require_once('view/detail_view_entry.php');
} else {
	require_once('view/detail_view.php');
}
?>