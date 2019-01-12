<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$id=intval($_GET['id']);
date_default_timezone_set('Europe/Istanbul');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$kategoriid=$_POST['kategoriid'];
$kitapAdi=$_POST['kitapadi'];
$yazar=$_POST['yazar'];
$stok=$_POST['stok'];
$ret=mysqli_query($con,"update kitap set kategoriid='$kategoriid',kitapAdi='$kitapAdi',yazar='$yazar',stok='$stok',guncellemeTarihi='$currentTime' where id='$id'");
if($ret)
{
$_SESSION['msg']="Kitap Başarıyla Güncellendi!";
}
else
{
  $_SESSION['msg']="Hata: Kitap Güncellenemedi!";
}
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

      <a class="navbar-brand mr-1" href="anasayfa.php">Kütüphane Otomasyon Sistemi</a>

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
              <a href="index.html">Yönetici Paneli</a>
            </li>
            <li class="breadcrumb-item active">Kitap Düzenle</li>
          </ol>

          <!-- Page Content -->
          <h1>Kitap Düzenle</h1>
          <hr>
          
            <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select * from kitap where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>Son Güncelleme</b> :<?php echo htmlentities($row['guncellemeTarihi']);?></p>
   <select class="form-control" name="kategoriid" required="required">
   <option value="">Kitabı Eklemek İstediğiniz Kategoriyi Seçiniz.</option>   
   <?php 
$kat=mysqli_query($con,"select * from kategori");
while($kategoriler=mysqli_fetch_array($kat))
{
?>
<option value="<?php echo htmlentities($kategoriler['id']);?>"><?php echo htmlentities($kategoriler['kategoriAdi']);?></option>
<?php } ?>

    </select>
   <div class="form-group">
    <label for="kitapadi">Kitap Adı</label>
    <input type="text" class="form-control" id="kitapadi" name="kitapadi" placeholder="" value="<?php echo htmlentities($row['kitapAdi']);?>" required />
  </div>
    <div class="form-group">
    <label for="stok">Yazarı</label>
    <input type="text" class="form-control" id="yazar" name="yazar" placeholder="" value="<?php echo htmlentities($row['yazar']);?>" required />
  </div>
    <div class="form-group">
    <label for="stok">Stok Miktarı</label>
    <input type="text" class="form-control" id="stok" name="stok" placeholder="" value="<?php echo htmlentities($row['stok']);?>" required />
  </div> 


<?php } ?>
 <button type="submit" name="submit" class="btn btn-info"><i class=" fa fa-refresh "></i> Update</button>
</form>
                            </div>
                            </div>
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