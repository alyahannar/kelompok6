<?php
$nama_dokumen='Laporan Penjualan Toko'; //Beri nama file PDF hasil.
define('_MPDF_PATH','koneksi/mpdf60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

ob_start();

?>
<table border='0' align='LEFT'>
<tr>
<th width="900px">
<h1>  LAPORAN PENJUALAN  <br> Toko Sembako</h1> </br>

</th>
</tr>
</table>
<hr style="height:3px;" />



<?php
error_reporting(0);
include "koneksi/koneksi.php";
include "koneksi/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tanggal_penjualanawal];
$tglpenjualanak = $_POST[tanggal_penjualanakhir];
?>

<p style="text-align:left;"> Periode <?php echo tgl_indo($tglpenjualanaw)?> s/d <?php echo tgl_indo($tglpenjualanak) ?> </p>

<table cellspacing="5" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No Penjualan</th>
                            <th width="20%">Tanggal Penjualan</th>
                            <th width="20%">Nama Produk</th>
                            <th width="20%">Stok Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_penjualan r
                        JOIN t_produk p ON ( r.id_produk = p.id_produk) where
                        tanggal_penjualan BETWEEN  '$_POST[tanggal_penjualanawal]' AND  '$_POST[tanggal_penjualanakhir]'
                        ORDER BY id_penjualan ASC");
                        $no = 1;
                          while ($r=mysqli_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td align="center"><?php echo "$r[id_penjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tanggal_penjualan']);?>
                            
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[stok_produk]"?></td>
                            <td align="center"><?php echo "$r[item_terjual]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga_produk]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(total_penjualan) as total_penjualan, 
                        sum(harga_produk) as harga_produk, sum(item_terjual) as item_terjual  FROM t_penjualan r  
                        join t_produk p on (r.id_produk=p.id_produk)
                        where 
                        tanggal_penjualan BETWEEN '$_POST[tanggal_penjualanawal]' 
                        AND  '$_POST[tanggal_penjualanakhir]' ORDER BY id_penjualan ASC"));
                        ?>

                      <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[item_terjual]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                      
                      <br> <br>
                      <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 460px;"> Malang, <?php echo "$tanggal"?>
                      <br><br></p>
                     <p style="margin: 50px 8px 5px 510px;"> MANAGER </p>

<?php

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>