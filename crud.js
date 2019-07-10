$(document).ready(function(){

	$(document).on('submit', '#Save', function() {

	   $.post("addprocess.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="card-panel teal"> <i class="material-icons left">info</i> &nbsp;'+data+'</div>');
			     $("#Save")[0].reset();
		     });
		 });
	     return false;
    });


	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('Sure to Delete ID no = ' +del_id))
		{
			$.post('delete.php', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});
		}
		return false;
	});

	$(".edit-link").click(function()
	{
		var id = $(this).attr("id");
		var edit_id = id;
		if(confirm('Sure to Edit ID no = ' +edit_id))
		{
			$(".content-loader").fadeOut('slow', function()
			 {
				$(".content-loader").fadeIn('slow');
				$(".content-loader").load('edit.php?edit_id='+edit_id);
				$("#btn-add").hide();
				$("#btn-view").show();
			});
		}
		return false;
	});

	$(document).on('submit', '#Update', function() {

	   $.post("editprocess.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
			     $("#dis").html('<div class="card-panel teal"> <i class="material-icons left">info</i> &nbsp;'+data+'</div>');
			     $("#Update")[0].reset();
				 $("body").fadeOut('slow', function()
				 {
					$("body").fadeOut('slow');
					window.location.href="articles.php";
				 });
		     });
		});
	    return false;
    });
});
