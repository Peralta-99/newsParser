<?php


namespace Modules\parser;


class lazyLoadParser extends BaseParser
{
    protected function getTemplateJsFileOfParse() {
        return "
            const page = require('webpage').create();
            const fs = require('fs');
            page.onConsoleMessage = function(msg) {
                console.log(msg);
            }
            const needArticlesCounter = %s;
            var numberOfAvailableArticles = 0;
            page.open('%s', function(status) {
                const intervalId = setInterval(function() {
                    if(numberOfAvailableArticles < needArticlesCounter) {
                        numberOfAvailableArticles = page.evaluate(function() {
                            window.scrollBy(0,500);
                            return document.querySelectorAll('a.%s').length;
                        });
                    }
                    else {
                        clearInterval(intervalId);
                        var articlesJsonLinks = page.evaluate(function() {
                            var all_links = [];
                            var links = document.querySelectorAll('a.%s');
                            if(!!links) {
                                [].forEach.call(links, function(link){
                                    all_links.push(
                                        link.getAttribute('href')
                                    );
                                });

                                var all_links_json = JSON.stringify(all_links);

                                return all_links_json;
                            }
                        });
                        fs.write('%s', articlesJsonLinks);
                        phantom.exit();
                    }
                }, 200);
            });
        ";
    }

    public function executeParse()
    {
        $this->executeFileWithPhantomJs();
        $this->writeDataToDb();
    }

    protected function writeDataToDb()
    {
        chdir(__DIR__ . '/js');
        if (file_exists($this->getJsonFileName())) {
            $arrOfLinks = json_decode(file_get_contents($this->getJsonFileName()));
            array_splice($arrOfLinks, $this->neededCountOfArticles);
            if (is_array($arrOfLinks)) {
                foreach ($arrOfLinks as $item) {
                    $this->scrapeFullArticle($item);
                }
            }
        }
    }

    protected function getArticleScraperScript()
    {
        return "
            const page = require('webpage').create();
            page.onConsoleMessage = function(msg) {
                console.log(msg);
            }
            page.open('%s', function(status) {
                if (status == 'success') {
                    console.log('hi');
                    phantom.exit();

                }
            });
        ";
    }
}
