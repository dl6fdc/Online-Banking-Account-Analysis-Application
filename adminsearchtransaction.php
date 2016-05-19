#!/usr/local/bin/php
<?php
session_start();
?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <title>Search Transactions</title>
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

<form class="form-horizontal" action="adminsearch.php" method="POST">
<h5><?php echo $_SESSION["noinputtransaction"] ?></h5>
<div class="form-group">
  <label class="col-sm-2 control-label"
    for="selectSite">Transaction ID</label>
  <div class="col-sm-10">
  <input class="form-control" type="text"
    id="transactionid" placeholder="Transaction ID" name="transactionid">      
  </div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label"
    for="inputName">Date</label>
  <div class="col-sm-5">
  <input class="form-control" type="date"
    id="idate" placeholder="Name" name="idate">
  </div>
  <div class="col-sm-5">
  <input class="form-control" type="date"
    id="fdate" placeholder="Name" name="fdate">
  </div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label"
    for="inputEmail">Category</label>
  <div class="col-sm-10">
  <select class="form-control" id="category" name="category">
    <option></option>
    <option>Education</option>
    <option>Medical</option>
	<option>Restaurants</option>
    <option>Rent</option>
    <option>Groceries</option>
    <option>Household</option>
    <option>Fuel</option>
  </select>
  </div>
</div>

<div class="form-group">
<div class="col-sm-10 col-sm-offset-2">
  <input type="submit" class="btn btn-default"  
  value="submit">
</div>
</div>

</form>



    </section>
  </div><!-- row -->   
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
