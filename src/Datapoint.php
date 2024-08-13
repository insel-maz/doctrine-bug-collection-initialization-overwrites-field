<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Datapoint
{
	#[ORM\Id]
	#[ORM\Column]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\Column]
	private string $name;

	/**
	 * @var Collection<int, InvoiceReceipt>
	 */
	#[ORM\OneToMany(targetEntity: InvoiceReceipt::class, mappedBy: 'datapoint')]
	private Collection $invoiceReceipts;

	public function __construct(string $name)
	{
		$this->name = $name;
		$this->invoiceReceipts = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return list<InvoiceReceipt>
	 */
	public function getInvoiceReceipts(): array
	{
		return $this->invoiceReceipts->getValues();
	}

	public function addInvoiceReceipt(InvoiceReceipt $param): void
	{
		if ($this->invoiceReceipts->contains($param)) {
			return;
		}
		$this->invoiceReceipts->add($param);
	}
}
