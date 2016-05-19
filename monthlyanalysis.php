#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];
$transactionid=$_POST["transactionid"];
$idate=$_POST["idate"];
$fdate=$_POST["fdate"];
$category=$_POST["category"];
$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}





$travel=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$medical=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$rest=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$groc=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$house=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$edu=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$fuel=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$rent=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$avg=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$total=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);


for ($i = 1; $i <= 12; $i++) {
	$stid = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Travel'");
	$r = oci_execute($stid);
	if (!$r) {
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row = oci_fetch_object($stid);
	$travel[$i]+=$row->AMT;
	//
	$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Medical'");
	$r1 = oci_execute($stid1);
	if (!$r1) {
		$e = oci_error($stid1);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row1 = oci_fetch_object($stid1);
	$medical[$i]+=$row1->AMT;
	//
	$stid2 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Restaurants'");
	$r2 = oci_execute($stid2);
	if (!$r2) {
		$e = oci_error($stid2);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row2 = oci_fetch_object($stid2);
	$rest[$i]+=$row2->AMT;
	//
	$stid3 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Groceries'");
	$r3 = oci_execute($stid3);
	if (!$r3) {
		$e = oci_error($stid3);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row3 = oci_fetch_object($stid3);
	$groc[$i]+=$row3->AMT;
	//
	$stid4 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Household'");
	$r4 = oci_execute($stid4);
	if (!$r4) {
		$e = oci_error($stid4);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row4 = oci_fetch_object($stid4);
	$house[$i]+=$row4->AMT;
	//
	$stid5 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Education'");
	$r5 = oci_execute($stid5);
	if (!$r5) {
		$e = oci_error($stid5);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row5 = oci_fetch_object($stid5);
	$edu[$i]+=$row5->AMT;
	//
	$stid6 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Fuel'");
	$r6 = oci_execute($stid6);
	if (!$r6) {
		$e = oci_error($stid6);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row6 = oci_fetch_object($stid6);
	$fuel[$i]+=$row6->AMT;
	//
	$stid7 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND EXTRACT(MONTH FROM DOT)='$i' AND CATEGORY='Rent'");
	$r7 = oci_execute($stid7);
	if (!$r7) {
		$e = oci_error($stid7);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row7 = oci_fetch_object($stid7);
	$rent[$i]+=$row7->AMT;
}

for ($i = 1; $i <= 12; $i++) {
	$avg[$i]=($travel[$i] + $medical[$i] + $rest[$i] + $edu[$i] + $rent[$i] + $groc[$i] + $house[$i] + $fuel[$i])/8;
	$total[$i]=$travel[$i] + $medical[$i] + $rest[$i] + $edu[$i] + $rent[$i] + $groc[$i] + $house[$i] + $fuel[$i];
}


?>


<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Monthly Analysis</title>
	<link rel="stylesheet" href="/CSS/styles.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);


      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Month', 'Travel', 'Education', 'Medical', 'Restaurants', 'Rent', 'Groceries', 'Household', 'Fuel','Total Expenditure', 'Average'],
         ['January',  <?php echo $travel[0]?>,      <?php echo $edu[0]?>,         <?php echo $medical[0]?>,             <?php echo $rest[0]?>,           <?php echo $rent[0]?>,           <?php echo $groc[0]?>,           <?php echo $house[0]?>,           <?php echo $fuel[0]?>, <?php echo $total[0]?>,           <?php echo $avg[0]?>],
         ['February',  <?php echo $travel[1]?>,      <?php echo $edu[1]?>,        <?php echo $medical[1]?>,             <?php echo $rest[1]?>,          <?php echo $rent[1]?>,           <?php echo $groc[1]?>,           <?php echo $house[1]?>,           <?php echo $fuel[1]?>,  <?php echo $total[1]?>,         <?php echo $avg[1]?>],
         ['March',  <?php echo $travel[2]?>,      <?php echo $edu[2]?>,        <?php echo $medical[2]?>,             <?php echo $rest[2]?>,           <?php echo $rent[2]?>,           <?php echo $groc[2]?>,           <?php echo $house[2]?>,           <?php echo $fuel[2]?>,    <?php echo $total[2]?>,       <?php echo $avg[2]?>],
         ['April',  <?php echo $travel[3]?>,      <?php echo $edu[3]?>,        <?php echo $medical[3]?>,             <?php echo $rest[3]?>,           <?php echo $rent[3]?>,           <?php echo $groc[3]?>,           <?php echo $house[3]?>,           <?php echo $fuel[3]?>,   <?php echo $total[3]?>,        <?php echo $avg[3]?>],
         ['May',  <?php echo $travel[4]?>,      <?php echo $edu[4]?>,         <?php echo $medical[4]?>,             <?php echo $rest[4]?>,          <?php echo $rent[4]?>,           <?php echo $groc[4]?>,           <?php echo $house[4]?>,           <?php echo $fuel[4]?>,       <?php echo $total[4]?>,    <?php echo $avg[4]?>],
         ['June',  <?php echo $travel[5]?>,      <?php echo $edu[5]?>,         <?php echo $medical[5]?>,             <?php echo $rest[5]?>,           <?php echo $rent[5]?>,           <?php echo $groc[5]?>,           <?php echo $house[5]?>,           <?php echo $fuel[5]?>,     <?php echo $total[5]?>,      <?php echo $avg[5]?>],
         ['July',  <?php echo $travel[6]?>,      <?php echo $edu[6]?>,        <?php echo $medical[6]?>,             <?php echo $rest[6]?>,          <?php echo $rent[6]?>,           <?php echo $groc[6]?>,           <?php echo $house[6]?>,           <?php echo $fuel[6]?>,       <?php echo $total[6]?>,    <?php echo $avg[6]?>],
         ['August',  <?php echo $travel[7]?>,      <?php echo $edu[7]?>,        <?php echo $medical[7]?>,             <?php echo $rest[7]?>,           <?php echo $rent[7]?>,           <?php echo $groc[7]?>,           <?php echo $house[7]?>,           <?php echo $fuel[7]?>,     <?php echo $total[7]?>,      <?php echo $avg[7]?>],
         ['September',  <?php echo $travel[8]?>,      <?php echo $edu[8]?>,        <?php echo $medical[8]?>,             <?php echo $rest[8]?>,           <?php echo $rent[8]?>,           <?php echo $groc[8]?>,           <?php echo $house[8]?>,           <?php echo $fuel[8]?>,   <?php echo $total[8]?>,        <?php echo $avg[8]?>],
         ['October',  <?php echo $travel[9]?>,      <?php echo $edu[9]?>,         <?php echo $medical[9]?>,             <?php echo $rest[9]?>,          <?php echo $rent[9]?>,           <?php echo $groc[9]?>,           <?php echo $house[9]?>,           <?php echo $fuel[9]?>,      <?php echo $total[9]?>,     <?php echo $avg[9]?>],
         ['November',  <?php echo $travel[10]?>,      <?php echo $edu[10]?>,        <?php echo $medical[10]?>,             <?php echo $rest[10]?>,           <?php echo $rent[10]?>,           <?php echo $groc[10]?>,           <?php echo $house[10]?>,           <?php echo $fuel[10]?>,     <?php echo $total[10]?>,      <?php echo $avg[10]?>],
         ['December',  <?php echo $travel[11]?>,      <?php echo $edu[11]?>,         <?php echo $medical[11]?>,             <?php echo $rest[11]?>,          <?php echo $rent[11]?>,           <?php echo $groc[11]?>,           <?php echo $house[11]?>,           <?php echo $fuel[11]?>,     <?php echo $total[11]?>,      <?php echo $avg[11]?>]
      ]);

    var options = {
      title : 'Monthly Expenditure Analysis',
      vAxis: {title: 'Amount (in USD)'},
      hAxis: {title: 'Month'},
      seriesType: 'bars',
      series: {9: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>
	
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
    <section class="col-md-6">
      <div id="chart_div" style="width: 1200px; height: 500px;"></div>
    <form action="analysis.php" method="POST">
    <input type="submit" value="Back">
    </form>
        
    </section>

  </div><!-- row -->
</div><!-- content container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
