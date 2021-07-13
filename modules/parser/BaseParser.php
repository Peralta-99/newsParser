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
    private string $jsonFileName;

    public function __construct(string $url, string $selector, int $neededCountOfArticles)
    {
        if (is_executable($this->pathToBinPhantom)) {
            $this->url = $url;
            $this->selector = $selector;
            $this->neededCountOfArticles = $neededCountOfArticles;
            $hash = md5($this->url) . "_{$this->selector}_{$this->neededCountOfArticles}";
            $this->scriptFileName = $hash . '.js';
            $this->jsonFileName = $hash . '.json';
        }
    }

    abstract public function executeParse();

    public function setVariablesInTemplateJs() {
        $this->readyToExecuteJs = sprintf($this->getTemplateJsFileOfParse(),
            $this->neededCountOfArticles, $this->url, $this->selector, $this->jsonFileName);
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
        chdir(__DIR__ . '/js');
        return file_exists($this->scriptFileName) ? true : file_put_contents($this->scriptFileName, $this->getReadyJs());
    }

    public function getJsonFileName() {
        return $this->jsonFileName;
    }

    /**
     * @return string
     */
    abstract protected function getTemplateJsFileOfParse();
}
