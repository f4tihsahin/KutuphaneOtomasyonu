<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0 or strlen($_SESSION['pcode'])==0)
    {   
header('location:login.php');
}
else{

if(isset($_POST['submit']))
{
$ogrencino=$_POST['ogrencino'];
$pinKodu=$_POST['pinKodu'];
$kitap=$_POST['kitap'];
    $durum=0;
$ret=mysqli_query($con,"insert into kitapgecmisi(ogrenciNo,pinKodu,kitap,durum) values('$ogrencino','$pinKodu','$kitap','$durum')");
if($ret)
{
$_SESSION['msg']="Kayıt Başarılı!";
}
else
{
  $_SESSION['hatamsg']="Kayıt Başarısız! Lütfen Yeniden Deneyin.";
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

    <title>Öğrenci Paneli - Kütüphane Otomasyon Sistemi</title>

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
              <a href="index.html">Öğrenci Paneli</a>
            </li>
            <li class="breadcrumb-item active">Kitap Al</li>
          </ol>

          <!-- Page Content -->
          <h1>Kitap Al</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<font color="red" align="center"><?php echo htmlentities($_SESSION['hatamsg']);?><?php echo htmlentities($_SESSION['hatamsg']="");?></font>
<?php $sql=mysqli_query($con,"select * from ogrenciler where ogrenciNo='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="studentname">Öğrenci Adı </label>
    <input type="text" class="form-control" id="ogrenciadi" name="ogrenciadi" value="<?php echo htmlentities($row['ogrenciAdi']);?>"  readonly/>
  </div>

 <div class="form-group">
    <label for="studentregno">Öğrenci No </label>
    <input type="text" class="form-control" id="ogrencino" name="ogrencino" value="<?php echo htmlentities($row['ogrenciNo']);?>"  placeholder="" readonly />
    
  </div>



<div class="form-group">
    <label for="Pincode">PIN Kodu</label>
    <input type="text" class="form-control" id="pinKodu" name="pinKodu" readonly value="<?php echo htmlentities($row['pinKodu']);?>" required />
  </div>   


 <?php } ?>





<div class="form-group">
    <label for="Department">Kategori</label>
    <select class="form-control" name="kategori" id="kategori" onBlur="kitapgetir()" required="required">
   <option value="">Kategori Seçin</option>   
   <?php 
$sql=mysqli_query($con,"select * from kategori");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['kategoriAdi']);?></option>
<?php } ?>

    </select> 
  </div>
                        
                           
                           
<div class="form-group">
    <label for="Course">Kitap</label>
    <select class="form-control" name="kitap" id="kitap" onBlur="stokkontrolu()" required="required">
   <option value="">Kitap Seçin</option> 
    </select> 
    <span id="stokkontrol" style="font-size:12px;"></span>
  </div>
                           
 


 <button type="submit" name="submit" id="submit" class="btn btn-info">Kitap Al</button>
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
      
      <script>
function kitapgetir() {
        jQuery.ajax({
            url: "kitapbul.php",
            data: {kategoriid: $("#kategori").val()},
            type: "POST",
            success:function(data){
                $("#kitap").html(data);
            },
            error:function (){alert("JQuery Hatası");}
        });
    }
function stokkontrolu() {
        jQuery.ajax({
            url: "kontrol.php",
            data: {kitapid: $("#kitap").val(), ogrno: $("#ogrencino").val()},
            type: "POST",
            success:function(data){
                $("#stokkontrol").html(data);
            },
            error:function (){alert("JQuery Hatası");}
        });
    }
</script>

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>