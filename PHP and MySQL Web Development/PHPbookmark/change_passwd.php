<?php 
require_once('bookmrak_fns.php');
session_start();
do_html_header('Change passwd');
check_valid_user();
display_passwd_form();
display_user_menu();
do_html_footer();
?>