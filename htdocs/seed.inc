<?php
 
class SEED
{
    protected $pdo;
 
    function __construct()
    {
		try {
			$db_config = array();
			$db_config['PDO_SGBD']		= 'mysql';
			$db_config['PDO_HOST']		= 'mariadb';
			$db_config['PDO_DB_NAME']	= 'testdrive';
			$db_config['PDO_USER']		= 'testdrive';
			$db_config['PDO_PASSWORD']	= 'testdrive';
			$db_config['PDO_OPTIONS']	= array(
				// Activation des exceptions PDO :
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				// Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			$this->pdo = new PDO($db_config['PDO_SGBD'] .':host='. $db_config['PDO_HOST'] .';dbname='. $db_config['PDO_DB_NAME'],
								$db_config['PDO_USER'],
								$db_config['PDO_PASSWORD'],
								$db_config['PDO_OPTIONS']);
			unset($db_config);
			// ----------------------------------------------------------------
			// Create database docker_lamp
			//$database = "docker_lamp";
			//$query = sprintf("CREATE DATABASE IF NOT EXISTS $database");
			$this->CreateTable('categories'); 
			$this->CreateTable('books'); 
		} catch(Exception $e) {
			include "./alert.php";
		}
	}
 
    function __destruct()
    {
        $this->db = null;
    }

    // Drop table
    public function DropTable($table)
    {
		$query = sprintf("DROP TABLE IF EXISTS $table");
		try {
			$this->pdo->exec($query);
		} catch(Exception $e) {
			include "./alert.php";
		} 
	}
 
    // Create table
	public function CreateTable($table) 
	{
		switch ($table) {
			case 'books':
				$query = sprintf("	CREATE TABLE IF NOT EXISTS $table (
										id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
										price DECIMAL(5,2) NOT NULL,
										title VARCHAR(30) NOT NULL,
										id_category INT(6) NOT NULL,
										created_at TIMESTAMP DEFAULT NOW(),
										updated_at TIMESTAMP DEFAULT NOW()
									)"
								);
				try {
					$this->pdo->exec($query);
				} catch(Exception $e) {
					include "./alert.php";
				} 
				break;
			case 'categories':
				$query = sprintf("	CREATE TABLE IF NOT EXISTS $table (
										id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
										name VARCHAR(30) NOT NULL,
										created_at TIMESTAMP DEFAULT NOW(),
										updated_at TIMESTAMP DEFAULT NOW()
									)"
								);
				try {
					$this->pdo->exec($query);
				} catch(Exception $e) {
					include "./alert.php";
				}
				break;
			default:
				break;
		}
	}

    // Add new Record
    public function SeedTable($table)
    {
		switch ($table) {
			case 'books':
				$query = sprintf("	INSERT INTO $table
										(title, price, id_category, created_at, updated_at)
									VALUES
										('php7', '25.00', '1', NOW(), NOW()),
										('Dune', '12.10', '2', NOW(), NOW()),
										('Mars la rouge', '22.80', '2', NOW(), NOW()),
										('L\'empreinte', '10.30', '3', NOW(), NOW()),
										('Orange amère', '9.70', '3', NOW(), NOW())
								");
				try {
					$this->pdo->exec($query);
				} catch(Exception $e) {
					include "./alert.php";
				} 

				// Add some books with bindValue and bind
				// bindValue
				$title = "MySQL 8";
				$price = '20,30';
				$id_category = '1';
				$stmt = $this->pdo->prepare('INSERT INTO books (title, price, id_category) VALUES (:title, :price, :id_category)');
				$stmt->bindValue('price', $price, PDO::PARAM_INT);
				$stmt->bindValue('title', $title, PDO::PARAM_STR);
				$stmt->bindValue('id_category', $id_category, PDO::PARAM_STR);
				try {
					$stmt->execute();
				} catch(Exception $e) {
					include "./alert.php";
				} 

				$title = "boostrap 4";
				$price = '22,20';
				$id_category = '1';
				$stmt->bindValue('price', $price, PDO::PARAM_INT);
				$stmt->bindValue('title', $title, PDO::PARAM_STR);
				$stmt->bindValue('id_category', $id_category, PDO::PARAM_STR);
				try {
					$stmt->execute();
				} catch(Exception $e) {
					include "./alert.php";
				} 

				// bindParam
				$title = "docker";
				$price = '28,60';
				$id_category = '1';
				$stmt = $this->pdo->prepare('INSERT INTO books (title, price, id_category) VALUES (:title, :price, :id_category)');
				$stmt->bindParam('price', $price, PDO::PARAM_INT);
				$stmt->bindParam('title', $title, PDO::PARAM_STR);
				$stmt->bindValue('id_category', $id_category, PDO::PARAM_STR);
				try {
					$stmt->execute();
				} catch(Exception $e) {
					include "./alert.php";
				} 

				$title = "Apache 2";
				$price = '16,30)';
				try {
					$stmt->execute();
				} catch(Exception $e) {
					include "./alert.php";
				}
				break;
			case 'categories':
				$query = sprintf("	INSERT INTO $table
										(name, created_at, updated_at)
									VALUES
										('Informatique', NOW(), NOW()),
										('Science Fiction', NOW(), NOW()),
										('Roman', NOW(), NOW())
								");
				try {
					$this->pdo->exec($query);
				} catch(Exception $e) {
					include "./alert.php";
				} 
				break;
			default:
				break;
		}
	}

    public function GetTable($table)
    {
		switch ($table) {
			case 'books':
				try {
					$stmt = $this->pdo->prepare('SELECT 
													b.id,
													b.title,
													b.price,
													DATE_FORMAT(b.created_at, "%d %M %Y at %Hh%i") as created_at, 
													DATE_FORMAT(b.updated_at, "%d %M %Y at %Hh%i") as updated_at,
													c.name AS category
												FROM
													books AS b
												LEFT JOIN
													categories c
												ON b.id_category = c.id
												ORDER BY
													b.id DESC
												LIMIT 0, :offset');
					$offset = 10;
					$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
					$stmt->execute();
					$books = $stmt->fetchAll(PDO::FETCH_OBJ);
				} catch(Exception $e) { 
					exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
				}
				return $books;
				break;
			case 'categories':
				//query to get data from the categories table
				try {
					$stmt = $this->pdo->prepare('SELECT id, name FROM categories ORDER BY name ASC LIMIT 0, :offset');
					$offset = 8;
					$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
					$stmt->execute();
					$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
				} catch(Exception $e) { 
					//exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
					include "./alert.php";
				}
				return $categories;
				break;
			default:
				break;
		}
	}
}

?>
