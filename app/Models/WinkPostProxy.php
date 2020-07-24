<?php

namespace App\Models;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Wink\WinkPost;

class WinkPostProxy extends WinkPost implements Feedable
{
    public static function getFeedItems()
    {
        return static::latest()->published()->get();
    }

    public function toFeedItem()
    {
        return FeedItem::create()
            ->id(route('show-post', $this->slug))
            ->title($this->title)
            ->summary(!empty($this->excerpt) ? $this->excerpt : $this->meta['meta_description'])
            ->updated($this->publish_date)
            ->link(route('show-post', $this->slug))
            ->category('post')
            ->author('Christopher Pitt');
    }

    public function getContentAttribute()
    {
        if (! $this->markdown) {
            return $this->body;
        }

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new StrikethroughExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new TaskListExtension());

        $converter = new CommonMarkConverter([], $environment);

        return new HtmlString($converter->convertToHtml($this->body));
    }
}
