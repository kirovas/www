<?
session_start();
$s = $_SERVER['DOCUMENT_ROOT'];
if ($_SESSION['auth_admin'] == "yes_auth")
{
        define('myeshop', true);      
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
$_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='category.php' >Категории</a>"; 
include($s."/admin/include/db_connect.php");
$kat_sel = $_POST[name];
$result_2 = mysql_query("SELECT * FROM category WHERE kat_id='$kat_sel'",$link);
 WHILE($row2 = mysql_fetch_array($result_2)){
    
        echo ' <option value="'.$row2[id].'">'.$row2[type].'</option>';    
    
 } 

}