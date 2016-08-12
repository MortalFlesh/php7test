<?php

namespace MF\PHP7Test\Service;

class Calculator
{
    public function sumInts(int ...$ints) : int
    {
        return array_sum($ints);
    }
}
