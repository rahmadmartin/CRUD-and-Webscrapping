<h1 class="center-align"><a href="articles.php" style="color:black;"><i class="medium material-icons">add</i>&nbspCREATE ARTICLE</a></h1>
<form method="post" enctype="multipart/form-data" id="Save" action="#">
  <div id="dis"></div>
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input type="text" placeholder="Title" name="title" id="title" autofocus />
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">mail</i>
      <textarea class="materialize-textarea" placeholder="Description" name="description" id="description"></textarea>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">vpn_key</i>
      <input type="text" placeholder="Tag" id="tag" name="tag" />
    </div>
  </div>
  <!-- <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">file_upload</i>
      <input type="file" placeholder="Image" id="image" name="image" accept="image/*" />
    </div>
  </div> -->
  <div class="row">
    <div class="input-field col s12 center-align">
    <button type="submit" class="waves-effect waves-light btn-large" name="btn-save" id="btn-save">
    <i class="material-icons left">send</i>ADD</button>
  </div>
</div>
</form>
