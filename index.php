<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	
	$_SESSION["menuId"]=$_GET["menuGon"];
	$_SESSION["modEkrani"]=$_GET["modd"];
	$_SESSION["modDurum"]=$_GET["ekle"];
	
	$_SESSION["dersId"]=$_GET["ders"];
	$_SESSION["bolumId"]=$_GET["bolum"];
	$_SESSION["donemId"]=$_GET["donem"];
	$_SESSION["binaId"]=$_GET["bina"];
	$_SESSION["sinifId"]=$_GET["sinif"];
	
	
	$_SESSION["binaDurumId"]=$_GET["binadrm"];
	
	function binaDurum()
	{
		include("baglanti.php");
		$sqlBinaDrm="SELECT * FROM binalar;";
		$sorguBinaDrm=mysql_query($sqlBinaDrm,$baglanti);
		echo "<div class=\"col-sm-3 col-md-3 col-lg-2 col-xl-2\">";
		echo "<div class=\"list-group\">";
			while($sonucBinaDrm=mysql_fetch_array($sorguBinaDrm))
			{
				if($sonucBinaDrm[id]==$_SESSION["binaDurumId"])
					echo "<a href=\"index.php?menuGon=1&binadrm=$sonucBinaDrm[id]\" class=\"btn btn-danger my-1\" role=\"button\">$sonucBinaDrm[adi]</a>";
				else
					echo "<a href=\"index.php?menuGon=1&binadrm=$sonucBinaDrm[id]\" class=\"btn btn-warning my-1\" role=\"button\">$sonucBinaDrm[adi]</a>";
			}
		echo "</div>";
		echo "</div>";
	}
	
	function grafikCiz()
	{
		$sayac1=0;
		$sayac2=0;
		include("baglanti.php");
		for($i=0;$i<5;$i++)
		{
			if($i==0)
				$sqlBinaDrm2="SELECT * FROM pazartesi WHERE bina_id='$_SESSION[binaDurumId]';";
			if($i==1)
				$sqlBinaDrm2="SELECT * FROM sali WHERE bina_id='$_SESSION[binaDurumId]';";
			if($i==2)
				$sqlBinaDrm2="SELECT * FROM carsamba WHERE bina_id='$_SESSION[binaDurumId]';";
			if($i==3)
				$sqlBinaDrm2="SELECT * FROM persembe WHERE bina_id='$_SESSION[binaDurumId]';";
			if($i==4)
				$sqlBinaDrm2="SELECT * FROM cuma WHERE bina_id='$_SESSION[binaDurumId]';";
			
			$sorguBinaDrm2=mysql_query($sqlBinaDrm2,$baglanti);
			while($sonucBinaDrm2=mysql_fetch_array($sorguBinaDrm2))
			{
				if($sonucBinaDrm2[durum]==0)
					$sayac1++;
				else
					$sayac2++;
			}
		}
		echo "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>";

		echo "<script type=\"text/javascript\">";
		// Load google charts
		echo "google.charts.load('current', {'packages':['corechart']});";
		echo "google.charts.setOnLoadCallback(drawChart);";

		// Draw the chart and set the chart values
		echo "function drawChart() {
		  var data = google.visualization.arrayToDataTable([
		  ['Sınıflar', 'Durum'],
		  ['Boş', $sayac1],
		  ['Dolu', $sayac2]
		]);";

		  // Optional; add a title and set the width and height of the chart
		  echo "var options = {'title':'Bina Durumu', 'width':600, 'height':450};";

		  // Display the chart inside the <div> element with id="piechart"
		  echo "var chart = new google.visualization.PieChart(document.getElementById('piechart'));";
		  echo "chart.draw(data, options);";
		echo "}";
		echo "</script>";
	}
	
	function modlar()
	{
		include("baglanti.php");
		$sqlModlar="SELECT * FROM kullanicilar WHERE rutbe='1';";
		$sorguModlar=mysql_query($sqlModlar,$baglanti);
		echo "<div class=\"col-sm-3 col-md-3 col-lg-2 col-xl-2\">";
		echo "<div class=\"list-group\">";
		if($_SESSION["modEkrani"]==1)
			echo "<a href=\"index.php?menuGon=3&modd=1\" class=\"btn btn-danger my-1\" role=\"button\">Kullanıcı Ekle</a>";
		else
			echo "<a href=\"index.php?menuGon=3&modd=1\" class=\"btn btn-warning my-1\" role=\"button\">Kullanıcı Ekle</a>";
		if($_SESSION["modEkrani"]==2)
			echo "<a href=\"index.php?menuGon=3&modd=2\" class=\"btn btn-danger my-1\" role=\"button\">Kullanıcı Sil</a>";
		else
			echo "<a href=\"index.php?menuGon=3&modd=2\" class=\"btn btn-warning my-1\" role=\"button\">Kullanıcı Sil</a>";
		if($_SESSION["modEkrani"]==3)
			echo "<a href=\"index.php?menuGon=3&modd=3\" class=\"btn btn-danger my-1\" role=\"button\">Bina Durum Güncelleme</a>";
		else
			echo "<a href=\"index.php?menuGon=3&modd=3\" class=\"btn btn-warning my-1\" role=\"button\">Bina Durum Güncelleme</a>";
		echo "</div>";
		echo "</div>";
	}
	
