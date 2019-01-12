<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
    
    
if(isset($_GET['geldi']))
      {
    
            date_default_timezone_set('Europe/Istanbul');
            $teslimtarihi=date( 'Y-m-d h:i:s A', time () );
              mysqli_query($con,"update kitapgecmisi set durum='1', teslimTarihi='$teslimtarihi' where id = '".$_GET['no']."'");
                  $_SESSION['msg']="Kitap teslim edildi olarak işaretlendi!";
      }


    
    
    
    
    
    

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yönetici Paneli - Kütüphane Otomasyon Sistemi</title>

    <!-- Bootstrap core CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="anasayfa.php">Kütüphane Otomasyonu</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
  
      <!-- Navbar -->
      <?php include('gereksinim/ustcubuk.php');?>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php include('gereksinim/kenarcubuk.php');?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Öğrenci Paneli</a>
            </li>
            <li class="breadcrumb-item active">Kayıt Geçmişi</li>
          </ol>

          <!-- Page Content -->
          <h1>Kayıt Geçmişi</h1>
          <hr>
            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
          <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Teslim Edilmemiş Kitaplar
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Öğrenci Adı</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Kitap Adı</th>
                                            <th>Kategorisi</th>
                                            <th>Kayıt Tarihi</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select kitapgecmisi.id as kayitid, kitap.kitapAdi as kitapadi,kategori.kategoriAdi as kategoriadi, kitapgecmisi.kayitTarihi as kayittarihi, ogrenciler.ogrenciAdi as ogrenciadi,ogrenciler.ogrenciNo as ogrencino, kitapgecmisi.durum as durumu from kitapgecmisi join kitap on kitap.id=kitapgecmisi.kitap join kategori on kategori.id=kitap.kategoriid join ogrenciler on ogrenciler.ogrenciNo=kitapgecmisi.ogrenciNo where kitapgecmisi.durum='0'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                              <td><?php echo htmlentities($row['ogrenciadi']);?></td>
                                            <td><?php echo htmlentities($row['ogrencino']);?></td>
                                            <td><?php echo htmlentities($row['kitapadi']);?></td>
                                            <td><?php echo htmlentities($row['kategoriadi']);?></td>
                                             <td><?php echo htmlentities($row['kayittarihi']);?></td>
                                            <td>
<a href="kayitgecmisi.php?no=<?php echo $row['kayitid']?>&geldi=durum" onClick="return confirm('Kitabı teslim edildi olarak kaydetmek istediğinize emin misiniz?')">
<button type="submit" name="submit" id="submit" class="btn btn-info">Kitap Teslim</button>
</a>
                                            </td>
                                         
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>
            <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Teslim Edilmiş Kitaplar
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Öğrenci Adı</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Kitap Adı</th>
                                            <th>Kategorisi</th>
                                            <th>Kayıt Tarihi</th>
                                            <th>Teslim Tarihi</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select kitapgecmisi.id as kayitid, kitap.kitapAdi as kitapadi,kategori.kategoriAdi as kategoriadi, kitapgecmisi.kayitTarihi as kayittarihi, ogrenciler.ogrenciAdi as ogrenciadi,ogrenciler.ogrenciNo as ogrencino, kitapgecmisi.teslimTarihi as teslimtarihi from kitapgecmisi join kitap on kitap.id=kitapgecmisi.kitap join kategori on kategori.id=kitap.kategoriid join ogrenciler on ogrenciler.ogrenciNo=kitapgecmisi.ogrenciNo where kitapgecmisi.durum='1'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                              <td><?php echo htmlentities($row['ogrenciadi']);?></td>
                                            <td><?php echo htmlentities($row['ogrencino']);?></td>
                                            <td><?php echo htmlentities($row['kitapadi']);?></td>
                                            <td><?php echo htmlentities($row['kategoriadi']);?></td>
                                             <td><?php echo htmlentities($row['kayittarihi']);?></td>
                                            <td><?php echo htmlentities($row['teslimtarihi']);?></td>
                                            <td>
<a href="kayitgecmisi.php?no=<?php echo $row['kayitid']?>&geldi=durum" onClick="return confirm('Kitabı teslim edildi olarak kaydetmek istediğinize emin misiniz?')">
<button type="submit" name="submit" id="submit" class="btn btn-info" disabled>Kitap Teslim</button>
</a>
                                            </td>
                                         
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>
            
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include('gereksinim/altyazi.php');?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('gereksinim/cikisuyari.php');?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
      


    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>