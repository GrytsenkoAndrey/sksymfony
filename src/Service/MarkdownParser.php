<?php

namespace App\Service;

class MarkdownParser
{
    public function parse(string $source): string
    {
        return $cache->get('markdown_' . md5($source), function () use ($source, $parsedown) {
            return $parsedown->text($source);
        });
    }
}
