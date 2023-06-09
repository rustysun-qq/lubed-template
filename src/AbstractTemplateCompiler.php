<?php
namespace Lubed\Template;

use Lubed\FileSystem\FSO;

abstract class AbstractTemplateCompiler implements TemplateCompiler {
    protected $fso;
    protected $template_path;
    protected $parser;

    public function __construct(TemplatePath $path,TemplateParser $parser) {
        $this->fso=new FSO();
        $this->template_path=$path;
        $this->parser = $parser;
    }

    public function getCompiledPath(string $path) : string {
        return sprintf('%s/%s/%s.php', $this->template_path->getCachedPath(),dirname($path), md5($path));
    }

    public function getSourcePath(string $path) : string {
        return sprintf('%s/%s', $this->template_path->getSourcePath(), $path);
    }

    public function isExpired(string $path) : bool {
        $compiled=$this->getCompiledPath($path);
        if (!$this->template_path->getCachedPath() || !$this->fso->exists($compiled)) {
            return true;
        }
        $lastModified=$this->fso->lastModified($path);
        return $lastModified >= $this->fso->lastModified($compiled);
    }
}
