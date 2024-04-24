<?php

namespace App\Database;


use App\Database\Adapters\MariaDBAdapter;
use App\Database\Adapters\DatabaseAdapterInterface;

// use App\Database\Adapters\ElasticsearchAdapter;

class DatabaseAdapterFactory {
    public static function createAdapter($type): DatabaseAdapterInterface {
        switch ($type) {
            case 'MariaDB':
                return new MariaDBAdapter();  // Direct instantiation
            default:
                throw new \Exception("Unsupported database type: $type");
        }
    }
}