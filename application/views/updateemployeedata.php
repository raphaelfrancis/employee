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
<body><h1><center>UPDATE EMPLOYEE DATA</center></h1>
<span style="padding-right:1000px;"></span><a href="employeelogout" class="btn btn-primary">LOG OUT</a>
<?php

foreach($editemployeedata as $value)
{
$updateid  = $value->id;
$firstname = $value->firstname;
$lastname  = $value->lastname;
$username  = $value->username;
$password  = $value->password;
$email  = $value->email;
$dob  = $value->dob;
$degree  = $value->degree;
$designation  = $value->designation;
$joindate  = $value->joindate;
$experience = $value->experience;
$image = $value->image;
	
}

?>
<div class="container">

<?php echo validation_errors(); ?>
<?php echo form_open_multipart('Employeecontroller/updateemployeedetails');?>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">FIRSTNAME:</label>
        <input class="form-control" id = "firstname" name = "firstname" type="text" value="<?php if(isset($firstname)) echo $firstname;?>">
      </div>
      <div class="col-4">
        <label for="ex2">LASTNAME:</label>
        <input class="form-control" id = "lastname" name = "lastname" type="text" value="<?php if(isset($lastname)) echo $lastname;?>">
      </div>
      <div class="col-4">
        <label for="ex3">USERNAME:</label>
        <input class="form-control" id = "username" name = "username" type="text" value="<?php if(isset($username)) echo $username;?>">
      </div>
</div>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">PASSWORD:</label>
        <input class="form-control" id="password" name="password" type="password" value="<?php if(isset($password)) echo $password;?>">
      </div>
      <div class="col-4">
        <label for="ex2">EMAIL:</label>
        <input class="form-control" id="email" name="email" type="email" value="<?php if(isset($email)) echo $email;?>">
      </div>
      <div class="col-4">
        <label for="ex3">DOB:</label>
        <input class="form-control" id="dob" name="dob" type="date" value="<?php if(isset($dob)) echo $dob;?>">
      </div>
</div>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">DEGREE:</label>
        <input class="form-control" id ="password" name="degree" type="text" value="<?php if(isset($degree)) echo $degree;?>">
      </div>
      <div class="col-4">
        <label for="ex2">DESIGNATION:</label>
        <input class="form-control" id="designation" name="designation" type="text" value="<?php if(isset($designation)) echo $designation;?>">
      </div>
      <div class="col-4">
        <label for="ex3">JOINDATE:</label>
        <input class="form-control" id="joindate" name="joindate" type="date" value="<?php if(isset($joindate)) echo $joindate;?>">
      </div>
</div>


<div class="form-group row">
      <div class="col-4">
        <label for="ex1">EXPERIENCE:</label>
        <input class="form-control" id="experience" name="experience" type="text" value="<?php if(isset($experience)) echo $experience;?>">
      </div>
	  <div class="col-4">
        <label for="ex1">UPLOAD IMAGE:</label>
        <input class="form-control" id="experience" name="userfile" type="file" class="btn btn-primary">
      </div>
	  <?php
	  if($image!=='')
	  {
	   ?>
	  <div class="col-4">
        <label for="ex1">IMAGE:</label>
        <img src="<?php echo base_url();?>/images/<?php echo $image;?>" width = "100" height= "100"  />
      </div>
	  <?php
	  }
	  ?>
	   <div class="col-4">
       
        <input class="form-control" id="experience" name="updateid" type="hidden" value= "<?php echo $updateid;?> " class="btn btn-primary">
      </div>
</div>

<button type="submit" class="btn btn-primary">UPDATE</button>

</form>
  



</div>
</body>
</html>