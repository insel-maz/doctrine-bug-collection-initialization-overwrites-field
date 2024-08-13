<?php

use Doctrine\ORM\EntityManager;

require_once 'bootstrap.php';
global $entityManager;

$entityManager->wrapInTransaction(function (EntityManager $entityManager) {
	$invoiceAuditRepository = $entityManager->getRepository(InvoiceAudit::class);
	$invoiceAudits = $invoiceAuditRepository->findAll();
	foreach ($invoiceAudits as $invoiceAudit) {
		$actualInvoice = $invoiceAudit->getActualInvoice();
		$datapoint = $actualInvoice->getDatapoint();

		echo 'Disposing invoice audit: ' . $invoiceAudit->getId() . PHP_EOL;
		$invoiceAudit->dispose();

		echo 'Actual invoice ➡ invoice audit: ' . gettype($actualInvoice->getInvoiceAudit()) . PHP_EOL;

		$datapointInvoiceReceipts = $datapoint->getInvoiceReceipts();

		echo 'Actual invoice ➡ invoice audit: ' . gettype($actualInvoice->getInvoiceAudit()) . PHP_EOL;
	}
});
