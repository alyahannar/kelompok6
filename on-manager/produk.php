<?php
error_reporting
?>

<?php
    switch ($_GET['act']) {
      
case 'view':
?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Produk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=pggna&act=view">Data Barang   
            </ol>
        </section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?pg=produk&act=add"> <button type="button" class="btn btn-info"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-info">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok Masuk</th>
                        <th>Satuan</th>
                        <th>Tgl Pemasukan</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
					
                    <tbody>
                    <?php
                    $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_produk order by id_produk asc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo "$no"?></td>
                        <td><?php echo "$r[nama_produk]"?></td>
                        <td><?php echo "Rp.". number_format("$r[harga_produk]",'0','.','.')?></td>
                        <td><?php echo "$r[stok_produk]"?></td>
                        <td><?php echo "$r[satuan]"?></td>
                        <td><?php echo "$r[tanggal_masuk]"?></td>
                        <td><a href="?pg=produk&act=edit&id=<?php echo $r['id_produk']?>"><button type="button" class="btn bg-orange"><i class="fa fa-pencil-square-o"></i></button></a></td>
                        <td><a href="?pg=produk&act=delete&id=<?php echo $r['id_produk']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i></button></a></td>
                        </tr>
		    <?php
                    $no++;
                    }
                    ?>
					
			
               </tbody>
                  </table>
                  </div>
              </div>
              </div>
              </div>
	</div>
  </section> 
    </div>
</div>
<?php
   break;
      case 'add':

    if(isset($_POST['add'])) {
    $nama_produk=$_POST['nama_produk'];
    $harga_produk=$_POST['harga_produk'];
    $stok_produk=$_POST['stok_produk'];
    $satuan=$_POST['satuan'];
    $tanggal_masuk=$_POST['tanggal_masuk'];
    
    $cek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_produk WHERE id_produk='$id_produk'"));
    if ($cek > 0){
    echo "<script>window.alert('Nama Barang yang anda masukan sudah ada')
    window.location='?pg=produk&act=view'</script>";
    }else {
    $query = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO t_produk VALUES ('','$_POST[nama_produk]',
                '$_POST[harga_produk]','$_POST[stok_produk]','$_POST[satuan]','$_POST[tanggal_masuk]')");
                
    echo "<script>window.alert('Data Berhasil Di Simpan')
    window.location='?pg=produk&act=view'</script>";
    }
    }
    ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Produk </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=produk&act=view">Data Produk</a></li>
            <li class="active"><a href="#">Tambah Data Produk</a></li>
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
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga Produk" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok Produk</label>
                      <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Stok Produk" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                      <input class="form-control" id="date" name="tanggal_masuk" placeholder="MM/DD/YYY" type="text" required data-fv-notempty-message="Tidak boleh kosong" />
                    </div>
                    
                  </div>

              </div>
              </div> 

              </div>

        
            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-info">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div>
              </div>
              </div>
  </div>
</section> 
    </div>
</div>


      <?php
      break;
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM t_produk WHERE id_produk='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE t_produk SET nama_produk='$_POST[nama_produk]',
                  harga_produk='$_POST[harga_produk]',stok_produk='$_POST[stok_produk]',satuan='$_POST[satuan]',tanggal_masuk='$_POST[tanggal_masuk]' WHERE id_produk='$_POST[id]'");
                echo "<script>window.location='?pg=produk&act=view'</script>";
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data Pengguna </h1>
            <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?pg=produk&act=view">Data Produk</a></li>
            <li class="active">Update Data Produk</li>
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
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['nama_produk'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga Produk" value= "<?php echo $d['harga_produk'];?>">
                      <input type="hidden" class="form-control" id="id" name="id" required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['id_produk'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok Produk</label>
                      <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Stok Produk" value= "<?php echo $d['stok_produk'];?>">
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan" placeholder="satuan" 
					  required data-fv-notempty-message="Tidak boleh kosong" value= "<?php echo $d['satuan'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                      <input type="text" class="form-control" id="date" name="tanggal_masuk" placeholder="MM/DD/YYY"  value= "<?php echo $d['tanggal_masuk'];?>">
                    </div>
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

        
            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-info">Update</button>
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
      mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM t_produk WHERE id_produk='$_GET[id_produk]'");
      echo "<script>window.location='?pg=produk&act=view'</script>";
      break;

    }
    ?>