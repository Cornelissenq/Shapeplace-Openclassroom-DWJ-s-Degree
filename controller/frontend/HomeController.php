<?php



Class HomeController
{
	public function home()
	{
		require('view/frontend/homeView.php');
	}

	public function error()
	{
		require('view/frontend/errorView.php');
	}

	public function RGPD()
	{
		setcookie("RGPD","yes", time()+ (86400 * 365));

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	public function NORGPD()
	{
		setcookie("NORGPD","no", time()+(86400 * 365));

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}
	public function feedInsta()
	{
		require('view/frontend/feedInstagramView.php');
	}
}