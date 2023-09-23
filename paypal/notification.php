<?php

	include('../config.php');
	$encode = json_encode($_POST);
	mysql_query("INSERT INTO `log` (log) VALUES ('".mysql_real_escape_string($encode)."')");
	$postdata=""; 
	foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&"; 
	$postdata .= "cmd=_notify-validate";  
	$curl = curl_init("https://www.paypal.com/cgi-bin/webscr"); 
	curl_setopt($curl, CURLOPT_HEADER, 0);  
	curl_setopt($curl, CURLOPT_POST, 1); 
	curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); 
	$response = curl_exec($curl); 
	curl_close($curl); 
	if ($response != "VERIFIED") {
		die("You should not do that ...");
	}
	if (isset($_POST['parent_txn_id'])) {
		$trid = $_POST['parent_txn_id'];
	} else {
		$trid = $_POST['txn_id'];
	}
	$tmppayment = mysql_query("SELECT * FROM payments WHERE trid = '".$trid."'");
	if (mysql_num_rows($tmppayment) == 1) {
		$payment = mysql_fetch_assoc($tmppayment);
		mysql_query("UPDATE payments SET status = '".$_POST['payment_status']."' WHERE trid = '".$trid."'");
		exit;
	}
	if ($_POST['receiver_email'] == 'valerij.lavrov@inbox.lv') {
		$name = mysql_real_escape_string($_POST['first_name'].' '.$_POST['last_name']);
		$address = mysql_real_escape_string($_POST['address_street']);
		$zip = mysql_real_escape_string($_POST['address_zip']);
		$email = mysql_real_escape_string($_POST['payer_email']);
		$phone = mysql_real_escape_string($_POST['contact_phone']);
		$item_name = mysql_real_escape_string($_POST['item_name']);
		$trid = mysql_real_escape_string($_POST['txn_id']);
		$status = mysql_real_escape_string($_POST['payment_status']);
		$query = "INSERT INTO `payments` (name, address, zip, email, item_name, trid, status, archive) VALUES ('".$name."', '".$address."', '".$zip."', '".$email."', '".$item_name."', '".$trid."', '".$status."', 0)";
		mysql_query("INSERT INTO `payments` (name, address, zip, email, phone, item_name, trid, status, archive) VALUES ('".$name."', '".$address."', '".$zip."', '".$email."', '".$phone."', '".$item_name."', '".$trid."', '".$status."', 0)");
	}
?>
