<?php

	session_start();
	ob_start();
	include("baglanti.php");
	
	$sqlSifirla="UPDATE pazartesi SET durum=0, ait='';";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="UPDATE sali SET durum=0, ait='';";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="UPDATE carsamba SET durum=0, ait='';";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="UPDATE persembe SET durum=0, ait='';";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="UPDATE cuma SET durum=0, ait='';";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="UPDATE dersler SET durum=0;";
	mysql_query($sqlSifirla,$baglanti);
	$sqlSifirla="TRUNCATE TABLE talepler;";
	mysql_query($sqlSifirla,$baglanti);
	
	header("location:index.php");
	ob_end_flush();
?>