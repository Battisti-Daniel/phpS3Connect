<?php

namespace App;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class Storage
{
    public static function resolve(): FileStorage
    {

        $storage = $_ENV['FILE_STORAGE'];

        if ($storage === "local") {
            return new LocalStorage();
        } else if ($storage === "s3") {
            $client = new S3Client([
                'version' => 'latest',
                'region' => 'us-west-2',
                'credentials' => [
                    'key' => $_ENV['S3_KEY'],
                    'secret' => $_ENV['S3_SECRET'],
                ],
            ]);

            return new S3Storage($client, $_ENV['S3_BUCKET']);
        }

        throw new \Exception("Invalid storage method!");
    }
}