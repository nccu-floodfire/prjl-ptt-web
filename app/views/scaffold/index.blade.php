<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!--<link rel="icon" href="http://getbootstrap.com/favicon.ico">-->

	<title>PTT Crawler Dashboard @ NCCU</title>

	<!-- Bootstrap core CSS -->
	<link href="/assets/css/bootstrap.v3.1.1.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="/themes/ptt/css/dashboard.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">PTT Crawler Dashboard @ NCCU</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://nccu-news.source.today/" target="_blank">News Dashboard</a></li>
				<li><a href="#">Help (TBD)</a></li>
				<li><a href="/api">API Doc</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="<?php if ($active == 'index') echo 'active';?>"><a href="/">Overview <span class="sr-only">(current)</span></a></li>
				<!--
				<li><a href="index.html#">Reports</a></li>
				<li><a href="index.html#">Analytics</a></li>
				-->
				<li><a href="#">Export (TBD)</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li class="<?php if ($active == 'Gossiping') echo 'active';?>"><a href="/board/Gossiping">Gossiping</a></li>
				<li class="<?php if ($active == 'Kaohsiung') echo 'active';?>"><a href="/board/Kaohsiung">Kaohsiung</a></li>
				<li class="<?php if ($active == 'politics') echo 'active';?>"><a href="/board/politics">politics</a></li>
				<li class="<?php if ($active == 'HatePolitics') echo 'active';?>"><a href="/board/HatePolitics">HatePolitics</a></li>

			</ul>
			<h5>Search</h5>
			<form action="/search" method="get">
				<input type="text" class="form-control" placeholder="Title" name="term" />
			</form>
			<form action="/search_author" method="get">
				<input type="text" class="form-control" placeholder="Author" name="term" />
			</form>
		</div>
		@yield('main')
	</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.v3.1.1.min.js"></script>
<script src="/assets/js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>



