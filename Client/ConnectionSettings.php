<?php

declare(strict_types = 1);

namespace Ulff\PhpMongodbClientBundle\Client;

class ConnectionSettings
{
    const PREFIX = 'mongodb://';

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @param string $host
     * @param string $port
     */
    public function __construct(string $host, string $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::PREFIX . $this->host . ':' . $this->port;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }
}
