<?php declare(strict_types=1);

use \Xervice\DataProvider\DataProviderConfig;

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] =  dirname(__DIR__) . '/src/DataTransferObject';

$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    dirname(__DIR__) . '/schema'
];

$config[DataProviderConfig::DATA_PROVIDER_NAMESPACE] = 'App\\DataTransferObject';