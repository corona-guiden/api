<?php

namespace App\Jobs;

use App\QNA;
use App\Suggestion;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeSuggestions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://www.folkhalsomyndigheten.se/smittskydd-beredskap/utbrott/aktuella-utbrott/covid-19/fragor-och-svar';

        /** @var Crawler $crawler */
        $crawler = \Goutte::request('GET', $url);

        $crawler->filter('.accordion__item')->each(function ($node) {
            /** @var Crawler $node */
            $question = $node->filter('strong .accordion__item__title__text span')->first()->text();
            $answer = $node->filter('.textbody div:not(.accordion__meta) p')->first()->text();
            $sourceUpdatedAt = $node->filter('.textbody .accordion__meta .posted')->first()->text();
            $sourceUpdatedAt = explode('Uppdaterad:', $sourceUpdatedAt)[1];
            $questionId = (int) ltrim($node->attr('id'), '_');

            /** @var Model $suggestion */
            $suggestion = Suggestion::firstOrNew([
                'question_id' => $questionId,
            ], [
                'answer' => $answer,
                'question' => $question,
                'source' => 'fohm',
                'status' => 'new',
                'source_updated_at' => $sourceUpdatedAt,
            ]);

            if ($suggestion->exists() && $suggestion->answer !== $answer) {
                $suggestion->previous_answer = $suggestion->answer;
                $suggestion->source_updated_at = $sourceUpdatedAt;
                $suggestion->status = 'updated';
                $suggestion->answer = $answer;

                if ($suggestion->qna()->exists()) {
                    $qna = $suggestion->qna();
                    $qna->status = 'updated';
                    $qna->save();
                }
            }

            $suggestion->save();
        });
    }
}
