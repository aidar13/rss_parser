<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class FeedController extends Controller
{
    public function demo() {
        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

        $feeds = Feeds::make($url);

        $items = [];

        foreach ($feeds->get_items() as $feed ) {

            foreach ($feed->get_enclosures() as $enclosure) {
                $feed_enclosure = $enclosure->link;
            }

            $items [] = array(
                'title' => $feed->get_title(),
                'image' => $feed_enclosure,
                'short_description' => $feed->get_content(),
                'published_date' => $feed->get_date(),
                'author' => $feed->get_author(),
                'link' => $feed->get_link()
//                'guid' => $feed->get_guid()
            );
        }

        return $items;

        $data = array(
                'title'     => $feed->get_title(),
                'permalink' => $feed->get_permalink(),
                'items'     => $feed->get_items(),
            );

        return View::make('feed', $data);
    }
}
