<html>
<head>
<title>Employee login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body><h1><center>EMPLOYEE REGISTRATRION</center></h1>

<div class="container">
 <form id = "employee" method= "post">
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">FIRSTNAME:</label>
        <input class="form-control" id = "firstname" name = "firstname" type="text">
      </div>
      <div class="col-4">
        <label for="ex2">LASTNAME:</label>
        <input class="form-control" id = "lastname" name = "lastname" type="text">
      </div>
      <div class="col-4">
        <label for="ex3">USERNAME:</label>
        <input class="form-control" id = "username" name = "username" type="text">
      </div>
</div>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">PASSWORD:</label>
        <input class="form-control" id="password" name="password" type="password">
      </div>
      <div class="col-4">
        <label for="ex2">EMAIL:</label>
        <input class="form-control" id="email" name="email" type="email">
      </div>
      <div class="col-4">
        <label for="ex3">DOB:</label>
        <input class="form-control" id="dob" name="dob" type="date">
      </div>
</div>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">DEGREE:</label>
        <input class="form-control" id ="degree" name="degree" type="text">
      </div>
      <div class="col-4">
        <label for="ex2">DESIGNATION:</label>
        <input class="form-control" id="designation" name="designation" type="text">
      </div>
      <div class="col-4">
        <label for="ex3">JOINDATE:</label>
        <input class="form-control" id="joindate" name="joindate" type="date">
      </div>
</div>


<div class="form-group row">
      <div class="col-4">
        <label for="ex1">EXPERIENCE:</label>
        <input class="form-control" id="experience" name="experience" type="text">
      </div>
      
      
</div>
    <button type="submit" id="submit" class="btn btn-primary">Submit</button>


</form>
</div>
</body>
<div id ="error"></div>
<div id ="success"></div>
<div id = "nameerror"></div>
<div id = "lastnameerror"></div>
<div id = "usernameerror"></div>
<div id = "passworderror"></div>
<div id = "emailerror"></div>
<div id = "degreeerror"></div>
<div id = "designationerror"></div>
<div id = "joindateerror"></div>
<div id = "doberror"></div>
<div id = "experienceerror"></div>

<script type="text/javascript">
  $(document).ready(function() {


      $('#employee').submit(function(e){
        e.preventDefault();
    var firstname = $("#firstname").val();
		var  lastname = $("#lastname").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var email = $("#email").val();
		var dob = $("#dob").val();
		var degree = $("#degree").val();
		var designation = $("#designation").val();
		var joindate = $("#joindate").val();
		var experience = $("#experience").val();
		
        if(firstname == '' ||lastname == ''||username == ''||password == ''||email == ''||dob ==''||degree == ''||designation == ''||joindate ==''||experience =='')
        {
            $('#error').html("please enter some fields");
        }

        if((firstname == '')||(!isNaN(firstname)))
        {
        $('#nameerror').css('color','red');
        $('#nameerror').html('Please add Firstname');
        return false;
        }

        if((lastname == '')||(!isNaN(lastname)))
        {
        $('#lastnameerror').css('color','red');
        $('#lastnameerror').html('Please add lastname');
        return false;
        }

        if(username == '')
        {
        $('#usernameerror').css('color','red');
        $('#usernameerror').html('Please add username');
        return false;
        }
        if(password == '')
        {
        $('#passworderror').css('color','red');
        $('#passworderror').html('Please add password');
        return false;
        }

        if(email == '')
        {
        $('#emailerror').css('color','red');
        $('#emailerror').html('Please add email');
        return false;
        }
        if(dob == '')
        {
        $('#doberror').css('color','red');
        $('#doberror').html('Please add date of birth');
        return false;
        }
         
        if(degree == '')
        {
        $('#degreeerror').css('color','red');
        $('#degreeerror').html('Please your degree');
        return false;
        }

        if(designation == '')
        {
        $('#designationerror').css('color','red');
        $('#designationerror').html('Please your designation');
        return false;
        }

        if(joindate == '')
        {
        $('#joindateerror').css('color','red');
        $('#joindateerror').html('Please your joindate');
        return false;
        }

        if((experience == '')||(isNaN(experience)))
        {
        $('#experienceerror').css('color','red');
        $('#experienceerror').html('Please add Experience in years');
        return false;
        }


	   
     
       
        $.ajax({
            type: "POST",
            data: {firstname:firstname,lastname:lastname,username:username,password:password, email:email,dob:dob,degree:degree,designation:designation,joindate:joindate,experience:experience},
            url: 'addemployeedetails',
            dataType: "json",
            success : function(data){
                if (data){
                  alert(data);
                  $('#success').css('color','green');
                  $('#success').html('Employeedata added successfully');
                } else {
                    alert("error");
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
<script>
        $(document).ready(function() {
        $("#username").change(function() {
        $.ajax({
            type: "POST",
            url: "checkusername",
            data: {
               username: $("#username").val()
            },
            success: function(result) {
            alert(success);
            }
        });
        });
        });
</script>

</html>