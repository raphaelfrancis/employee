<!DOCTYPE html>
<html>
<head>
	<title>Demo Upload Image using Ajax on Codeigniter</title>
	<style type="text/css">
		.container {
			padding: 10px;
		}
		.error {
			color: red;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Demo Upload Image using Ajax on Codeigniter</h1>
		<p>
			<form id="form-upload" method="POST" action="">
				<input type="file" name ="userfile"/> 
				NAME:<input id="email" name="email" type="email">

				<br />
				<br />
				<button type="submit" id="btn-submit">submit</button>
			</form>
		</p>
		<p class="error">
			
		</p>
	</div>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#form-upload').submit(function(e) {
				e.preventDefault();
				var formData = new FormData($(this)[0]);
				
				//reset error messsage
				$('.error').html('');
				$.ajax({
					url: "Welcomecontroller/do_upload",
					type: 'POST',
					dataType: 'json',
					data: formData,
					async: true,
					beforeSend: function() {
						$('#btn-submit').prop('disabled', true);
					},
					success: function(response) {
						var name = JSON.stringify(response)
						alert(name);
					},
					complete: function() {
						$('#btn-submit').prop('disabled', false);
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});
		});
	</script>
</body>
</html>