?>
<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Proje</title>
  </head>
  <body>
	<div class="container">
		<p class="h2 text-center my-5">Proje Dersi Uygulaması</p>
		<div class="row">
		<div class="col-xl-12 btn-group-md-horizontal my-3 text-center" role="group">
			<div class="col-12">
				<a href="index.php?menuGon=1" class="btn btn-success mb-1" role="button">Bina Durumları</a>
				<a href="index.php?menuGon=2" class="btn btn-success mb-1" role="button">Ders ve Sınıf Seçimi</a>
				<a href="index.php?menuGon=3" class="btn btn-success mb-1" role="button">Moderatörleri Yönet</a>
				<a href="index.php?menuGon=4" class="btn btn-success mb-1" role="button">Talepler</a>
				<a href="index.php?menuGon=5" class="btn btn-success mb-1" role="button">Çıkış Yap</a>
			</div>
		</div>
			<?php
				if($_SESSION["menuId"]==1)
				{
					echo binaDurum();
					if($_SESSION["binaDurumId"]>0 && $_SESSION["binaDurumId"]<6)
					{
						echo "<div class=\"col-6\">";
						echo grafikCiz();
							echo "<div id=\"piechart\"></div>";
						echo "</div>";
					}
				}
			
				if($_SESSION["menuId"]==2)
				{
					echo "<div class=\"col-2\"></div>";
					echo "<div class=\"col-8 text-center\">";
			?>
						<select id="1" class="form-control" onchange="git(this)">
							<option value="0" selected>Bölüm Seçiniz... </option>
							<?php
								$sqlBolum="SELECT * FROM bolumler;";
								$sorguBolum=mysql_query($sqlBolum,$baglanti);
								while($sonucBolum=mysql_fetch_array($sorguBolum))
								{
									if($sonucBolum[id]==$_SESSION["bolumId"])
										echo "<option value=\"$sonucBolum[id]\" selected=\"\">$sonucBolum[adi]</option>";
									else
										echo "<option value=\"$sonucBolum[id]\">$sonucBolum[adi]</option>";
								}
							?>
						</select>
						<?php
							if($_SESSION["bolumId"]>0)
							{
						?>
							<select id="2" class="form-control" onchange="git2(this)">
								<option value="0" selected="">Dönem Seçiniz...</option>
								<?php
									for($i=1;$i<9;$i++)
									{
										if($i==$_SESSION[donemId])
											echo "<option value=$i selected=\"\">$i</option>";
										else
											echo "<option value=$i>$i</option>";
									}
								?>
							</select>
						<?php
							}
						
							if($_SESSION["bolumId"]>0 && $_SESSION["donemId"])
							{
						?>
							<select id="3" class="form-control" onchange="git3(this)">
								<option value="0" selected="">Ders Seçiniz...</option>
								<?php
									$sqlDersler="SELECT * FROM dersler WHERE bolum_id='$_SESSION[bolumId]' AND donem_id='$_SESSION[donemId]';";
									$sorguDersler=mysql_query($sqlDersler,$baglanti);
									while($sonucDersler=mysql_fetch_array($sorguDersler))
									{
										if($sonucDersler[id]==$_SESSION["dersId"])
											echo "<option value=\"$sonucDersler[id]\" selected=\"\">$sonucDersler[adi]</option>";
										else
											echo "<option value=\"$sonucDersler[id]\">$sonucDersler[adi]</option>";
									}
								?>
							</select>
							
						<?php
							}
							
							if($_SESSION["bolumId"]>0 && $_SESSION["dersId"] && $_SESSION["donemId"]>0)
							{
						?>
							<select id="4" class="form-control" onchange="git4(this)">
								<option value="0" selected="">Bina Seçiniz...</option>
								<?php
									$sqlBina="SELECT * FROM binalar;";
									$sorguBina=mysql_query($sqlBina,$baglanti);
									while($sonucBina=mysql_fetch_array($sorguBina))
									{
										if($sonucBina[id]==$_SESSION["binaId"])
											echo "<option value=\"$sonucBina[id]\" selected=\"\">$sonucBina[adi]</option>";
										else
											echo "<option value=\"$sonucBina[id]\">$sonucBina[adi]</option>";
									}
								?>
							</select>
						<?php
							}
							
							if($_SESSION["bolumId"]>0 && $_SESSION["dersId"] && $_SESSION["donemId"]>0 && $_SESSION["binaId"]>0)
							{
						?>
								<select id="5" class="form-control" onchange="git5(this)">
									<option value="0" selected="">Sınıf Seçiniz...</option>
									<?php
										$sqlSinif="SELECT * FROM siniflar WHERE bina_id='$_SESSION[binaId]'";
										$sorguSinif=mysql_query($sqlSinif,$baglanti);
										while($sonucSinif=mysql_fetch_array($sorguSinif))
										{
											if($sonucSinif[id]==$_SESSION["sinifId"])
												echo "<option value=\"$sonucSinif[id]\" selected=\"\">$sonucSinif[adi]</option>";
											else
												echo "<option value=\"$sonucSinif[id]\">$sonucSinif[adi]</option>";
										}
									?>
								</select>
						<?php
							}
							if($_SESSION["bolumId"]>0 && $_SESSION["dersId"] && $_SESSION["donemId"]>0 && $_SESSION["binaId"]>0 && $_SESSION["sinifId"]>0)
							{
								include("table.php");
							}
					echo "</div>";
					echo "<div class=\"col-2\"></div>";
				}
				
				if($_SESSION["menuId"]==3)
				{
					echo modlar();
					
					if($_SESSION["modEkrani"]==1)
					{
						if($_SESSION["modDurum"]==1)
						{
							echo "<div class=\"col-sm-3 col-md-6\">";
								echo "<p class=\"text-center font-weight-bold text-success mt-3\">Kullanıcı Başarıyla Eklendi</p>";
							echo "</div>";
						}
						else if($_SESSION["modDurum"]==2)
						{
							echo "<div class=\"col-sm-3 col-md-6\">";
								echo "<p class=\"text-center font-weight-bold text-danger mt-3\">Eksik veya hatalı veri girdiniz!!!</p>";
							echo "</div>";
						}
						else
						{
							echo "<div class=\"col-sm-3 col-lg-8 px-lg-5 text-center\">";
							echo "<p class=\"text-center font-weight-bold text-danger mt-3\">Aynı binadan sorumlu başka \"Moderatör\" varsa; son eklenen geçerli olacaktır!</p>";
								echo "<form method=\"POST\" action=\"modEkle.php\">";
									echo "<div class=\"col-sm-3 col-md-9 form-group mx-lg-3 mt-lg-2 px-5\">";
										echo "<input type=\"text\" class=\"form-control\" name=\"user\" placeholder=\"Kullanıcı Adı\">";
										echo "<input type=\"password\" class=\"form-control my-1\" name=\"pass\" placeholder=\"Şifre\">";
										echo "<select id=\"6\" class=\"form-control\" name=\"build\">";
											echo "<option value=\"0\">Admin Ekleyecekseniz Değiştirmeyiniz!</option>";
											echo "<option value=\"1\">Hasan Ali Yücel Binası</option>";
											echo "<option value=\"2\">Sosyal Bilimler Binası</option>";
											echo "<option value=\"3\">Fen Bilimleri Binası</option>";
											echo "<option value=\"4\">Resim-İş Binası</option>";
											echo "<option value=\"5\">Cahit Arf Binası</option>";
										echo "</select>";
										echo "<label class=\"radio-inline\">";
											echo "<input type=\"radio\" name=\"rank\" value=\"0\">Admin";
										echo "</label>";
										echo "<label class=\"radio-inline\">";
											echo "<input type=\"radio\" name=\"rank\" value=\"1\">Moderatör";
										echo "</label><br>";
										echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Ekle\">";
									echo "</div>";
								echo "</form>";
							echo "</div>";
						}
					}
					if($_SESSION["modEkrani"]==2)
					{
						$sqlModGoruntule="SELECT kullanicilar.k_adi, kullanicilar.id, binalar.adi FROM kullanicilar,binalar WHERE binalar.mod_id=kullanicilar.id;";
						$sorguModGoruntule=mysql_query($sqlModGoruntule,$baglanti);
						$sqlModGoruntule2="SELECT * FROM kullanicilar WHERE rutbe=0;";
						$sorguModGoruntule2=mysql_query($sqlModGoruntule2,$baglanti);
							
						echo "<div class=\"col-sm-3 col-md-6 text-center\" role=\"group\">";
						echo "<p class=\"text-center font-weight-bold text-danger\">Silmek İstediğiniz Kişinin İsmine Tıklayınız.</p>";
						echo "<div class=\"btn-group-horizontal\" role=\"group\">";
							while($sonucModGoruntule2=mysql_fetch_array($sorguModGoruntule2))
							{
								echo "<a href=\"modSil.php?silinen=$sonucModGoruntule2[id]\" class=\"btn my-2 mx-2 btn-outline-primary text-capitalize\" role=\"button\">$sonucModGoruntule2[k_adi]<br>(Admin)</a>";
							}
							while($sonucModGoruntule=mysql_fetch_array($sorguModGoruntule))
							{
								echo "<a href=\"modSil.php?silinen=$sonucModGoruntule[id]\" class=\"btn my-2 mx-2 btn-outline-primary text-capitalize\" role=\"button\">$sonucModGoruntule[k_adi]<br>$sonucModGoruntule[adi]</a>";
							}
						echo "</div>";
						echo "</div>";
					}
				}
				
				if($_SESSION["menuId"]==5)
				{
					include("logout.php");
				}
			?>
		</div>
	</div>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script language="JavaScript">
		function git(a)
		{
			window.location="index.php?menuGon=2&bolum="+a.value;
		}
		function git2(b)
		{
			var a=document.getElementById("1").value;
			window.location="index.php?menuGon=2&bolum="+a+"&donem="+b.value;
		}
		function git3(c)
		{
			var a = document.getElementById("1").value;
			var b = document.getElementById("2").value;
			window.location="index.php?menuGon=2&bolum="+a+"&donem="+b+"&ders="+c.value;
		}
		function git4(d)
		{
			var a = document.getElementById("1").value;
			var b = document.getElementById("2").value;
			var c = document.getElementById("3").value;
			window.location="index.php?menuGon=2&bolum="+a+"&donem="+b+"&ders="+c+"&bina="+d.value;
		}
		function git5(e)
		{
			var a = document.getElementById("1").value;
			var b = document.getElementById("2").value;
			var c = document.getElementById("3").value;
			var d = document.getElementById("4").value;
			window.location="index.php?menuGon=2&bolum="+a+"&donem="+b+"&ders="+c+"&bina="+d+"&sinif="+e.value;
		}
	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
<?php
ob_end_flush();
?>
</html>