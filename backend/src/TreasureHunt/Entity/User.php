<?php

namespace TreasureHunt\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class User implements NormalizableInterface
{
    private $uuid;
    private $username;
    private $registeredAt;

    public function __construct(UuidInterface $uuid, $username, \DateTime $registeredAt)
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->registeredAt = $registeredAt;
    }

    public static function signup($username)
    {
        return new self(Uuid::uuid4(), $username, new \DateTime());
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function toArray()
    {
        return [
            'uuid' => $this->uuid->toString(),
            'username' => $this->username,
            'registered_at' => $this->registeredAt->format('Y-m-d H:i:s'),
        ];
    }

    public function normalize(NormalizerInterface $normalizer, $format = null, array $context = [])
    {
        return $this->toArray();
    }
}
