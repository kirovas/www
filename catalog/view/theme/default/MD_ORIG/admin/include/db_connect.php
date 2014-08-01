<?php
defined('myeshop') or die('Доступ запрещён!');
$db_host		= 'allsoft.mysql.ukraine.com.ua';
$db_user		= 'allsoft_shop';
$db_pass		= '3s4bhz7a';
$db_database	= 'allsoft_shop'; 

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db($db_database,$link) or die("Нет соединения с БД ".mysql_error());
mysql_query("SET names utf8");
?>