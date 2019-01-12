<?php
session_start();
$_SESSION['alogin']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="Başarıyla çıkış yaptınız.";
?>
<script language="javascript">
document.location="index.php";
</script>
