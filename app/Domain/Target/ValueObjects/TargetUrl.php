<?php

namespace App\Domain\Target\ValueObjects;

use InvalidArgumentException;

final readonly class TargetUrl {
    public string $value;

    public function __construct(string $value)
    {
        $url = trim($value);

        if($url === '') {
            throw new InvalidArgumentException('Target URL is required.');
        }
        if(! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Target URL is invalid.');
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);

        if(! in_array($scheme, ['http', 'https'], true)) {
            throw new InvalidArgumentException('Target URL must use http or https.');
        }

        $this->value = $value;
    }
}
