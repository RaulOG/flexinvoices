<?php

class Invoice
{
	private int $id;
	private string $clientName;
	private float $amount;
	private float $amountPlusVat;
	private float $vatRate;
	private string $status;
	private string $date;
	private string $createdAt;
	private const PAID = 'paid';
	private const UNPAID = 'unpaid';

	public function __construct($invoice)
	{
		$this->id = $invoice['id'];
		$this->clientName = $invoice['client'];
		$this->amount = $invoice['invoice_amount'];
		$this->amountPlusVat = $invoice['invoice_amount_plus_vat'];
		$this->vatRate = $invoice['vat_rate'];
		$this->status = $invoice['invoice_status'];
		$this->date = $invoice['invoice_date'];
		$this->createdAt = $invoice['created_at'];
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getClientName(): string
	{
		return $this->clientName;
	}

	public function getAmount(): float
	{
		return $this->amount;
	}

	public function getAmountPlusVat(): float
	{
		return $this->amountPlusVat;
	}

	public function getVatRate(): float
	{
		return $this->vatRate;
	}

	public function getStatus(): string
	{
		return $this->status;
	}

	public function getDate(): string
	{
		return $this->date;
	}

	public function getCreatedAt(): string
	{
		return $this->createdAt;
	}

	public function isPaid(): bool
	{
		return $this->getStatus() === SELF::PAID;
	}

	public function getPaidAmount(): float
	{
		if ($this->getStatus() === self::PAID) {
			return $this->getAmount();
		}

		return 0;
	}

	public function getUnpaidAmount(): float
	{
		if ($this->getStatus() === self::PAID) {
			return 0;
		}

		return $this->getAmount();
	}
}