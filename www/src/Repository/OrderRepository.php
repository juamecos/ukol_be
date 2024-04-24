<?php

namespace App\Repository;

use App\Model\Order;
use Exception;

class OrderRepository extends BaseRepository {

    // Constructor to initialize with a specific database adapter and specify the table name
    public function __construct($adapterType = 'MariaDB') {
        parent::__construct('orders',$adapterType );
    }
}
