<?php 

require_once ('model/ProgramManager.php');

Class AdminProgramController
{
	public function tableProgram()
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();


		$list = $programManager->getAllPrograms();

		require('view/backend/tableProgramView.php');
	}
	/*  --------------------- add program --------------------- */

	public function addProgram()
	{

		require('view/backend/addProgramView.php');

	}

	public function addedProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$added = $programManager->addProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program);

		$_SESSION['success'] = 'Le programme est ajouté';

		header('Location: index.php?action=adminProgram');
		
	}

	/*  --------------------- edit program --------------------- */

		public function editProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$program = $programManager->getProgram($idProgram);

		require('view/backend/editProgramView.php');
	}

		public function editedProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$edited = $programManager->editProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram);

		$_SESSION['success'] = 'Le programme est modifié';

		header('Location: index.php?action=adminProgram');		

	}

	/*  --------------------- delete program --------------------- */

		public function deleteProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$delete = $programManager->deleteProgram($idProgram);

		$_SESSION['success'] = 'Le programme est supprimé';

		header('Location: index.php?action=adminProgram');
	}
}