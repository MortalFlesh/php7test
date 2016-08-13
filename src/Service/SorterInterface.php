<?php

namespace MF\PHP7Test\Service;

interface SorterInterface
{
    /**
     * @param int[]
     * @return int[]
     */
    public function sortInts(int ...$ints) : array;
}
