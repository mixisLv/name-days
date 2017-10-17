<?php
/**
 * @author    Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 * @copyright Copyright (C) 2017 Mikus Rozenbergs
 */


namespace mixisLv\NameDays;


class Names
{
    /** @var string */
    private $key;

    /** @var array */
    private $names;

    /**
     * Names constructor.
     *
     * @param string $key
     * @param array  $names
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
    public function key() {
        return $this->key;
    }

    /**
     * toString
     *
     * @return string
     */
    public function toString()
    {
        return join(", ", $this->names);
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return $this->names;
    }
}