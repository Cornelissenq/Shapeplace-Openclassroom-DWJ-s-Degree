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

	public function formAddArea($lat,$lng,$search)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$listCategory = $areaManager->listCategory();

		require('view/frontend/formAddAreaView.php');
	}

	public function addArea($name,$lat,$lng,$content,$city,$category)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$addArea = $areaManager->addPlace($name,$lat,$lng,$content,$city,$category);


		$_SESSION['success'] = 'Merci, le lieu est ajouté';

		header('Location: index.php?action=home');
 	}

 	public function showArea($idArea,$search)
 	{
 		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();
 		$noteManager = new Cornelissen\Shapeplace\Model\NoteManager();

 		$location = $search;
 		$area = $areaManager->getPlace($idArea);
 		$notes = $noteManager->getNotes($idArea);
 		$avgNote = $noteManager->averageNote($idArea);



 		require('view/frontend/areaView.php');
 	}

}