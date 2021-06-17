<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleXMLElement;
use Vedmant\FeedReader\Facades\FeedReader;

class MainController extends Controller
{
    public function index(){
        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';
        $f = FeedReader::read($url);

        foreach ($f->get_items() as $item ){
            $feed = [
                'title' => $item->get_title(),
                'link' => $item->get_link(),
                'short_description' => $item->get_content(),
                'published_date' => date('y-m-d h:m:s', strtotime($item->get_date())),
                'author' => $item->get_author() ? $item->get_author()->email : '',
                'image' => $item->get_enclosures()[0]->link ? $item->get_enclosures()[0]->link : ''
            ];

            News::firstOrCreate($feed);
        }

        $items = News::orderBy('published_date')
            ->paginate(10);

        return view('admin.pages.feed.index', compact('items'));
    }
}
