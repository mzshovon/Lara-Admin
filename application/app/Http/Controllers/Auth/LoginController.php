<?php

namespace App\Http\Controllers\Auth;

use App\Cart;
use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $departments = Department::with('categories')->latest()->get();
        $product_images = DB::table('product_images')
            ->groupBy('product_id')
            ->get();
        View::share('departments', $departments);
        View::share('product_images', $product_images);
    }

    public function showLoginForm()
    {
        session(['link' => url()->previous()]);
        return view('auth.login');
    }


    protected function authenticated(Request $request, $user)
    {
        return redirect(session('link'));
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect()->route( 'home');
    }
}
