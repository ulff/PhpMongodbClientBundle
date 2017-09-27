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
     * @var ConnectionSettings
     */
    private $connectionSettings;

    /**
     * @param \MongoClient $nativeClient
     */
    public function __construct(array $params)
    {
        $this->validateEnvironment();
        $this->retrieveParams($params);

        $this->nativeClient = new \MongoClient((string) $this->connectionSettings);
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
        if(empty($params['mongodb_host'])) {
            throw new MongodbConfigurationException('Missing configuration: mongodb_host');
        }
        if(empty($params['mongodb_port'])) {
            throw new MongodbConfigurationException('Missing configuration: mongodb_port');
        }

        $this->connectionSettings = new ConnectionSettings($params['mongodb_host'], $params['mongodb_port']);
    }
}
