<?php

namespace Hcode\PagSeguro;

class CreditCard {

	private $token;
	private $installment;
	private $holder;
	private $billingaddress;

	public function __construct(
		string $token,
		Installment $installment,
		Holder $holder,
		Address $billingaddress
	)
	{

		if (!$token)
		{

			throw new Exception("Informe o token do cartão de crédito.");

		}

		$this->token = $token;
		$this->installment = $installment;
		$this->holder = $holder;
		$this->billingaddress = $billingaddress;

	}

	public function getDOMElement():DOMElement
	{
	
		$dom = new DOMDocument();

		$creditCard = $dom->createElement("creditCard");
		$creditCard = $dom->appendChild($creditCard);

		$token = $dom->createElement("token", $this->token);
		$token = $creditCard->appendChild($token);
		
		$installment = $this->$installment->getDomElement();
		$installment = $dom->importNode($installment, true);
		$installment = $creditCard->appendChild($installment);

		$holder = $this->$holder->getDomElement();
		$holder = $dom->importNode($holder, true);
		$holder = $creditCard->appendChild($holder);

		$billingaddress = $this->$billingaddress->getDomElement("billingAddress");
		$billingaddress = $dom->importNode($billingaddress, true);
		$billingaddress = $creditCard->appendChild($billingaddress);

		return $creditCard;

	}
	
}

?>