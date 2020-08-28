<?php

	session_start();
	ob_start();
	include("baglanti.php");
	
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$buildId=$_POST["build"];
	$rank=$_POST["rank"];
	
	$sqlModEkle="INSERT INTO kullanicilar (k_adi,sifre,bina_id,rutbe) VALUES ('$user','$pass','$buildId','$rank');";
/*	$sqlGuncelle="SELECT * FROM binalar WHERE id='$buildId';";
	$sorguGuncelle=mysql_query($sqlGuncelle,$baglanti);
		while($sonuc=mysql_fetch_array($sorguGuncelle))
			$kullanici=$sonuc[mod_id];
*/

	if($user!="" && $pass!="" && $buildId!="" && $rank!="")
	{
		mysql_query($sqlModEkle,$baglanti);
		
		$sqlGuncelle3="SELECT * FROM kullanicilar WHERE bina_id='$buildId';";
		$sorguGuncelle3=mysql_query($sqlGuncelle3,$baglanti);
		while($sonuc2=mysql_fetch_array($sorguGuncelle3))
			$kullanici=$sonuc2[id];
		
		$sqlGuncelle2="UPDATE binalar SET mod_id='$kullanici' WHERE id='$buildId';";
		mysql_query($sqlGuncelle2,$baglanti);
		
		echo $kullanici."<br>";
		echo $sqlGuncelle;
		header("location:index.php?menuGon=3&modd=1&ekle=1");
	}
	else
		header("location:index.php?menuGon=3&modd=1&ekle=2");
ob_end_flush();
?>