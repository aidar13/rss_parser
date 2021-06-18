<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Vedmant\FeedReader\Facades\FeedReader;

class GetUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get updates of news';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';
//        $f = FeedReader::read($url);
//
//        foreach ($f->get_items() as $item ){
//            if(!News::where('link', $item->get_link())->first()) {
//                $feed = [
//                    'title' => $item->get_title(),
//                    'link' => $item->get_link(),
//                    'short_description' => $item->get_content(),
//                    'published_date' => Carbon::parse($item->get_date())->format('d-m-Y H:i:s'),
//                    'author' => $item->get_author() ? $item->get_author()->email : '',
//                    'image' => $item->get_enclosures()[0]->link ? $item->get_enclosures()[0]->link : '' //Error: ceil(): Argument #1 ($num) must be of type int|float, string given
//                ];
//
//                News::create($feed);
//            }
//        }
//
//        Request::create([
//            'method' => 'GET',
//            'url' => $url,
//            'response_code' => 200,
//            'response_body' => $f,
//        ]);

        $this->info('News successfully updated.');
    }
}
