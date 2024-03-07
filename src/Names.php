<?php
/**
 * @author    Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 * @copyright Copyright (C) 2017 Mikus Rozenbergs
 */

namespace mixisLv\NameDays;

class Names
{
    /** @var string */
    private string $key;

    /** @var array<int, string> */
    private array $names;

    /**
     * Names constructor.
     *
     * @param string $key
     * @param array<int, string> $names
     */
    public function __construct(string $key, array $names)
    {
        $this->key = $key;
        $this->names = $names;
    }

    /**
     * key
     *
     * @return string
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * toString
     *
     * @return string
     */
    public function toString(): string
    {
        return implode(", ", $this->names);
    }

    /**
     * toArray
     *
     * @return array<int, string>
     */
    public function toArray(): array
    {
        return $this->names;
    }
}
