<?php
require __DIR__ . '/db_connection.php';
 
class CRUD
{
 
    protected $db;
 
    function __construct()
    {
        $this->db = DB();
    }
 
    function __destruct()
    {
        $this->db = null;
    }
 
    /*
     * Add new Record
     *
     * @param $title
     * @param $price
     * @return $mixed
     * */
    public function Create($title, $price)
    {
		//echo "title=$title";
		//echo "price=$price";
        $query = $this->db->prepare("INSERT INTO books (title, price) VALUES (:title,:price)");
        $query->bindParam(":title", $title, PDO::PARAM_STR);
        $query->bindParam(":price", $price, PDO::PARAM_STR);
        $query->execute();
		//var_dump($query);
        return $this->db->lastInsertId();
    }

    /*
     * Read all records with FETCH_NUM
     *
     * @return $mixed
     * */
    public function Read_for_graph()
    {
        $query = $this->db->prepare("SELECT title,price FROM books");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
 
    /*
     * Read all records
     *
     * @return $mixed
     * */
    public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM books");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
    /*
     * Delete Record
     *
     * @param $book_id
     * */
    public function Delete($book_id)
    {
        $query = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $query->bindParam(":id", $book_id, PDO::PARAM_STR);
        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $title
     * @param $price
     * @return $mixed
     * */
    public function Update($title, $price, $book_id)
    {
        $query = $this->db->prepare("UPDATE books SET title = :title, price = :price, updated_at = NOW() WHERE id = :id");
		var_dump($query);
        $query->bindParam(":title", $title, PDO::PARAM_STR);
        $query->bindParam(":price", $price, PDO::PARAM_STR);
        $query->bindParam(":id", $book_id, PDO::PARAM_STR);
        $query->execute();
    }
 
    /*
     * Get Details
     *
     * @param $book_id
     * */
    public function Details($book_id)
    {
        $query = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $query->bindParam(":id", $book_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }
}
 
	function get_average( array $array_arg) :float {
		$average = 0;
		$sum = 0;
		foreach ($array_arg as $value) {
			$sum += $value;
		}
		return $sum/count($array_arg);
	}
?>
