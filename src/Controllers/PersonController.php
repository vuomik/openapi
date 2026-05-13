<?php

namespace POC\Controllers;

use apimatic\jsonmapper\JsonMapper;
use POC\Gateways\FakeDatabase;
use POC\Mappers\ORM;
use POC\Models\Person;
use POC\Models\Response;
use Psr\Http\Message\ResponseInterface;

class PersonController extends Controller
{
    /**
     * @OA\Post(
     *  path="/person",
     *  operationId="createPerson",
     *  tags={"person"},
     *  @OA\Response(
     *    response=203,
     *    description="Accepted new person for processing",
     *    @OA\JsonContent(ref="#/components/schemas/Response")
     *  ),
     *  @OA\RequestBody(
     *    @OA\JsonContent(ref="#/components/schemas/Person")
     *  )
     * )
     */
    public function personPost(): ResponseInterface
    {
        $obj = (new JsonMapper())->map($this->getRequestBody(), new Person);

        $orm = null; // this would be some sort of data model, such as a Zend ORM object

        $mapped = (new ORM)->map($obj, $orm);

        (new FakeDatabase)->createPerson($mapped);
        
        return $this->makeResponse(new Response(
            message: "It worked"
        ), 203);
    }

    /**
     * @OA\Get(
     *  path="/person/{personId}",
     *  operationId="showPerson",
     *  tags={"person"},
     *  @OA\Parameter(
     *    name="personId",
     *    in="path",
     *    description="Personal identification token of a person in our system",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *      type="integer",
     *      format="int64"
     *    )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="A person's profile",
     *    @OA\JsonContent(ref="#/components/schemas/Person")
     *  )
     * )
     */
    public function personGet(): ResponseInterface
    {
        $id = 1; // Get from the request

        $data = (new FakeDatabase)->fetchPersonById($id);

        $obj = (new JsonMapper())->map($data, new Person);

        return $this->makeResponse($obj, 200);
    }

    /**
     * @OA\Put(
     *  path="/person/{personId}",
     *  operationId="updatePerson",
     *  tags={"person"},
     *  @OA\Parameter(
     *    name="personId",
     *    in="path",
     *    description="Personal identification token of a person in our system",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *      type="integer",
     *      format="int64"
     *    )
     *  ),
     *  @OA\RequestBody(
     *    @OA\JsonContent(ref="#/components/schemas/Person")
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="A person's profile",
     *    @OA\JsonContent(ref="#/components/schemas/Person")
     *  )
     * )
     */
    public function personPut(): ResponseInterface
    {
        $this->validateRequest();

        $id = 1; // Get from the request

        $obj = (new JsonMapper())->map($this->getRequestBody(), new Person);

        $orm = null; // this would be some sort of data model, such as a Zend ORM object

        $mapped = (new ORM)->map($obj, $orm);

        (new FakeDatabase)->updatePerson($id, $mapped);
        
        return $this->makeResponse($obj, 200);
    }
}
