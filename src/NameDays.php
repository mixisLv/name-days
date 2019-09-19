<?php
/**
 * @author    Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 * @copyright Copyright (C) 2017 Mikus Rozenbergs
 */

namespace mixisLv\NameDays;

class NameDays
{
    private $data = [];


    /**
     * NameDays constructor.
     *
     * @param string $source
     *
     * @throws \Exception
     */
    public function __construct($source = 'name-days-lv')
    {
        $this->loadData($source);

        return $this;
    }

    /**
     * loadData
     *
     * @param $source
     *
     * @throws \Exception
     */
    private function loadData($source)
    {
        $dataFile = null;

        switch ($source) {
            case 'name-days-lv':
                $dataFile = __DIR__ . '/../data/name-days-lv.json';
                break;
            case 'name-days-lv-extended':
                $dataFile = __DIR__ . '/../data/name-days-lv-extended.json';
                break;
            default:
                throw new \Exception('NameDays data source not found');
                break;
        }

        $this->data = json_decode(file_get_contents($dataFile), true);
    }

    /**
     * getNames
     *
     * @param $date
     *
     * @return Names
     */
    public function getNames($date=null)
    {
        $key = substr($date ?? date('m-d'), -5);

        return new Names($key, $this->data[$key] ?? []);
    }

    /**
     * date
     *
     * @param $name
     *
     * @param bool $withYear
     * @return string
     */
    public function getDate($name, $withYear = false)
    {
        $date = null;
        $searchName = mb_strtolower($name);
        foreach ($this->data as $key => $names) {
            if (in_array($searchName, array_map('mb_strtolower', $names))) {
                $date =  (new Names($key, $names))->key();
                break;
            }
        }

        return $date ? ($withYear ? date('Y-') : '') . $date : null;
    }
}
