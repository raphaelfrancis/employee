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
 <div class="container">
 
      <div class="table-responsive">    
<table border=1 class="table">
<tr style="background-color: #b8daff;"><td style="padding: .75rem;">ID</td><td style="padding: .75rem;">FIRST NAME</td><td style="padding: .75rem;">CREATED DATE</td><td style="padding: .75rem;">UPDATED DATE</td><td>ACTION</td></tr>

<?php 
$i=1;
 foreach($empresult as $employeesdata){
  $createddate = $employeesdata["createddate"];
  $date = date("Y-m-d",strtotime($createddate));
  $updateddate = $employeesdata["updateddate"];
  $updatedate = date("Y-m-d",strtotime($updateddate));

?>
<tr><td><?php echo $i;?></td><td style="padding: .75rem; vertical-align: top; border-top: 1px solid #e9ecef;"><?=$employeesdata["firstname"];?></td><td style="padding:.75rem; vertical-align: top; border-top: 1px solid #e9ecef;"><?php echo $date;?></td><td style="padding:.75rem; vertical-align: top; border-top: 1px solid #e9ecef;"><?php echo $updatedate;?></td><td style="padding: .75rem; vertical-align: top; border-top: 1px solid #e9ecef;"><a href="selectemployeedata?id=<?php echo $employeesdata["id"];?>" class="btn btn-primary">VIEW EMPLOYEE DATA</a></td></tr>     
   <?php 
$i++;
}
?>  
</table>
<ul class="pagination"><?php echo $links;?></ul>
</div>
</div>
</body>
</html>