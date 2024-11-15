<?php
$schedule_id =$_GET['schedule_id'];
$sql =" DELETE FROM work_schedule WHERE  schedule_id =$schedule_id";
$query = $conn->query($sql); 
header('location:?module=work_schedule&action=list')
?>