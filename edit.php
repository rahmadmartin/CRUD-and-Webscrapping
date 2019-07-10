<?php
include_once 'dbnewssy.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$db_con->prepare("SELECT * FROM articles WHERE id=:aid");
	$stmt->execute(array(':aid'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<h1 class="center-align"><a href="#" style="color:black;"><i class="medium material-icons">add</i>&nbspEDIT ARTICLES</a></h1>
<form method="post" id="Update" action="#">
  <div id="dis"></div>
	<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>" hidden>
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" >
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input type="text" name="description" id="description" value="<?php echo $row['description']; ?>" >
    </div>
  </div>
  <!-- <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">mail</i>
      <textarea type="text" class="materialize-textarea form-control" placeholder="Description" name="description" id="description"><?php echo $row['description']; ?></textarea>
  </div> -->
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">vpn_key</i>
      <input type="text" name="tag" id="tag" value="<?php echo $row['tag']; ?>" >
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 center-align">
    <button type="submit" class="waves-effect waves-light btn-large" name="btn-update" id="btn-update">
    <i class="material-icons left">send</i>EDIT</button>
  </div>
</div>
</form>
