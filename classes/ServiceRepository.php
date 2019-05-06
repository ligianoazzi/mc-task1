<?php

class ServiceRepository
{
	private $db;
	private $repository;

	public function __construct(Conn $db, repository $repository)
	{
		$this->db = $db->connect();
		$this->repository = $repository;
	}

	public function list()
	{
		$query = "SELECT * FROM `repositories`";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

	public function find($name)
	{
		$query = "SELECT * FROM `repositories` WHERE name = :name";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":name", $name);		
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}	

	public function save()
	{
		$query = "INSERT INTO `repositories` (`id`, `owner_id`, `name`, `watchers`, `stars`, `forks`, `url`) VALUES (:id, :owner_id, :name, :watchers, :stars, :forks, :url)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":id", $this->repository->getId());
		$stmt->bindValue(":owner_id", $this->repository->getOwner_Id());
		$stmt->bindValue(":name", $this->repository->getName());		
		$stmt->bindValue(":watchers", $this->repository->getWatchers());
		$stmt->bindValue(":stars", $this->repository->getStars());		
		$stmt->bindValue(":forks", $this->repository->getForks());	
		$stmt->bindValue(":url", $this->repository->getUrl());		



		$stmt->execute();
		return $this->db->lastInsertId();
	}


	public function update()
	{
		$query = "UPDATE `repositories` SET `name`=? WHERE `id`=?";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(1, $this->repository->getName());		
		$stmt->bindValue(2, $this->repository->getId());	

		$ret = $stmt->execute();

		return $ret;
	}

	public function delete(int $id)
	{
		$query = "DELETE FROM `repositories`  WHERE `id`=:id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":id", $id);	

		$ret = $stmt->execute();

		return $ret;
	}
}