<?php

namespace App\Validation;

class UserRules
{
    public function validateEmailDomain(string $str): bool
    {
        return preg_match('/@(students\.salle\.url\.edu|ext\.salle\.url\.edu|salle\.url\.edu)$/', $str);
    }
}
