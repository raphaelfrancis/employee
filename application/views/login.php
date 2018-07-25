<html>
<head>
<title>Employee login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body><h1><center>EMPLOYEE LOGIN</center></h1>

<div class="container">
<form id ="employeelogin" method="post">
<div class="form-group row">
      <div class="col-3">
        <label for="ex1">USER NAME:</label>
        <input class="form-control" id="username" type="text" name="username">
        <label for="ex2">PASSWORD:</label>
        <input class="form-control" id="password" type="password" name="password">
      </div>
</div>
<button type="submit" class="btn btn-primary" id= "submit">Submit</button>
<span style = "padding-right:100px;"></span><a href="Employeecontroller/employeeregister"  class="btn btn-primary" role="button">SIGNUP</a>

</form>
  



</div>
</body>
<div id ="error"></div>
<div id = "nameerror"></div>
<div id = "passworderror"></div>
<script type="text/javascript">
  $(document).ready(function() {

      $('#employeelogin').submit(function(e){
        e.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
		    
        if(username == '' || password == '')
        {
            $('#error').html("please enter some fields");
            return false;
        }

        if(username == '')
        {
            $('#nameerror').css('color','red');
            $('#nameerror').html('Please add Firstname');
            return false;
        }
        if(password == '')
        {
            $('#passworderror').css('color','red');
            $('#passworderror').html('Please add password');
            return false;
        }
       
        $.ajax({
            type: "POST",
            data: {username:username,password:password},
            url: 'Employeecontroller/employeelogin',
            dataType: "json",
            success : function(data){
                console.log(data);
                if (data)
                {
                    console.log(data);
                    window.location.href = "<?php echo base_url();?>index.php/Employeecontroller/viewemployeedata";
                }
                else
                {
                    console.log(data);
                }
            },
            error: function (jqXHR, exception) {
               
          var msg = '';
          if (jqXHR.status === 0) {
              msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 404) {
              msg = 'Requested page not found. [404]';
          } else if (jqXHR.status == 500) {
              msg = 'Internal Server Error [500].';
          } else {
              msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }
          $('#post').css('color','red');
          $('#post').html(msg);
          return false;
      }

        });


      });
  });
</script>

</html>