<?php

require_once __DIR__ . '/../app/InvoiceController.php';

$request = explode('?', $_SERVER['REQUEST_URI'])[0];

switch ($request) {
	case '/':
		(new InvoiceController())->index();
		break;
	case '/export':
		(new InvoiceController())->export();
		break;
	case '/export_by_company':
		(new InvoiceController())->exportByCompany();
		break;
	default:
		http_response_code(404);
}