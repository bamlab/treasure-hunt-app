<?php

namespace TreasureHunt\Api\Command;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CreateGameCommand
{
    public $label;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('label', new NotBlank([
            'message' => 'Game must have a label.',
        ]));

        $metadata->addPropertyConstraint('label', new Length([
            'min' => 5,
            'max' => 100,
            'minMessage' => 'Game label must be at least {{ min }} characters long.',
            'maxMessage' => 'Game label must be at most {{ max }} characters long.',
        ]));
    }
}
