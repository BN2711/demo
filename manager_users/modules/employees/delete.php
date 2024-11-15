<?php
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<?php
$employee_id =$_GET['employee_id'];
$sql =" DELETE FROM employees WHERE  employee_id =$employee_id";
$query = $conn->query($sql); 
header('Location: ?module=employees&action=list')
?>