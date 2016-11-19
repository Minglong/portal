<?php

namespace App\Spam;

use Illuminate\Contracts\Auth\Guard;

class SpamRule
{
    /**
     * @var \App\Spam\SpamDetector
     */
    private $spamDetector;

    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    private $guard;

    public function __construct(SpamDetector $spamDetector, Guard $guard)
    {
        $this->spamDetector = $spamDetector;
        $this->guard = $guard;
    }

    public function validate($attribute, $value): bool
    {
        return ! $this->spamDetector->detectsSpam($value, $this->guard->user());
    }
}
