<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Click;
use App\Models\Page;
use App\Models\Link;
use App\Models\View;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();

        $links = Link::where('page_id', $page->id)
                        ->where('active', 1)
                        ->orderBy('order')
                        ->get();

        $view = View::firstOrNew(
            ['page_id' => $page->id, 'view_date' => date('Y-m-d')]
        );

        $view->total++;

        $view->save();

        if($page) {

            $bg = '#FFF';

            switch($page->bgType) {
                case 'image': 
                    $bg = "url('".url('/medias/uploads').'/'.$page->bgValue."')";

                break;
                
                case 'color': 

                    $colors = explode(',', $page->bgValue);

                    $bg = 'linear-gradient(90deg,';
                    $bg .= $colors[0].',';
                    $bg .= !empty($colors[1]) ? $colors[1] : $colors[0];
                    $bg .= ')';
                    
                break;
            }

            return view('page',[

                'fontColor' => $page->fontColor,
                'image' => url('/medias/uploads').'/'.$page->image,
                'title' => $page->title,
                'description' => $page->description,
                'fbPixel' => $page->fbPixel,
                'bg' => $bg,
                'links' => $links
            ]);

        } else {
            return view('404');
        } 
    } 
}
