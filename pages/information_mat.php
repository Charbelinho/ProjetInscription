<?php 

	// if (isset($_COOKIE['ouverture'])) {

	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="../css/fig.css">
	<link rel="stylesheet"  href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body class="container">

	<div class="row">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<h3 class="panel-title">ID PERMANENT</h3>
					</div>
					<div class="panel-body">Votre ID permanent est : <strong><?php echo $_COOKIE['mat_gen']; ?></strong>.</div>
				</div>
				<div class="alert span5 alert-danger">
				<h3>Information importante!</h3>
				Il est recommander de bien memorisé l'<strong>ID permanent</strong> ceci vous sera utile durant votre cursus.
				</div>
				<div class="col-sm-7">
					<div class="btn-group btn-group-justified">
						<a href="Identifiant_permanent.php" class="btn btn-info btn-lg">Se connecter</a>
						<a href="acceuil.php" class="btn btn-default btn-lg">Page d'Acceuil</a>
					</div>
				</div>
					
			</div>

	</div>
</body>
</html>
<!--  -->
