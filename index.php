<?php

session_start();

if(isset($_SESSION['user_session'])!="")
{
	header("Location: home.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN | AdminNEWSSY</title>
<link rel="stylesheet" href="css/materialize.min.css" media="screen">
<!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
<!-- <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="validation.min.js"></script>
<!-- <link href="style.css" rel="stylesheet" type="text/css" media="screen"> -->
<script type="text/javascript" src="script.js"></script>

</head>

<body class="teal">

<div class="signin-form">

	<div class="container">
		<div class="row">
		    <br><br><br><br>
		    <br><br><br><br>
		    <div class="col s12 m3">
		    </div>
		      <div class="col s12 m6">
		        <div class="card-panel">
							<div class="content-loader">
		          <h1 class="center-align">LOGIN - AdminNEWSSY</h1>
		          <div class="row">
								<form class="form-signin" method="post" id="login-form">

        <div id="error">
        <!-- error will be shown here ! -->
        </div>

				<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">account_circle</i>
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" autofocus />
        <span id="check-e"></span>
				</div></div>

				<div class="row">
				<div class="input-field col s12">
					<i class="material-icons prefix">vpn_key</i>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
				</div></div>

				<div class="row">
				<div class="input-field col s12 center-align">
        <button type="submit" class="btn btn-large" name="btn-login" id="btn-login">
    		<i class="material-icons left">send</i> LOGIN
			</button>
				</div></div>

      </form>
		</div>
	</div>
	<center>
		<a href="#" class="btn btn-large" id="btn-register">
				<i class="material-icons left">face</i> REGISTER
			</a>
			<a href="#" class="btn btn-large" id="btn-back">
			<i class="material-icons left">navigate_before</i> LOGIN
		</a>
				<a href="../" class="btn btn-large" target="_blank" id="btn-view">
					<i class="material-icons left">visibility</i> VIEW WEBSITE
				</a>
			</center>
    </div>

</div>

<script type="text/javascript">
$(document).ready(function(){

	// $("#btn-register").hide();
	$("#btn-back").hide();

	$("#btn-register").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('regis.php');
			$("#btn-back").show();
			$("#btn-register").hide();
			// $("#btn-back").show();
		});
	});

	$("#btn-back").click(function(){

		$("#btn-register").hide();
		$("#btn-back").show();

		$("body").fadeOut('slow', function()
		{
			$("body").load('index.php');
			$("body").fadeIn('slow');
			window.location.href="index.php";
		});
	});

});
</script>
<script src="crud.js"></script>
<script src="js/materialize.min.js"></script>

</body>
</html>
