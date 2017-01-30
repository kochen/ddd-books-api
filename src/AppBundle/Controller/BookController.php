<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use MyCompany\Book\DomainModel\BookRepository;
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
     * @Annotations\View(
     *  templateVar="pages"
     * )
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

        /** @var BookRepository */
        $bookRepository = $this->container->get('my_company.book.repository');
        $result = $bookRepository->getAll($limit, $offset);
        $response = new ApiResponse(true, $result);
        return $response->getFormattedResponse();
    }
}
