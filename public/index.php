<?php

require_once __DIR__ . '/../app/InvoiceController.php';

$request = explode('?', $_SERVER['REQUEST_URI'])[0];

if ($request === '/') {
	(new InvoiceController())->index();

} else if ($request === '/export') {
	(new InvoiceController())->export();

} else if ($request === '/export_by_company') {
	(new InvoiceController())->exportByCompany();

} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && preg_match('/\/invoices\/\d+/', $request)) {
	$invoiceId = (int) explode('/invoices/', $request)[1];
	(new InvoiceController())->update($invoiceId);

} else {
	http_response_code(404);
}