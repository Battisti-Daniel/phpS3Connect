<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\Storage;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Storage::resolve()->put('file.txt','S3 test!');

echo "Done!";