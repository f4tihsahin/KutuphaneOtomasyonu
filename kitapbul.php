<?php 
require_once("gereksinim/baglanti.php");


if(!empty($_POST["kategoriid"])) {
	$kategoriid= $_POST["kategoriid"];
		$result =mysqli_query($con,"SELECT *, kitap.id kitapID FROM kitap left join kategori on kitap.kategoriid=kategori.id where kategori.id='$kategoriid'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<option value=''>Kitap Seçin</option>";
    while($row=mysqli_fetch_array($result)){  
        echo "<option value=".$row[kitapID].">".$row[kitapAdi]."</option>";
    }
    
       
}
else{
    echo "<option value=''>Uygun Kitap Yok</option>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}

    
?>
