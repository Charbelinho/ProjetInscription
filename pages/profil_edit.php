<?php 
session_start();
$matricule1=$_SESSION['id'];
$bd=mysqli_connect("localhost","root","","gest_ins_db_24_01");

$req_etu="SELECT `MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud` FROM `etudiant` WHERE `IdPermanent`='$matricule1'";
$list_req_etu=mysqli_query($bd,$req_etu);
$tab_etud=mysqli_fetch_array($list_req_etu);
$id_pers=$tab_etud['MatEtud'];

$req_pai="SELECT `NumPai`, `LibPai`, `DatePai`, `MonatantPai`, `ModePai`, `MatEtud`, `NumInscrip`, `CodeCaisse` FROM `paiement` WHERE `MatEtud`='$id_pers'";
$list_req_pai=mysqli_query($bd,$req_pai);
$tab_pai=mysqli_fetch_array($list_req_pai);
$num_insc=$tab_pai['NumInscrip'];

$req_ins="SELECT `NumInscrip`, `DateInscrip`, `ValidationInscrip`, `CodeNiv`, `CodeAnnee`, `CodeFil` FROM `inscription` WHERE `NumInscrip`='$num_insc'";
$list_req_ins=mysqli_query($bd,$req_ins);
$tab_ins=mysqli_fetch_array($list_req_ins);
$cod_fil=$tab_ins['CodeFil'];
$cod_niv=$tab_ins['CodeNiv'];

$req_fil="SELECT `CodeFil`, `LibFil` FROM `filiere` WHERE `CodeFil`='$cod_fil'";
$list_req_fil=mysqli_query($bd,$req_fil);
$tab_fil=mysqli_fetch_array($list_req_fil);

$req_niv="SELECT `CodeNiv`, `LibNiv`, `CodeFil` FROM `niveau` WHERE `CodeNiv`='$cod_niv'";
$list_req_niv=mysqli_query($bd,$req_niv);
$tab_niv=mysqli_fetch_array($list_req_niv);

$tab_sexe = array('F'=>"FEMME",'H'=>"HOMME" );
$tab_oriente=array('OR' => "ORIENTE",'NO' => "NON ORIENTE");

// LISTE DES NIVEAU ----------------------------------------------------------------
	$list_niv="SELECT * FROM `niveau`";
	$enr_niv=mysqli_query($bd,$list_niv);
// LISTE DES FILIERES ----------------------------------------------------------------
	$list_fil="SELECT `CodeFil`, `LibFil` FROM `filiere`";
	$enr_fil=mysqli_query($bd,$list_fil);

