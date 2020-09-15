<?php 
	$error="";
	$mat_etud=$_POST['idpermanent'];

	$mat_pass=$_POST['motdepassetud'];
	
	

	session_start();

	$connect=mysqli_connect("localhost","root","","gest_ins_db_24_01");
	$verif_mat="SELECT `MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `MotDePassEtud`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud` FROM `etudiant` WHERE `IdPermanent`='$mat_etud'";
	$verif=mysqli_query($connect,$verif_mat);
	$count_mat=mysqli_num_rows($verif);
	$arraypasse=mysqli_fetch_array($verif);
	$pass_etud=$arraypasse['MotDePassEtud'];

	$verif_passe="SELECT `MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `MotDePassEtud`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud` FROM `etudiant` WHERE `MotDePassEtud`='$pass_etud'";
	$verif_pass=mysqli_query($connect,$verif_passe);
	$count_pass=mysqli_num_rows($verif_pass);
	 

	if ($count_mat==1) {
		if (in_array($mat_pass, $arraypasse)) {
		$_SESSION['id']=$mat_etud;
		$_SESSION['bool']=1;
		header("refresh:0.5; profil_etudiant.php");
	}
	}

	
else{
	$error="votre identifiant ou votre mot de passe est incorret";
	setcookie("errors",$error,time()+5);
	header("refresh:0.5; Identifiant_permanent.php");
} 
	
 ?>