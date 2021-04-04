<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Click;
use App\Models\Page;
use App\Models\View;
use App\Models\User;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'login', 'loginAction', 'register', 'registerAction'
        ]]);
    }

    public function index()
    {   
        $user = Auth::user();

        $pages = Page::where('user_id', $user->id)->get();
        
        return view('admin/index', compact('pages'));
    }

    public function login(Request $request)
    {
        return view('admin/users/login', [
            'error' => $request->session()->get('error')
        ]);
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);

        if(Auth::attempt($credentials)) {

            return redirect('/admin');
        } else {

            $request->session()->flash('error', 'Email e/ou senha não conferem');
            return redirect()->back();
        }
    }

    public function register(Request $request)
    {
        return view('admin/users/register', [
            'error' => $request->session()->get('error')
        ]);
    }

    public function registerAction(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);

        $hasEmail = User::where('email', $credentials['email'])->count();

        if($hasEmail === 0) {

            if(!$credentials) {
                
            $newUser = new User();
            $newUser->email = $credentials['email'];
            $newUser->password = Hash::make($credentials['password']);
            
            $newUser->save();

            Auth::login($newUser);

            return redirect('admin');

            } else {

                $request->session()->flash('error', 'Os campos não foram preenchidos');
                return redirect()->back();
            }
           
        } else {
            $request->session()->flash('error', 'Este email já tem uma conta existente');
            return redirect()->back();
        }
    }
    
    public function logout() 
    {
      Auth::logout();

      return redirect()->route('login');
    }

    public function pageLinks($slug)
    {
        $user = Auth::user();

        $page = Page::where('slug', $slug)
        ->where('user_id', $user->id)->first();

        $links = Link::where('page_id', $page->id)
            ->orderBy('order', 'ASC')->get();

        if($page) {

            return view('admin.pages.pageLinks', compact(['page', 'links']));
        } else {
            
            return redirect('/admin');
        }
    }

    public function pageDesign($slug)
    {
        return view('admin.pages.pageDesign');
    }

    public function pageStats($slug)
    {
        return view('admin.pages.pageStats');
    }
}
