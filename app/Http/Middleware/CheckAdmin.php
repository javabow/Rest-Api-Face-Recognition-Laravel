<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id = Auth::id();

        $id_content = $request->route()->parameter('id');

        $endpoint = "http:/localhost:9000/api/mahasiswa/".$id_content;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        if ($statusCode == 200) {

            if ($content['id_admin'] != $id) {
                Session::flash('message', 'Anda tidak mempunyai akses untuk data ini !');
                Session::flash('alert-class', 'alert-danger');
                return redirect(route('training'));
            }

        }else{
            echo "Error API";
        }

        return $next($request);
  
    }
}
