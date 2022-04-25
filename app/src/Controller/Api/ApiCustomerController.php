<?php

namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CustomerRepository;
use App\Repository\SalespersonRepository;
use App\Mapper\CustomerMapper;

/**
 * Class ApiCustomerController
 * @package App\Controller\Api
 * @Route("/api")
 */
class ApiCustomerController extends AbstractController
{
	private $customerRepository;

	public function __construct(CustomerRepository $customerRepository, SalespersonRepository $salespersonRepository)
	{
		$this->customerRepository = $customerRepository;
		$this->salespersonRepository = $salespersonRepository;
	}

	/**
	 * @Route("/customers", methods="GET")
	 */
	public function getCustomers(): Response
	{
		$customers = $this->customerRepository->findAll();
		if (!$customers) {
			throw new HttpException(404, "Ressource not found");
		}
		$result = CustomerMapper::transform($customers);
		return new JsonResponse($result);
	}

	/**
	 * @Route("/customers/{id}", methods="GET")
	 */
	public function getCustomerById(int $id): Response
	{
		if (!$id) {
			throw new HttpException(400, "Invalid id");
		}
		$customer = $this->customerRepository->findOneBy(['idcustomer' => $id]);
		if (!$customer) {
			// throw new HttpException(404, "Ressource not found");
            return new JsonResponse("Invalid parameter: id not found", 404);
		}
		$result = CustomerMapper::transform(array($customer));
		return new JsonResponse($result);
	}

	/**
	 * @Route("/customer/", methods="POST")
	 */
	public function addCustomer(Request $request): Response
	{
		$data = json_decode($request->getContent(), true);

		if (empty($data['Society']) || empty($data['IdSalesperson']) || empty($data['Credit'])) {
			// throw new NotFoundHttpException('Expecting mandatory parameters!');
            return new JsonResponse('Expecting mandatory parameters!', 400);
		} elseif ($data['IdSalesperson'] < 0) {
			// throw new HttpException(400, "Invalid parameter : idSalesperson must be positive integer");
            return new JsonResponse("Invalid parameter : idSalesperson must be positive integer", 400);
		}

		$salesperson = $this->salespersonRepository->findOneBy(['idsalesperson'=>$data['IdSalesperson']]);
		$data['IdSalesperson'] = $salesperson;

		$newCustomer = CustomerMapper::getNewCustomer($data);

		$this->customerRepository->addCustomer($newCustomer);

		// check Add ok
		return $this->getCustomers();
	}

	/**
	 * @Route("/customer/{id}", methods="PUT")
	 */
	public function updateCustomer(Request $request, int $id): Response
	{
		if (!$id) {
			throw new HttpException(400, "Invalid id");
		}
		$customer = $this->customerRepository->find($id);
		
		$data = json_decode($request->getContent(), true);

		if (empty($data['Society']) || empty($data['IdSalesperson']) || empty($data['Credit'])) {
			throw new NotFoundHttpException('Expecting mandatory parameters!');
		} elseif ($data['IdSalesperson'] < 0) {
			throw new HttpException(400, "Invalid parameter : idSalesperson must be positive integer");
		}

		$salesperson = $this->salespersonRepository->findOneBy(['idsalesperson'=>$data['IdSalesperson']]);
		$data['IdSalesperson'] = $salesperson;		

		$this->customerRepository->updateCustomer($customer, $data);

		return $this->getCustomerById($id);
	}

	/**
	 * @Route("/customer/{id}", methods="DELETE")
	 */
	public function deleteCustomer(int $id): Response
	{
		if (!$id) {
			throw new HttpException(400, "Invalid id");
		}

		$customer = $this->customerRepository->findOneBy(['idcustomer' => $id]);

		if (!$customer) {
			// throw new HttpException(400, "Invalid parameter: id not found");
            return new JsonResponse("Invalid parameter: id not found", 404);
		}

		$this->customerRepository->removeCustomer($customer);

		// check deletion ok
		$customer = $this->customerRepository->findOneBy(['idcustomer' => $id]);
		$result = !$customer ? ['status' => 'customer deleted'] : ['status' => 'deletion failed'];

		return new JsonResponse($result);
	}
}
