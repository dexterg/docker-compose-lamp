<?php

class Database {
	private static $dbName = 'testdrive';
	private static $dbHost = 'mariadb';
	private static $dbUsername = 'testdrive';
	private static $dbUserPassword = 'testdrive';
	private static $cont = null;
	
	public function __construct() {
	}

	public function __destruct() {
        self::$cont = null;
	}

	public static function connect() {
		if ( null == self::$cont ) {
			try {
				self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			} catch(PDOException $e) {
				die($e->getMessage()); 
			}
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
