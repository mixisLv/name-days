<?php

namespace mixisLv\NameDays\Tests;

use Exception;
use mixisLv\NameDays\NameDays;
use PHPUnit\Framework\TestCase;

final class NamesTest extends TestCase
{
    /**
     * testNamesArray
     *
     * @throws Exception
     */
    public function testNamesArray(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getNames("09-29")->toArray();

        $this->assertSame(['Miķelis', 'Mikus', 'Miks', 'Mihails', 'Jumis'], $names);
    }

    /**
     * testNamesString
     *
     * @throws Exception
     */
    public function testNamesString(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getNames("09-29")->toString();

        $this->assertSame('Miķelis, Mikus, Miks, Mihails, Jumis', $names);
    }

    /**
     * testNamesKey
     *
     * @throws Exception
     */
    public function testNamesKey(): void
    {
        $nameDays = new NameDays();
        $key      = $nameDays->getDate("MiKuS");

        $this->assertSame('09-29', $key);
    }

    /**
     * testEmpty
     *
     * @throws Exception
     */
    public function testEmpty(): void
    {
        $nameDays = new NameDays();
        $key      = $nameDays->getNames("02-29");

        $this->assertSame('–', $key->toString());
        $this->assertSame(['–'], $key->toArray());
    }

    /**
     * testNameKeyNotFound
     *
     * @throws Exception
     */
    public function testNameKeyNotFound(): void
    {
        $nameDays = new NameDays();
        $key      = $nameDays->getDate("name-not-found");

        $this->assertNull($key);
    }

    /**
     * testExtendedNames
     *
     * @throws Exception
     */
    public function testExtendedNames(): void
    {
        $nameDays = new NameDays('name-days-lv-extended');
        $names    = $nameDays->getNames("09-24")->toArray();

        $this->assertSame($names, ["Agris", "Agrita", "Agrits", "Agrons", "Steidzīte", "Steiga"]);
    }

    /**
     * testExtendedOnlyNames
     *
     * @throws Exception
     */
    public function testExtendedOnlyNames(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getExtendedNames("09-24")->toArray();

        $this->assertSame(["Agrits", "Agrons", "Steidzīte", "Steiga"], $names);
    }

    /**
     * testExtendedOnlyNamesKey
     *
     * @throws Exception
     */
    public function testExtendedOnlyNamesKey(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getExtendedNames("09-24");

        $this->assertSame('09-24', $names->key());
    }

    /**
     * testExtendedOnlyNamesFromExtendedSource
     *
     * @throws Exception
     */
    public function testExtendedOnlyNamesFromExtendedSource(): void
    {
        $nameDays = new NameDays('name-days-lv-extended');
        $names    = $nameDays->getExtendedNames("09-24")->toArray();

        $this->assertSame(["Agrits", "Agrons", "Steidzīte", "Steiga"], $names);
    }

    /**
     * testExtendedOnlyNamesEmpty
     *
     * @throws Exception
     */
    public function testExtendedOnlyNamesEmpty(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getExtendedNames("02-29");

        $this->assertSame('–', $names->toString());
        $this->assertSame(['–'], $names->toArray());
    }

    public function testException(): void
    {
        $this->expectException(Exception::class);
        new NameDays('test-exception');
    }
}
