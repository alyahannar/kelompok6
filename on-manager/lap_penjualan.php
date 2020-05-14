<?php
switch ($_GET['act']) {
      
  // PROSES VIEW DATA LAPORAN PENJUALAN //      
      
   case 'view':
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Laporan Penjualan</a></li>
             </ol>
        </section>

<section class="content">
  <div class="row">
  <div class="col-md-5">
  <form action="?pg=lappj&act=cek" method="POST">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
      <input class="form-control" id="date" name="tanggal_penjualanawal" placeholder="MM/DD/YYY" type="text" required/>
      </div>
  </div>
  <div class="col-md-5">
      <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
      <input class="form-control" id="date" name="tanggal_penjualanakhir" placeholder="MM/DD/YYY" type="text" required/>
      </div>
  </div>
  
  <div class="col-md-2">
      <div class="form-group">
      <label for="exampleInputEmail1">Mulai Pencarian</label><br>
      <input type="submit" value="Pencarian" class="btn btn-info">
      </div>
  </div>
  </form>

  <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No Penjualan</th>
                        <th>Tanggal Penjualan</th>
                        <th>Nama Produk</th>
                        <th>Stok Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Item Terjual</th>
                        <th>Total Penjualan</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                    <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                    
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[harga_produk],-"?></td>
                    <td><span style="font-weight:bold"><?php echo "Rp.$liatHarga[isv_sales],-"?></td>
                    </tr>
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<?php
break;

  case 'cek':
  // menampilkan pertanyaan pertama
  $sqlp = "SELECT * FROM t_penjualan r
          JOIN t_produk p ON ( r.id_produk = p.id_produk) where
          tanggal_penjualan BETWEEN  '$_POST[tanggal_penjualanawal]' AND  '$_POST[tanggal_penjualanakhir]'
          ORDER BY id_penjualan ASC";

  $rs=mysqli_query($GLOBALS["___mysqli_ston"], $sqlp);
  $data=mysqli_fetch_array($rs);

  if (!(empty($data))){
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Laporan Penjualan</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> Laporan Penjualan</a></li>
             </ol>
        </section>

    <section class="content">
      <div class="row">
      <div class="col-md-5">
      <form action="?pg=lappj&act=cek" method="POST">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Awal</label>
          <input class="form-control" id="date" name="tanggal_penjualanawal" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-5">
          <div class="form-group">
          <label for="exampleInputEmail1">Tanggal Penjualan Akhir</label>
          <input class="form-control" id="date" name="tanggal_penjualanakhir" placeholder="MM/DD/YYY" type="text" required/>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
          <label for="exampleInputEmail1">Mulai Pencarian</label><br>
          <input type="submit" value="Pencarian" class="btn bg-orange">
          </div>
      </div>
      </form>

      <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-info">
                      <div class="box-body">
                      <div class="table-responsive">
                      <table class="table table-hover responsive">
                        <thead>
                          <tr>
                            <th>No Penjualan</th>
                            <th>Tanggal Penjualan</th>
                            <th>Nama Produk</th>
                            <th>Stok Produk</th>
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
                            <td><?php echo "$r[id_penjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tanggal_penjualan']);?>
                            
                            <center><td><?php echo "$tglpenjualan"?></td></center>
                            <center><td><?php echo "$r[nama_produk]"?></td></center>
                            <center><td><?php echo "$r[stok_produk]"?></td></center>
                            <center><td><?php echo "$r[item_terjual]"?></td></center>
                            <center><td><?php echo "Rp.". number_format("$r[harga_produk]",'0','.','.')?></td></center>
                            <center><td><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td></center>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="4"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(total_penjualan) as total_penjualan, 
                        sum(harga_produk) as harga_produk, sum(item_terjual) as item_terjual FROM t_penjualan r  
                        join t_produk p on (r.id_produk=p.id_produk)
                        where 
                        tanggal_penjualan BETWEEN '$_POST[tanggal_penjualanawal]' 
                        AND  '$_POST[tanggal_penjualanakhir]' ORDER BY id_penjualan ASC"));
                        ?>
						
                        <center><td><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[item_terjual]",'0','.','.')?></td></center>
                        <center><td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td></center>
                        <center><td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td></center>
                        </tr>
                        </tbody>
                      </table>
                      </div><!-- /.box-body -->
                  </div>
                  </div><!-- /.box -->
                  </div> <!-- /.col -->
      </div>
        <!-- /.row (main row) -->

      <div class="row">
              <div class="col-md-4">
              <form role="form" action="cetak_pdf.php" method="POST" target="_blank">
              <div class="box-body">
                  <div class="form-group">
                  <button type="submit" class="btn btn-danger">
                  <i class="fa fa-file-pdf-o">Simpan ke PDF</i>  
                  </button>
                  </div>

                  <div class="form-group">
                  <input type="hidden" class="form-control" id="date" name="tanggal_penjualanawal" placeholder="Nama Konsumen" value= "<?php echo $_POST['tanggal_penjualanawal']?>">
                  <input type="hidden" class="form-control" id="date" name="tanggal_penjualanakhir" placeholder="Nama Konsumen" value= "<?php echo $_POST['tanggal_penjualanakhir']?>">
                  </div>
              </div>
              </form>
          </div>
          </div>

    </section> <!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->

<?php
} else { 
  ?>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1> Silahkan pilih</h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="?pg=lappj&act=view"><i class="fa fa-dashboard"></i> laporan Penjualan</a></li>
             </ol>
      </section>

      <section class="content">
          <div class="box box-success">
              <div class="box-body">
                  <div class="form-group">
                  <?php
                  echo " <p> Maaf untuk pencarian yang anda cari tidak tersedia. <br>
                  Silahkan coba lakukan pencarian ulang. Terima Kasih </p>";
                  
                  ?>
                  </div>
              </div>
          </div>
      </section> <!-- /.content -->
    </div> <!-- /.container -->
  </div> <!-- /.content-wrapper -->

  <?php
  }
  ?>

<?php
break;
}
?>