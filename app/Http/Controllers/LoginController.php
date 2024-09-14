<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Services\Encryption;
use App\Admin;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        
        $title = 'Login Account';
        $data  = array();
        return view('admin.profile.login')->with(compact(['data', 'title']));
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputString = new Encryption();
        $this->middleware('guest:admin')->except('logout');
      
    }

    protected function guard()
    {
        return Auth::guard('admin');
        
    }

    public function login(Request $request){
        
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
            ]);

        if (\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'role' => 'admin'])){

            return redirect(route('dashboard'));
        }

        return redirect(route('admin.login'))->with('error', 'Invalid Email address or Password');
    }

    public function logout()
    {
       Auth::guard('admin')->logout();
       return redirect(route('admin.login'));
    }


 
}
