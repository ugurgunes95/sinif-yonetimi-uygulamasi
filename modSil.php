<?php

	include("baglanti.php");
	
	$silinecek=$_GET["silinen"];
	
	$sqlModSil="DELETE FROM kullanicilar WHERE id='$silinecek';";
	if($silinecek!="")
	{
		mysql_query($sqlModSil,$baglanti);
		header("location:index.php?menuGon=3&modd=2&sil=1");
	}
	else
		header("location:index.php?menuGon=3&modd=2&sil=2");

?>