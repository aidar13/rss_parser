<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Request;
use Illuminate\Support\Carbon;
use Vedmant\FeedReader\Facades\FeedReader;

class MainController extends Controller
{
    public function index(){
        $items = News::orderBy('published_date', 'desc')
            ->paginate(12);

        return view('admin.pages.feed.index', compact('items'));
    }

    public function getUpdates(){
        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';
        $f = FeedReader::read($url);

        foreach ($f->get_items() as $item ){
            if(!News::where('link', $item->get_link())->first()) {
                $feed = [
                    'title' => $item->get_title(),
                    'link' => $item->get_link(),
                    'short_description' => $item->get_content(),
                    'published_date' => Carbon::parse($item->get_date())->format('d-m-Y H:i:s'),
                    'author' => $item->get_author() ? $item->get_author()->email : '',
                    'image' => $item->get_enclosures()[0]->link ? $item->get_enclosures()[0]->link : ''
                ];

                News::create($feed);
            }
        }

        Request::create([
            'method' => 'GET',
            'url' => $url,
            'response_code' => 200,
            'response_body' => $f,
        ]);

        return redirect()->back()->with('success', "News successfully updated");
    }

    public function requests(){
        $items = Request::orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.pages.request.index', compact('items'));
    }
}
