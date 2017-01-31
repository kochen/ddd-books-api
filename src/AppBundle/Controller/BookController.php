<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookNotFoundException;
use MyCompanyBundle\Book\DomainModel\BookRepository;

use AppBundle\Response\ApiResponse;

class BookController extends FOSRestController
{
    /**
     * List all books.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing books.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="25", description="How many books to return.")
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getBooksAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        /** @var BookRepository $bookRepository */
        $bookRepository = $this->container->get('my_company.book.repository');
        $result = $bookRepository->getAll($limit, $offset);
        $response = new ApiResponse(true, $result);
        return $response->getFormattedResponse();
    }

    /**
     * Get single Book.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Book for a given id",
     *   output = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the book is not found"
     *   }
     * )
     *
     * @param int     $id      the page id
     *
     * @return array
     *
     */
    public function getBookAction($id)
    {
        try {
            /** @var BookRepository $bookRepository */
            $bookRepository = $this->container->get('my_company.book.repository');
            $result = $bookRepository->getById($id);
        } catch (BookNotFoundException $e) {
            $response = new ApiResponse(false, null, $e->getMessage());
            return $response->getFormattedResponse();
        }
        $response = new ApiResponse(true, $result);
        return $response->getFormattedResponse();
    }

    /**
     * Create a Page from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new book from the submitted data.",
     *   input = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return array
     */
    public function postBookAction(Request $request)
    {
//
    }

    /**
     * Update existing page from the submitted data or create a new page at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )xw
     *
     * @param Request $request the request object
     * @param int     $id      the page id
     *
     * @return array
     *
     */
    public function putBookAction(Request $request, $id)
    {

    }


}
