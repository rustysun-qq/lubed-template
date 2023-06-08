<?php
namespace Lubed\Template;

class DefaultCompiler extends AbstractTemplateCompiler {
    protected $path;
    protected $handler='$view';

    public function compile(?string $path=null) : ?string {
        if ($path) {
            $this->setPath($path);
        }
        $contents=$this->getCompiledContent($path);
        $compiled_file=null;
        if (null !== $this->template_path->getCachedPath()) {
            $compiled_file=$this->getCompiledPath($path);
            if (!$this->fso->put($compiled_file, $contents)) {
                $compiled_file=null;
            }
        }
        return $compiled_file;
    }

    public function getPath() : string {
        return $this->path;
    }

    public function setPath(string $path) {
        $this->path=$path;
    }

    private function getCompiledContent(string $path) : string {
        $tpl_path=$this->getSourcePath($path);
        $template_content=$this->fso->get($tpl_path);
        return $this->parser->parse($template_content, $this->handler);
    }
}
