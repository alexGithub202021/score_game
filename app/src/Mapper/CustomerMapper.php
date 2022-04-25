<?php

namespace App\Mapper;

use App\Entity\Customer;

class CustomerMapper
{
	public static function transform(array $customers): array
	{
		$result = array();

		if (count($customers) > 0) {
			foreach ($customers as $customer) {
				$result[] = [
					'IdCustomer' => $customer->getIdcustomer(),
					'Society' => $customer->getSociety(),
					'Credit' => $customer->getCredit(),
					'IdSalesperson' => $customer->getIdsalesperson()
				];
			}
		}

		return $result;
	}

	public static function getNewCustomer($data): Customer
	{
		$newCustomer = new Customer();

		$newCustomer
			->setSociety($data['Society'])
			->setIdsalesperson($data['IdSalesperson'])
			->setCredit($data['Credit']);

		return $newCustomer;
	}
}