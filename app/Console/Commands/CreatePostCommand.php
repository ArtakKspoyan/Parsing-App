<?php

namespace App\Console\Commands;

use App\Models\Parsing;
use http\Client\Response;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;
use Vedmant\FeedReader\Facades\FeedReader;

class CreatePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posts Create Command';

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
        $infos = FeedReader::read('http://static.feed.rbc.ru/rbc/logical/footer/news.rss');
        foreach ($infos->get_items() as $info){
            try {
                Parsing::create([
                    'title' => $info->get_title(),
                    'link' => $info->get_link(),
                    'description' => $info->get_description(),
                    'author' => $info->get_author()->email ?? null,
                    'pubDate' => $info->get_date(),
                    'image' => $info->get_enclosure()->link ?? null
                ]);
                $response = \response()->json([
                    'error' => false,
                    'code'  => 200,
                    'message' => 'Post added!'
                ], 200);;

            } catch (Throwable $e) {
                $response = \response()->json([
                    'error' => true,
                    'code'  => 500,
                    'message' => 'Post do not added!'
                ], 500);
            }

            $dt = Carbon::now();
            $date = $dt->toDateTimeString();
            $parsingLogs = [
                'date' => $date,
                'request_method' => 'Get',
                'request_url' => 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss',
                'response_http_code' => $response->status(),
                'response_body' => $response->content(),
            ];
            DB::table('parsing_logs')->insert($parsingLogs);

        }
        $this->info('Crated posts success');
    }
}
