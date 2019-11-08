<?php 

require_once ('model/AreaManager.php');

Class AdminAreaController
{

	public function tableArea()
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$list = $areaManager->getPlaces();

		require('view/backend/tableAreaView.php');
	}

	public function editArea($idArea)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$area = $areaManager->getPlace($idArea);

		require('view/backend/editAreaView.php');
	}

	public function editedArea($name,$description,$city,$idCategory,$idArea)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		$edit = $areaManager->editArea($name,$description,$city,$idCategory,$idArea);

		$_SESSION['success'] = 'Le spot est modifié';
		header('Location: ../adminSpot/');
	}

	public function deleteArea($idArea)
	{
		$areaManager = new Cornelissen\Shapeplace\Model\AreaManager();

		if ($_SESSION['role'] == 'superAdmin')
		{
			$delete = $areaManager->deleteArea($idArea);
			$_SESSION['success'] = 'Le spot est supprimé';
		}
		else
		{
			$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaires';
		}

		header('Location: ../adminSpot/');
	}
}