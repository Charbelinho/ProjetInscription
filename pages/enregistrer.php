<?php 

	if (isset($_POST['valider_enreg'])) {
		$bd=mysqli_connect("localhost","root","","gest_ins_db_24_01");


		$etu="INSERT INTO `etudiant` (`MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `MotDePassEtud`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud`) VALUES ('".$_POST['matetu']."', '".$_POST['nometud']."', '".$_POST['prenometud']."', '', '".$_POST['motdepassetud']."', '".$_POST['sexeetud']."', '".$_POST['datenaissetud']."', '".$_POST['lieunaissetud']."', '".$_POST['statetud']."', '".$_POST['teletud']."', '".$_POST['emailetud']."', '".$_POST['residetud']."', 'user.png')";
			$enretu=mysqli_query($bd,$etu);
		
		$mot=$_POST['nometud'];

		$alias=substr($mot,0,3);
		setcookie("alia_mot",$alias,time()+(60*60*24),"/");
		
		$var=1;
		while ($var==1) {
			$mat=rand(999,9999);
			$rq="SELECT `NumInscrip`, `DateInscrip`, `ValidationInscrip`, `CodeNiv`, `CodeAnnee`, `CodeFil` FROM `inscription` WHERE `NumInscrip`='$mat'";
			$rq1=mysqli_query($bd,$rq);

		$num=mysqli_num_rows($rq1);
			if ($num==1) {
				$var=1;
			}
			else{
				$var=0;

			}
		}

		$mat_etudiant=$_POST['matetu'];

		setcookie("matr_etu",$mat_etudiant,time() + (60*60),"/");
		setcookie("num_inscri",$mat,time() + (60*60),"/");

		header("refresh:1,paiment.php");
		
		// setcookie("num","2",time()+60,"/");
	}
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
<body>
	<div class="container-fluid">
		<p class="col-md-5 forminscription">INSCRIPTION</p>
		<form action="" method="post">
			<div class="row etu">
				<div class="col-sm-offset-2 col-md-10">
					<legend><span class="titletu">ETUDIANT</span></legend>
						<div class="col-sm-8 ok">
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="matricule">Matricule :</label>		
									<input type="text" name="matetu" id="matricule" class="form-control" autofocus placeholder="AB20181401" >
								</div>
							</div>
							<div class="row form-group">
							
								<div class="col-sm-6">
									<label for="nom">Nom :</label>
									<input type="text" name="nometud" id="nom" class="form-control" autofocus>
								</div>
								<div class="col-sm-6">
									<label for="prenom">Prénom :</label>
									<input type="text" name="prenometud" id="prenom" class="form-control">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-sm-6">
									<label for="datenaiss">Date de Naissance :</label>
									<input type="date" name="datenaissetud" id="datenaiss" class="form-control" placeholder="jj-MM-AAAA">
								</div>
								<div class="col-sm-4 sexes">
									<label for="sexe">Sexe :</label>
									<input type="radio" name="sexeetud"  value="H" id="homme" checked="checked"><label for="homme">H</label>
									<input type="radio" name="sexeetud" value="F" id="femme"><label for="femme">F</label>
								</div>
								<div class="col-sm-4 sexes">
									<label for="statuet">Orienté de l'Etat :</label>
									<input type="radio" name="statetud"  value="OR" id="oriente" checked="checked"><label for="oriente">OUI</label>
									<input type="radio" name="statetud" value="NO" 		id="non-oriente"><label for="non-oriente">NON</label>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-12">
									<label for="lieunaissance">Lieu de naissance :</label>
									<input type="text" name="lieunaissetud" id="lieunaissance" class="form-control">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-12">
									<label for="residence">Résidence :</label>
									<input type="text" name="residetud" id="residence" class="form-control">
								</div>
								<div class="col-sm-6">
									<label for="mail">Adresse electronique :</label>
									<input type="mail" name="emailetud" id="mail" class="form-control">
								</div>
								<div class="col-sm-6">
									<label for="mdp">Mot de passe :</label>
									<input type="password" name="motdepassetud" id="mdp" class="form-control">
								</div>
							</div>	
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="telephone">Télephone :</label>
									<input type="tel" name="teletud" id="telephone" value="+225" class="form-control">
								</div>
							</div>					
						</div>
				</div>
			</div>
			<div class="row">
			<div>
				<div class="col-sm-offset-5 col-sm-6" >
				<input type="submit" name="valider_enreg" value="valider" class="btn btn-info btn-lg btreset">
				<button type="reset" class="btn btn-default btn-lg btreset"><i class="fas fa-redo-alt"></i> REINITIALISER</button>
			</div>
			</div>
		</div>
	</form>
	<br>
	<?php include("pied.php"); ?>
</div>

	
</body>
</html>