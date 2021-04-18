<?php

require_once __DIR__ . '/../db/MysqlDatabase.php';
require_once __DIR__ . '/InvoiceCollection.php';
require_once __DIR__ . '/Invoice.php';

class InvoiceRepository
{
	private PDO $connection;

	public function __construct()
	{
		$this->connection = MysqlDatabase::getInstance()->getConnection();
	}

	public function findAll()
	{
		$pdoStatement = $this->connection->prepare("SELECT * FROM invoices");
		$pdoStatement->execute();
		$invoices = new InvoiceCollection();
		foreach($pdoStatement->fetchAll() as $invoice) {
			$invoices->add(new Invoice($invoice));
		}
		return $invoices;
	}
}