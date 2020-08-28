<?php
    session_start();
    ob_start();
    include("baglanti.php");

  	$sayac=0;
  	$user=$_POST["user"];
  	$pass=$_POST["pass"];

  	$SQL_kul="SELECT * FROM kullanicilar WHERE k_adi='$user' AND sifre='$pass';";
  	$sorgu_kul=mysql_query($SQL_kul,$baglanti);
  	while($sonuc_kul=mysql_fetch_array($sorgu_kul))
  	{
  		$sayac++;
  		$_SESSION["kullaniciId"]=$sonuc_kul[id];
  		$_SESSION["ad"]=$sonuc_kul[k_adi];
		$_SESSION["binaaId"]=$sonuc_kul[bina_id];
		
		if($sonuc_kul[rutbe]==0)
			$_SESSION["rutbe"]="Administratör";
		if($sonuc_kul[rutbe]==1)
			$_SESSION["rutbe"]="Moderatörü";
		
  	}

  	if($sayac==1)
  	{
		if($_SESSION["binaaId"]>0)
		{
			$sqlBina="SELECT * FROM binalar WHERE id='$_SESSION[binaaId]';";
			$sqlBinaSorgu=mysql_query($sqlBina,$baglanti);
			while($sonucBina=mysql_fetch_array($sqlBinaSorgu))
				$_SESSION["binaAdi"]=$sonucBina[adi];
		}
  		header("Location:index.php");
  	}

  	else
  	{
		$_SESSION["kullaniciId"]=0;
  		header("Location:index.php");
  	}

  	ob_end_flush();
?>
