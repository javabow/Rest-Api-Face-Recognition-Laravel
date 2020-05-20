<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Elo;

class EloController extends Controller
{
    //
    public function index()
    {
    	$elo = Elo::where('id', '>', 1)->paginate(8);

    	return view('elo', ['elo' => $elo]);
    }

    public function add()
    {
    
    	return view('add_employee');
    
    }

    public function input(Request $request)
    {

        $this->validate($request,[
            'judul' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required',
            'type' => 'required'
        ]);

        //optimisasi untuk pemanggilan artikel pada URL
        $urlJudul = str_replace(' ', '-', $request->judul);

        $urlJudul = strtolower($urlJudul);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'gambar_guide';
        $file->move($tujuan_upload,$nama_file);

        $endpoint = "http:/localhost:9000/api/guide";
        try {
            
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', $endpoint, [
                'form_params' => [
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'url' => $urlJudul,
                    'image' => $nama_file,
                    'type' => $request->type    
                ]
            ]);

            $statusCode = $response->getStatusCode();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
        

        if ($statusCode == 201) {
            return redirect('/elo');
        }else{
            echo "Error API";
        }
    
    }

    public function edit($id)
	{

    	$pegawai = Elo::find($id);
    	return view('edit_employee', ['elo' => $pegawai]);

	}

	public function delete($id)
	{
	
	    $pegawai = Elo::find($id);
	    $pegawai->delete();
	    return redirect('/elo')->with('status', 'Data Berhasil Dihapus!');
	
	}

	public function update($id, Request $request)
	{
	    $this->validate($request,[
		   'nama' => 'required',
		   'alamat' => 'required'
	    ]);
	 
	    $pegawai = Elo::find($id);
	    $pegawai->nama = $request->nama;
	    $pegawai->alamat = $request->alamat;
	    $pegawai->save();

	    return redirect('/elo');
	}

}
