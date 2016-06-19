<?php

namespace TreasureHunt\Api\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use TreasureHunt\Entity\User;

class SignupUserCommandHandler extends AbstractCommandHandler
{
    public function handle(SignupUserCommand $command)
    {
        if ($response = $this->validate($command)) {
            return $response;
        }

        $user = User::signup($command->username);

        $this->save(function (Connection $database) use ($user) {
            $database->insert('th_user', $user->toArray());
        });

        return $this->createResponse($user, Response::HTTP_CREATED);
    }
}
