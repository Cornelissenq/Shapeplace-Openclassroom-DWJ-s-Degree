<?php 

require_once ('model/ProgramManager.php');

Class AdminProgramController
{
	/*  --------------------- add program --------------------- */

	public function addProgram()
	{

		require('view/backend/..');

	}

		public function addedProgram($idSection,$nameProgram,$extractProgram,$contentProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$added = $programManager->addProgram($idSection,$nameProgram,$extractProgram,$contentProgram);

		$_SESSION['success'] = 'Le programme est ajouté';

		header('Location: ..');
		
	}

	/*  --------------------- edit program --------------------- */

		public function editProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$edit = $programManager->getProgram($idProgram);

		require('view/backend/..');
	}

		public function editedProgram($nameProgram,$extractProgram,$contentProgram,$idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$edited = $programManager->editProgram($nameProgram,$extractProgram,$contentProgram,$idProgram);

		$_SESSION['success'] = 'Le programme est modifié';

		header('Location: ..');		

	}

	/*  --------------------- delete program --------------------- */

		public function deleteProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$delete = $programManager->deleteProgram($idProgram);

		$_SESSION['success'] = 'Le programme est supprimé';

		header('Location: ..');
	}
}