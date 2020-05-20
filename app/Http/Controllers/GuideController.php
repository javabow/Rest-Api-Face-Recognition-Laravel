<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    
	public function index()
	{
		$endpoint = "http:/localhost:9000/api/guide";

		$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

		$statusCode = $response->getStatusCode();
		$content = json_decode($response->getBody(), true);

		if ($statusCode == 200) {
			return view('guide', ['guide' => $content]);
		}else{
			echo "Error API";
		}
		
	}

}
