<?php
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}

include_once 'dbnewssy.php';

$stmt = $db_con->prepare("SELECT * FROM user WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ARTICLES - AdminNEWSSY</title>

  <link rel="stylesheet" href="css/materialize.min.css" media="screen">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="jquery.dataTables.min.css">
  <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
  <script type="text/javascript" src="jquery.dataTables.min.js"></script>
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
    <br>
    <div class="col s12 m12">
      <a class="btn-floating btn-large waves-effect waves-light teal" id="btn-add"><i class="material-icons">add</i></a>
      <a class="btn-floating btn-large waves-effect waves-light teal" id="btn-view"><i class="material-icons">navigate_before</i></a>
      <div class="content-loader">
          <h1 class="center-align"><a href="articles.php" style="color:black;"><i class="medium material-icons">description</i>&nbspARTICLES</a></h1>
    <table class="responsive-table highlight" id="Table">
  <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Tag</th>
        <th>Action</th>
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
      <td><button id="<?php echo $row['id']; ?>" class="edit-link waves-effect waves-light btn-large">
      <i class="material-icons">mode_edit</i></button></td>
      <td><button id="<?php echo $row['id']; ?>" class="delete-link waves-effect waves-light btn-large">
      <i class="material-icons">delete</i></button></td>
    </tr>
  </tbody>
  <?php } ?>
</table>
</div>
  </div>
</div>

  <script type="text/javascript">
  $(document).ready(function(){

    $("#btn-view").hide();

    $("#btn-add").click(function(){
      $(".content-loader").fadeOut('slow', function()
      {
        $(".content-loader").fadeIn('slow');
        $(".content-loader").load('add.php');
        $("#btn-add").hide();
        $("#btn-view").show();
      });
    });

    $("#btn-view").click(function(){

      $("body").fadeOut('slow', function()
      {
        $("body").load('articles.php');
        $("body").fadeIn('slow');
        window.location.href="articles.php";
      });
    });

  });
  </script>
  <script type="text/javascript" src="crud.js"></script>
  <script type="text/javascript" href="js/materialize.min.js"/>
	<script type="text/javascript">
  $(document).ready(function(){
	    $(".dropdown-button").dropdown();
	});

		$(document).ready(function(){
		    $('#Table').DataTable();
		});
	</script>
</body>
</html>
