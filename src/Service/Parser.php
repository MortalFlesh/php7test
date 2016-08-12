<?php

namespace MF\PHP7Test\Service;

class Parser
{
    /**
     * @param string $input
     * @param string $delimeter
     * @return string[]
     */
    public function parseStringsFromStringInput(string $input, string $delimeter = ',') : array
    {
        return explode($delimeter, str_replace(' ', '', $input));
    }
}
