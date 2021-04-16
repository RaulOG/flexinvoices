<?php

const INVOICES_PER_PAGE = 5;
$hostName = "db";
$dbName = "flexinvoices";
$userName = "root";
$password = "flexadmin";

try {
	$conn = new PDO("mysql:host=$hostName;dbname=$dbName", $userName, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	exit("Connection failed: " . $e->getMessage());
}

$sth = $conn->prepare("SELECT * FROM invoices");
$sth->execute();
$invoiceCount = $sth->rowCount();
$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
$invoicesPageCount = (int) ($invoiceCount / INVOICES_PER_PAGE);
if (($invoiceCount % INVOICES_PER_PAGE) > 0) {
	$invoicesPageCount++;
}

$sth = $conn->prepare("SELECT * FROM invoices LIMIT " . ($page-1) * INVOICES_PER_PAGE . ", " . INVOICES_PER_PAGE . "");
$sth->execute();
$invoices = $sth->fetchAll();
?>

<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	</head>
	<body>
		<table class="table table-striped">
<?php
foreach($invoices as $invoice) {
	echo "<tr>";
	echo '<td>' . $invoice['id'] . '</td>';
	echo '<td>' . $invoice['client'] . '</td>';
	echo '<td>' . $invoice['invoice_amount'] . '</td>';
	echo '<td>' . $invoice['invoice_amount_plus_vat'] . '</td>';
	echo '<td>' . $invoice['vat_rate'] . '</td>';
	echo '<td>' . $invoice['invoice_status'] . '</td>';
	echo '<td>' . $invoice['invoice_date'] . '</td>';
	echo '<td>' . $invoice['created_at'] . '</td>';
	echo "</tr>";
}
?>
		</table>
		<center>
			<nav aria-label="Page navigation">
				<ul class="pagination">

					<!-- Previous button -->
					<?php
					if ($page > 1){
					?>
					<li>
						<a href="?page=<?= ($page-1) ?>" aria-label="Previous">
							<span aria-hidden="true">Previous page</span>
						</a>
					</li>
					<?php
					}
					?>

					<!-- Next button -->
					<?php
					if($invoicesPageCount > $page) {
					?>
					<li>
						<a href="?page=<?= ($page+1) ?>" aria-label="Next">
						<span aria-hidden="true">Next page</span>
						</a>
					</li>
					<?php
					}
					?>

				</ul>
			</nav>
		</center>
	</body>
</html>