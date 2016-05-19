#!/usr/local/bin/php
 
<?php
$usersNum = 0;
$transactionNum = 0;
$forexNum = 0;
$customerNum = 0;
$adminNum = 0;
$accountNum = 0;

$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
 

$stid1 = oci_parse($conn, "SELECT COUNT(*) AS USERSNUM  FROM USERS");
$stid2 = oci_parse($conn, "SELECT COUNT(*) AS TRANSACTIONNUM  FROM TRANSACTION");
$stid3 = oci_parse($conn, "SELECT COUNT(*) AS FOREXNUM  FROM FOREX");
$stid4 = oci_parse($conn, "SELECT COUNT(*) AS CUSTOMERNUM  FROM CUSTOMER");
$stid5 = oci_parse($conn, "SELECT COUNT(*) AS ADMINNUM  FROM ADMIN");
$stid6 = oci_parse($conn, "SELECT COUNT(*) AS ACCOUNTNUM  FROM ACCOUNT");
/*
if (!$stid1 && !$stid2 && !$stid3 && !$stid4 && !$stid5 && !$stid6) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/
// Perform the logic of the query
$r1 = oci_execute($stid1);
$r2 = oci_execute($stid2);
$r3 = oci_execute($stid3);
$r4 = oci_execute($stid4);
$r5 = oci_execute($stid5);
$r6 = oci_execute($stid6);
/*
if (!$r1 && !$r2 && !$r3 && !$r4 && !$r5 && !$r6) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/
$row1 = oci_fetch_object($stid1);
$row2 = oci_fetch_object($stid2);
$row3 = oci_fetch_object($stid3);
$row4 = oci_fetch_object($stid4);
$row5 = oci_fetch_object($stid5);
$row6 = oci_fetch_object($stid6);

$usersNum = $row1->USERSNUM;
$transactionNum = $row2->TRANSACTIONNUM;
$forexNum = $row3->FOREXNUM;
$customerNum = $row4->CUSTOMERNUM;
$adminNum = $row5->ADMINNUM;
$accountNum = $row6->ACCOUNTNUM;
$total = $usersNum + $transactionNum + $forexNum + $customerNum + $adminNum + $accountNum;

echo "The total number of tuples in USERS are $usersNum" . ".<br>";
echo "The total number of tuples in TRANSACTION are $transactionNum" . ".<br>";
echo "The total number of tuples in FOREX are $forexNum" . ".<br>";
echo "The total number of tuples in CUSTOMER are $customerNum" . ".<br>";
echo "The total number of tuples in ADMIN are $adminNum" . ".<br>";
echo "The total number of tuples in ACCOUNT are $accountNum" . ".<br>";
echo "The total number of tuples in our database are $total";

oci_free_statement($stid1);
oci_free_statement($stid2);
oci_free_statement($stid3);
oci_free_statement($stid4);
oci_free_statement($stid5);
oci_free_statement($stid6);

oci_close($conn);
 
?>
