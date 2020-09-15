
<?php 
session_start();
if (isset($_SESSION['bool']) and $_SESSION['bool']==1) {
	

$bd=mysqli_connect("localhost","root","","gest_ins_db_24_01");

$matricule=$_SESSION['id'];

// LIAISON DES TABLES DE LA BASE DE DONNES---------------------------------------------------------
$req_etu="SELECT `MatEtud`, `NomEtud`, `PrenomEtud`, `IdPermanent`, `SexeEtud`, `DateNaissEtud`, `LieuNaissEtud`, `StatutEtud`, `ContactEtud`, `EmailEtud`, `ResidenceEtud`, `PhotoEtud` FROM `etudiant` WHERE `IdPermanent`='$matricule'";
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
// AJOUT DES DOSSIER POUR L'INSCRIPTION----------------------------------------------------------
if (isset($_POST['valider_diplom'])) {
	if (isset($_FILES['my_file']) and isset($_FILES['my_file']['name'])) {	
	
			$taillemax=3145728;
			$file_ext=strtolower(strrchr($_FILES['my_file']['name'], '.'));
			$tab_ext=array('.rar','.zip');			
		$mate=$tab_etud['MatEtud'];
		$ins=$tab_ins['NumInscrip'];
		if (in_array($file_ext, $tab_ext)) {
			if ($_FILES['my_file']['size'] <= $taillemax) {

				$file_dest="../etudiant/dossier/".$matricule.$file_ext;
				$file_tmp_name=$_FILES['my_file']['tmp_name'];
				
				if (move_uploaded_file($file_tmp_name, $file_dest)) {
					$doss_id=$matricule.$file_ext;

					$rq_update_doss="INSERT INTO `dossier` (`NumDoss`, `DateEnregisDoss`, `ContenuDoss`, `Infocorrespond`) VALUES (NULL, '02-12-2019', '$doss_id', 'v bvgb ')";
					$rq_query_doss=mysqli_query($bd,$rq_update_doss);

					$rq_list_doss="SELECT `NumDoss`, `DateEnregisDoss`, `ContenuDoss`, `Infocorrespond` FROM `dossier` WHERE `ContenuDoss`='$doss_id'";
					$rq_lis_query=mysqli_query($bd,$rq_list_doss);

					$array_dossir=mysqli_fetch_array($rq_lis_query);

					$mat_doss=$array_dossir['NumDoss'];
					

					$rq_update_reli="INSERT INTO `fournir` (`NumDoss`, `MatEtud`) VALUES ('$mat_doss', '$id_pers')";
					$rq_query_rel=mysqli_query($bd,$rq_update_reli);

				}
			}
			else{
				echo "utiliser un photo d'au moins 2Mo ";
			} 
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>MON PROFIL</title>
	<link rel="stylesheet" type="text/css" href="../css/fig.css">
	<link rel="stylesheet"  href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<p class="forminscription profilfig"><span class="text_profil">MON PROFIL</span></p>
		<div class="row">
			<div class="col-sm-3 profil">
				<div class="row">

					<div class=" col-sm-offset-3 col-sm-5 photo_profil thumbnail ">
							<img src="../etudiant/photo/<?php echo $tab_etud['PhotoEtud']; ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 ">
						<p class="nom_prenom"><?php echo $tab_etud['NomEtud']; ?> <?php echo $tab_etud['PrenomEtud']; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<p><span class="contact_form">CONTACT</span></p>
						<table class="table table-bordered matable">
							<tr>
								<td><?php echo $tab_etud['EmailEtud']; ?></td>
							</tr>
							<tr>
								<td><?php echo $tab_etud['ContactEtud']; ?></td>
							</tr>
						</table>
					</div>
				</div>
				
			</div>
			<!-- FIN DU PREMIER BLOC --------------------------------------------------------------------- -->
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-12 edit">
					<div class="btn-group btn-group-justified">
						<div class="col-sm-4">
							<a href="profil_edit.php" class="btn btn-danger btn-sm">Modifier</a>
							<a href="Identifiant_permanent.php" class="btn btn-default btn-sm">Deconnecter</a>
						</div>
					</div>
				</div>
			</div>
			<!-- ligne 2 -->
			<div class="row">
				<div class="col-sm-5">
					<table class="table table-bordered matable">
						<th>INFORMATION PERSO.</th>
						<tr>
							<td>ID PERMANENT</td>
							<td><?php echo $tab_etud['IdPermanent']; ?></td>
						</tr>
						<tr>
							<td>NOM</td>
							<td><?php echo $tab_etud['NomEtud']; ?></td>
						</tr>
						<tr>
							<td>PRENOM</td>
							<td><?php echo $tab_etud['PrenomEtud']; ?></td>
						</tr>
						<tr>
							<td>SEXE</td>
							<td><?php echo $tab_sexe[$tab_etud['SexeEtud']]; ?></td>
						</tr>
						<tr>
							<td>DATE DE NAISSANCE</td>
							<td><?php echo $tab_etud['DateNaissEtud']; ?></td>
						</tr>
						<tr>
							<td>LIEU DE NAISSANCE</td>
							<td><?php echo $tab_etud['LieuNaissEtud']; ?></td>
						</tr>
						<tr>
							
							<td>RESIDENCE</td>
							<td><?php echo $tab_etud['ResidenceEtud']; ?></td>
						</tr>
						<tr>			
							<td>STATUT</td>
							<td><?php echo $tab_oriente[$tab_etud['StatutEtud']]; ?></td>
						</tr>
						<tr>

							<td>MATRICULE</td>
							<td><?php echo $tab_etud['MatEtud']; ?></td>
						</tr>
					</table>
				</div>

				<div class="col-sm-5">
					<table class="table table-bordered matable">
						<th>INFORMATION ECOLE</th>
						<tr>
							<td>DATE D'INSCRIPTION</td>
							<td><?php echo $tab_ins['DateInscrip']; ?></td>
						</tr>
						<tr>
							<td>FILIERE</td>
							<td><?php echo $tab_fil['LibFil']; ?></td>
						</tr>
						<tr>

							<td>NIVEAU</td>
							<td><?php echo $tab_niv['LibNiv']; ?></td>
						</tr>

						<tr>
							<td>ANNEE SCOLAIRE</td>
							<td><?php echo $tab_ins['CodeAnnee']; ?></td>
						</tr>
					</table>
				</div>

			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-8">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row idperm">
							<div class="col-md-10">
								<legend><span class="titletu"></span></legend>
									<div class="col-sm-8 ok">

										<div class="row form-group">
											<div class="col-sm-12">
												<label for="dp">Mon Dossier :</label>
												<input type="file" name="my_file" id="dp" class="form-control">
											</div>
										</div>						
									</div>
							</div>
						</div>
						<div class="row">
						<div>
							<div class="col-sm-offset-5 col-sm-6" >
							<input type="submit" name="valider_diplom" value="valider" class="btn btn-info btn-lg btreset">
							<button type="reset" class="btn btn-default btn-lg btreset"><i class="fas fa-redo-alt"></i> REINITIALISER</button>
						</div>
						</div>
					</div>
				</form>
				</div>
	</div>

</div>

</body>
</html>
<?php }
else{
	echo "connecter vous";
} ?>