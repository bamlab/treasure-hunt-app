<?php

namespace TreasureHunt\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use TreasureHunt\Entity\User;

class SignupUserCommandHandler
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

    public function handle(SignupUserCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors)) {
            return new JsonResponse($this->serializer->serialize($errors, 'json'), Response::HTTP_BAD_REQUEST);
        }

        $user = User::signup($command->username);

        $this->database->beginTransaction();
        $this->database->insert('th_user', $user->toArray());
        $this->database->commit();

        return new Response(
            $this->serializer->serialize($user, 'json'),
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json']
        );
    }
}
