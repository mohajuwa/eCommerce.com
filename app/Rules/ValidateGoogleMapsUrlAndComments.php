<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateGoogleMapsUrlAndComments implements Rule
{
    public function passes($attribute, $value)
    {
        // Define the regular expression pattern for a Google Maps URL
        $urlRegex = '/^https?:\/\/(www\.)?(maps\.google\.com\/maps|goo\.gl\/maps|maps\.app\.goo\.gl)\/.*$/';

        // Check if the URL matches the pattern
        return preg_match($urlRegex, $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid Google Maps URL.';
    }
}
