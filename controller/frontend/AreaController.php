<?php

require_once('model/AreaManager.php');
require_once ('model/NoteManager.php');

Class AreaController
{
	public function setMap($search)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$location = $search;
		$markers = $areaManager->getPlaces();
		
		require('view/frontend/mapView.php');
	}

	public function setMapwLatLng($lattitude,$longitude)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();
		
		$lat = $lattitude;
		$lng = $longitude;
		$markers = $areaManager->getPlaces();
		
		require('view/frontend/mapView.php');
	}

	public function formAddArea($lattitude,$longitude)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$lat = $lattitude;
		$lng = $longitude;
		$listCategory = $areaManager->listCategory();

		require('view/frontend/formAddAreaView.php');
	}

	public function addArea($name,$lattitude,$longitude,$content,$city,$category)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$addArea = $areaManager->addPlace($name,$lattitude,$longitude,$content,$city,$category);


		$_SESSION['success'] = 'Merci, le lieu est ajouté';

		$map = $this->setMapwLatLng($lattitude,$longitude);
 	}

 	public function showArea($idArea)
 	{
 		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();
 		$noteManager = new Cornelissen\Shapeplace\Model\NoteManager();

 		$area = $areaManager->getPlace($idArea);
 		$notes = $noteManager->getNotes($idArea);
 		$avgNote = $noteManager->averageNote($idArea);



 		require('view/frontend/areaView.php');
 	}

}