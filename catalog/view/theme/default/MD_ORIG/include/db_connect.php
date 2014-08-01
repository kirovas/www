<?php
defined('myeshop') or die('Доступ запрещён!');
/*
$db_host		= 'allsoft.mysql.ukraine.com.ua';
$db_user		= 'allsoft_vishivka';
$db_pass		= 'ffuwchub';
$db_database	= 'allsoft_vishivka';
*/
$db_host		= 'localhost';
$db_user		= 'vishivka';
$db_pass		= '';
$db_database	= 'vishivka';

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db($db_database,$link) or die("Нет соединения с БД ".mysql_error());
mysql_query("SET names utf8");
//var

$linc_img = '/vishivka.pl.ua/www/image/data/velo/';
?>