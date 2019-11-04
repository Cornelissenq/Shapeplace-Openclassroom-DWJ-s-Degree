<?php

require_once('model/NoteManager.php');

Class NoteController
{
	public function showNotes($idArea)
	{
		$noteManager = new Cornelissen\Shapeplace\Model\NoteManager();

		$notes = $noteManager->getNotes($idArea);
	}

	public function addNote($idArea,$idUser,$pseudoUser,$note,$content)
	{
		$noteManager = new Cornelissen\Shapeplace\Model\NoteManager();

		$add = $noteManager->addNote($idArea,$idUser,$pseudoUser,$note,$content);

		$_SESSION['success'] = 'L\'avis est ajouté.';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	public function deleteNote($idNote)
	{
		$noteManager = new Cornelissen\Shapeplace\Model\NoteManager();

		$delete = $noteManager->deleteNote($idNote);

		$_SESSION['success'] = 'L\'avis est supprimé';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	
}