<?php
  session_start();
  session_destroy();
   echo "<SCRIPT language=Javascript>
  alert('Anda Telah Keluar dari Manager. Terimakasih')
  </script>
  <meta http-equiv='refresh' content='0; url=../index.php'/>";

?>
