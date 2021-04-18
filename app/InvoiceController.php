<?php

require_once __DIR__ . '/InvoiceRepository.php';

class InvoiceController
{
	private const INVOICES_PER_PAGE = 5;

	public function index()
	{
		$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
		$invoiceRepository = new InvoiceRepository();
		$invoices = $invoiceRepository->findAll();
		$totalInvoicePages = (int) ceil($invoices->count() / self::INVOICES_PER_PAGE);
		$invoices = $invoices->slice(
			self::INVOICES_PER_PAGE * ($page - 1),
			self::INVOICES_PER_PAGE
		);

		require_once __DIR__ . '/../resources/views/invoices/index.php';
	}
}