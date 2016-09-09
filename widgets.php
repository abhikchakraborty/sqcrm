<?php 
// Copyright SQCRM. For licensing, reuse, modification and distribution see license.txt 
/**
* widget request handler
* All the widget which includes HTML output are routed via this file 
* @see includes/modules.footer.inc.php load_detail_view_plugin()
* @author Abhik Chakraborty
*/

include_once("config.php") ;
$widget_name = $_REQUEST["widget_name"] ;
$resource_name = $_REQUEST["resource_name"] ;

if (!is_object($_SESSION["do_user"])) {
	$show_login_on_session_expire = true ;
	$session_expire_message = _('Your session has been expired, please login again.');
}
if (is_object($_SESSION['do_user'])) {
	try {
		if (!$_SESSION['do_user']->iduser) {
			$show_login_on_session_expire = true ;
			$session_expire_message = _('Error getting the user information, looks like your session has been expired. Please login again.');
		}
	} catch (Exception $e) {
		$show_login_on_session_expire = true ;
		$session_expire_message = _('Your session has been expired, please login again.');
	}
}
if ($show_login_on_session_expire === true) {
	$login_next_url = 'current_page';
	$_SESSION["do_crm_messages"]->set_message('error',$session_expire_message);
	include("includes/header.inc.php") ;
	include("includes/pagetop.inc.php") ;
	require('modules/User/login.php');
	include("includes/footer.inc.php");
	exit;
} else {
	$allow_disp = $_SESSION["do_crm_action_permission"]->action_permitted_user('view',$module_id) ;
	if (true === $allow_disp) {
		require('widgets/'.$widget_name.'/'.$resource_name.'.php');
	} else {
		echo '<div class="alert alert-danger">';
		echo '<strong>';
		echo _('Access Denied ! ');
		echo '</strong>';
		echo _('You are not authorized to perform this operation.');
		echo '</div>';
	}
}
?>