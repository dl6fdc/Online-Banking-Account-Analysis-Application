#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];

$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement
$stid = oci_parse($conn, "SELECT * FROM USERS JOIN CUSTOMER ON CUSTOMER.SSN=USERS.SSN WHERE CUSTOMER.CUSTOMERID='$customerid' AND USERS.PASSWORD='$password'");

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid1 = oci_parse($conn, "SELECT * FROM ACCOUNT WHERE CUSTOMERID='$customerid'");
// Perform the logic of the query
$r1 = oci_execute($stid1);
if (!$r1) {
    $e = oci_error($stid1);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$row = oci_fetch_object($stid1);
$balance=$row->BALANCE;
?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>User</title>
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
			<li><a href="user.php"><?php echo $name ?></a></li>
        	<li><a href="accountdetails.php">Account Details</a></li>
          	<li><a href="#services">About Us</a></li>
          	<li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>

<div class="content container">
  <div class="row">

    <section class="col-md-12">
<h2>
	<?php echo "Welcome " . $name ?>
</h2>
    </section>
    <section class="col-md-6">
      <h3>Account Details</h3>
      <div class="rowi">
        <section class="col-md-6"><p>Customer ID</p></section>
        <section class="col-md-6"><p>Balance</p></section>
        <section class="col-md-6"><p><?php echo $customerid ?></p></section>
        <section class="col-md-6"><p><?php echo $balance ?></p></section>
      </div>
    </section>
    <section class="col-md-6">
      <h3>Transactions</h3>
        <section class="col-md-3"><p>Transaction ID</p></section>
        <section class="col-md-2"><p>Date</p></section>
        <section class="col-md-3"><p>Category</p></section>
        <section class="col-md-2"><p>Amount</p></section>
        
        <?php
			$stid2 = oci_parse($conn, "SELECT * FROM TRANSACTION WHERE CUSTOMERID='$customerid' ORDER BY DOT DESC");
			// Perform the logic of the query
			$r2 = oci_execute($stid2);
			if (!$r2) {
				$e = oci_error($stid2);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			
			$i = 0;
			while (($row1 = oci_fetch_array($stid2, OCI_BOTH)) != false && $i < 5) {				
				print ("<section class=\"col-md-3\"><p>" . $row1['TRANSACTIONID'] . "</p></section>");
				print ("<section class=\"col-md-2\"><p>" . $row1['DOT'] . "</p></section>");
				print ("<section class=\"col-md-3\"><p>" . $row1['CATEGORY'] . "</p></section>");
				print ("<section class=\"col-md-2\"><p>" . $row1['AMOUNT'] . "</p></section>");
				$i += 1;
			}
			
			oci_free_statement($stid);
			oci_free_statement($stid1);
			oci_free_statement($stid2);
			
			oci_close($conn);
		?>
        
    </section>

  </div><!-- row -->
  <div class="row">
    <section class="col-md-12">
      <h3>Main Menu</h3>
      <ul>
        <li><a href="analysis.php">Transactions Analysis</a></li>
        <li><a href="searchtransaction.php">Search Transaction</a></li>
        <li><a href="loan.php">Inquire Loan</a></li>
        <li><a href="forex.html">Foreign Exchange Amount</a></li>
      </ul>
    </section>
  </div> 
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
