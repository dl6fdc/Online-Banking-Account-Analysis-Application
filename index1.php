#!/usr/local/bin/php
<?php
session_start();

$name=$_SESSION["name"];
$customerid=$_SESSION["customerid"];

?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Home Page</title>
	<link rel="stylesheet" href="/CSS/styles.css">
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-o<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Home Page</title>
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

    <section class="col-sm-12">
      <h2>Bank Account DataBase Systems</h2>      
      <p> We help our customers to manage their money more wisely </p>

      <p>Everyone has different financial needs, which is why we offers a variety of spending analysis , along with guidance from a team of people who genuinely care about helping you reach your financial goals.</p>
    </section>

    <section class="col-sm-4">
      <h3>Transaction Analysis</h3>
      <p>Accounting transaction analysis is the process involved of the first step in the accounting cycle which is to identify and analyze transactions</p>
      <a href="#">read articles</a>
    </section>

    <section class="col-sm-4">
      <h3>Foreign Exchange</h3>
      <p>Traveling abroad but not sure where to get the best exchange rate for your currency? Want to remit money back home and still trying to figure the money transfer rates..</p>
      <a href="#">read articles </a>
    </section>

    <section class="col-sm-4">
      <h3>Loan</h3>
      <p>Be prepared for the expected and the unexpected with the flexibility of a Line of Credit, a ready source of funds that allows you to borrow what you need (up to your credit limit) when you need it.</p>
      <a href="#">read articles</a>
    </section>
  </div><!-- row -->   
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>nly">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Online Banking Application</a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
        	<li><a href="login.html">Sign In/Sign Up</a></li>
          	<li><a href="#services">About Us</a></li>
          	<li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>

<div class="content container">
  <div class="row">

    <section class="col-sm-12">
      <h2>Bank Account DataBase Systems</h2>      
      <p> We help our customers to manage their money more wisely </p>

      <p>Everyone has different financial needs, which is why we offers a variety of spending analysis , along with guidance from a team of people who genuinely care about helping you reach your financial goals.</p>
    </section>

    <section class="col-sm-4">
      <h3>Transaction Analysis</h3>
      <p>Accounting transaction analysis is the process involved of the first step in the accounting cycle which is to identify and analyze transactions</p>
      <a href="#">read articles</a>
    </section>

    <section class="col-sm-4">
      <h3>Foreign Exchange</h3>
      <p>Traveling abroad but not sure where to get the best exchange rate for your currency? Want to remit money back home and still trying to figure the money transfer rates..</p>
      <a href="#">read articles </a>
    </section>

    <section class="col-sm-4">
      <h3>Loan</h3>
      <p>Be prepared for the expected and the unexpected with the flexibility of a Line of Credit, a ready source of funds that allows you to borrow what you need (up to your credit limit) when you need it.</p>
      <a href="#">read articles</a>
    </section>
  </div><!-- row -->   
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
