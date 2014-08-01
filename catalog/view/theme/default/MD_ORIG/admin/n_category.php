<?php
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
  include($s."/admin/include/functions.php");
if ($_POST["submit_cat"])
{
if ($_SESSION['add_category'] == '1')
{

    $error = array();
    
  if (!$_POST["cat_type"])  $error[] = "Укажите тип товара!"; 
  
  
  if (count($error))
  {
      $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>"; 
  }else
  {
     $cat_type = clear_string($_POST["cat_type"]);
    //$cat_brand = clear_string($_POST["cat_brand"]);
     @$kat_id = clear_string($_POST["kat_id"]);
    
                    mysql_query("INSERT INTO category(type,kat_id)
						VALUES(						
                            '".$cat_type."',
                            '".$kat_id."'
                                                          
						)",$link);
                   
     $_SESSION['message'] = "<p id='form-success'>Категория успешно добавлена!</p>";   
  }
    
}else
{
  $msgerror = 'У вас нет прав на добавление категорий!';  
}  

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script> 
    <script type="text/javascript" src="js/my.js"></script> 
	<title>Панель Управления - Категории</title>
</head>
<body>
<div id="block-body">
<?php
	include($s."/admin/include/block-header.php");
?>
<div id="block-content">
<div id="block-parameters">
<p id="title-page" >Категории</p>
</div>


<form>

    
    <input name="add_cat" id="add_cat" type="submit" value="Добавить категорию" />
</form>
<table>
    <tr><td>Имя </td><td>Подкатегория</td><td>Действие</td></tr>
<?
    $q_kat = mysql_query("SELECT * FROM category")or die(mysql_error());
    while ($rowq_kat = mysql_fetch_array($q_kat)){
        
       $q_kat2 = mysql_query("SELECT * FROM category WHERE  '$rowq_kat[id]=$rowq_kat[kat_id]'")or die(mysql_error());
      
       
      echo '
      <tr><td>'.$rowq_kat[type].'</td><td>'.$rowq_kat2[id].'</td><td><a href="edit_kat.php?id='.$rowq_kat[id].'">Редактировать</a></td></tr>
      
      
      ';
      
    }
      while( $rowq_kat2 = mysql_fetch_array($q_kat2)){
        echo '<tr><td></td><td>'.$rowq_kat2[type].'</td><td><a href="edit_kat.php?id='.$rowq_kat[id].'">Редактировать</a></td></tr>';
       }


?>

    
  

</table>
</div>
</div>
</body>
</html>
<?php
}else
{
    header("Location: login.php");
}
?>