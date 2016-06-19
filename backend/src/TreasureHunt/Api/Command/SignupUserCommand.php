<?php

namespace TreasureHunt\Command;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SignupUserCommand
{
    public $username;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('username', new NotBlank([
            'message' => 'Field "username" is required.',
        ]));

        $metadata->addPropertyConstraint('username', new Length([
            'min' => 6,
            'max' => 25,
            'minMessage' => 'Username must be at least {{ min }} characters long.',
            'maxMessage' => 'Username must be at most {{ max }} characters long.',
        ]));

        $metadata->addPropertyConstraint('username', new Regex([
            'pattern' => '/^[a-z0-9]+$/i',
            'message' => 'Username must only contain letters and digits.',
        ]));
    }
}
