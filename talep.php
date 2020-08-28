<?php
	session_start();
    ob_start();
	
	$counter=0;
	$counter3=0;
	include("baglanti.php");
	
	$talepEden=$_SESSION["kullaniciId"];
	$talepDers=$_SESSION["dersId"];
	$talepHoca=$_SESSION["ogrId"];
	$talepBolum=$_SESSION["bolumId"];
	$talepOgr=$_SESSION["ogrId"];
	$talepDonem=$_SESSION["donemId"];
	$talepBina=$_SESSION["binaId"];
	$talepSinif=$_SESSION["sinifId"];
	$talepGunler=$_GET["gunDeg"];
	$talepGun=explode(",",$talepGunler);
	$talepSaatler=$_GET["saatDeg"];
	$talepSaat=explode(",",$talepSaatler);
	echo $talepGunler."<br>".$talepSaatler."<br>";
	
	$sqlTalep="INSERT INTO talepler (talepEden_id,talepDers_id,talepHoca_id,talepBolum_id,talepDonem_id,talepBina_id,talepSinif_id,talepGun_id,talepSaatler,talepDurum) VALUES ('$talepEden','$talepDers','$talepHoca','$talepBolum','$talepDonem','$talepBina','$talepSinif','$talepGunler','$talepSaatler','0')";
	$sqlDersGuncelleme="UPDATE dersler SET durum='1' WHERE id='$talepDers';";
	
	
	while($counter<count($talepGun))
	{
		$gunEkle=($talepSaat[$counter]);
		if($talepGun[$counter]==1)
			$sqlGunGuncelleme="UPDATE pazartesi SET durum='1',ait='Onay Bekleniyor' WHERE bina_id='$talepBina' AND sinif_id='$talepSinif' AND saat_id='$gunEkle';";
		else if($talepGun[$counter]==2)
			$sqlGunGuncelleme="UPDATE sali SET durum='1',ait='Onay Bekleniyor' WHERE bina_id='$talepBina' AND sinif_id='$talepSinif' AND saat_id='$gunEkle';";
		else if($talepGun[$counter]==3)
			$sqlGunGuncelleme="UPDATE carsamba SET durum='1',ait='Onay Bekleniyor' WHERE bina_id='$talepBina' AND sinif_id='$talepSinif' AND saat_id='$gunEkle';";
		else if($talepGun[$counter]==4)
			$sqlGunGuncelleme="UPDATE persembe SET durum='1',ait='Onay Bekleniyor' WHERE bina_id='$talepBina' AND sinif_id='$talepSinif' AND saat_id='$gunEkle';";
		else if($talepGun[$counter]==5)
			$sqlGunGuncelleme="UPDATE cuma SET durum='1',ait='Onay Bekleniyor' WHERE bina_id='$talepBina' AND sinif_id='$talepSinif' AND saat_id='$gunEkle';";
			
		$counter3+=2;
		echo $sqlGunGuncelleme."<br>";
		mysql_query($sqlGunGuncelleme,$baglanti);
		$counter++;
	}
	
	mysql_query($sqlDersGuncelleme,$baglanti);
	mysql_query($sqlTalep,$baglanti);
	header("location:index.php");

  	ob_end_flush();
?>