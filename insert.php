#!/usr/local/bin/php

<?php

session_start();

$ssn=$_POST["inputSSN"];
$firstname=$_POST["inputFirstName"];
$lastname=$_POST["inputLastName"];
$gender=$_POST["inputGender"];
$dob=$_POST["inputDOB"];
$phone=$_POST["inputPhoneNumber"];
$address=$_POST["inputAddress"];
$password=$_POST["inputPassword"];
$email=$_POST["inputEmail"];

if($gender == 'Male'){
	$gender='M';
}
else{
	$gender='F';
}

$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, "SELECT * FROM USERS WHERE SSN='$ssn'");

$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$row = oci_fetch_object($stid);

$count = oci_num_rows($stid);
if ($count == 0) {
	$stid1 = oci_parse($conn, "SELECT MAX(CUSTOMERID) AS LAST FROM CUSTOMER");
	$r1 = oci_execute($stid1);
	if (!$r1) {
		$e = oci_error($stid1);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row1 = oci_fetch_object($stid1);
	$customerid = $row1->LAST + 1;
	$_SESSION["customerid"]=$customerid;
	$_SESSION["name"]=$firstname;
	
	$stid2 = oci_parse($conn, "INSERT INTO USERS VALUES('$ssn','$firstname', '$lastname', '$dob', '$phone', '$email', '$gender', '$password')");

	$r2 = oci_execute($stid2);
	if (!$r2) {
		$e = oci_error($stid2);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$stid3 = oci_parse($conn, "INSERT INTO CUSTOMER VALUES('$customerid','$address','$ssn')");

	$r3 = oci_execute($stid3);
	if (!$r3) {
		$e = oci_error($stid3);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$stid4 = oci_parse($conn, "SELECT MAX(ACCOUNTNUM) AS ACC FROM ACCOUNT");

	$r4 = oci_execute($stid4);
	if (!$r4) {
		$e = oci_error($stid4);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row2 = oci_fetch_object($stid4);
	$accountnum = $row2->ACC + 1;
	
	$stid5 = oci_parse($conn, "INSERT INTO ACCOUNT VALUES('$accountnum','0','$customerid','$ssn')");

	$r5 = oci_execute($stid5);
	if (!$r5) {
		$e = oci_error($stid5);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	header('location: user.php');
	
} else{
	$_SESSION["exist"]="Account Already Exist";
	header('location: login.php');
}

oci_free_statement($stid);
oci_free_statement($stid1);
oci_free_statement($stid2);
oci_free_statement($stid3);
oci_free_statement($stid4);
oci_free_statement($stid5);
oci_close($conn);
?>
