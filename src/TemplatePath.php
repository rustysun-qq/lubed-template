<?php
namespace Lubed\Template;
final class TemplatePath {
    private $source_path;
    private $cached_path;

    public function __construct(string $source_path,string $cached_path)
    {
        $this->source_path = $source_path;
        $this->cached_path = $cached_path;
    }

    /**
     * @return string
     */
    public function getSourcePath() : string {
        return $this->source_path;
    }

    /**
     * @return string
     */
    public function getCachedPath() : string {
        return $this->cached_path;
    }
}
