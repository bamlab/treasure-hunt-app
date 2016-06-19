<?php

namespace TreasureHunt\Api\Command;

use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractCommandHandler
{
    private $validator;
    private $database;
    private $serializer;

    public function __construct(
        ValidatorInterface $validator,
        Connection $database,
        SerializerInterface $serializer
    )
    {
        $this->validator = $validator;
        $this->database = $database;
        $this->serializer = $serializer;
    }

    protected function validate($data)
    {
        $errors = $this->validator->validate($data);
        if (count($errors)) {
            return $this->createResponse($errors, Response::HTTP_BAD_REQUEST);
        }
    }

    protected function serialize($data, array $context = [])
    {
        return $this->serializer->serialize($data, 'json', $context);
    }

    protected function save(\Closure $callback)
    {
        $this->database->beginTransaction();
        call_user_func_array($callback, [$this->database]);
        $this->database->commit();
    }

    protected function createResponse($data, $statusCode = Response::HTTP_OK, array $headers = [])
    {
        return new Response($this->serialize($data, 'json'), $statusCode, array_merge(
            ['Content-Type' => 'application/json'],
            $headers
        ));
    }
}
