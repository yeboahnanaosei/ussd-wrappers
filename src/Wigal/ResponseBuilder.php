<?php

namespace Yeboahnanaosei\Ussd\Wigal;

class ResponseBuilder
{
    private array $lines;

    public function __construct()
    {
    }

    /**
     * Writes a new line.
     *
     * @param string $line
     * @return self
     */
    public function addLine(string $line): self
    {
        $this->lines[] = $line;
        return $this;
    }

    public function toString(): string
    {
        return join("^", $this->lines);
    }
}