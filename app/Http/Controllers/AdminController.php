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
use Illuminate\Validation\Rule;

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

    public function newLink($slug)
     {

        $user = Auth::user();

        $page = Page::where('user_id', $user->id)
            ->where('slug', $slug)
            ->first();

            if($page) {

                return view('admin/make_links',[
                    'menu' => 'links',
                    'page' => $page
                ]);

            } else {
                return redirect('/admin');
            }
    }

    public function newLinkStore($slug, Request $request)
    {
        $user = Auth::user();

        $page = Page::where('user_id', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {

            $credentials = $request->validate([
                'active' => ['required', 'boolean'],
                'title' => ['required', 'min:3'],
                'href' => ['required', 'url'],
                'bgColor' => ['required'],
                'textColor' => ['required'],
                'borderType' => ['required', Rule::in(['square', 'rounded'])]
            ]);

            $totalLinks = Link::where('page_id', $page->id)->count();

            $newLink = new Link();
            $newLink->page_id = $page->id;
            $newLink->active = $credentials['active'];
            $newLink->order = $totalLinks;
            $newLink->title = $credentials['title'];
            $newLink->href = $credentials['href'];
            $newLink->bgColor = $credentials['bgColor'];
            $newLink->textColor = $credentials['textColor'];
            $newLink->borderType = $credentials['borderType'];

            $newLink->save();

            return redirect('/admin/'. $page->slug.'/links');

        } else {    
            return redirect('/admin');
        }
    }

    public function editLink($slug, $linkId)
    {
        
        $user = Auth::user();

        $page = Page::where('user_id', $user->id)
            ->where('slug', $slug)
            ->first();

        if($page) {

            $link = Link::where('page_id', $page->id)
                ->where('id', $linkId)
                ->first();
            
            if($link) {

                return view('admin/make_links', [
                    'menu' => 'links',
                    'page' => $page,
                    'link' => $link
                ]);
            }
        }
    }

    public function linkUpdate($slug, $linkid, Request $request) {

        $user = Auth::user();

        $page = Page::where('user_id', $user->id)
            ->where('slug', $slug)->first();

        if($page) {

            $link = Link::where('page_id', $page->id)
                ->where('id', $linkid)->first();

            if($link) {

            $credentials = $request->validate([
                'active' => ['required', 'boolean'],
                'title' => ['required', 'min:3'],
                'href' => ['required', 'url'],
                'bgColor' => ['required'],
                'textColor' => ['required'],
                'borderType' => ['required', Rule::in(['square', 'rounded'])]
            ]);

            $link->active = $credentials['active'];
            $link->title = $credentials['title'];
            $link->href = $credentials['href'];
            $link->bgColor = $credentials['bgColor'];
            $link->textColor = $credentials['textColor'];
            $link->borderType = $credentials['borderType'];
            $link->save();

            return redirect('/admin/'. $page->slug.'/links');
                
            }
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

    public function OrderUpdate($linkId, $order)
    {
        $user = Auth::user();

        $link = Link::find($linkId);

        $pagesUserId = [];

        $pagesUserIdLogged = Page::where('user_id', $user->id)->get();

        foreach($pagesUserIdLogged as $pageUserIdLogged) {

            $pagesUserId[] = $pageUserIdLogged->id;

        }

        if(in_array($link->page_id, $pagesUserId)) {

            if($link->order > $order) {

                $afterLinks = Link::where('page_id', $link->page_id)
                    ->where('order', '>=', $order)
                    ->get();

                foreach($afterLinks as $afterLink) {
                    $afterLink->order++;
                    $afterLink->save();
                }

            } elseif($link->order < $order) {

                $beforeLinks = Link::where('page_id', $link->page_id)
                    ->where('order', '<=', $order)
                    ->get();

                foreach($beforeLinks as $beforeLink) {
                    $beforeLink->order--;
                    $beforeLink->save();
                } 
            }

            $link->order = $order;
            $link->save();

            $allLinks = Link::where('page_id', $link->page_id)
            ->orderBy('order', 'ASC')
            ->get();

            foreach($allLinks as $linkKey => $linkItem) {
                $linkItem->order = $linkKey;
                $linkItem->save();
            }
        }

        return [];
    }
}
