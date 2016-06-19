<?php

namespace TreasureHunt\Api\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use TreasureHunt\Entity\Game;

class CreateGameCommandHandler extends AbstractCommandHandler
{
    public function handle(CreateGameCommand $command)
    {
        if ($response = $this->validate($command)) {
            return $response;
        }

        $game = Game::create($command->label);

        $this->save(function (Connection $database) use ($game) {
            $database->insert('th_user', $game->toArray());
        });

        return $this->createResponse($game, Response::HTTP_CREATED);
    }
}
