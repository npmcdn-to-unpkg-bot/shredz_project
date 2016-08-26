<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => env('FILESYSTEM_DEFAULT'),//'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD'),//'s3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
        ],

        'ftp' => [
            'driver'   => 'ftp',
            'host'     => 'ftp.example.com',
            'username' => 'your-username',
            'password' => 'your-password',

            // Optional FTP Settings...
            // 'port'     => 21,
            // 'root'     => '',
            // 'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,
        ],

        's3' => [
            'driver' => env('FILESYSTEM_S3_DRIVER', 's3'),
            'key'    => env('FILESYSTEM_S3_KEY'),
            'secret' => env('FILESYSTEM_S3_SECRET'),
            'region' => env('FILESYSTEM_S3_REGION'),
            'bucket' => env('FILESYSTEM_S3_BUCKET', 'shredz-com-v2'),
            'root'   => storage_path('app'), // Only used with local driver
        ],

        'shredz-carts' => [
            'driver' => env('FILESYSTEM_SHREDZ_CARTS_DRIVER', 's3'),
            'key'    => env('FILESYSTEM_S3_KEY'),
            'secret' => env('FILESYSTEM_S3_SECRET'),
            'region' => env('FILESYSTEM_S3_REGION'),
            'bucket' => env('FILESYSTEM_SHREDZ_CARTS_BUCKET', 'SHREDZ-CARTS'),
            'root'   => storage_path('app'), // Only used with local driver
        ],

        'shredz-site' => [
            'driver' => env('FILESYSTEM_SHREDZ_SITE_DRIVER', 's3'),
            'key'    => env('FILESYSTEM_S3_KEY'),
            'secret' => env('FILESYSTEM_S3_SECRET'),
            'region' => env('FILESYSTEM_S3_REGION'),
            'bucket' => env('FILESYSTEM_SHREDZ_SITE_BUCKET', 'SHREDZ-SITE'),
            'root'   => storage_path('app'), // Only used with local driver
        ],

        'rackspace' => [
            'driver'    => 'rackspace',
            'username'  => 'your-username',
            'key'       => 'your-key',
            'container' => 'your-container',
            'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
            'region'    => 'IAD',
            'url_type'  => 'publicURL',
        ],

    ],

];
