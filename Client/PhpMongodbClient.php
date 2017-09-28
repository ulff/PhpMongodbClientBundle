<?php

declare(strict_types = 1);

namespace Ulff\PhpMongodbClientBundle\Client;

use Ulff\PhpMongodbClientBundle\Exception\MongodbConfigurationException;
use Ulff\PhpMongodbClientBundle\Exception\MongodbEnvironmentException;

class PhpMongodbClient
{
    /**
     * @var \MongoClient
     */
    private $nativeClient;

    /**
     * @var ConnectionUri
     */
    private $connectionUri;

    /**
     * @var ConnectionOptions
     */
    private $connectionOptions;

    /**
     * @param \MongoClient $nativeClient
     */
    public function __construct(array $params)
    {
        $this->validateEnvironment();
        $this->retrieveParams($params);

        $this->nativeClient = new \MongoClient(
            (string) $this->connectionUri,
            $this->connectionOptions->toArray()
        );
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return \MongoClient::VERSION;
    }

    /**
     * @return \MongoClient
     */
    public function getNativeClient(): \MongoClient
    {
        return $this->nativeClient;
    }

    private function validateEnvironment()
    {
        if(!class_exists('\MongoClient')) {
            throw new MongodbEnvironmentException('Missing dependencies: missing native mongodb client');
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
