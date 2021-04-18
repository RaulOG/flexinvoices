<?php

require_once __DIR__ . '/../app/InvoiceController.php';

$request = explode('?', $_SERVER['REQUEST_URI'])[0];

switch ($request) {
	case '/':
		(new InvoiceController())->index();
		break;
	default:
		http_response_code(404);
}