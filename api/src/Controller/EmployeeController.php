<?php

namespace App\Controller;


use App\Resource\Factory\EmployeesForShift\EmployeesForShiftInputFactory;
use App\Resource\Factory\EmployeesForShift\EmployeesForShiftOutputFactory;
use App\Resource\Factory\EmployeesForShift\EmployeesForShiftInputDTOFactory;
use App\Resource\Factory\EmployeesForShift\EmployeesForShiftResponseObjectFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class EmployeeController
 * @package App\Controller
 */
class EmployeeController extends AbstractController
{
    private EmployeesForShiftInputDTOFactory $factoryInput;

    private EmployeesForShiftInputFactory $factoryRequest;

    private EmployeesForShiftResponseObjectFactory $factoryResponse;

    private EmployeesForShiftOutputFactory $factoryOutput;


    /**
     * EmployeeController constructor.
     * @param EmployeesForShiftInputDTOFactory $factoryInput
     * @param EmployeesForShiftInputFactory $factoryRequest
     * @param EmployeesForShiftResponseObjectFactory $factoryResponse
     * @param EmployeesForShiftOutputFactory $factoryOutput
     */
    public function __construct(
        EmployeesForShiftInputDTOFactory $factoryInput,
        EmployeesForShiftInputFactory $factoryRequest,
        EmployeesForShiftResponseObjectFactory $factoryResponse,
        EmployeesForShiftOutputFactory $factoryOutput
    )
    {
        $this->factoryInput = $factoryInput;
        $this->factoryRequest = $factoryRequest;
        $this->factoryResponse = $factoryResponse;
        $this->factoryOutput = $factoryOutput;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getForShiftAction(Request $request)
    {
        try {
            $inputDTO = $this->factoryInput->createFromRequestQueryParams($request);
            $requestObject = $this->factoryRequest->createFromInput($inputDTO);
            $responseObject = $this->factoryResponse->createFromRequestObject($requestObject);
            $outputDTO = $this->factoryOutput->createFromResponseObject($responseObject);
            return new JsonResponse($outputDTO);
        } catch(HttpException $exception) {
            $statusCode = $exception->getStatusCode();
            $message = $exception->getMessage();
            return new JsonResponse(['error'=>$message], $statusCode);
        }
    }

}
