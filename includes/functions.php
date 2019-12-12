<?php
require_once 'config.php';
function meta_tags($page_title){
	global $sdescription, $skeywords;
	echo "<title>$page_title</title>
		<meta http-equiv='content-type' content='text/html; charset=UTF-8' />
		<meta name='author' content='Ahmed Mostafa' />
		<meta name='description' content='".$sdescription."' />
		<meta name='keywords' content='".$skeywords."' />";
}
function includes($style_path = null){
	echo "<link rel='stylesheet' type='text/css' href='".$style_path."styles/style.css' />
	<script src='http://api.html5media.info/1.1.6/html5media.min.js'></script>";
}
function add($tbl,$query_sequel){
	global $DB, $DB_name;
	$add = $DB->query("INSERT INTO `".$DB_name."`.`".$tbl."` ".$query_sequel."");
	return $add;
}
function edit($tbl,$query_sequel){
	global $DB, $DB_name;
	$edit = $DB->query("UPDATE `".$DB_name."`.`".$tbl."` SET ".$query_sequel."");
	return $edit;
}
function get($fields,$tbl,$query_sequel = null){
	global $DB, $DB_name;
	$get = $DB->query("SELECT ".$fields." FROM `".$DB_name."`.`".$tbl."` ".$query_sequel."");
	return $get;
}
function delete($tbl,$query_sequel){
	global $DB, $DB_name;
	$delete = $DB->query("DELETE FROM `".$DB_name."`.`".$tbl."` WHERE ".$query_sequel."");
	return $delete;
}
?>