<?php

namespace App\Service;

use Demontpx\ParsedownBundle\Parsedown;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownParser
{
    public function parse(
        string $source,
        Parsedown $parsedown,
        AdapterInterface $cache
    ): string {
        return $cache->get('markdown_' . md5($source), function () use ($source, $parsedown) {
            return $parsedown->text($source);
        });
    }
}
