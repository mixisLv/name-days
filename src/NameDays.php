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
     * @var array<string, array<string, array<int, string>>> $loadedSources
     */
    private array $loadedSources = [];

    /**
     * NameDays constructor.
     *
     * @param string $source
     *
     * @throws \Exception
     */
    public function __construct(string $source = 'name-days-lv')
    {
        $this->data = $this->loadData($source);
    }

    /**
     * loadData
     *
     * @param string $source
     *
     * @return array<string, array<int, string>>
     *
     * @throws \Exception
     */
    private function loadData(string $source): array
    {
        if (isset($this->loadedSources[$source])) {
            return $this->loadedSources[$source];
        }

        switch ($source) {
            case 'name-days-lv':
                $dataFile = __DIR__ . '/../data/name-days-lv.csv';
                break;
            case 'name-days-lv-extended':
                $dataFile = __DIR__ . '/../data/name-days-lv-extended.csv';
                break;
            default:
                throw new \Exception('NameDays data source not found');
        }

        $data = [];
        $csv = file_get_contents($dataFile);
        if ($csv) {
            $rows = explode("\n", $csv);
            $data = $this->parseNames($rows);
        }

        return $this->loadedSources[$source] = $data;
    }

    /**
     * @param array<int, string> $rows
     * @return array<string, array<int, string>>
     */
    private function parseNames(array $rows): array
    {
        $nameDays = [];
        foreach ($rows as $row) {
            $row = trim($row);
            if ($row === '' || str_starts_with($row, 'datums')) {
                continue;
            }

            $data = str_getcsv($row);
            if (!isset($data[0], $data[1])) {
                continue;
            }

            [$day, $month] = explode('.', trim($data[0]));
            $month = str_replace('.', '', $month);
            $day   = str_replace('.', '', $day);

            $names = preg_split('/\s+/', trim($data[1])) ?: [];
            $names = array_values(array_filter(array_map('trim', $names), fn($n) => $n !== ''));

            if ($names) {
                $nameDays[sprintf('%02d-%02d', $month, $day)] = $names;
            }
        }

        return $nameDays;
    }

    /**
     * getNames
     *
     * @param string|null $date
     *
     * @return Names
     */
    public function getNames(?string $date = null): Names
    {
        $key = substr($date ?? date('m-d'), -5);
        $names = $this->data[$key] ?? [];
        if (empty($names)) {
            $names = ['–'];
        }

        return new Names($key, $names);
    }

    /**
     * getExtendedNames
     *
     * Returns only the names present in the extended dataset but not in the default dataset.
     *
     * @param string|null $date
     *
     * @return Names
     */
    public function getExtendedNames(?string $date = null): Names
    {
        $key           = substr($date ?? date('m-d'), -5);
        $defaultNames  = array_map('mb_strtolower', $this->loadData('name-days-lv')[$key] ?? []);
        $extendedNames = $this->loadData('name-days-lv-extended')[$key] ?? [];

        $names = array_values(array_filter(
            $extendedNames,
            static fn(string $name): bool => !in_array(mb_strtolower($name), $defaultNames, true)
        ));

        if (empty($names)) {
            $names = ['–'];
        }

        return new Names($key, $names);
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
