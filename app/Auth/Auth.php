<?php

namespace App\Auth;

use DI\Container;


class Auth
{
	public function check()
	{
		return isset($_SESSION['auth']);
	}

	public function logout()
	{
		unset($_SESSION);
	}
	
}