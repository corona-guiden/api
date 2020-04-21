<?php

namespace App\Jobs;

use App\WebsiteMonitor;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\HTMLToMarkdown\HtmlConverter;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeWebsiteMonitors implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $url;
    public string $dateSelector;
    public string $contentSelector;

    /**
     * Create a new job instance.
     *
     * @param $url
     * @param $dateSelector string  Selector for the updated at date
     * @param $contentSelector  string  Selector for the main HTML content
     */
    public function __construct($url, $dateSelector, $contentSelector)
    {
        $this->url = $url;
        $this->dateSelector = $dateSelector;
        $this->contentSelector = $contentSelector;
    }

    /**
     * Execute the job.
     *
     * @return WebsiteMonitor
     */
    public function handle()
    {
        $htmlConverter = new HtmlConverter();

        /** @var Crawler $crawler */
        $crawler = \Goutte::request('GET', $this->url);
        $scrapedDateString = $crawler->filter($this->dateSelector)->first()->text();
        $scrapedHtml = $crawler->filter($this->contentSelector)->html();
        $markdown = $htmlConverter->convert(strip_tags($scrapedHtml,'<p><a><h1><h2><h3><h4><h5><h6><ul><li><ol><br>'));
        $sourceUpdatedAt = Carbon::make($scrapedDateString);

        $websiteMonitor = WebsiteMonitor::firstOrNew([
            'url' => $this->url,
            'date_selector' => $this->dateSelector,
            'content_selector' => $this->contentSelector,
        ], [
            'source_updated_at' => $sourceUpdatedAt,
            'page_content' => $markdown,
            'status' => 'new'
        ]);

        if ($websiteMonitor->exists() && $sourceUpdatedAt->isAfter($websiteMonitor->source_updated_at)) {
            $websiteMonitor->page_content_previous = $websiteMonitor->page_content;
            $websiteMonitor->page_content = $markdown;
            $websiteMonitor->source_updated_at = $sourceUpdatedAt;
            $websiteMonitor->status = 'updated';
        }

        $websiteMonitor->save();

        return $websiteMonitor;
    }
}
