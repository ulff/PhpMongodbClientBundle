<?php

declare(strict_types = 1);

namespace Ulff\PhpMongodbClientBundle\Client;

use Ulff\PhpMongodbClientBundle\Exception\MongodbConfigurationException;

class ConnectionUri
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
     * @var string|null
     */
    private $username;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @param array $connection
     */
    public function __construct(array $connection)
    {
        $this->validate($connection);

        $this->host = $connection['host'];
        $this->port = $connection['port'];
        $this->username = $connection['username'] ?? null;
        $this->password = $connection['password'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $credentials = '';
        if ($this->username !== null && $this->password !== null) {
            $credentials = $this->username . ':' . $this->password . '@';
        }

        return self::PREFIX . $credentials . $this->host . ':' . $this->port;
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

    /**
     * @return null|string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    private function validate(array $connection)
    {
        if(empty($connection['host'])) {
            throw new MongodbConfigurationException('Missing connection configuration: host');
        }
        if(empty($connection['port'])) {
            throw new MongodbConfigurationException('Missing connection configuration: port');
        }
    }
}
