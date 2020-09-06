<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

	
}
