<?php

namespace Modules\parser;

use PhantomInstaller\PhantomBinary;

class ParserStarter
{
    protected string $path;
    protected string $url;
    protected string $selector;

    /**
     * @param string $siteUrl section with articles or news, example: 'https://tjournal.ru/news'
     * @param string $articleSelector css-class of <a> tag with link of article, example: 'news-feed__item'
     * @param bool $lazyLoadOfArticles if lazy load articles by onscroll then this argument is true,
     * else if used pagination - then false
     * @return void
     */
    public function __construct(string $siteUrl, string $articleSelector, bool $lazyLoadOfArticles = true)
    {
        $url = parse_url($siteUrl);
        $siteUrl = "{$url['scheme']}://{$url['host']}";
        if ($siteUrl && $articleSelector) {
            $this->run($lazyLoadOfArticles ?
                new lazyLoadParser($siteUrl, $articleSelector) :
                new paginatedParser($siteUrl, $articleSelector));
        }
    }

    protected function run(BaseParser $parserInstance) {
        $parserInstance->setVariablesInTemplateJs();
        $parserInstance->executeParse();
    }
}
