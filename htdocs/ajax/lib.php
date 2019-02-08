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
	public function Create($title, $price, $id_category)
	{
		$query = $this->db->prepare("INSERT INTO books (title, price, id_category) VALUES (:title,:price,:id_category)");
		$query->bindParam(":title", $title, PDO::PARAM_STR);
		$query->bindParam(":price", $price, PDO::PARAM_STR);
		$query->bindParam(":id_category", $id_category, PDO::PARAM_STR);
		$query->execute();
		var_dump($query);
		return $this->db->lastInsertId();
	}

	/*
	 * Read all records with FETCH_NUM for books graph
	 *
	 * @return $mixed
	 * */
	public function Read_for_books_graph()
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
	 * Read all records with FETCH_NUM for categories graph
	 *
	 * @return $mixed
	 * */
	public function Read_for_categories_graph()
	{
		$query = $this->db->prepare("
									SELECT C.name, count(C.name) AS total
									FROM books AS B, categories AS C
									WHERE B.id_category = C.id
									GROUP BY B.id_category
									");
		$query->execute();
		$data = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}

	/*
	 * Read all categories records
	 *
	 * @return $mixed
	 * */
	public function Read_categories()
	{
		$query = $this->db->prepare("SELECT * FROM categories");
		$query->execute();
		$data = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}

	/*
	 * Read all books records
	 *
	 * @return $mixed
	 * */
	public function getBooksCount($limitinf = 0)
	{
		//$query = $this->db->prepare("SELECT * FROM books");
		$query = $this->db->prepare('SELECT count(id) FROM books');
		$query->execute();
		return $query->fetchColumn();
	}

	/*
	 * Read all books records
	 *
	 * @return $mixed
	 * */
	public function Read($limitinf = 0)
	{
		//$query = $this->db->prepare("SELECT * FROM books");
		$query = $this->db->prepare('SELECT 
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
									LIMIT :limitinf, :offset');
		$offset = 5;
		$query->bindValue('offset', $offset, PDO::PARAM_INT);
		$query->bindValue('limitinf', $limitinf, PDO::PARAM_INT);
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
	public function Delete($id)
	{
		$query = $this->db->prepare("DELETE FROM books WHERE id=:id");
		$query->bindParam(":id", $id, PDO::PARAM_STR);
		$query->execute();
	}
 
	/*
	* Update Record
	*
	* @param $title
	* @param $price
	* @return $mixed
	* */
	public function Update($title, $price, $id_category, $id)
	{
		$query = $this->db->prepare("UPDATE books SET title=:title, price=:price, id_category=:id_category, updated_at=NOW() WHERE id=:id");
		//var_dump($query);
		$query->bindParam(":title", $title, PDO::PARAM_STR);
		$query->bindParam(":price", $price, PDO::PARAM_STR);
		$query->bindParam(":id_category", $id_category, PDO::PARAM_STR);
		$query->bindParam(":id", $id, PDO::PARAM_STR);
		$query->execute();
	}
 
	/*
	 * Get Details
	 *
	 * @param $book_id
	 * */
	public function Details($id)
	{
		//$query = $this->db->prepare("SELECT * FROM books WHERE id=:id");
		$query = $this->db->prepare('SELECT 
										b.id,
										b.title,
										b.price,
										c.id AS category_id
									FROM
										books AS b
									LEFT JOIN
										categories c
									ON b.id_category = c.id
									WHERE
										b.id=:id
									');
		$query->bindParam(":id", $id, PDO::PARAM_STR);
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
