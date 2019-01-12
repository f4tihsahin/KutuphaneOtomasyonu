<?php 
require_once("gereksinim/baglanti.php");
if(!empty($_POST["kitapid"])) {
	$kitapid= $_POST["kitapid"];
    $ogrno= $_POST["ogrno"];
		$result =mysqli_query($con,"SELECT * FROM kitap WHERE id='$kitapid'");
    	$secilenkitap=mysqli_fetch_array($result);
        $count=$secilenkitap['stok'];
        $durum=0;
        $alinmiskitap = mysqli_query($con,"SELECT * FROM kitapgecmisi WHERE kitap='$kitapid' AND durum='$durum'");
        $alinmiskitapsayisi=mysqli_num_rows($alinmiskitap);
if($count<=$alinmiskitapsayisi)
{
echo "<span style='color:red'>Talep ettiğiniz kitap şu an stokta yok!</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
else{
	echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
if(!empty($_POST["kitapid"])) {
	$kitapid= $_POST["kitapid"];
	
		$result =mysqli_query($con,"SELECT * FROM kitapgecmisi WHERE kitap='$kitapid' AND ogrenciNo='$ogrno' AND durum='$durum'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'>Seçmek istediğiniz kitap zaten sizde!</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}

?>
