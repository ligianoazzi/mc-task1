<?php

class ServiceOwner
{
	private $db;
	private $owner;

	public function __construct(Conn $db, owner $owner)
	{
		$this->db = $db->connect();
		$this->owner = $owner;
	}

	public function list()
	{
		$query = "SELECT * FROM `owners`";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function find($name)
	{
		$query = "SELECT * FROM `owners` WHERE name = :name";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":name", $name);		
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}	

	public function save()
	{
		$query = "INSERT INTO `owners` (`id`, `name`) VALUES (:id, :name)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":id", $this->owner->getId());
		$stmt->bindValue(":name", $this->owner->getName());
		$stmt->execute();
		return $this->db->lastInsertId();
	}


	public function update()
	{
		$query = "UPDATE `owners` SET `name`=? WHERE `id`=?";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(1, $this->owner->getName());		
		$stmt->bindValue(2, $this->owner->getId());	

		$ret = $stmt->execute();

		return $ret;
	}

	public function delete(int $id)
	{
		$query = "DELETE FROM `owners`  WHERE `id`=:id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":id", $id);	

		$ret = $stmt->execute();

		return $ret;
	}
}