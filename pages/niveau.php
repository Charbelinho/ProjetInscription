
	<?php 
		$bd=mysqli_connect("localhost","root","","gest_ins_db_24_01");
		$fil=$_GET['fil'];
		if ($fil!="") {
			$req_niv="SELECT `CodeNiv`, `LibNiv`, `CodeFil` FROM `niveau` WHERE `CodeFil`='$fil'";
			$enr_niv=mysqli_query($bd,$req_niv);
			while ( $list_niv=mysqli_fetch_array($enr_niv)) { ?>
				<option value="<?php echo $list_niv['CodeNiv']; ?>"><?php echo $list_niv['LibNiv']; ?></option>
			<?php }
			} ?>
