<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	//Sınıf özellikleri veritabanındaki verilerle karşılaştırıp 'var' veya 'yok' olarak gösteriliyor.
	$durum="";
	$durum2="";
	
	$sqlOzellik="SELECT * FROM siniflar WHERE id='$_SESSION[sinifId]';";
	$sorguOzellik=mysql_query($sqlOzellik,$baglanti);
	while($sonucOzellik=mysql_fetch_array($sorguOzellik))
		$ozellikler=split(" ",$sonucOzellik[ozellikler]);
	
	if(((int)$ozellikler[0])==0)
		$durum=" Yok";
	else if(((int)$ozellikler[0])==1)
		$durum=" Var";
	
	if(((int)$ozellikler[1])==0)
		$durum2=" Yok";
	else if(((int)$ozellikler[1])==1)
		$durum2=" Var";
	
	$i=1;
	$sqlSaat="SELECT * FROM saatler;";
	$sorguSaat=mysql_query($sqlSaat,$baglanti);
	
?>

<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<table class="col-12 table table-hover my-3 table-responsive-sm"
			<tr>
				<td colspan="7" class="text-center font-weight-bold">
					Sınıf Özellikleri
				</td>
			</tr>
			<tr>
				<td colspan="3" class="text-center font-italic">
				<?php
					echo "<small>Projeksiyon:<b>$durum</b> <br>Akıllı Tahta:<b>$durum2</b></small>";
				?>
				</td>
				<td colspan="3" class="text-center font-italic">
				<?php
					echo "<small>Kişi Sayısı(Sınav): <b>$ozellikler[2]</b> <br>Kişi Sayısı(Ders): <b>$ozellikler[3]</b></small>";
				?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Pazartesi</td>
				<td>Salı</td>
				<td>Çarşamba</td>
				<td>Perşembe</td>
				<td>Cuma</td>
			</tr>
	//Haftanın hangi gününde hangi saatlerde sınıfın müsait olduğu veritabanından çağrılıyor.
			<?php
				$sId=0;
				while($sonucSaat=mysql_fetch_array($sorguSaat))
				{
					$sId++;
					$i=1;
					echo "<tr>";
						echo "<td><small>".substr($sonucSaat[baslangic],0,5)."-".substr($sonucSaat[bitis],0,5)."</small></td>";
					if($i==1)
					{
						$sqlGunSaat="SELECT * FROM pazartesi WHERE sinif_id='$_SESSION[sinifId]' AND saat_id='$sId';";
						$sorguGunSaat=mysql_query($sqlGunSaat,$baglanti);
						while($sonucGunSaat=mysql_fetch_array($sorguGunSaat))
						{
							if($sonucGunSaat[durum]==0)
								echo "<td><b><center>Boş</center></b></td>";
							else if($sonucGunSaat[durum]==1)
								echo "<td><b><center>Dolu</center></b></td>";
							
							break;
						}
						$i++;
					}
					if($i==2)
					{
						$sqlGunSaat="SELECT * FROM sali WHERE sinif_id='$_SESSION[sinifId]' AND saat_id='$sId';";
						$sorguGunSaat=mysql_query($sqlGunSaat,$baglanti);
						while($sonucGunSaat=mysql_fetch_array($sorguGunSaat))
						{
							if($sonucGunSaat[durum]==0)
								echo "<td><b><center>Boş</center></b></td>";
							else if($sonucGunSaat[durum]==1)
								echo "<td><b><center>Dolu</center></b></td>";
							
							break;
						}
						$i++;
					}
					if($i==3)
					{
						$sqlGunSaat="SELECT * FROM carsamba WHERE sinif_id='$_SESSION[sinifId]' AND saat_id='$sId';";
						$sorguGunSaat=mysql_query($sqlGunSaat,$baglanti);
						while($sonucGunSaat=mysql_fetch_array($sorguGunSaat))
						{
							if($sonucGunSaat[durum]==0)
								echo "<td><b><center>Boş</center></b></td>";
							else if($sonucGunSaat[durum]==1)
								echo "<td><b><center>Dolu</center></b></td>";
							
							break;
						}
						$i++;
					}
					if($i==4)
					{
						$sqlGunSaat="SELECT * FROM persembe WHERE sinif_id='$_SESSION[sinifId]' AND saat_id='$sId';";
						$sorguGunSaat=mysql_query($sqlGunSaat,$baglanti);
						while($sonucGunSaat=mysql_fetch_array($sorguGunSaat))
						{
							if($sonucGunSaat[durum]==0)
								echo "<td><b><center>Boş</center></b></td>";
							else if($sonucGunSaat[durum]==1)
								echo "<td><b><center>Dolu</center></b></td>";
							
							break;
						}
						$i++;
					}
					if($i==5)
					{
						$sqlGunSaat="SELECT * FROM cuma WHERE sinif_id='$_SESSION[sinifId]' AND saat_id='$sId';";
						$sorguGunSaat=mysql_query($sqlGunSaat,$baglanti);
						while($sonucGunSaat=mysql_fetch_array($sorguGunSaat))
						{
							if($sonucGunSaat[durum]==0)
								echo "<td><b><center>Boş</center></b></td>";
							else if($sonucGunSaat[durum]==1)
								echo "<td><b><center>Dolu</center></b></td>";
							
							break;
						}
						$i++;
					}
					
					echo "</tr>";
				}
			?>
		</table>
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
