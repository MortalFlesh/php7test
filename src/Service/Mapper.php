<?php

namespace MF\PHP7Test\Service;

class Mapper
{
    public function mapStringsToInts(string ...$strings) : array
    {
        return array_map(function (string $string) {
            return preg_match('/^\d+$/', $string) ? intval($string) : $string;
        }, $strings);
    }
}
