<?php

namespace Modules\parser;

use PhantomInstaller\PhantomBinary;

class ParserStarter
{
    protected string $path;

    /**
     * @param string $jsFileName add new in modules/parser/js directory
     * @return void
     */
    public function __construct($jsFileName)
    {
        $pathToBinPhantom = PhantomBinary::BIN;
        chdir(__DIR__ . '/js');
        $dir = getcwd();
        $pathToExecuteJsFile = "{$pathToBinPhantom} {$dir}/{$jsFileName}";
        if (is_executable($pathToBinPhantom)) {
            $this->path = $pathToExecuteJsFile;
            $this->run();
        }
    }

    protected function run() {
        exec($this->path);
    }
}
