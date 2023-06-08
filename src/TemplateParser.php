<?php
namespace Lubed\Template;

interface TemplateParser {

    public function parse(string $content, $handler) : string;
}
