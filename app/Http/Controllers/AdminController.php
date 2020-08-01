<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    
	public function login(){
        return view('auth/login');
    }

    public function logout(){
        Session::flush();
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = Admin::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('training');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public function register(Request $request){
        return view('auth/register');
    }

    public function registerPost(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:admins',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new Admin();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('auth/login')->with('alert-success','Kamu berhasil Register');
    }

}
