<?php

declare(strict_types = 1);

namespace Ulff\PhpMongodbClientBundle\Exception;

class MongodbEnvironmentException extends PhpMongodbClientException
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
