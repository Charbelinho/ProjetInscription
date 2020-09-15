<?php 
	// LA DATE GENEREE ---------------------------------
		$year=date("Y");
		$year=(int) $year;
		$last_year=$year-1;
		$new_year=$last_year."-".$year;
// ENREGISTREMENT DES DONNEES DANS LA BASE ----------------------------------------------------------------
$bd=mysqli_connect("localhost","root","","gest_ins_db_24_01");
	if (isset($_POST['valider_paiment'])) {
		
		$inser_inscri="INSERT INTO `inscription` (`NumInscrip`, `DateInscrip`, `ValidationInscrip`, `CodeNiv`, `CodeAnnee`, `CodeFil`) VALUES ('".$_COOKIE['num_inscri']."', NOW(), '', '".$_POST['niveau']."', '$new_year', '".$_POST['filiere']."');";
		$enr_insci=mysqli_query($bd,$inser_inscri);
		
		$ins_pay="INSERT INTO `paiement` (`NumPai`, `LibPai`, `DatePai`, `MonatantPai`, `ModePai`, `MatEtud`, `NumInscrip`, `CodeCaisse`) VALUES ('".$_POST['numpay']."', 'INSCRIPTION', NOW(), '".$_POST['monpay']."', '".$_POST['modepaiement']."', '".$_COOKIE['matr_etu']."', '".$_COOKIE['num_inscri']."', '231')";
		$enr_pay=mysqli_query($bd,$ins_pay);
// ALGORITHME POUR GENERER LE MATRICULE D'UN ETUDIANT ----------------------------------------------------------------

		$nom=$_COOKIE['alia_mot'];
		$begin_year=substr($year, 2,2);		

		$bool=1;
		while ($bool==1) {
			$val=rand(999,9999);

			$id=$nom."".$begin_year."".$val;

			$rq2="SELECT `MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud` FROM `etudiant` WHERE `IdPermanent`='$id'";
			$list_rq=mysqli_query($bd,$rq2);

			$num1=mysqli_num_rows($list_rq);
			if ($num1==1) {
				$bool=1;
			}
			else{
				$bool=0;

			}
		}
// INSERTION DU MATRICULE DE L'ETUDIANT DANS LA BASE ----------------------------------------------------------------
		$inser_id="UPDATE `etudiant` SET `IdPermanent` = '$id' WHERE `etudiant`.`MatEtud` = '".$_COOKIE['matr_etu']."'";
		$enr_id=mysqli_query($bd,$inser_id);
		setcookie("mat_gen",$id,time()+(60*60*24));
		echo $inser_id;
		setcookie("ouverture",1,time()+(60));
		header("refresh:5; information_mat.php");

	}
	// LISTE DES NIVEAU ----------------------------------------------------------------
	$list_niv="SELECT * FROM `niveau`";
	$enr_niv=mysqli_query($bd,$list_niv);
// LISTE DES FILIERES ----------------------------------------------------------------
	$list_fil="SELECT `CodeFil`, `LibFil` FROM `filiere`";
	$enr_fil=mysqli_query($bd,$list_fil);
