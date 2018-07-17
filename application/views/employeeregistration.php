<html>
<head>
<title>Employee login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body><h1><center>EMPLOYEE REGISTRATRION</center></h1>

<div class="container">
<?php echo validation_errors(); ?>
<?php echo form_open('Employeecontroller/addemployeedetails'); ?>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">FIRSTNAME:</label>
        <input class="form-control" id = "name" name = "firstname" type="text">
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
        <input class="form-control" id ="password" name="degree" type="text">
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

<button type="submit" class="btn btn-primary">Submit</button>

</form>
  



</div>
</body>
</html>