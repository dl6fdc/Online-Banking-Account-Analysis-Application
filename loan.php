#!/usr/local/bin/php
<?php 
session_start();
$customerid = $_SESSION["customerid"];
$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$stid = oci_parse($conn, "SELECT BALANCE FROM ACCOUNT WHERE CUSTOMERID='$customerid'");
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    $accountBalance = floatval($row['BALANCE']);
}


if ($accountBalance < 2000)
	$rate = 7;
elseif ($accountBalance < 4000)
	$rate = 6;
elseif ($accountBalance < 6000)
	$rate = 5;
elseif ($accountBalance < 8000)
	$rate = 4;
elseif ($accountBalance < 10000)
	$rate = 3;
else
	$rate = 2.5;

$newaccountbalance = 1.40 * $accountBalance;

oci_free_statement($stid);
oci_close($conn);

?>

<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <title>Inquire Loan</title>
  <link rel="stylesheet" href="/CSS/styles.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index1.php">Online Banking Application</a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
			<li><a href="user.php"><?php echo $_SESSION["name"] ?></a></li>
          <li><a href="accountdetails.php">Account Details</a></li>
            <li><a href="#services">About Us</a></li>
            <li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
<div class="container">
  <div class="row">
<section class="col-md-12">
      <h3>Check Loan</h3>
        <section class="col-md-6"><p>Account Balance: </p></section>
        <section class="col-md-6"><p><?php echo $accountBalance; ?></p></section>
        <section class="col-md-6"><p>Maximum Amount of Money: </p></section>
        <section class="col-md-6"><p><?php echo $newaccountbalance; ?></p></section>
        <section class="col-md-6"><p>Best Interest Rate Offered: </p></section>
        <section class="col-md-6"><p><?php echo $rate; ?></p></section>
</section>
</div>    
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
