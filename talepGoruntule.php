<?php
    session_start();
    ob_start();
    include("baglanti.php");
	
	
	function talepGor()
	{
		$degerler=array();
		$talepSayisi=0;
		$sayici=0;
		
		include("baglanti.php");
		$sqltalepGoruntule="SELECT * FROM talepler WHERE talepEden_id=$_SESSION[kullaniciId] AND talepDurum=0";
		$sorgutalepGoruntule=mysql_query($sqltalepGoruntule,$baglanti);
		while($sonuctalepGoruntule=mysql_fetch_array($sorgutalepGoruntule))
		{
			$degerler[$talepSayisi][0]=$sonuctalepGoruntule[talepEden_id];
			$degerler[$talepSayisi][1]=$sonuctalepGoruntule[talepSinif_id];
			$degerler[$talepSayisi][2]=$sonuctalepGoruntule[talepDers_id];
			$degerler[$talepSayisi][3]=$sonuctalepGoruntule[talepBolum_id];
			$degerler[$talepSayisi][4]=$sonuctalepGoruntule[talepGun_id];
			$degerler[$talepSayisi][5]=$sonuctalepGoruntule[talepSaatler];
			$degerler[$talepSayisi][6]=$sonuctalepGoruntule[talepBina_id];
			$gunGorn=explode(",",$degerler[$talepSayisi][4]);
			$talepSayisi++;
		}
		$guuun="";
		
		for($soo=0;$soo<count($gunGorn);$soo++)
		{
			if($soo==0)
				$guuun=$gunGorn[$soo];
			
			if($soo>0)
			{
				if($gunGorn[$soo]!=$gunGorn[$soo-1])
					$guuun=$guuun.$gunGorn[$soo];
			}
		}
		
		//print_r(array_count_values($gunGorn));
		//echo count($degerler);
		//echo $talepSayisi;
		while($sayici<count($degerler))
		{
			echo "<tr>";
				$sqltalepGoruntule2="SELECT * FROM kullanicilar WHERE bina_id=".$degerler[$sayici][6].";";
				$sorgutalepGoruntule2=mysql_query($sqltalepGoruntule2,$baglanti);
				while($snc1=mysql_fetch_array($sorgutalepGoruntule2))
				{
					echo "<td class=\"text-center text-capitalize\">$snc1[k_adi]</td>";
				}
				$sqltalepGoruntule2="SELECT * FROM siniflar WHERE id=".$degerler[$sayici][1].";";
				$sorgutalepGoruntule2=mysql_query($sqltalepGoruntule2,$baglanti);
				while($snc1=mysql_fetch_array($sorgutalepGoruntule2))
				{
					echo "<td class=\"text-center text-capitalize\">$snc1[adi]</td>";
				}
				$sqltalepGoruntule2="SELECT * FROM dersler WHERE id=".$degerler[$sayici][2].";";
				$sorgutalepGoruntule2=mysql_query($sqltalepGoruntule2,$baglanti);
				while($snc1=mysql_fetch_array($sorgutalepGoruntule2))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc1[adi]</td>";
				}
				$sqltalepGoruntule2="SELECT * FROM bolumler WHERE id=".$degerler[$sayici][3].";";
				$sorgutalepGoruntule2=mysql_query($sqltalepGoruntule2,$baglanti);
				while($snc1=mysql_fetch_array($sorgutalepGoruntule2))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc1[adi]</td>";
				}
				$syyy=0;
				while($syyy<strlen($guuun))
				{
					if($syyy==0)
					{
						if($guuun[$syyy]==1)
							echo "<td class=\"text-center text-capitalize small\">pazartesi";
						if($guuun[$syyy]==2)
							echo "<td class=\"text-center text-capitalize small\">salı";
						if($guuun[$syyy]==3)
							echo "<td class=\"text-center text-capitalize small\">çarşamba";
						if($guuun[$syyy]==4)
							echo "<td class=\"text-center text-capitalize small\">perşembe";
						if($guuun[$syyy]==5)
							echo "<td class=\"text-center text-capitalize small\">cuma";
					}
					else
					{
						if($guuun[$syyy]==1)
							echo " pazartesi<br>".$degerler[$sayici][5].". saatler</td>";
						if($guuun[$syyy]==2)
							echo " salı<br>".$degerler[$sayici][5].". saatler</td>";
						if($guuun[$syyy]==3)
							echo " çarşamba<br>".$degerler[$sayici][5].". saatler</td>";
						if($guuun[$syyy]==4)
							echo " perşembe<br>".$degerler[$sayici][5].". saatler</td>";
						if($guuun[$syyy]==5)
							echo " cuma<br>".$degerler[$sayici][5].". saatler</td>";
					}
					$syyy++;
				}
				echo "<td class=\"text-center small\">Beklemede</td>";
			$sayici++;
			echo "</tr>";
		}
		
	}
	
	function talepGor2()
	{
		$degerler2=array();
		$talepSayisi2=0;
		$sayici2=0;
		
		include("baglanti.php");
		$sqltalepGoruntuleGelen="SELECT * FROM talepler WHERE talepBina_id=$_SESSION[binaaId] AND talepDurum=0";
		$sorgutalepGoruntuleGelen=mysql_query($sqltalepGoruntuleGelen,$baglanti);
		while($sonuctalepGoruntuleGelen=mysql_fetch_array($sorgutalepGoruntuleGelen))
		{
			$degerler2[$talepSayisi2][0]=$sonuctalepGoruntuleGelen[talepEden_id];
			$degerler2[$talepSayisi2][1]=$sonuctalepGoruntuleGelen[talepSinif_id];
			$degerler2[$talepSayisi2][2]=$sonuctalepGoruntuleGelen[talepDers_id];
			$degerler2[$talepSayisi2][3]=$sonuctalepGoruntuleGelen[talepBolum_id];
			$degerler2[$talepSayisi2][4]=$sonuctalepGoruntuleGelen[talepGun_id];
			$degerler2[$talepSayisi2][5]=$sonuctalepGoruntuleGelen[talepSaatler];
			$degerler2[$talepSayisi2][6]=$sonuctalepGoruntuleGelen[talepBina_id];
			$degerler2[$talepSayisi2][7]=$sonuctalepGoruntuleGelen[talep_id];
			$gunGorn2=explode(",",$degerler2[$talepSayisi2][4]);
			$talepSayisi2++;
		}
		$guuun2="";
		
		for($soo2=0;$soo2<count($gunGorn2);$soo2++)
		{
			if($soo2==0)
				$guuun2=$gunGorn2[$soo2];
			
			if($soo2>0)
			{
				if($gunGorn2[$soo2]!=$gunGorn2[$soo2-1])
					$guuun2=$guuun2.$gunGorn2[$soo2];
			}
		}
		
		//echo $talepSayisi2." ".count($degerler2);
		while($sayici2<count($degerler2))
		{
			echo "<tr>";
				$sqltalepGoruntuleGelen2="SELECT * FROM kullanicilar WHERE id=".$degerler2[$sayici2][0].";";
				$sorgutalepGoruntuleGelen2=mysql_query($sqltalepGoruntuleGelen2,$baglanti);
				while($snc2=mysql_fetch_array($sorgutalepGoruntuleGelen2))
				{
					echo "<td class=\"text-center text-capitalize\">$snc2[k_adi]</td>";
				}
				$sqltalepGoruntuleGelen2="SELECT * FROM siniflar WHERE id=".$degerler2[$sayici2][1].";";
				$sorgutalepGoruntuleGelen2=mysql_query($sqltalepGoruntuleGelen2,$baglanti);
				while($snc2=mysql_fetch_array($sorgutalepGoruntuleGelen2))
				{
					echo "<td class=\"text-center text-capitalize\">$snc2[adi]</td>";
				}
				$sqltalepGoruntuleGelen2="SELECT * FROM dersler WHERE id=".$degerler2[$sayici2][2].";";
				$sorgutalepGoruntuleGelen2=mysql_query($sqltalepGoruntuleGelen2,$baglanti);
				while($snc2=mysql_fetch_array($sorgutalepGoruntuleGelen2))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc2[adi]</td>";
				}
				$sqltalepGoruntuleGelen2="SELECT * FROM bolumler WHERE id=".$degerler2[$sayici2][3].";";
				$sorgutalepGoruntuleGelen2=mysql_query($sqltalepGoruntuleGelen2,$baglanti);
				while($snc2=mysql_fetch_array($sorgutalepGoruntuleGelen2))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc2[adi]</td>";
				}
				$syyy2=0;
				while($syyy2<strlen($guuun2))
				{
					if($syyy2==0)
					{
						if($guuun2[$syyy2]==1)
							echo "<td class=\"text-center text-capitalize small\">pazartesi";
						if($guuun2[$syyy2]==2)
							echo "<td class=\"text-center text-capitalize small\">salı";
						if($guuun2[$syyy2]==3)
							echo "<td class=\"text-center text-capitalize small\">çarşamba";
						if($guuun2[$syyy2]==4)
							echo "<td class=\"text-center text-capitalize small\">perşembe";
						if($guuun2[$syyy2]==5)
							echo "<td class=\"text-center text-capitalize small\">cuma";
					}
					else
					{
						if($guuun2[$syyy2]==1)
							echo " pazartesi<br>".$degerler2[$sayici2][5].". saatler</td>";
						if($guuun2[$syyy2]==2)
							echo " salı<br>".$degerler2[$sayici2][5].". saatler</td>";
						if($guuun2[$syyy2]==3)
							echo " çarşamba<br>".$degerler2[$sayici2][5].". saatler</td>";
						if($guuun2[$syyy2]==4)
							echo " perşembe<br>".$degerler2[$sayici2][5].". saatler</td>";
						if($guuun2[$syyy2]==5)
							echo " cuma<br>".$degerler2[$sayici2][5].". saatler</td>";
					}
					$syyy2++;
				}
				
				
				echo "<td class=\"text-center\"><p class=\"small\">Bekleniyor..</p></td>";
				echo "<td><a href=\"talepOnay.php?tId=".$degerler2[$sayici2][7]."&tGun=".$degerler2[$sayici2][4]."&tDersID=".$degerler2[$sayici2][2]."&tSaatler=".$degerler2[$sayici2][5]."&tBina=".$degerler2[$sayici2][6]."&tSinif=".$degerler2[$sayici2][1]."\" class=\"btn btn-outline-success ml-3 my-1\" role=\"button\">Onayla</a></td>";
			$sayici2++;
			echo "</tr>";
		}
	}
	
	function talepGor3()
	{
		$degerler3=array();
		$talepSayisi3=0;
		$sayici3=0;
		include("baglanti.php");
		$sqltalepGoruntuleGelen2="SELECT * FROM talepler WHERE talepDurum=0";
		$sorgutalepGoruntuleGelen2=mysql_query($sqltalepGoruntuleGelen2,$baglanti);
		while($sonuctalepGoruntuleGelen2=mysql_fetch_array($sorgutalepGoruntuleGelen2))
		{
			$degerler3[$talepSayisi3][0]=$sonuctalepGoruntuleGelen2[talepEden_id];
			$degerler3[$talepSayisi3][1]=$sonuctalepGoruntuleGelen2[talepSinif_id];
			$degerler3[$talepSayisi3][2]=$sonuctalepGoruntuleGelen2[talepDers_id];
			$degerler3[$talepSayisi3][3]=$sonuctalepGoruntuleGelen2[talepBolum_id];
			$degerler3[$talepSayisi3][4]=$sonuctalepGoruntuleGelen2[talepGun_id];
			$degerler3[$talepSayisi3][5]=$sonuctalepGoruntuleGelen2[talepSaatler];
			$degerler3[$talepSayisi3][6]=$sonuctalepGoruntuleGelen2[talepBina_id];
			$degerler3[$talepSayisi3][7]=$sonuctalepGoruntuleGelen2[talep_id];
			$gunGorn3=explode(",",$degerler3[$talepSayisi3][4]);
			$talepSayisi3++;
		}
		
		$guuun3="";
		
		for($soo3=0;$soo3<count($gunGorn3);$soo3++)
		{
			if($soo3==0)
				$guuun3=$gunGorn3[$soo3];
			
			if($soo3>0)
			{
				if($gunGorn3[$soo3]!=$gunGorn3[$soo3-1])
					$guuun3=$guuun3.$gunGorn3[$soo3];
			}
		}
		
		//echo $talepSayisi2." ".count($degerler2);
		while($sayici3<count($degerler3))
		{
			echo "<tr>";
				$sqltalepGoruntuleGelen3="SELECT * FROM kullanicilar WHERE id=".$degerler3[$sayici3][0].";";
				$sorgutalepGoruntuleGelen3=mysql_query($sqltalepGoruntuleGelen3,$baglanti);
				while($snc3=mysql_fetch_array($sorgutalepGoruntuleGelen3))
				{
					echo "<td class=\"text-center text-capitalize\">$snc3[k_adi]</td>";
				}
				$sqltalepGoruntuleGelen3="SELECT * FROM siniflar WHERE id=".$degerler3[$sayici3][1].";";
				$sorgutalepGoruntuleGelen3=mysql_query($sqltalepGoruntuleGelen3,$baglanti);
				while($snc3=mysql_fetch_array($sorgutalepGoruntuleGelen3))
				{
					echo "<td class=\"text-center text-capitalize\">$snc3[adi]</td>";
				}
				$sqltalepGoruntuleGelen3="SELECT * FROM dersler WHERE id=".$degerler3[$sayici3][2].";";
				$sorgutalepGoruntuleGelen3=mysql_query($sqltalepGoruntuleGelen3,$baglanti);
				while($snc3=mysql_fetch_array($sorgutalepGoruntuleGelen3))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc3[adi]</td>";
				}
				$sqltalepGoruntuleGelen3="SELECT * FROM bolumler WHERE id=".$degerler3[$sayici3][3].";";
				$sorgutalepGoruntuleGelen3=mysql_query($sqltalepGoruntuleGelen3,$baglanti);
				while($snc3=mysql_fetch_array($sorgutalepGoruntuleGelen3))
				{
					echo "<td class=\"text-center text-capitalize small\">$snc3[adi]</td>";
				}
				$syyy3=0;
				while($syyy3<strlen($guuun3))
				{
					if($syyy3==0)
					{
						if($guuun3[$syyy2]==1)
							echo "<td class=\"text-center text-capitalize small\">pazartesi";
						if($guuun3[$syyy3]==2)
							echo "<td class=\"text-center text-capitalize small\">salı";
						if($guuun3[$syyy3]==3)
							echo "<td class=\"text-center text-capitalize small\">çarşamba";
						if($guuun3[$syyy3]==4)
							echo "<td class=\"text-center text-capitalize small\">perşembe";
						if($guuun3[$syyy3]==5)
							echo "<td class=\"text-center text-capitalize small\">cuma";
					}
					else
					{
						if($guuun3[$syyy3]==1)
							echo " pazartesi<br>".$degerler3[$sayici3][5].". saatler</td>";
						if($guuun3[$syyy3]==2)
							echo " salı<br>".$degerler3[$sayici3][5].". saatler</td>";
						if($guuun3[$syyy3]==3)
							echo " çarşamba<br>".$degerler3[$sayici3][5].". saatler</td>";
						if($guuun3[$syyy3]==4)
							echo " perşembe<br>".$degerler3[$sayici3][5].". saatler</td>";
						if($guuun3[$syyy3]==5)
							echo " cuma<br>".$degerler3[$sayici3][5].". saatler</td>";
					}
					$syyy3++;
				}
				
				
				echo "<td><a href=\"talepOnay.php?tId=".$degerler3[$sayici3][7]."&tGun=".$degerler3[$sayici3][4]."&tDersID=".$degerler3[$sayici3][2]."&tSaatler=".$degerler3[$sayici3][5]."&tBina=".$degerler3[$sayici3][6]."&tSinif=".$degerler3[$sayici3][1]."\" class=\"btn btn-outline-success ml-3 my-1\" role=\"button\">Onayla</a></td>";
			$sayici3++;
			echo "</tr>";
		}
	}
	
	if($_SESSION["rutbe"]=="Administratör")
	{
		echo "<table class=\"col-10 table table-hover my-1 table-responsive-sm\">";
			echo "<tr class=\"text-center font-weight-bold\"><td colspan=\"6\">Gelen Talepler</td></tr>";
				echo "<tr>";
					echo "<td class=\"text-center font-weight-bold\">Talebi Oluşturan Moderatör</td>";
					echo "<td class=\"text-center font-weight-bold\">Derslik Adı</td>";
					echo "<td class=\"text-center font-weight-bold\">Ders Adı</td>";
					echo "<td class=\"text-center font-weight-bold\">Bölüm Adı</td>";
					echo "<td class=\"text-center font-weight-bold\">Talep Edilen Gün-Saat</td>";
					echo "<td class=\"text-center font-weight-bold\">Onay</td>";
			echo "</tr>";
			echo talepGor3();
		echo "</table>";
	}
	
	else if($_SESSION["rutbe"]=="Moderatörü")
	{
		
			if($_SESSION["talepEkran"]==1 || $_SESSION["talepEkran"]=="")
			{
				echo "<div class=\"col-xl-3 col-lg-6 col-md-6 col-sm-12\">";
					echo "<div class=\"list-group\">";
						echo "<a href=\"index.php?menuGon=4&tlpEkrni=1\" class=\"btn btn-danger ml-3 my-1\" role=\"button\">Gönderilen Talepler</a>";
						echo "<a href=\"index.php?menuGon=4&tlpEkrni=2\" class=\"btn btn-warning ml-3 my-1\" role=\"button\">Gelen Talepler</a>";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-xl-3\">";
					echo "<table class=\"col-10 table table-hover my-1 table-responsive-sm\">";
						echo "<tr class=\"text-center font-weight-bold\"><td colspan=\"6\">Gönderilen Talepler</td></tr>";
						echo "<tr>";
							echo "<td class=\"text-center font-weight-bold\">Onaylaması Beklenen Moderatör</td>";
							echo "<td class=\"text-center font-weight-bold\">Derslik Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Ders Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Bölüm Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Talep Edilen Gün-Saat</td>";
							echo "<td class=\"text-center font-weight-bold\">Durum</td>";
						echo "</tr>";
						echo talepGor();
					echo "</table>";
				echo "</div>";
			}
			
			else if($_SESSION["talepEkran"]==2)
			{
				echo "<div class=\"col-xl-3 col-lg-6 col-md-6 col-sm-12\">";
					echo "<div class=\"list-group\">";
						echo "<a href=\"index.php?menuGon=4&tlpEkrni=1\" class=\"btn btn-warning ml-3 my-1\" role=\"button\">Gönderilen Talepler</a>";
						echo "<a href=\"index.php?menuGon=4&tlpEkrni=2\" class=\"btn btn-danger ml-3 my-1\" role=\"button\">Gelen Talepler</a>";
					echo "</div>";
				echo "</div>";
				echo "<div class=\"col-xl-6 col-lg-6 col-md-6 col-sm-12 ml-xl-3\">";
				
				if($_SESSION["onay"]==1)
					echo "<p class=\"text-center font-weight-bold text-success mt-3\">Onaylama işlemi başarılı!</p>";
				
					echo "<table class=\"col-10 table table-hover my-1 table-responsive-sm\">";
						echo "<tr class=\"text-center font-weight-bold\"><td colspan=\"6\">Gelen Talepler</td></tr>";
						echo "<tr>";
							echo "<td class=\"text-center font-weight-bold\">Talebi Oluşturan Moderatör</td>";
							echo "<td class=\"text-center font-weight-bold\">Derslik Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Ders Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Bölüm Adı</td>";
							echo "<td class=\"text-center font-weight-bold\">Talep Edilen Gün-Saat</td>";
							echo "<td class=\"text-center font-weight-bold\">Onay</td>";
						echo "</tr>";
						echo talepGor2();
					echo "</table>";
				echo "</div>";
			}
	}
	
  	ob_end_flush();
?>