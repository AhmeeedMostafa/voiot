<?php
ob_start();
session_start();
$host 	 = 'localhost';
$user	 = 'root';
$pass	 = '';
$DB_name = 'voiot';

$DB 	 = new mysqli($host,$user,$pass,$DB_name);
if ($DB->connect_error){
	die ("Connect Error : ".$DB->connect_error);
}

$get_site_settings = $DB->query("SELECT * FROM `site_settings`");
$res_site_settings = $get_site_settings->fetch_object();

$sname 			= $res_site_settings->sname;
$sdescription 	= $res_site_settings->sdescription;
$skeywords 		= $res_site_settings->skeywords;
$scase 			= $res_site_settings->scase;
$sclosemsg 		= $res_site_settings->sclosemsg;
$smail 			= $res_site_settings->smail;
?>