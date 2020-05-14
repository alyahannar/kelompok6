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
			
		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>