<?php
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

include_once 'dbnewssy.php';
include("export_data.php");

$stmt = $db_con->prepare("SELECT * FROM user WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

use PHPMailer\PHPMailer\PHPMailer;

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	if(empty($_POST["name"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
	}
	else
	{
		$name = clean_text($_POST["name"]);
		if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
			$error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
		}
	}
	if(empty($_POST["email"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
	}
	else
	{
		$email = clean_text($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error .= '<p><label class="text-danger">Invalid email format</label></p>';
		}
	}
	if(empty($_POST["subject"]))
	{
		$error .= '<p><label class="text-danger">Subject is required</label></p>';
	}
	else
	{
		$subject = clean_text($_POST["subject"]);
	}
	if(empty($_POST["message"]))
	{
		$error .= '<p><label class="text-danger">Message is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["message"]);
	}
	if($error == '')
	{

require '../vendor/autoload.php';	
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "youremail";

//Showing server dialog
$mail->SMTPDebug = false;  

//Password to use for SMTP authentication
$mail->Password = "yourpassword";				//Sets SMTP password
		$mail->setFrom($_POST["email"], $_POST["name"]);
		$mail->addReplyTo($_POST["email"], $_POST["name"]);
		$mail->AddAddress('rahmad.martin@gmail.com', 'Rahmad Martin');		//Adds a "To" address
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML				
		$mail->Subject = $_POST["subject"];				//Sets the Subject of the message
		$mail->Body = $_POST["message"];				//An HTML or plain text message body
		$mail->SMTPOptions = array(
							'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			$error = '<label class="text-success">Thank you for contacting us</label>';
		}
		else
		{
			$error = '<label class="text-danger">There is an Error</label>';
		}
		$name = '';
		$email = '';
		$subject = '';
		$message = '';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DASHBOARD - AdminNEWSSY</title>

  <link rel="stylesheet" href="css/materialize.min.css" media="screen">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
	<script src="https//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<!-- <ul id="dropdown1" class="dropdown-content">
  <li><a href="#!">one</a></li>
  <li><a href="#!">two</a></li>
  <li class="divider"></li>
  <li><a href="#!">three</a></li>
</ul> -->
  <nav>
  <div class="nav-wrapper fixed teal">
    <a href="home.php" class="brand-logo">&nbsp&nbspAdminNEWSSY</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="articles.php">Articles</a></li>
      <li><a href="#"><?php echo $row['username']; ?></a></li>
			<li><a href="logout.php">Logout</a></li>&nbsp&nbsp
			<!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>&nbsp&nbsp -->
    </ul>
  </div>
</nav>

  <div class="container">
    <br><br><br>
    <div class="col s12 m12">
      <div class="card-panel">
          <h1 class="center-align"><a href="articles.php" style="color:black;"><i class="medium material-icons">description</i>&nbspARTICLES</a></h1>
    <table class="responsive-table highlight centered">
  <thead>
    <tr>
        <th data-field="Title">Title</th>
        <th data-field="Description">Description</th>
        <th data-field="Tag">Tag</th>
    </tr>
  </thead>
  <?php
          require_once 'dbnewssy.php';

          $stmt = $db_con->prepare("SELECT * FROM articles ORDER BY id ASC");
          $stmt->execute();
  		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  		{
  			?>
  <tbody>
    <tr>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php echo $row['tag']; ?></td>
    </tr>
  </tbody>
  <?php } ?>
</table>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
			</form>
</div>
</div>
  </div>

	<div class="container">
		<br><br><br>
		<div class="col s12 m12">
			<div class="card-panel">
					<h1 class="center-align"><a href="http://kaskus.co.id" style="color:black;"><i class="medium material-icons">description</i>&nbspTempo - Tekno</a></h1>
	<?php

	getFeed("http://rss.tempo.co/");

	function getFeed($feed_url) {

	    $content = file_get_contents($feed_url);
	    $x = new SimpleXmlElement($content);

	    echo "<ul>";

	    foreach($x->channel->item as $entry) {
	        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a> - $entry-> - $entry->description</li></br>";
	    }
	    echo "</ul>";
}
	?>
</div>
</div>
</div>

<div class="container">
	<br><br><br>
	<div class="col s12 m12">
		<div class="card-panel">
				<h1 class="center-align"><a href="http://kaskus.co.id" style="color:black;"><i class="medium material-icons">description</i>&nbspDetik - Inet</a></h1>
<?php

Feed("http://rss.detik.com/index.php/inet");

function Feed($feedurl) {

		$content = file_get_contents($feedurl);
		$x = new SimpleXmlElement($content);

		echo "<ul>";

		foreach($x->channel->item as $entry) {
				echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a> - $entry->pubDate - $entry->description</li></br>";
		}
		echo "</ul>";
}
?>
</div>
</div>
</div>

<div class="container">
	<br><br><br>
	<div class="col s12 m12">
		<div class="card-panel">
				<h1 class="center-align"><a href="http://kaskus.co.id" style="color:black;"><i class="medium material-icons">description</i>&nbspLiputan6 - Tekno</a></h1>
<?php

FeedLip6("http://tekno.liputan6.com/feed/rss");

function FeedLip6($feedurl) {

		$content = file_get_contents($feedurl);
		$x = new SimpleXmlElement($content);

		echo "<ul>";

		foreach($x->channel->item as $entry) {
				echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a> - $entry->pubDate - $entry->description</li></br>";
		}
		echo "</ul>";
}
?>
</div>
</div>
</div>

<div class="container">
	<br><br><br>
	<div class="col s12 m12">
	
				<h1 class="center-align"><i class="medium material-icons">mail</i>&nbspMAILER</h1>
					<?php echo $error; ?>
					<form method="post">
						<div class="form-group">
							<label>Enter Name</label>
							<input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Email</label>
							<input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Subject</label>
							<input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
						</div>
						<div class="form-group">
							<label>Enter Message</label>
							<textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
						</div>
						<div class="form-group" align="center">
							<input type="submit" name="submit" value="Submit" class="btn btn-info" />
						</div>
					</form>

			
		</div>
	</div>

  <script type="text/javascript" href="js/materialize.min.js"/>
	<script type="text/javascript">
	$(document).ready(function(){
	    $(".dropdown-button").dropdown();
	});

		$(document).ready(function(){
		    $('table').DataTable();
		});
	</script>
</body>
</html>
