<?php 

require_once ('model/UserManager.php');

Class AdminUserController
{
	public function tableUser()
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		if($_SESSION['role'] == 'superAdmin')
		{
			$list = $userManager->listUser();

			require('view/backend/tableUserView.php');
		}
		else
		{
			header('Location: index.php?action=admin');
		}	
	}

	public function givePower($idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$give = $userManager->givePower($idUser);

		$_SESSION['success'] = 'Les droits sont mis en place.';
		header('Location: index.php?action=adminUser');
	}

	public function remainPower($idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$give = $userManager->remainPower($idUser);

		$_SESSION['success'] = 'Les droits sont enlevé.';
		header('Location: index.php?action=adminUser');
	}

	public function deleteUser($idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$give = $userManager->deleteUser($idUser);

		$_SESSION['success'] = 'L\'utilisateur est supprimé.';
		header('Location: index.php?action=adminUser');
	}
}