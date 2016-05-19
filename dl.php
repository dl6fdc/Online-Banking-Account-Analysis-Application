#!/usr/local/bin/php

<?php

session_start();

$userid=$_POST["username"];
$password=$_POST["password"];


$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement
$stid = oci_parse($conn, "SELECT * FROM USERS JOIN CUSTOMER ON CUSTOMER.SSN=USERS.SSN WHERE CUSTOMER.CUSTOMERID='$userid' AND USERS.PASSWORD='$password'");
//$stid = oci_parse($conn, "SELECT * FROM USERS");
/*if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}*/

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

/*
while (($row = oci_fetch_object($stid)) != false) {
    // Use upper case attribute names for each standard Oracle column
    echo $row->FIRSTNAME . "<br>\n";
    
}
*/



// Fetch the results of the query
/*print "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";*/
$row = oci_fetch_object($stid);
$count = oci_num_rows($stid);
if ($count == 1) {
	

	$_SESSION["customerid"]=$row->CUSTOMERID;
	$_SESSION["name"]=$row->FIRSTNAME;
	header('location: user.php');
} else{
	$stid1 = oci_parse($conn, "SELECT * FROM USERS JOIN ADMIN ON USERS.SSN=ADMIN.SSN WHERE ADMIN.ADMINID='$userid' AND USERS.PASSWORD='$password'");
	$r1 = oci_execute($stid1);
	if (!$r1) {
		$e = oci_error($stid1);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row1 = oci_fetch_object($stid1);
	$count1 = oci_num_rows($stid1);
	
	if($count1 == 1){
		$_SESSION["customerid"]=$row1->ADMINID;
		$_SESSION["name"]=$row1->FIRSTNAME;
		header('location: admin.php');
	}
	else{
		$_SESSION["incorrect"]="Incorrect Username or Password";
		header('location: login.php');
	}
}


oci_free_statement($stid);
oci_close($conn);

?>

