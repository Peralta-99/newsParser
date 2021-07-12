<?php

namespace Modules\parser;

use PhantomInstaller\PhantomBinary;

abstract class BaseParser
{
    private string $pathToBinPhantom = PhantomBinary::BIN;
    protected string $url;
    protected string $selector;
    protected string $readyToExecuteJs;
    private string $scriptFileName;
    protected int $neededCountOfArticles;

    public function __construct(string $url, string $selector, int $neededCountOfArticles)
    {
        if (is_executable($this->pathToBinPhantom)) {
            $this->url = $url;
            $this->selector = $selector;
            $this->neededCountOfArticles = $neededCountOfArticles;
        }
    }

    abstract public function executeParse();

    public function setVariablesInTemplateJs() {
        $this->readyToExecuteJs = sprintf($this->getTemplateJsFileOfParse(), $this->url, $this->selector, $this->neededCountOfArticles);
    }

    private function getReadyJs() {
        return $this->readyToExecuteJs;
    }

    protected function executeFileWithPhantomJs() {
        if ($this->writeToJsFile()) {
            chdir(__DIR__ . '/js');
            $dir = getcwd();
            $pathToExecuteJsFile = "{$this->pathToBinPhantom} {$dir}/{$this->scriptFileName}";
            exec($pathToExecuteJsFile);
        };
    }

    private function writeToJsFile() {
        $hash = md5($this->url) . "_{$this->selector}_{$this->neededCountOfArticles}";
        $this->scriptFileName = $hash . '.js';
        chdir(__DIR__ . '/js');
        return file_exists($this->scriptFileName) ? true : file_put_contents($this->scriptFileName, $this->getReadyJs());
    }

    /**
     * @return string
     */
    abstract protected function getTemplateJsFileOfParse();
}
