<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment configuration from .env.testing
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env.testing');
$dotenv->load();