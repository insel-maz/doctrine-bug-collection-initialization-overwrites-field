<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InvoiceAudit
{
	#[ORM\Id]
	#[ORM\Column]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\OneToOne]
	#[ORM\JoinColumn(nullable: false)]
	private InvoiceReceipt $actualInvoice;

	public function __construct(InvoiceReceipt $actualInvoice)
	{
		$this->actualInvoice = $actualInvoice;

		$actualInvoice->setInvoiceAudit($this);
	}

	public function dispose(): void
	{
		$this->actualInvoice->setInvoiceAudit(null);
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getActualInvoice(): InvoiceReceipt
	{
		return $this->actualInvoice;
	}
}
