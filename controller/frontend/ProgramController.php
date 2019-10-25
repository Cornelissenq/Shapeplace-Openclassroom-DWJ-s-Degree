<?php 

require_once ('model/ProgramManager.php');
require_once ('model/SectionManager.php');
require_once ('model/CommentManager.php');

Class ProgramController
{
	public function getSections()
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$sections = $sectionManager->getSections();

		require('view/frontend/listSection.php');
	}

	public function showPrograms($idSection)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$programs = $programManager->getPrograms($idSection);
		$section = $sectionManager->getSection($idSection);

		require('view/frontend/listProgram.php');
	}

	public function showProgram($idSection,$idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();		
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$section = $sectionManager->getSection($idSection);
		$program = $programManager->getProgram($idProgram);
		$comments = $commentManager->getCommentsProgram($idProgram);


		require('view/frontend/programView.php');
	}
}