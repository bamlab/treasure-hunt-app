<?php

namespace TreasureHunt\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class Game implements NormalizableInterface
{
    private $uuid;
    private $label;
    private $createdAt;
    private $finishedAt;

    public function __construct(UuidInterface $uuid, $label, \DateTime $createdAt, \DateTime $finishedAt = null)
    {
        $this->uuid = $uuid;
        $this->label = $label;
        $this->createdAt = $createdAt;
        $this->finishedAt = $finishedAt;
    }

    public static function create($label)
    {
        return new self(Uuid::uuid4(), $label, new \DateTime());
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function finish($time = null)
    {
        if (null === $time) {
            $time = 'now';
        }

        if (!$time instanceof \DateTime) {
            $time = new \DateTime($time);
        }

        $this->finishedAt = $time;
    }

    public function toArray()
    {
        $data = [
            'uuid' => $this->uuid->toString(),
            'label' => $this->label,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
        ];

        if ($this->finishedAt instanceof \DateTime) {
            $data['finished_at'] = $this->finishedAt->format('Y-m-d H:i:s');
        }

        return $data;
    }

    public function normalize(NormalizerInterface $normalizer, $format = null, array $context = [])
    {
        return $this->toArray();
    }
}
