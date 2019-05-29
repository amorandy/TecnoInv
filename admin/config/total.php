<?php 

include "config.php";

    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-0days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total1 = $arr["total"];

    if($total1 == NULL) {
	
	
	$total1 = 0;
	
	
}


   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-1days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total2 = $arr["total"];

    if($total2 == NULL) {
	
	
	$total2 = 0;
	
	
}

   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-2days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total3 = $arr["total"];

    if($total3 == NULL) {
	
	
	$total3 = 0;
	
	
}

   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-3days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total4 = $arr["total"];

    if($total4 == NULL) {
	
	
	$total4 = 0;
	
	
}

   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-4days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total5 = $arr["total"];

    if($total5 == NULL) {
	
	
	$total5 = 0;
	
	
}

   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-5days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total6 = $arr["total"];

    if($total6 == NULL) {
	
	
	$total6 = 0;
	
	
}

   $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date)='".date("Y-m-d", strtotime ("-6days"))."'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
				
    $total7 = $arr["total"];

    if($total7 == NULL) {
	
	
	$total7 = 0;
	
	
}

mysqli_close($db_connect); 