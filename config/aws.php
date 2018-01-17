<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. The minimum
    | required options are declared here, but the full set of possible options
    | are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */

    // AWS
    'credentials' => [
        'key'    => 'AKIAJRKK7IRWDYVSPU2Q',
        'secret' => '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',
    ],
    'region' => 'us-east-2',
    'version' => 'latest',

    // You can override settings for specific services
    'Ses' => [
        'region' => 'us-east-2',
    ],
];
