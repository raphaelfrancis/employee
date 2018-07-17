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
<body><h1><center>ADMIN UPDATE</center></h1>
<?php

foreach($editemployeedata as $value)
{
$updateid  = $value->id;
$username  = $value->username;
$password  = $value->password;
}
?>
<div class="container">

<?php echo validation_errors(); ?>
<?php echo form_open('Employeecontroller/updateadmindetails');?>
<div class="form-group row">
      
      <div class="col-4">
        <label for="ex3">USERNAME:</label>
        <input class="form-control" id = "username" name = "username" type="text" value="<?php if(isset($username)) echo $username;?>">
      </div>
	  <div class="col-4">
        <label for="ex1">PASSWORD:</label>
        <input class="form-control" id="password" name="password" type="password" value="<?php if(isset($password)) echo $password;?>">
      </div>
</div>



<div class="form-group row">
     
	 
	   <div class="col-4">
       
        <input class="form-control" id="experience" name="updateid" type="hidden" value= "<?php echo $updateid;?> " class="btn btn-primary">
      </div>
	  
</div>

<button type="submit" class="btn btn-primary">UPDATE</button>

</form>
  



</div>
</body>
</html>