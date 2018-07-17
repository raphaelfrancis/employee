<html>
<head>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='custom.css' rel='stylesheet' type='text/css'>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">


</head>
<body>
<center><h1>VIEW EMPLOYEE DATA</h1></center>

<span style = "padding-right:1200px;"></span><a href = "adminlogout" class="btn btn-primary" >LOG OUT</a>
 
<?php 
foreach($empresult as $value)
{
      $firstname = $value->firstname;
      $lastname = $value->lastname;
      $username = $value->username;
      $email = $value->email;
      $dob = $value->dob;
      $degree = $value->degree;
      $designation = $value->designation;
      $joindate = $value->joindate;
      $experience = $value->experience;
      $image = $value->image;
      $employeeid = $value->id;
}
?>  
<div class="container">

<div class="form-group row">
      <div class="col-4">
        <label for="ex1">FIRSTNAME:</label>
        <?php echo $firstname;?>
      </div>
      <div class="col-4">
        <label for="ex2">LASTNAME:</label>
        <?php echo $lastname;?>
      </div>
      <div class="col-4">
        <label for="ex3">USERNAME:</label>
        <?php echo $firstname;?>
      </div>
</div>

<div class="form-group row">
      <div class="col-4">
        <label for="ex1">EMAIL:</label>
        <?php echo $email;?>
      </div>
      <div class="col-4">
        <label for="ex2">DOB:</label>
        <?php echo $dob;?>
      </div>
      <div class="col-4">
        <label for="ex3">DEGREE:</label>
        <?php echo $degree;?>
      </div>
</div>

<div class="form-group row">
      <div class="col-4">
        <label for="ex1">DESIGNATION:</label>
        <?php echo $designation;?>
      </div>
      <div class="col-4">
        <label for="ex2">JOINDATE:</label>
       <?php echo $joindate;?>
      </div>
      <div class="col-4">
        <label for="ex3">EXPERIENCE IN YEARS:</label>
        <?php echo $experience;?>
      </div>
</div>

<?php
if($image!=='')
{
?>
<div class="form-group row">
      <div class="col-4">
        <label for="ex1">IMAGE:</label>
        <img src = "<?php echo base_url();?>/images/<?php echo $image;?>" width="100" height="100">
      </div>
</div>
<?php
}
?>

<a href = "editemployeedata?id=<?php echo $employeeid;?>" class="btn btn-primary">EDIT</a>
<span style="padding-right:200px;"></span>
<a href = "deleteemployeedata?id=<?php echo $employeeid;?>" class="btn btn-primary">DELETE</a>





</body>
</html>