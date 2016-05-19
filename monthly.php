#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];
$date= $_POST["date"];
$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$travel=0;
$medical=0;
$rest=0;
$groc=0;
$house=0;
$edu=0;
$fuel=0;
$rent=0;


if($date == 'January'){
	$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-JAN-2016' AND DOT <='31-JAN-2016' GROUP BY CATEGORY");
}
else if($date == 'February'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-FEB-2016' AND DOT <='29-FEB-2016' GROUP BY CATEGORY");
}
else if($date == 'March'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-MAR-2016' AND DOT <='31-MAR-2016' GROUP BY CATEGORY");
}
else if($date == 'April'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-APR-2016' AND DOT <='30-APR-2016' GROUP BY CATEGORY");
}
else if($date == 'May'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-MAY-2016' AND DOT <='31-MAY-2016' GROUP BY CATEGORY");
}
else if($date == 'June'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-JUN-2016' AND DOT <='30-JUN-2016' GROUP BY CATEGORY");
}
else if($date == 'July'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-JUL-2016' AND DOT <='31-JUL-2016' GROUP BY CATEGORY");
}
else if($date == 'August'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-AUG-2016' AND DOT <='31-AUG-2016' GROUP BY CATEGORY");
}
else if($date =='September'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-SEP-2016' AND DOT <='30-SEP-2016' GROUP BY CATEGORY");
}
else if($date == 'October'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-OCT-2016' AND DOT <='31-OCT-2016' GROUP BY CATEGORY");
}
else if($date == 'November'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-NOV-2016' AND DOT <='30-NOV-2016' GROUP BY CATEGORY");
}
else if($date == 'December'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, CATEGORY FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND DOT >='1-DEC-2016' AND DOT <='31-DEC-2016' GROUP BY CATEGORY");
}
else{
}

$r = oci_execute($stid1);
if (!$r) {
    $e = oci_error($stid1);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$i=0;
while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {
	if($row['CATEGORY'] == 'Travel'){
		$travel += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Medical'){
		$medical += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Restaurants'){
		$rest += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Rent'){
		$rent += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Groceries'){
		$groc += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Household'){
		$house += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Education'){
		$edu += $row['AMT'];
	}
	if($row['CATEGORY'] == 'Fuel'){
		$fuel += $row['AMT'];
	}
	$i += 1;
}

?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>User</title>
	<link rel="stylesheet" href="/CSS/styles.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Total amount Spend'],
          ['Travel',   <?php echo $travel; ?>],
          ['Education', <?php echo $edu; ?>],
          ['Rent',  <?php echo $rent; ?>],
          ['Fuel', <?php echo $fuel; ?>],
          ['Restaurants',    <?php echo $rest; ?>],
          ['Household',       <?php echo $house; ?>],
          ['Groceries', <?php echo $groc; ?>],
          ['Medical',    <?php echo $medical; ?>     ]
        ]);

        var options = {
          title: 'My <?php echo $date; ?> Expenditures Pie Chart',
          is3D: true,
        };
		
		var data
		
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
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
      <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
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
