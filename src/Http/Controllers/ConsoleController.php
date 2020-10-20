<?php

namespace Bagoesz21\ConsoleBrowser\Http\Controllers;

use Bagoesz21\ConsoleBrowser\Console;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
	public function index()
	{
		return view('console-browser::console');
	}

	public function execute(Request $request)
	{
        $code = $request->get('code');
        //dd($code);

		// Execute and profile the code
		$profile = Console::execute($code);

		// Terminate on error, as Error Handler already responded.
		if (isset($profile['error']) and $profile['error']) {
			exit;
		}

		// Response
		return response()->json($profile);
    }

}
