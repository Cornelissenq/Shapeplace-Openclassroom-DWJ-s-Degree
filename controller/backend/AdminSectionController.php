<?php 

require_once ('model/SectionManager.php');

Class AdminSectionController
{

	/*  --------------------- add section --------------------- */

	public function addSection()
	{
		require('view/backend/..');
	}

	public function addedSection($nameSection,$extractSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$add = $sectionManager->addSection($nameSection,$extractSection);

		$_SESSION['success'] = 'La section est ajoutée.';

		header('Location:..');
	}

	/*  --------------------- edit section --------------------- */

	public function editSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$edit = $sectionManager->getSection($idSection);

		require('view/backend/..');
	}

	public function editedSection($nameSection,$extractSection,$idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$edited = $sectionManager->editSection($nameSection,$extractSection,$idSection);

		$_SESSION['success'] = 'La section est modifiée';

		header('Location:..');
	}

	/*  --------------------- delete section --------------------- */
	
	public function deleteSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$delete = $sectionManager->deleteSection($idSection);

		$_SESSION['success'] = 'La section est supprimée';

		header('Location:..');
	}
}