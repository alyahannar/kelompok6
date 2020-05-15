<?php

    switch ($_GET['act']) {
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=penjualan&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan</th>
                        <th>Nama Produk</th>
                        <th>Stok Produk</th>
                        <th>Harga Produk</th>
                        <th>Jumlah Pembelian(Item)</th>
                        <th>Total Penjualan</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_penjualan r join t_produk p 
                    on (p.id_produk=r.id_produk)  order by id_penjualan asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>

                        <?php 
                        $tanggal_penjualan=tgl_indo($r['tanggal_penjualan']);?>
                        
                        <td><?php echo "$tanggal_penjualan"?></td>
                        <td><?php echo "$r[nama_produk]"?></td>
                        <td><?php echo "$r[stok_produk]"?></td>
                        <td><?php echo "Rp.". number_format("$r[harga_produk]",'0','.','.')?></td>
                        <td><?php echo "$r[item_terjual]"?></td>
                        <td><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                        <td><a href="?pg=penjualan&act=delete&id=<?php echo $r['id_penjualan']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>

                    <?php
                    $no++;
                    }
                    ?>
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
      case 'add':
      if (isset($_POST['add'])) {

        $ambilProduk = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from t_produk where id_produk = '$_POST[id_produk]'"));

        $total_penjualan = $_POST[item_terjual] * $ambilProduk[harga_produk];
        $sisaStok = $ambilProduk[stok_produk] - $_POST[item_terjual];

        if ($_POST[item_terjual] > $ambilProduk[stok_produk]){
          echo "<SCRIPT language=Javascript>
          alert('Maaf Stok Produk yang tersedia tidak mencukupi, Silahkan Ulangi Pengisian Form Penjualan')
          </script>
          <script>window.location='?pg=penjualan&act=add'</script>";
        } else {

                $query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO t_penjualan VALUES ('$_POST[id_penjualan]',
                '$_POST[tanggal_penjualan]','$_POST[id_produk]',
                '$_POST[item_terjual]','$total_penjualan')");

                mysqli_query($GLOBALS["___mysqli_ston"], "update t_produk set stok_produk = '$sisaStok'
                             where id_produk = '$_POST[id_produk]'");
                echo "<script>window.alert('Data Berhasil Di Simpan')
				window.location='?pg=penjualan&act=view'</script>";
              }
            }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Penjualan </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=penjualan&act=view">Data Penjualan</a></li>
            <li class="active"><a href="#">Tambah Data Penjualan</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <?php
                      $sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from t_penjualan");
                      
                      $num = mysqli_num_rows($sql);
                      
                      if($num <> 0)
                      {
                      $kode = $num + 1;
                      }else
                      {
                      $kode = 1;
                      }
                      
                      $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                      $tahun = date('Ym');
                      $kode_jadi = "PJLN$tahun$bikin_kode";

                      ?>
                      <label for="exampleInputEmail1">Nomor Penjualan</label>
                      <input type="text" class="form-control" id="nopenj" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong" disabled>
                      <input type="hidden" class="form-control" id="id_penjualan" name="id_penjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Penjualan</label>
                      <input class="form-control" id="date" name="tanggal_penjualan" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Produk</label> <br>
                      <select class="form-control select2" name="id_produk" style="width: 100%;">
                      <option value="">--- Silahkan Pilih ---</option>
                      <optgroup label="--- Nama Produk ---">
                      <?php
                      $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_produk ORDER BY id_produk");
                      while($r=mysqli_fetch_array($tampil)){
                      ?>
                      <option value="<?php echo $r['id_produk']?>"><?php echo $r['nama_produk'] ?></option>
                      <?php
                    }
                    ?>
                    </optgroup>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Pembelian</label>
                      <input type="number" class="form-control" id="item_terjual" name="item_terjual" placeholder="Jumlah Pembelian" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name ='add' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


      <?php
      break;
      case 'delete':
      $ambilProduk = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from t_penjualan r
        join t_produk p on (r.id_produk=p.id_produk) where id_penjualan='$_GET[id]'"));

      $stokproduk = $ambilProduk[item_terjual] + $ambilProduk[stok_produk];

      mysqli_query($GLOBALS["___mysqli_ston"], "update t_produk set stok_produk = '$stokproduk'
                    where id_produk = '$ambilProduk[id_produk]'");

      mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM t_penjualan WHERE id_penjualan='$_GET[id]'");
      echo "<script>window.alert('Data Berhasil Di Hapus')
	  window.location='?pg=penjualan&act=view'</script>";
	  
      break;

    }
    ?>
    