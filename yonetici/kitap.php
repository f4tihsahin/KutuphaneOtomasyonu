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
$kategoriid=$_POST['kategoriid'];
$kitapAdi=$_POST['kitapadi'];
$yazar=$_POST['yazar'];
$stok=$_POST['stok'];
$ret=mysqli_query($con,"insert into kitap(kategoriid,kitapAdi,yazar,stok) values('$kategoriid','$kitapAdi','$yazar','$stok')");
if($ret)
{
$_SESSION['msg']="Kitap Başarıyla Eklendi.";
}
else
{
  $_SESSION['msg']="Hata! Kitap Eklenirken Bir Hata Oluştu.";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from kitap where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Kitap silindi!";
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
            <li class="breadcrumb-item active">Kitap Kayıt</li>
          </ol>

          <!-- Page Content -->
          <h1>Kitap Kayıt</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                       
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
    <div class="form-group">
    <label for="Department">Kategori</label>
  </div>
    <select class="form-control" name="kategoriid" required="required">
   <option value="">Kitabı Eklemek İstediğiniz Kategoriyi Seçiniz.</option>   
   <?php 
$sql=mysqli_query($con,"select * from kategori");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['kategoriAdi']);?></option>
<?php } ?>

    </select>
   <div class="form-group">
    <label for="kitapadi">Kitap Adı</label>
    <input type="text" class="form-control" id="kitapadi" name="kitapadi" placeholder="" required />
  </div>
    <div class="form-group">
    <label for="kitapadi">Yazarı</label>
    <input type="text" class="form-control" id="yazar" name="yazar" placeholder="" required />
  </div>
    <div class="form-group">
    <label for="stok">Stok Miktarı</label>
    <input type="text" class="form-control" id="stok" name="stok" placeholder="" required />
  </div>

 <button type="submit" name="submit" class="btn btn-info">Kaydet</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
            
            <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kitapları Yönet
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Kitap Adı</th>
                                            <th>Yazarı</th>
                                            <th>Kategori</th>
                                            <th>Stok Miktarı</th>
                                             <th>Eklenme Tarihi</th>
                                             <th>Eylem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select *, kitap.id kitapID from kitap left join kategori on kitap.kategoriid=kategori.id left join kitapgecmisi on kitap.id=kitapgecmisi.kitap");
#$bolumtablosu=mysqli_query($con,"select * from bolum");
#$bolumtab=mysqli_fetch_array($bolumtablosu);
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['kitapAdi']);?></td>
                                            <td><?php echo htmlentities($row['yazar']);?></td>
                                            <td><?php echo htmlentities($row['kategoriAdi']);?></td>
                                            <td><?php echo htmlentities($row['stok']);?></td>
                                            <td><?php echo htmlentities($row['eklemeTarihi']);?></td>
                                            <td>
                                            <a href="kitapduzenle.php?id=<?php echo $row['kitapID']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i>Düzenle</button> </a>                                        
  <a href="kitap.php?id=<?php echo $row['kitapID']?>&del=delete" onClick="return confirm('Kitabı silmek istediğinize emin misiniz?')">
                                            <button class="btn btn-danger">Sil</button>
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