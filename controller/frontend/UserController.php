<?php 

require_once ('model/UserManager.php');
require_once ('model/CommentManager.php');

Class UserController
{
	public function loginForm()
	{
		if (isset($_SESSION['id_user']))
		{
			$_SESSION['error'] = 'Vous êtes déja identifié.';

			header('Location: index.php?action=home ');
		}
		else
		{
			require('view/frontend/formLoginView.php');
		}
	}
	public function login($pseudo,$pw)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$result = $userManager->login($pseudo,$pw);

	
		if ($result)
		{

			if ($_POST['stayOnline'])
			{
				setcookie("id_user", $result['id'], time() + (86400 * 365));
				setcookie("pseudo", $result['pseudo'], time() + (86400 * 365));
				setcookie("avatar", $result['avatar'], time() + (86400 * 365));
				setcookie("role", $result['role'], time() + (86400 * 365));
			}
			
			
			$_SESSION['success'] = 'Vous êtes bien identifié.';

			$_SESSION['id_user'] = $result['id'];
			$_SESSION['pseudo'] = $result['pseudo'];
			$_SESSION['avatar'] = $result['avatar'];
			$_SESSION['role'] = $result['role'];

			header('Location: index.php');
		}
		else
		{
			session_start();
			$_SESSION['error'] = 'Mauvais identifiants, merci de réitérer votre demande.';

			header('Location: index.php?action=login');
		}
	}

	public function logout()
	{
		if (isset($_COOKIE['id_user']))
		{
			setcookie("id_user", "",time()-3600);
			setcookie("pseudo", "",time()-3600);
			setcookie("avatar", "",time()-3600);
			setcookie("role", "",time()-3600);	
		}
		$_SESSION = array();
		session_destroy();
		
		session_start();
		$_SESSION['success'] = 'Vous êtes bien déconnecté.';
		
		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	public function registerForm()
	{
		if (isset($_SESSION['id_user']))
		{
			session_start();
			$_SESSION['error'] = 'Vous êtes déja identifié.';

			header('Location: index.php');
		}
		else
		{
			require('view/frontend/formRegisterView.php');
		}
	}
	public function register($pseudo,$pw,$pw2,$name,$surname,$email,$date_birth,$city)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$pseudoTest = $userManager->checkPseudo($pseudo);
		$emailTest = $userManager->checkEmail($email);

		if (!$pseudoTest)
		{
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
			{
				if(!$emailTest)
				{
					if ($pw === $pw2)
					{
						$register = $userManager->register($pseudo,$pw,$name,$surname,$email,$date_birth,$city);
						$login = $this->login($pseudo,$pw);
					}
					else
					{
						$_SESSION['error'] = 'Veuillez saisir deux fois le même mot de passse.';

						header('refresh:0');
					}
				
				}
				else
				{
				$_SESSION['error'] = 'L\'adresse mail est déja utilisé.';

				header('refresh:0');
				}

			}
			else
			{
				$_SESSION['error'] = 'L\'adresse mail n\'est pas valide.';

				header('refresh:0');
			}
		}
		else
		{
			$_SESSION['error'] = 'Le nom d\'utilisateur est déja utilisé.';

			header('refresh:0');
		}
	}
	public function showProfil($idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$user = $userManager->getInfoUser($idUser);
		$comments = $commentManager->getCommentsUser($idUser);

		require('view/frontend/userProfilView.php');
	}

	public function editProfil($idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$user = $userManager->getInfoUser($idUser);

		require('view/frontend/editUserProfilView.php');
	}

	public function editAvatar($avatar,$idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		if ($avatar['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($avatar['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');

			$file = $_SESSION['id_user']. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
		        move_uploaded_file($avatar['tmp_name'], 'public/images/user/' . basename($file));                 
		        $avatarName = 'public/images/user/' .$file;
		        $userManager->editAvatar($avatarName,$idUser);
		        if (isset($_SERVER["HTTP_REFERER"]))
				{
					header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
				}
				else
				{
					header('Location: index.php?action=home');
				}
			}
			else
			{
				$_SESSION['error'] = 'L\'image doit être au format ".jpg/.jpeg/.png".';
				header('Location: index.php?action=editProfil');
			}
		}
		else
		{
			$_SESSION['error'] = 'L\'image doit faire moins de 2Mo.';
			header('Location: index.php?action=editProfil');
		}


				
	}

	public function editPw($pseudo,$pw,$newPw,$newPw2)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$result = $userManager->login($pseudo,$pw);

		if($result)
		{
			if ($newPw == $newPw2)
			{
				$editPw = $userManager->editPw($newPw,$pseudo);

				$_SESSION['success'] = 'Le nouveau mot de passe est bien pris en compte.';
				header('Location: ' .$_SERVER["HTTP_REFERER"]);
			}
			else
			{
				$_SESSION['error'] = 'Vos nouveaux mots de passe sont différents.';
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
		else
		{
			$_SESSION['error'] = 'L\'ancien mot de passe n\'est pas valable.';
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

	public function editMail($mail,$mail2,$idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		if($mail == $mail2)
		{
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
			{
				$userManager->editMail($mail,$idUser);

				$_SESSION['success'] = 'L\'adresse mail a bien été modifié.';
				if (isset($_SERVER["HTTP_REFERER"]))
				{
					header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
				}
				else
				{
					header('Location: index.php?action=home');
				}
			}
			else
			{
				$_SESSION['error'] = 'Merci de saisir une adresse mail valide';
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
		else
		{
			$_SESSION['error'] = 'Merci de saisir deux fois la même adresse.';
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

	public function editInsta($insta,$idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		if(preg_match("#^https://www\.instagram\.com/[a-z].{3}#",$insta))
		{
			$insta = $userManager->editInsta($insta,$idUser);

			$_SESSION['success'] = 'Le lien Instagram est pris en compte.';
			if (isset($_SERVER["HTTP_REFERER"]))
			{
				header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
			}
			else
			{
				header('Location: index.php?action=home');
			}
		}
		else
		{
			$_SESSION['error'] = 'Veuillez saisir un lien Instagram valide.';
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

	public function editCity($city,$idUser)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$city = $userManager->editCity($city,$idUser);

		$_SESSION['success'] = 'Le changement de ville est pris en compte.';
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