<?php

class InvoiceCollection
{
	private array $invoices = [];

	public function add(Invoice $invoice)
	{
		$this->invoices[] = $invoice;
	}

	public function count(): int
	{
		return count($this->invoices);
	}

	public function toArray(): array
	{
		return $this->invoices;
	}

	public function slice(int $offset, int $sliceSize): InvoiceCollection
	{
		$slice = new InvoiceCollection();

		while ($sliceSize-- > 0){
			if (is_null($this->invoices[$offset])) {
				break;
			}
			$slice->add($this->invoices[$offset++]);
		}

		return $slice;
	}
}