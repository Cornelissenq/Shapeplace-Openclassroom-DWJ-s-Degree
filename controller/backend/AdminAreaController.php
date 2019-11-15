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

		$urlSlug = preg_replace('~[^\pL\d]+~u', '-', $name);
		$urlSlug = iconv('utf-8', 'us-ascii//TRANSLIT', $urlSlug);
		$urlSlug = preg_replace('~[^-\w]+~', '', $urlSlug);
		$urlSlug = trim($urlSlug, '-');
		$urlSlug = preg_replace('~-+~', '-', $urlSlug);
		$urlSlug = strtolower($urlSlug);

		$edit = $areaManager->editArea($name,$urlSlug,$description,$city,$idCategory,$idArea);

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