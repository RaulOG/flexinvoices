<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	</head>
	<body>
		<table class="table table-striped">
<?php
foreach ($invoices->toArray() as $invoice) {
	echo "<tr>";
	echo '<td>' . $invoice->getId() . '</td>';
	echo '<td>' . $invoice->getClientName() . '</td>';
	echo '<td>' . $invoice->getAmount() . '</td>';
	echo '<td>' . $invoice->getAmountPlusVat() . '</td>';
	echo '<td>' . $invoice->getVatRate() . '</td>';
	echo '<td>' . $invoice->getStatus() . '</td>';
	echo '<td>' . $invoice->getDate() . '</td>';
	echo '<td>' . $invoice->getCreatedAt() . '</td>';
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
					if ($totalInvoicePages > $page) {
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