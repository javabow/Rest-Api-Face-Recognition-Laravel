<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Session;
use File;

class TrainingController extends Controller
{
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
            
        	$endpoint = "http:/localhost:9000/api/mahasiswa";

			$client = new \GuzzleHttp\Client();

			$response = $client->request('GET', $endpoint);

			$statusCode = $response->getStatusCode();
			$content = json_decode($response->getBody(), true);

			if ($statusCode == 200) {
				return view('training', ['mahasiswa' => $content]);
			}else{
				echo "Error API";
			}

        
	
	}

	public function search($query)
	{
		$endpoint = "http:/localhost:9000/api/mahasiswa/search/$query";

		$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

		$statusCode = $response->getStatusCode();
		$content = json_decode($response->getBody(), true);

		if ($statusCode == 200) {
			return view('training', ['mahasiswa' => $content]);
		}else{
			echo "Error API";
		}
		
	}

	public function delete($id, $nim)
    {
    
    	//POP data yang akan dihapus dimana tersimpan dalam dataset
		$command = escapeshellcmd("C:/Users/Javabow/AppData/Local/Programs/Python/Python37/python.exe E:/web/htdocs/test/Rest-Api-Face-Recognition-Laravel/public/delete_encoded.py $nim");

		// echo (shell_exec($command));

		if (shell_exec($command)) {

			$endpoint = "http:/localhost:9000/api/mahasiswa/$id";

			$client = new \GuzzleHttp\Client();

			$response = $client->request('delete', $endpoint);

			$statusCode = $response->getStatusCode();
			$content = json_decode($response->getBody(), true);

			//path untuk delete directory gambar yang sebelumnya tersimpan
		    $path = public_path().'/gambar_mahasiswa/'.$nim;

		    //delete directory mahasiswa yang berisi gambar
		    File::deleteDirectory($path);
			if ($statusCode == 204) {
				Session::flash('message', 'Sukses Menghapus Data Training !');

		    	return redirect('/training');
			}else{
				echo "Error API";
			}
	    	
	    }

    	
    
    }

	public function add()
    {
    
    	return view('addtraining');
    
    }

	public function edit($id)
    {

    	$endpoint = "http:/localhost:9000/api/mahasiswa/$id";

		$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

		$statusCode = $response->getStatusCode();
		$content = json_decode($response->getBody(), true);
		if ($statusCode == 200) {
			return view('edit_training', ['datamhs' => $content]);
		}else{
			echo "Error API";
		}
    
    }

    public function update($id, Request $request)
    {
    	
    	$this->validate($request,[
            'nim' => 'required',
            'nimlama' => 'required',
            'nama' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg|max:4096'
        ]);

        $endpoint = "http:/localhost:9000/api/mahasiswa/$id";
        try {
            
            $client = new \GuzzleHttp\Client();

            $response = $client->request('PUT', $endpoint, [
                'json' => [
                    'nim' => $request->nim,
                    'nama' => $request->nama 
                ]
            ]);

            $statusCode = $response->getStatusCode();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            return $e->getResponse()->getBody()->getContents();
        }

        

        if ($statusCode == 200) {

        	if ($request->nim != $request->nimlama) {
			    $pathlama = public_path().'/gambar_mahasiswa/'.$request->nimlama;
			    $pathbaru = public_path().'/gambar_mahasiswa/'.$request->nim;

			    rename ($pathlama, $pathbaru);
			    $nimlama = $request->nimlama;

			    if ($request->gambar == null) {
			    	$nim = $request->nim;
					$command = escapeshellcmd("C:/Users/Javabow/AppData/Local/Programs/Python/Python37/python.exe E:/web/htdocs/test/Rest-Api-Face-Recognition-Laravel/public/mencoba4.py $nim $nimlama");
					if (shell_exec($command)) {
	    				Session::flash('message', 'Sukses Update NIM Data Training !');

	    				return redirect('/training');
	    			}
			    }

			}else{
			    $nimlama = 'none';
			}

        	if ($request->gambar != null) {
        		// menyimpan data file yang diupload ke variabel $file
		        $file = $request->file('gambar');
		        $nama_file = time()."_".$file->getClientOriginalName();

		    	//check directory nim untuk menyimpan gambar, jika belum ada buat dan upload
		        $path = public_path().'/gambar_mahasiswa/'.$request->nim;

		        //delete directory mahasiswa yang berisi gambar untuk mengganti dengan yang baru
		        File::deleteDirectory($path);

				if (File::isDirectory($path) or File::makeDirectory($path, 0777, true, true)) {
					$file->move($path,$nama_file);
				}

				$nim = $request->nim;
				$command = escapeshellcmd("C:/Users/Javabow/AppData/Local/Programs/Python/Python37/python.exe E:/web/htdocs/test/Rest-Api-Face-Recognition-Laravel/public/mencoba4.py $nim $nimlama");
				if (shell_exec($command)) {
    				Session::flash('message', 'Sukses Edit Data Training !');

    				return redirect('/training');
    			}
        	}
        Session::flash('message', 'Sukses Edit Data Training !');
        return redirect('/training');   
        
        }else{
            echo "Error API";
        }

    }

	public function train(Request $request)
    {

        $this->validate($request,[
            'nim' => 'required',
            'nama' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
            'id_admin' => 'required'
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();

        //check directory nim untuk menyimpan gambar, jika belum ada buat dan upload
        $path = public_path().'/gambar_mahasiswa/'.$request->nim;
		if (File::isDirectory($path) or File::makeDirectory($path, 0777, true, true)) {
			$file->move($path,$nama_file);
		}

        $endpoint = "http:/localhost:9000/api/mahasiswa";
        try {
            
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', $endpoint, [
                'form_params' => [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'id_admin' => $request->id_admin
                ]
            ]);

            $statusCode = $response->getStatusCode();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            return $e->getResponse()->getBody()->getContents();
        }

        $nimlama = 'none';

		$nim = $request->nim;
		$command = escapeshellcmd("C:/Users/Javabow/AppData/Local/Programs/Python/Python37/python.exe E:/web/htdocs/test/Rest-Api-Face-Recognition-Laravel/public/mencoba4.py $nim $nimlama");

        if ($statusCode == 201) {
        	if (shell_exec($command)) {
    			Session::flash('message', 'Sukses Menambahkan Data Training !');

    			return redirect('/training');
    		}
            
        }else{
            echo "Error API";
        }
    
    }

}
