<?php

require_once __DIR__ . '/../app/InvoiceRepository.php';

const INVOICES_PER_PAGE = 5;

$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
$invoiceRepository = new InvoiceRepository();
$invoices = $invoiceRepository->findAll();
$totalInvoicePages = (int) ceil($invoices->count() / INVOICES_PER_PAGE);
$invoices = $invoices->slice(
	INVOICES_PER_PAGE * ($page - 1),
	INVOICES_PER_PAGE
);

require_once __DIR__ . '/../resources/views/invoices/index.php';