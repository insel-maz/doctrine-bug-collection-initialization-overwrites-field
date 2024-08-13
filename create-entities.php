<?php

use Doctrine\ORM\EntityManager;

require_once 'bootstrap.php';
global $entityManager;

$entityManager->wrapInTransaction(function (EntityManager $entityManager) {
	$datapoint = new Datapoint('Electric meter');
	$entityManager->persist($datapoint);

	$invoiceReceipt1 = new InvoiceReceipt($datapoint);
	$entityManager->persist($invoiceReceipt1);
	$invoiceReceipt2 = new InvoiceReceipt($datapoint);
	$entityManager->persist($invoiceReceipt2);
	$invoiceReceipt3 = new InvoiceReceipt($datapoint);
	$entityManager->persist($invoiceReceipt3);

	$invoiceAudit = new InvoiceAudit($invoiceReceipt1);
	$entityManager->persist($invoiceAudit);
});
