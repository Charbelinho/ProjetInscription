<?php 
session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/fig.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body class="container-fluid">
	<?php include("entete.php") ?>

	<div class="rows">
		<form action="verification.php" method="post">
			<div class="row idperm">
				<div class="col-sm-offset-2 col-md-10">
					<legend><span class="titletu">CONNEXION</span></legend>
						<div class="col-sm-8 ok">
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="idp">ID PERMANENT :</label>
									<input type="text" name="idpermanent" id="idp" class="form-control">
								</div>
								<div class="col-sm-6">
									<label for="mdp">Mot de passe :</label>
									<input type="password" name="motdepassetud" id="mdp" class="form-control">
								</div>
							</div>						
						</div>
				</div>
			</div>
			<div class="row">
			<div>
				<div class="col-sm-offset-4 col-sm-6" >
				<input type="submit" name="valider_enreg" value="Se connecter" class="btn btn-info btn-lg btreset">
				<button type="reset" class="btn btn-default btn-lg btreset"><i class="fas fa-redo-alt"></i> REINITIALISER</button>
			</div>
			</div>
		</div>
	</form>	
		<?php 	if (isset($_COOKIE['errors'])) {?>

					<div class="alert span5 alert-danger">
						<h3>Information importante!</h3>
						<?php 	echo $_COOKIE['errors']; ?>
					</div>
		<?php 	} ?>
	</div>
			
			
		
</body>
</html>
<?php 
session_destroy();
 ?>