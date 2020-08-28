<?php

	session_start();
	ob_start();
	include("baglanti.php");
	
	$onayTalepId=$_GET["tId"];
	$onayTalepGunu=$_GET["tGun"];
	$onayTalepDers=$_GET["tDersID"];
	$onayTalepSaatler=$_GET["tSaatler"];
	$onayTalepBina=$_GET["tBina"];
	$onayTalepSinif=$_GET["tSinif"];
	$onayTalepSaatler=explode(",", $onayTalepSaatler);
	$onayTalepGunu=explode(",", $onayTalepGunu);
	$dersName="";
	
	
	$sqlDersAdi="SELECT * FROM dersler WHERE id='$onayTalepDers';";
	$sorguDersAdi=mysql_query($sqlDersAdi,$baglanti);
	while($dersnamesonuc=mysql_fetch_array($sorguDersAdi))
		$dersName=$dersnamesonuc[adi];
	
	$sqlTalepOnay="UPDATE talepler SET talepDurum='1' WHERE talep_id='$onayTalepId';";
	mysql_query($sqlTalepOnay,$baglanti);
	$sqlGunSayac=0;
	while($sqlGunSayac<count($onayTalepSaatler))
	{
		if($onayTalepGunu[$sqlGunSayac]==1)
			$onayTalepGunu2="pazartesi";
		if($onayTalepGunu[$sqlGunSayac]==2)
			$onayTalepGunu2="sali";
		if($onayTalepGunu[$sqlGunSayac]==3)
			$onayTalepGunu2="carsamba";
		if($onayTalepGunu[$sqlGunSayac]==4)
			$onayTalepGunu2="persembe";
		if($onayTalepGunu[$sqlGunSayac]==5)
			$onayTalepGunu2="cuma";
		$sqlTalepOnay2="UPDATE ".$onayTalepGunu2." SET ait='$dersName' WHERE sinif_id='$onayTalepSinif' AND bina_id='$onayTalepBina' AND saat_id='".$onayTalepSaatler[$sqlGunSayac]."';";
		mysql_query($sqlTalepOnay2,$baglanti);
		//echo $sqlTalepOnay2."<br>";
		$sqlGunSayac++;
	}
	
	
	//echo $sqlTalepOnay."<br>";
	header("location:index.php?menuGon=4&tlpEkrni=2&onay=1");
	ob_end_flush();
?>