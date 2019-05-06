<?php

class Repository
{
	private $id;
	private $owner_id;	
	private $name;
	private $watchers;
	private $stars;
	private $forks;
	private $url;

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

	public function getOwner_Id(){
		return $this->owner_id;
	}
	public function setOwner_Id($owner_id){
		$this->owner_id = $owner_id;
	}	

	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}

	public function getWatchers(){
		return $this->watchers;
	}
	public function setWatchers($watchers){
		$this->watchers = $watchers;
	}

	public function getStars(){
		return $this->stars;
	}
	public function setStars($stars){
		$this->stars = $stars;
	}

	public function getForks(){
		return $this->forks;
	}
	public function setForks($forks){
		$this->forks = $forks;
	}	

	public function getUrl(){
		return $this->url;
	}
	public function setUrl($url){
		$this->url = $url;
	}
}