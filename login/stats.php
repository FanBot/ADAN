<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Fanbot dashboard</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

<section id="container" >

<!-- Header start -->

	<?php require_once("resources/header.php"); ?>

<!-- Header end -->


<!-- Left sidebar start -->

	<?php require_once("resources/leftSidebar.php"); ?>

<!-- Left sidebar end -->


    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->


		<!-- Total likes chart html -->        
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Interacciones totales este mes
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">

                        <div class="chart">
						<div id="allLikes" style="height: 250px;"></div></div>

                    </div>
                </section>
            </div>
        </div>
        
        <!-- Total likes chart end-->

		<!-- Likes for each machine chart html -->        
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Interacciones por Maquina
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">

                        <div class="chart">
						<div id="singleLikes" style="height: 250px;"></div></div>

                    </div>
                </section>
            </div>
        </div>
        
        <!-- Likes for each machine likes chart end-->

        
 
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    
<!-- Right sidebar start-->

	<?php require_once("resources/rightSidebar.php"); ?>

<!-- Right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/jquery.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<!--Morris Chart-->
<script src="js/morris-chart/morris.js"></script>
<script src="js/morris-chart/raphael-min.js"></script>
<!--Easy Pie Chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>

    <script type="text/javascript">
		new Morris.Line({
		  // ID of the element in which to draw the chart.
		  element: 'allLikes',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
		    {day: '1', a: 100, b:50 },
		    {day: '2', a: 120, b:50 },
		    {day: '3', a: 155, b:50 },
		    {day: '4', a: 255, b:50 },
		    {day: '5', a: 100, b:50 },
		    {day: '6', a: 150, b:50 },
		    {day: '7', a: 130, b:50 },
		    {day: '8', a: 100, b:50 },
		    {day: '9', a: 156, b:50 },
		    {day: '10', a: 103, b:50 },
		    {day: '11', a: 120, b:50 },
		    {day: '12', a: 110, b:200 },
		    {day: '13', a: 154, b:200 },
		    {day: '14', a: 155, b:200 },
		    {day: '15', a: 180, b:200 },
		    {day: '16', a: 120, b:50 },
		    {day: '17', a: 190, b:50 },
		    {day: '18', a: 110, b:50 },
		    {day: '19', a: 125, b:50 },
		    {day: '20', a: 120, b:50 },
		    {day: '21', a: 220, b:50 },
		    {day: '22', a: 110, b:50 },
		    {day: '23', a: 155, b:50 },
		    {day: '24', a: 150, b:50 },
		    {day: '25', a: 180, b:50 },
		    {day: '26', a: 120, b:50 },
		    {day: '27', a: 180, b:50 },
		    {day: '28', a: 100, b:50 },
		    {day: '29', a: 145, b:50 },
		    {day: '30', a: 120, b:50 },
		    {day: '31', a: 190, b:50 }

		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'day',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['a', 'b'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Chap', 'Eva'],
		  smooth: true,
		  parseTime: false,

		});

		new Morris.Line({
		  // ID of the element in which to draw the chart.
		  element: 'singleLikes',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
		    {day: '1', a: 100},
		    {day: '2', a: 120, b:50 },
		    {day: '3', a: 155, b:50 },
		    {day: '4', a: 255, b:50 },
		    {day: '5', a: 100, b:50 },
		    {day: '6', a: 150, b:50 },
		    {day: '7', a: 130, b:50 },
		    {day: '8', a: 100, b:50 },
		    {day: '9', a: 156, b:50 },
		    {day: '10', a: 103, b:50 },
		    {day: '11', a: 120, b:50 },
		    {day: '12', a: 110, b:200 },
		    {day: '13', a: 154, b:200 },
		    {day: '14', a: 155, b:200 },
		    {day: '15', a: 180, b:200 },
		    {day: '16', a: 120, b:50 },
		    {day: '17', a: 190, b:50 },
		    {day: '18', a: 110, b:50 },
		    {day: '19', a: 125, b:50 },
		    {day: '20', a: 120, b:50 },
		    {day: '21', a: 220, b:50 },
		    {day: '22', a: 110, b:50 },
		    {day: '23', a: 155, b:50 },
		    {day: '24', a: 150, b:50 },
		    {day: '25', a: 180, b:50 },
		    {day: '26', a: 120, b:50 },
		    {day: '27', a: 180, b:50 },
		    {day: '28', a: 100, b:50 },
		    {day: '29', a: 145, b:50 },
		    {day: '30', a: 120, b:50 },
		    {day: '31', a: 190, b:50 }

		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'day',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['a'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Chap'],
		  smooth: true,
		  parseTime: false,

		});

    </script>


</body>
</html>
