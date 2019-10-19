<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class UserManager extends Manager
{
	public function login($pseudo,$pw)
	{
		$db = $this->dbConnect();

		$login = $db->prepare('SELECT * FROM user WHERE pseudo = ? AND pw = ?');
		$login->execute(array($pseudo,sha1($pw)));
		$result = $login->fetch();

		return $result;
	}

	public function checkPseudo($pseudo)
	{
		$db = $this->dbConnect();

		$login = $db->prepare('SELECT * FROM user WHERE pseudo = ?');
		$login->execute(array($pseudo));
		$pseudoTest = $login->fetch();

		return $pseudoTest;
	}

	public function checkEmail($email)
	{
		$db = $this->dbConnect();

		$login = $db->prepare('SELECT * FROM user WHERE email = ?');
		$login->execute(array($email));
		$emailTest = $login->fetch();

		return $emailTest;
	}
	public function register($pseudo,$pw,$name,$surname,$email,$date_birth,$city)
	{
		$db = $this->dbConnect();

		$register = $db->prepare('INSERT INTO user(pseudo,pw,role,name,surname,email,date_birth,city,date_creation) VALUES (?, ?, "user", ?, ?, ?, ?, ?, NOW())');
		$register->execute(array($pseudo,sha1($pw),$name,$surname,$email,$date_birth,$city));
	}
}
