<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$ogrenciadi=$_POST['ogrenciadi'];
$akts=$_POST['akts'];
$ret=mysqli_query($con,"update ogrenciler set ogrenciAdi='$ogrenciadi' where ogrenciNo='".$_SESSION['login']."'");
if($ret)
{
$_SESSION['msg']="Bilgileriniz Başarıyla Güncellendi!";
}
else
{
  $_SESSION['msg']="Hata: Bilgi Güncelleme Başarısız!";
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

    <title>Kütühane Otomasyonu</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="anasayfa.php">Kütühane Otomasyonu</a>

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
            <li class="breadcrumb-item active">Bilgilerim</li>
          </ol>

          <!-- Page Content -->
          <h1>Bilgilerim</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                       
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<?php $sql=mysqli_query($con,"select * from ogrenciler where ogrenciNo='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="ogrenciadi">Adı</label>
    <input type="text" class="form-control" id="ogrenciadi" name="ogrenciadi" value="<?php echo htmlentities($row['ogrenciAdi']);?>"  />
  </div>

 <div class="form-group">
    <label for="ogrencinumarasi">Numarası</label>
    <input type="text" class="form-control" id="ogrencinumarasi" name="ogrencinumarasi" value="<?php echo htmlentities($row['ogrenciNo']);?>"  placeholder="Student Reg no" readonly />
    
  </div>



<div class="form-group">
    <label for="Pincode">PIN Kodu</label>
    <input type="text" class="form-control" id="Pincode" name="Pincode" readonly value="<?php echo htmlentities($row['pinKodu']);?>" required />
  </div>   

<div class="form-group">
    <label for="AKTS">AKTS</label>
    <input type="text" class="form-control" id="akts" name="akts" readonly value="<?php echo htmlentities($row['akts']);?>" required />
  </div>  


  <?php } ?>

 <button type="submit" name="submit" id="submit" class="btn btn-info">Güncelle</button>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>