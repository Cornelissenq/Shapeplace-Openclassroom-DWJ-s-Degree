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

		$register = $db->prepare('INSERT INTO user(pseudo,pw,role,name,surname,email,date_birth,city,date_inscription) VALUES (?, ?, "user", ?, ?, ?, ?, ?, NOW())');
		$register->execute(array($pseudo,sha1($pw),$name,$surname,$email,$date_birth,$city));
	}

	public function getInfoUser($idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,DATE_FORMAT(date_birth, \'Le %d/%m/%Y\') AS date_birth_fr FROM user WHERE id = ? ');
		$req->execute(array($idUser));

		$user = $req->fetch();

		return $user;
	}

	public function editPw($newPw,$pseudo)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET pw = ? WHERE pseudo = ?');
		$req->execute(array(sha1($newPw),$pseudo));

	}
	public function editAvatar($avatarName,$idUser)
	{
		$db = $this->dbConnect();

		$avatar = $db->prepare('UPDATE user SET avatar = ? WHERE id = ?');
		$avatar->execute(array($avatarName,$idUser));
	}
	public function editInsta($insta,$idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET instagram = ? WHERE id = ?');
		$insta = $req->execute(array($insta,$idUser));
	}
	public function editMail($mail,$idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET email = ? WHERE id = ?');
		$req->execute(array($mail,$idUser));
	}

	public function editCity($city,$idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET city = ? WHERE id = ?');
		$req->execute(array($city,$idUser));
	}

	/*  ------------------------------------------ Backend ------------------------------------------ */

	public function listUser()
	{
		$db = $this->dbConnect();

		$list = $db->query('SELECT * FROM user ORDER BY date_inscription DESC');

		return $list;
	}

	public function givePower($idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET role = "admin" WHERE id = ?');
		$req->execute(array($idUser));
	}

	public function remainPower($idUser)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE user SET role = "user" WHERE id = ?');
		$req->execute(array($idUser));
	}

	public function deleteUser($idUser)
	{
		$db = $this->dbConnect();

		$delete = $db->prepare('DELETE FROM user WHERE id = ?');
		$delete->execute(array($idUser));
	}


}
