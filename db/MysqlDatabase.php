<?php

class MysqlDatabase
{
	private static ?MysqlDatabase $instance = null;
	private PDO $connection;
	private string $hostName = "db";
	private string $dbName = "flexinvoices";
	private string $userName = "root";
	private string $password = "flexadmin";

	private function __construct()
	{
		try {
			$this->connection = new PDO("mysql:host=$this->hostName;dbname=$this->dbName", $this->userName, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			exit("Connection failed: " . $e->getMessage());
		}
	}

	public static function getInstance(): MysqlDatabase
	{
		if (!self::$instance) {
			self::$instance = new MysqlDatabase();
		}

		return self::$instance;
	}

	public function getConnection(): PDO
	{
		return $this->connection;
	}
}