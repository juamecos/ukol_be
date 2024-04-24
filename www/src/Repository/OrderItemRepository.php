<?php

namespace App\Repository;

use App\Model\OrderItem;

class OrderItemRepository extends BaseRepository {

    // Constructor to initialize with a specific database adapter and specify the table name
    public function __construct($adapterType = 'MariaDB') {
        parent::__construct('OrderItem',$adapterType ); 
    }
}