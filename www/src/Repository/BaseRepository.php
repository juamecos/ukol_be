<?php

namespace App\Repository;

use App\Database\DatabaseAdapterFactory;
use PDO;
use PDOException;

class BaseRepository {
    protected $adapter;
    protected $table;

    public function __construct($table, $adapterType = 'MariaDB') {
        $this->table = $table;
        $this->adapter = DatabaseAdapterFactory::createAdapter($adapterType);
    }

    // Find a single element by its ID
    public function findOneElement($id) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = :id";
            $result = $this->adapter->query($query, ['id' => $id]);
            return $result ? $result : null;
        } catch (PDOException $e) {
            throw new \Exception("Error finding element: " . $e->getMessage());
        }
    }

    // Insert a single element into the database
    public function insertOneElement($data) {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
            $this->adapter->query($query, $data);
            return $this->adapter->lastInsertId();
        } catch (PDOException $e) {
            throw new \Exception("Error inserting element: " . $e->getMessage());
        }
    }

    // Update a single element in the database
    public function updateOneElement($id, $data) {
        try {
            $updates = join(', ', array_map(function($key) {
                return "$key = :$key";
            }, array_keys($data)));

            $data['id'] = $id;
            $query = "UPDATE {$this->table} SET $updates WHERE id = :id";
            $this->adapter->query($query, $data);
        } catch (PDOException $e) {
            throw new \Exception("Error updating element: " . $e->getMessage());
        }
    }

    // Insert multiple elements into the database
    public function insertManyElements($elements) {
        try {
            foreach ($elements as $element) {
                $this->insertOneElement($element);
            }
        } catch (PDOException $e) {
            throw new \Exception("Error inserting multiple elements: " . $e->getMessage());
        }
    }

    // Delete a single element from the database
    public function deleteOneElement($id) {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $this->adapter->query($query, ['id' => $id]);
        } catch (PDOException $e) {
            throw new \Exception("Error deleting element: " . $e->getMessage());
        }
    }

    // Find elements with optional filters, sorting, and pagination
    public function findElements($filters = [], $sort = null, $limit = null, $offset = null) {
        try {
            $query = "SELECT * FROM {$this->table}";

            if ($filters) {
                $filterQueries = array_map(function($key) {
                    return "$key = :$key";
                }, array_keys($filters));
                $query .= " WHERE " . implode(' AND ', $filterQueries);
            }

            if ($sort) {
                $query .= " ORDER BY " . implode(', ', array_map(function($field, $order) {
                    return "$field $order";
                }, array_keys($sort), $sort));
            }

            if ($limit) {
                $query .= " LIMIT $limit";
            }

            if ($offset) {
                $query .= " OFFSET $offset";
            }

            return $this->adapter->query($query, $filters);
        } catch (PDOException $e) {
            throw new \Exception("Error finding elements: " . $e->getMessage());
        }
    }

    // Count the number of elements in the table
    public function countElements() {
        try {
            $query = "SELECT COUNT(*) FROM {$this->table}";
            $result = $this->adapter->query($query);
            return $result[0]['COUNT(*)'];
        } catch (PDOException $e) {
            throw new \Exception("Error counting elements: " . $e->getMessage());
        }
    }
}
