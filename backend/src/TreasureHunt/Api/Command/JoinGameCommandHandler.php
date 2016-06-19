<?php

namespace TreasureHunt\Api\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use TreasureHunt\Entity\Game;
use TreasureHunt\Entity\JoinedGame;
use TreasureHunt\Entity\User;

class JoinGameCommandHandler extends AbstractCommandHandler
{
    public function handle(JoinGameCommand $command)
    {
        if ($response = $this->validate($command)) {
            return $response;
        }

        $user = $this->findUser($command->user);
        $game = $this->findGame($command->game);

        if ($joinedGame = $this->findJoinedGame($command->game, $command->user)) {
            return $this->createResponse($joinedGame, Response::HTTP_NO_CONTENT);
        }

        $joinedGame = $user->joinGame($game);
        $this->save(function (Connection $database) use ($joinedGame) {
            $database->insert('th_played_games', $joinedGame->toArray());
        });

        return $this->createResponse($joinedGame, Response::HTTP_CREATED);
    }

    private function findUser($uuid)
    {
        $stmt = $this->database->prepare('SELECT * FROM `th_user` WHERE `uuid` = :uuid');
        $stmt->bindValue('uuid', $uuid);
        $stmt->execute();

        if (!$data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new \InvalidArgumentException(sprintf('Invalid user UUID: %s', $uuid));
        }

        return User::load($data);
    }

    private function findGame($uuid)
    {
        $stmt = $this->database->prepare('SELECT * FROM `th_game` WHERE `uuid` = :uuid');
        $stmt->bindValue('uuid', $uuid);
        $stmt->execute();

        if (!$data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new \InvalidArgumentException(sprintf('Invalid game UUID: %s', $uuid));
        }

        return Game::load($data);
    }

    private function findJoinedGame($game, $user)
    {
        $stmt = $this->database->prepare('SELECT * FROM `th_played_games` WHERE `user_uuid` = :user AND `game_uuid` = :game');
        $stmt->bindValue('user', $user);
        $stmt->bindValue('game', $game);
        $stmt->execute();

        if ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return JoinedGame::load($data);
        }
    }
}
