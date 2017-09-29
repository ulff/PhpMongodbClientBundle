<?php

declare(strict_types = 1);

namespace Ulff\PhpMongodbClientBundle\Client;

use Ulff\PhpMongodbClientBundle\Exception\MongodbConfigurationException;
use Ulff\PhpMongodbClientBundle\Exception\MongodbEnvironmentException;

class PhpMongodbClient
{
    /**
     * @var \MongoDB\Driver\Manager
     */
    private $manager;

    /**
     * @var ConnectionUri
     */
    private $connectionUri;

    /**
     * @var ConnectionOptions
     */
    private $connectionOptions;

    /**
     * @param \MongoDB\Driver\Manager $nativeClient
     */
    public function __construct(array $params)
    {
        $this->validateEnvironment();
        $this->retrieveParams($params);

        $this->manager = new \MongoDB\Driver\Manager(
            (string) $this->connectionUri,
            $this->connectionOptions->toArray()
        );
    }

    /**
     * @return \MongoDB\Driver\Manager
     */
    public function getManager(): \MongoDB\Driver\Manager
    {
        return $this->manager;
    }

    private function validateEnvironment()
    {
        if(!class_exists('\MongoDB\Driver\Manager')) {
            throw new MongodbEnvironmentException('Missing dependencies: missing mongodb driver');
        }
    }

    private function retrieveParams(array $params)
    {
        if(!array_key_exists('connection', $params)) {
            throw new MongodbConfigurationException('Missing configuration: connection');
        }

        $this->connectionUri = new ConnectionUri($params['connection']);
        $this->connectionOptions = new ConnectionOptions($params['options']);
    }
}
