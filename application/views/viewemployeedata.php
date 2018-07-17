<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <h2>Employee Details </h2>
  <a href="employeelogout" class="btn btn-primary">LOG OUT</a>
  <center><table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
		<th>Username</th>
        <th>Password</th>
		<th>EMAIL</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $data[0]->firstname;?></td>
        <td><?php echo $data[0]->lastname;?></td>
		<td><?php echo $data[0]->username;?></td>
        <td><?php echo $data[0]->password;?></td>
		<td><?php echo $data[0]->email;?></td>
        
		<td><a href="editemployeedata?id=<?php echo $data[0]->id;?>" class="btn btn-primary">EDIT</a></td>
		
		</tr>
    </tbody>
  </table></center>
</div>
</body>

</html>