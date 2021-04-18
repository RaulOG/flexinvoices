<?php

require_once __DIR__ . '/InvoiceRepository.php';

class InvoiceController
{
	private const INVOICES_PER_PAGE = 5;
	private InvoiceRepository $invoiceRepository;

	public function __construct()
	{
		$this->invoiceRepository = new InvoiceRepository();
	}

	public function index()
	{
		$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;
		$invoices = $this->invoiceRepository->findAll();
		$totalInvoicePages = (int) ceil($invoices->count() / self::INVOICES_PER_PAGE);
		$invoices = $invoices->slice(
			self::INVOICES_PER_PAGE * ($page - 1),
			self::INVOICES_PER_PAGE
		);

		require_once __DIR__ . '/../resources/views/invoices/index.php';
	}

	public function export()
	{
		$invoices = $this->invoiceRepository->findAll()->toArray();

		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=invoices.csv");
		
		foreach ($invoices as $invoice) {
			echo sprintf("%u,%s,%.5f\n", $invoice->getId(), $invoice->getClientName(), $invoice->getAmount());
		}
	}

	public function exportByCompany()
	{
		$invoices = $this->invoiceRepository->findAll()->toArray();

		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=invoices_by_company.csv");
		
		foreach ($invoices as $invoice) {
			echo sprintf("%s,%.5f,%.5f,%.5f\n", $invoice->getClientName(), $invoice->getAmount(), $invoice->getPaidAmount(), $invoice->getUnpaidAmount());
		}
	}
}