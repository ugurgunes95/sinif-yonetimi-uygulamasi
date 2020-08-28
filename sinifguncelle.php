<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	$prjksiyon=$_POST["prjksyn"];
	$akillitahta=$_POST["akllitahta"];
	$KisiSnv=$_POST["kisiSinav"];
	$KisiDrs=$_POST["kisiDers"];
	$guncellenecekolan=$_POST["GuncellenecekSinif"];
	
	$OzellikYeni=$prjksiyon." ".$akillitahta." ".$KisiSnv." ".$KisiDrs;
	$SqlGuncelleSinifi="UPDATE siniflar SET ozellikler='$OzellikYeni' WHERE id='$guncellenecekolan';";
	mysql_query($SqlGuncelleSinifi,$baglanti);
	
	header("location:index.php?menuGon=3&modd=3&SnfGnclOnay=1");
	ob_end_flush();
?>