// LISTES DES CAISSES ----------------------------------------------------------------
	$list_caiss="SELECT `CodeCaisse`, `LibCaisse` FROM `caisse`";
	$enr_caiss=mysqli_query($bd,$list_caiss);
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
		<p class="col-md-5 forminscription">PAIEMENT</p>
		<form action="paiment.php" method="post">
			<!-- INSCRIPTION ----------------------------------------------------------------------------------------- -->
			<!-- <div class="col-sm-8 ok">

				<div class="row form-group">
					<div class="col-sm-6">
						<label for="matet">MNUMEROS inscription :</label>
						<input type="hidden" name="numinscrip" id="matet" value="<?php echo $_COOKIE['num_inscri']; ?>" class="form-control" autofocus required="required">
					</div>
				</div>														
			</div> -->
			<!-- NIVEAU , FILIERE ------------------------------------------------------------------------------------------ -->
			
					<!-- ANNE ACCADEMIQUE GENEREE --------------------------------------------------------------------------------- -->
			
			<!-- PAYEMENT------------------------------------------------------------------------------------------ -->
			<div class="row pay">
				<fieldset class="col-sm-8">
				<legend><span class="titlec">NIVEAU SOUHAITE</span></legend>
					<div class="row">
						<!-- CHOIX DE LA FILIERE---------------------------------------------------- -->
						<div class="col-sm-6">
							<label for="filiere">Filière :</label> 
							<select name="filiere" id="filiere" class="form-control" onchange="chang_niveau()">
								<option value="choisir">choisir</option>

								<optgroup label="licence profesionnel">
								<?php while($lfil=mysqli_fetch_array($enr_fil)) {?>
									<option value="<?php echo $lfil['CodeFil'] ;?>"><?php echo $lfil['LibFil']; ?></option>
								<?php } ?>
								</optgroup>
						</select>
						</div>
						<!-- CHHOIX DU NIVEAU------------------------------------------------------------------- -->
						<div class="col-sm-6" >
							<label>Niveau :</label>
							<select class="form-control" name="niveau" id="niveau">
								<option value="">choisir</option>			
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset class="col-md-offset-1 col-md-11">
					<legend><span class="title">PAIEMENT</span></legend>
						<fieldset>
							<legend><span class="title">MODALITES DE PAIEMENT</span></legend>
							<div class="row">
								<div class="col-md-3 col-xs-6">
									<input type="radio" name="modepaiement" id="orange" value="orange" checked="checked"><label for="orange"><img src="../img/om.jpg" class="operateur"></label>
								</div>

								<div class="col-md-3 col-xs-6">
									<input type="radio" name="modepaiement" id="moov" value="moov"><label for="moov"><img src="../img/moov.jpg" class="operateur"></label>
								</div>

								<div class="col-md-3 col-xs-6">
									<input type="radio" name="modepaiement" id="mtn" value="mtn"><label for="mtn"><img src="../img/mtn.jpg" class="operateur"></label>
								</div>
								<div class="col-md-3 col-xs-6">
									<input type="radio" name="modepaiement" id="visa" value="visa"><label for="visa"><img src="../img/visa1.jpg" class="operateur"></label>
								</div>
							</div>
						</fieldset>
							<div class="infostransfert">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur suscipit minima veritatis consequatur facilis iusto illo! Mollitia alias, facere animi repellendus, ducimus esse debitis possimus modi sed quae quaerat vitae.</p>
							</div>
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="numpaimement">N° PAIEMENT :</label>
									<input type="text" name="numpay" class="form-control" placeholder="A12478574">

									<!-- NUMEROS D'INSCRIPTION------------------------------------------------------------- -->
									<input type="hidden" name="numinsc" id="numinscript" class="form-control">
								</div>
								<div class="col-sm-6">

									<label for="montant">Montant d'inscription :</label>
									<input type="text" name="monpay" id="montant" class="form-control">
								</div>
							</div>
							<div class="col-sm-4">
								<label>Caisse :</label>
								<select class="form-control" name="caiss">
									<option value="choisir">choisir</option>
								
											<?php while($lcaiss=mysqli_fetch_array($enr_caiss)) {?>
												<option value="<?php echo $lcaiss['CodeCaisse']; ?>"><?php echo $lcaiss['LibCaisse']; ?></option>
											<?php } ?>				
								</select>
							</div>
								<div class="row form-group">
									<div class="col-sm-6">	
										<!-- matricule etudiant ------------------------------------------------------------	 -->
										<input type="hidden" name="matet" id="matetu" value="" class="form-control" autofocus required="required">
								</div>
							</div>
				</fieldset>
			</div>
			
			<div class="row">
				<div class="col-sm-offset-5 col-sm-6">
					<input type="submit" value="valider" name="valider_paiment" class="btn btn-info btn-lg btreset">
					<button type="reset" class="btn btn-default btn-lg btreset"><i class="fas fa-redo-alt"></i> REINITIALISER</button>
				</div>
			</div>
			</form>
			
		</div>
		
	</div>
</body>
</html>
<script>
		function chang_niveau(){
		var chang=new XMLHttpRequest();
		chang.open("GET","niveau.php?fil="+document.getElementById("filiere").value,false);
		chang.send(null);
		document.getElementById("niveau").innerHTML=chang.responseText;
	}
</script>