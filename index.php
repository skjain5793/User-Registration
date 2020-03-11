<!doctype html>
<html>
<head lang="en">
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-8">
<hr> 
<form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="name">NAME</label>
<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
</div>
<div class="form-group">
<label for="email">EMAIL</label>
<input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required />
</div>

<div class="form-group">
<label for="phone">Phone No.</label>
<input type="text" class="form-control" id="phone" name="phone" placholder="Enter your contact number">
</div>

<input id="uploadImage" type="file" accept="image/*" name="image" />
<div id="preview"><img src="filed.png" /></div><br>
<input class="btn btn-success" type="submit" value="Upload">
</form>
<div id="err"></div>
<hr>

</div>
</div>
</div>

<script>
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  var emailregex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
  var email = $("#email").val();

 
  var phoneregex = /^\d{10}$/;
  var phone = $("#phone").val();

  var nameregex = /^[a-z][a-z\s]*$/;
var name = $("#name").val();

if(!nameregex.test(name)){
  alert("Invalid name");
return false;
}
else  if(!emailregex.test(email)){
  alert("Invalid email id");
return false;
} else if(!phoneregex.test(phone)){
  alert("Invalid contact number");
return false;
}

  $.ajax({
   url: "ajaxupload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
   cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#form")[0].reset(); 
    }
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});
</script>

</body></html>