if (isset($_POST['maj'])) {
	if (isset($_FILES['avatar']) and isset($_FILES['avatar']['name'])) {	
	
			$taillemax=2097152;
			$file_ext=strtolower(strrchr($_FILES['avatar']['name'], '.'));
			$tab_ext=array('.jpg','.jpeg','.png','.gif');			
		$mate=$tab_etud['MatEtud'];
		$ins=$tab_ins['NumInscrip'];
		if (in_array($file_ext, $tab_ext)) {
			if ($_FILES['avatar']['size'] <= $taillemax) {

				$file_dest="../etudiant/photo/".$matricule1.$file_ext;
				$file_tmp_name=$_FILES['avatar']['tmp_name'];
				
				if (move_uploaded_file($file_tmp_name, $file_dest)) {
					$photopro=$matricule1.$file_ext;

					$rq_update_etu1="UPDATE `etudiant` SET `NomEtud` = '".$_POST['nometud']."', `PrenomEtud` = '".$_POST['prenometud']."', `DateNaissEtud` = '".$_POST['datenaissetud']."', `LieuNaissEtud` = '".$_POST['lieunaissetud']."', `ContactEtud` = '".$_POST['teletud']."', `EmailEtud` = '".$_POST['emailetud']."', `ResidenceEtud` = '".$_POST['residetud']."', `PhotoEtud` = '$photopro' WHERE `etudiant`.`MatEtud` = '$mate'";
					$rq_query_etu=mysqli_query($bd,$rq_update_etu1);

					$rq_update_ecole="UPDATE `inscription` SET `CodeNiv` = '".$_POST['niveau']."', `CodeFil` = '".$_POST['filiere']."' WHERE `inscription`.`NumInscrip` = '$ins'";
					$rq_query_ecole=mysqli_query($bd,$rq_update_ecole);

				}
			}
			else{
				echo "utiliser un photo d'au moins 2Mo ";
			} 
		}
		else{
			$rq_update_etu="UPDATE `etudiant` SET `NomEtud` = '".$_POST['nometud']."', `PrenomEtud` = '".$_POST['prenometud']."', `DateNaissEtud` = '".$_POST['datenaissetud']."', `LieuNaissEtud` = '".$_POST['lieunaissetud']."', `ContactEtud` = '".$_POST['teletud']."', `EmailEtud` = '".$_POST['emailetud']."', `ResidenceEtud` = '".$_POST['residetud']."' WHERE `etudiant`.`MatEtud` = '$mate'";
			$rq_query_etu=mysqli_query($bd,$rq_update_etu);

			$rq_update_ecole="UPDATE `inscription` SET `CodeNiv` = '".$_POST['niveau']."', `CodeFil` = '".$_POST['filiere']."' WHERE `inscription`.`NumInscrip` = '$ins'";
			$rq_query_ecole=mysqli_query($bd,$rq_update_ecole);

			echo $rq_update_ecole."<br>";
			echo $rq_update_etu;
		}
	}
	header("refresh:0.3, profil_etudiant.php");
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>mise a jor</title>
 	<link rel="stylesheet" type="text/css" href="../css/fig.css">
	<link rel="stylesheet"  href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
 </head>
 <body class="container-fluid">
 	<p class="forminscription profilfig"><span class="text_profil">MODIFICATION DE MON PROFIL</span></p>
 	<form action="" method="post" enctype="multipart/form-data">
			<div class="row etu">
				<div class="col-sm-offset-2 col-md-10">
					
					<legend><span class="titletu">ETUDIANT</span></legend>

						<div class="col-sm-8 ok">
							<input type="file" name="avatar">
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="matricule">Matricule :</label>		
									<input type="text" name="matetu" id="matricule" value="<?php echo $tab_etud['MatEtud']; ?>" class="form-control" autofocus >
								</div>
							</div>
							<div class="row form-group">
							
								<div class="col-sm-6">
									<label for="nom">Nom :</label>
									<input type="text" name="nometud" id="nom" value="<?php echo $tab_etud['NomEtud']; ?>" class="form-control" autofocus>
								</div>
								<div class="col-sm-6">
									<label for="prenom">Prénom :</label>
									<input type="text" name="prenometud" id="prenom" value="<?php echo $tab_etud['PrenomEtud']; ?>" class="form-control">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-sm-6">
									<label for="datenaiss">Date de Naissance :</label>
									<input type="date" name="datenaissetud" id="datenaiss" value="<?php echo $tab_etud['DateNaissEtud']; ?>" class="form-control" placeholder="jj-MM-AAAA">
								</div>
								<div class="col-sm-4 sexes">
									<label for="sexe">Sexe :</label>
									<input type="radio" name="sexeetud"  value="H" id="homme" checked="checked"><label for="homme">H</label>
									<input type="radio" name="sexeetud" value="F" id="femme"><label for="femme">F</label>
								</div>
								<div class="col-sm-4 sexes">
									<label for="statuet">Orienté de l'Etat :</label>
									<input type="radio" name="statetud"  value="OR" id="oriente" checked="checked"><label for="oriente">OUI</label>
									<input type="radio" name="statetud" value="NO" id="non-oriente"><label for="non-oriente">NON</label>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-12">
									<label for="lieunaissance">Lieu de naissance :</label>
									<input type="text" name="lieunaissetud" id="lieunaissance" value="<?php echo $tab_etud['LieuNaissEtud']; ?>" class="form-control">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-12">
									<label for="residence">Résidence :</label>
									<input type="text" name="residetud" id="residence" value="<?php echo $tab_etud['ResidenceEtud']; ?>" class="form-control">
								</div>
								<div class="col-sm-6">
									<label for="mail">Adresse electronique :</label>
									<input type="mail" name="emailetud" id="mail" value="<?php echo $tab_etud['EmailEtud']; ?>" class="form-control">
								</div>
							</div>	
							<div class="row form-group">
								<div class="col-sm-6">
									<label for="telephone">Télephone :</label>
									<input type="tel" name="teletud" id="telephone" value="<?php echo $tab_etud['ContactEtud']; ?>" value="+225" class="form-control">
								</div>
							</div>

						</div>
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
			
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
			<div>
				<div class="col-sm-offset-4 col-sm-6" >
				<input type="submit" name="maj" value="MISE A JOUR" class="btn btn-info btn-lg">
				<button type="reset" class="btn btn-default btn-lg btreset"><i class="fas fa-redo-alt"></i> REINITIALISER</button>
			</div>
			</div>
		</div><br>
		<br>
	</form>
	<?php include("pied.php") ?>
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