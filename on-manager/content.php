<?php 

if (!isset($_GET['pg'])) {
	include 'dashboard.php';
} else {
	switch ($_GET['pg']) {
		case 'dashboard':
			include 'dashboard.php';
			break;
    	case 'admin':
			include 'admin.php';
			break;
		case 'produk':
			include 'produk.php';
			break;
		case 'penjualan':
			include 'penjualan.php';
			break;
			case 'lappj':
			include 'lap_penjualan.php';
			break;
		case 'cetak':
			include 'cetak_pdf.php';
			break;
			
		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>