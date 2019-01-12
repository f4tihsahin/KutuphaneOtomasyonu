<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$ogrenciadi=$_POST['ogrenciadi'];
$ogrencino=$_POST['ogrencino'];
$parola=md5($_POST['parola']);
$pinkodu = rand(100000,999999);
$ret=mysqli_query($con,"insert into ogrenciler(ogrenciAdi,ogrenciNo,parola,pinKodu) values('$ogrenciadi','$ogrencino','$parola','$pinkodu')");
if($ret)
{
$_SESSION['msg']="Öğrenci Başarıyla Kaydedildi!";
}
else
{
  $_SESSION['msg']="Hata! Öğrenci Kayıt Edilemedi.";
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
            <li class="breadcrumb-item active">Öğrenci Kayıt</li>
          </ol>

          <!-- Page Content -->
          <h1>Öğrenci Kayıt</h1>
          <hr>
          
            
            
            
            
            
            <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="ogrenciadi">Öğrenci Adı</label>
    <input type="text" class="form-control" id="ogrenciadi" name="ogrenciadi" placeholder="Öğrencinin adını girin" required />
  </div>

 <div class="form-group">
    <label for="ogrencino">Öğrenci Numarası</label>
    <input type="text" class="form-control" id="ogrencino" name="ogrencino" onBlur="userAvailability()" placeholder="Öğrenci numarasını girin" required />
     <span id="user-availability-status1" style="font-size:12px;"></span>
  </div>



<div class="form-group">
    <label for="parola">Parola</label>
    <input type="password" class="form-control" id="parola" name="parola" placeholder="Öğrencinin parolasını girin" required />
  </div>   

 <button type="submit" name="submit" id="submit" class="btn btn-info">Kaydet</button>
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
      

      <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "kontrol.php",
data:'regno='+$("#ogrencino").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
      
      
    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>