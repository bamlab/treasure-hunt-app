<?php

namespace TreasureHunt\Api\Command;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class JoinGameCommand
{
    public $user;
    public $game;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('user', new NotBlank([
            'message' => 'User UUID is required.',
        ]));

        $metadata->addPropertyConstraint('user', new Uuid([
            'message' => 'User UUID is not valid.',
        ]));

        $metadata->addPropertyConstraint('game', new NotBlank([
            'message' => 'Game UUID is required.',
        ]));

        $metadata->addPropertyConstraint('game', new Uuid([
            'message' => 'Game UUID is not valid.',
        ]));
    }
}
