<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function ShowRegisterForm(){
        return view('auth.registerForm');
    }

    public function Register(Request $request){
        try{
            // dd($request);
            $request ->validate([
                    'name'=>'required|string|min:3|max:40',
                    'email'=>'required|email|string|max:255|unique:users,email',
                    'password'=>'required|string|min:6|max:12',
                    'phone_number'=>[
                        'required',
                        'string',
                        'regex:/^08[0-9]{8,12}$/'
                    ]
                ]
            );

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone_number'=>$request->phone_number,
            ]);

            return redirect()->route('login')->with('success', 'successfully registered');
        } catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
            // dump($e->getMessage());
            // return back()->withErrors(provider: 'error', key: "error occured please check input");
        } catch(Exception $e){
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function ShowLoginForm(){
        return view('auth.loginForm');
    }

    public function Login(Request $request){
        try{
            $request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]);

            if(Auth::attempt(credentials: $request->only('email', 'password'))){
                $request->session()->regenerate();

                if(Auth::user()->role === 'admin'){
                    return redirect()->route('admin')->with('success', 'authenticated');
                }else{
                    return redirect()->route('catalog')->with('success', 'successfully login');
                }

            }else{
                // dump('login failed credentials is not found please try again');
                return back()->with('error','Credentials not found');
            }
        }catch(Exception $e){
                dump($e->getMessage());
        }
    }

    public function Logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
