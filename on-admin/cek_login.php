<?php
error_reporting(0);

include "koneksi/koneksi.php";
$pass=md5($_POST[pass]);

$login=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM admin WHERE username='$_POST[username]' AND password='$pass'and status ='Y'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

if ($ketemu > 0){
  session_start();
  
  ("username");
  ("password");
  ("status");
  ("id_level");

  $_SESSION[username]     = $r[username];
  $_SESSION[password]     = $r[password];
  $_SESSION[status]       = $r[status];
  $_SESSION[id_level]     = $r[id_level];
  
  
  header('location:home.php');
}
else{
  echo "<SCRIPT language=Javascript>
  alert('Login Anda Gagal,  username dan password tidak valid. Silahkan Hubungi Admin')
  </script>";
  echo "
  <meta http-equiv='refresh' content='0; url=../index.php'/>";
}
?>
