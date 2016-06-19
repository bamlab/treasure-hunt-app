<?php

namespace TreasureHunt\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JoinedGame implements NormalizableInterface
{
    private $uuid;
    private $user;
    private $game;
    private $startedAt;
    private $finishedAt;
    private $score;

    public function __construct(UuidInterface $uuid, UuidInterface $user, UuidInterface $game, $startedAt = null, $finishedAt = null, $score = 0)
    {
        if (!$startedAt instanceof \DateTime) {
            $startedAt = new \DateTime($startedAt);
        }

        if (null !== $finishedAt && !$finishedAt instanceof \DateTime) {
            $finishedAt = new \DateTime($finishedAt);
        }

        $this->uuid = $uuid;
        $this->user = $user;
        $this->game = $game;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
        $this->score = (int) $score;
    }

    public static function create(User $user, Game $game)
    {
        return new self(Uuid::uuid4(), $user->getUuid(), $game->getUuid(), new \DateTime());
    }

    public static function load(array $data)
    {
        return new self(
            Uuid::fromString($data['uuid']),
            Uuid::fromString($data['user_uuid']),
            Uuid::fromString($data['game_uuid']),
            $data['started_at'],
            $data['finished_at'],
            $data['score']
        );
    }

    public function toArray()
    {
        $data = [
            'uuid' => $this->uuid->toString(),
            'user_uuid' => $this->user->toString(),
            'game_uuid' => $this->game->toString(),
            'started_at' => $this->startedAt->format('Y-m-d H:i:s'),
        ];

        if ($this->finishedAt instanceof \DateTime) {
            $data['finished_at'] = $this->finishedAt->format('Y-m-d H:i:s');
        }

        $data['score'] = $this->score;

        return $data;
    }

    public function normalize(NormalizerInterface $normalizer, $format = null, array $context = [])
    {
        return $this->toArray();
    }
}
