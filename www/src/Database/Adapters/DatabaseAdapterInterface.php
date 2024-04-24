<?php

namespace App\Database\Adapters;

interface DatabaseAdapterInterface {
    public function connect();
    public function query($query);
    public function lastInsertId();
    public function disconnect();
}
