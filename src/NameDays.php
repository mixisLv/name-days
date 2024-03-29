<?php
/**
 * @author    Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 * @copyright Copyright (C) 2017 Mikus Rozenbergs
 */

namespace mixisLv\NameDays;

class NameDays
{
    /**
     * @var array<string, array<int, string>> $data
     */
    private array $data = [];

    /**
     * NameDays constructor.
     *
     * @param string $source
     *
     * @throws \Exception
     */
    public function __construct(string $source = 'name-days-lv')
    {
        $this->loadData($source);
    }

    /**
     * loadData
     *
     * @param string $source
     *
     * @throws \Exception
     */
    private function loadData(string $source): void
    {
        switch ($source) {
            case 'name-days-lv':
                $dataFile = __DIR__ . '/../data/name-days-lv.json';
                break;
            case 'name-days-lv-extended':
                $dataFile = __DIR__ . '/../data/name-days-lv-extended.json';
                break;
            default:
                throw new \Exception('NameDays data source not found');
        }

        $data = [];
        $json = file_get_contents($dataFile);
        if ($json) {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }

        $this->data = is_array($data) ? $data : [];
    }

    /**
     * getNames
     *
     * @param string|null $date
     *
     * @return Names
     */
    public function getNames(string $date = null): Names
    {
        $key = substr($date ?? date('m-d'), -5);

        return new Names($key, $this->data[$key] ?? []);
    }

    /**
     * date
     *
     * @param string $name
     * @param bool $withYear
     *
     * @return string
     */
    public function getDate(string $name, bool $withYear = false): ?string
    {
        $date       = null;
        $searchName = mb_strtolower($name);
        foreach ($this->data as $key => $names) {
            if (in_array($searchName, array_map('mb_strtolower', $names), true)) {
                $date = (new Names($key, $names))->key();
                break;
            }
        }

        return $date ? ($withYear ? date('Y-') : '') . $date : null;
    }
}
