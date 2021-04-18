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

	public function findById(int $id)
	{
		$pdoStatement = $this->connection->prepare("SELECT * FROM invoices WHERE id = :id");
		$pdoStatement->execute(['id' => $id]);
		return new Invoice($pdoStatement->fetch());
	}

	public function update(Invoice $invoice)
	{
		$pdoStatement = $this->connection->prepare("UPDATE invoices SET invoice_status=:invoice_status WHERE id=:id");
		$pdoStatement->execute([
			'invoice_status' => $invoice->getStatus(),
			'id' => $invoice->getId()
		]);
	}
}