<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InvoiceReceipt
{
	#[ORM\Id]
	#[ORM\Column]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\OneToOne(mappedBy: 'actualInvoice')]
	private ?InvoiceAudit $invoiceAudit = null;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	private Datapoint $datapoint;

	public function __construct(Datapoint $datapoint)
	{
		$this->datapoint = $datapoint;

		$datapoint->addInvoiceReceipt($this);
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getInvoiceAudit(): ?InvoiceAudit
	{
		return $this->invoiceAudit;
	}

	public function setInvoiceAudit(?InvoiceAudit $invoiceAudit): void
	{
		$this->invoiceAudit = $invoiceAudit;
	}

	public function getDatapoint(): Datapoint
	{
		return $this->datapoint;
	}
}
