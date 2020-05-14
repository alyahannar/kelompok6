<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="?pg=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

       <br/>
       <br/>
       <br/>
   

<div class="row">
    <div class="col-lg-6" style="float:none;margin:auto;">
        <div class="panel panel-default">
		    <!-- <div class="callout callout-danger">
                <h4>Selamat Datang "<?php echo strtoupper($_SESSION['nama']);?>" APLIKASI STOK BARANG MASUK KELUAR</h4>
                </p>
              </div> -->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Info Manager</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6" style="float:none;margin:auto;">

                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Username</th>
                                <th>:</th>
                                <td><?php echo $_SESSION["nama"]?></td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <th>:</th>
                                <td><?php date_default_timezone_set("Asia/Jakarta"); echo $date = date(' H:i:s'); ?></td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <th>:</th>
                                <td>Manager</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

	 