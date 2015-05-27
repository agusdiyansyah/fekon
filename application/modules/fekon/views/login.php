<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FEKON UNTAN</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'inventory/bootstrap/css/bootstrap.css' ?>">
</head>
<body style="background:#E2E2E2">
	<div class="container">
		<div class="row" style="min-height:100px">
			
		</div>
		<div class="row">
			<div style="width:400px;height:400px;margin:0 auto;">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background:#2c3e50;height:70px">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background:#fff;">
						<br>
						<form action="fekon/login" method="POST" role="form">
							<legend>Login</legend>
						
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" class="form-control" name="userid" placeholder="">
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password" placeholder="">
							</div>
						
							
						
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>