<?php

require_once "classes/Curl.php";
require_once "classes/GetData.php";
require_once "classes/Conn.php";
require_once "classes/Repository.php";
require_once "classes/ServiceRepository.php";
require_once "classes/Owner.php";
require_once "classes/ServiceOwner.php";

$GetData = new GetData;
$page = 1;
$db = new Conn("mysql.ligiano.info", "ligiano18", "ligiano18", "dloehsnxu8");

$repository = new repository;
$service_repository = new ServiceRepository($db, $repository);

$owner = new owner;
$service_owner = new ServiceOwner($db, $owner);

$repositories = array("laravel", "symfony");

foreach ($repositories as  $value) {

	do {
		$url = "https://api.github.com/users/".$value."/repos?page=".$page."&client_id=b465d105aee4311167a0&client_secret=2706124575d73acdb35cef112f5686cdba73c6f0"; 

		$return = $GetData->get($url);

		if ( !empty($return) ) {

			foreach ($return as $value) {
			    
			    echo '<br>'; 
				echo "ID: ".$value['id']."<br>";
				echo "Repository Name: ".$value['name']."<br>";
				echo "Owner ID: ".$value['owner']['id']."<br>";
				echo "Owner Name: ".$value['owner']['login']."<br>";

				echo "watchers_count: ".$value['watchers_count']."<br>";

				echo "forks ".$value['forks']."<br>";
				echo "stargazers_count: ".$value['stargazers_count']."<br>";
				echo "url: ".$value['url'];

				echo "<br>-------------------------------------------------------<br>";


				$find_r = $service_repository->find($value['name']);
				
				if (empty($find_r)){ // first need to know if needs to insert the repository
					
					echo "inserting repository:<b>".$value['name']."</b><br>";

					$repository->setId($value['id']);
					$repository->setOwner_Id($value['owner']['id']);
					$repository->setName($value['name']);
					$repository->setWatchers($value['watchers_count']);
					$repository->setStars($value['stargazers_count']);
					$repository->setForks($value['forks']);
					$repository->setUrl($value['url']);
					$insert_repository = $service_repository->save();
					echo $insert_repository."<br>";

					$find_o = $service_owner->find($value['owner']['login']);
					if (empty($find_o)){
						$owner->setId($value['owner']['id']);
						$owner->setName($value['owner']['login']);
						$insert_owner =  $service_owner->save();
						echo $insert_owner."<br>"; 
					} 

				} else {

					echo "<b>".$value['name']." </b>is already in the database.";

				}

				echo "<br>-------------------------------------------------------<br><br>";
			}

		}

		$page ++;

	}
	while ( !empty($return) );

}