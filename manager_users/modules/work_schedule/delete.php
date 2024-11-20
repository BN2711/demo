<?php
$employee_id =$_GET['employee_id'];
$sql =" DELETE FROM work_schedule WHERE  employee_id =$employee_id";
$query = $conn->query($sql); 
header('location:?module=work_schedule&&action=list')
?>
