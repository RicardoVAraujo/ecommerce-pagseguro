<?php 

use \Hcode\Page;
use \Hcode\Model\User;
use \Hcode\PagSeguro\Config;
use \Hcode\Model\Order;
use \Hcode\PagSeguro\Transporter;

$app->get("/payment", function(){

	User::verifyLogin(false);

	$order = new Order();

	$order->getFromSession();

	$years = [];

	for ($y = date("Y"); $y < date("Y") + 14; $y++)
	{

		array_push($years, $y);

	}

	$page = new Page();

	$page->setTpl("payment", array(
		"order"=>$order->getValues(),
		"msgError"=>$order->getError(),
		"years"=>$years,
		"pagseguro"=>array(
			"urlJS"=>Config::getUrlJS(),
			"id"=>Transporter::createSession(),
			"maxInstallmentNoInterest"=>Config::MAX_INSTALLMENT_NO_INTEREST,
			"maxInstallment"=>Config::MAX_INSTALLMENT
		)
	));

});

?>