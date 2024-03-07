<?php

use mixisLv\NameDays\NameDays;
use PHPUnit\Framework\TestCase;

final class NamesTest extends TestCase
{
    /**
     * testNamesArray
     *
     * @throws \Exception
     */
    public function testNamesArray(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getNames("09-29")->toArray();

        $this->assertSame($names, ['Miķelis', 'Mikus', 'Miks', 'Mihails', 'Jumis']);
    }

    /**
     * testNamesString
     *
     * @throws \Exception
     */
    public function testNamesString(): void
    {
        $nameDays = new NameDays();
        $names    = $nameDays->getNames("09-29")->toString();

        $this->assertSame($names, 'Miķelis, Mikus, Miks, Mihails, Jumis');
    }

    /**
     * testNamesKey
     *
     * @throws \Exception
     */
    public function testNamesKey(): void
    {
        $nameDays = new NameDays();
        $key      = $nameDays->getDate("MiKuS");

        $this->assertSame($key, '09-29');
    }

    /**
     * testEmpty
     *
     * @throws \Exception
     */
    public function testEmpty(): void
    {
        $nameDays = new NameDays();
        $key      = $nameDays->getNames("02-29");

        $this->assertSame($key->toString(), '–');
        $this->assertSame($key->toArray(), []);
    }

    /**
     * testNameKeyNotFound
     *
     * @throws \Exception
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
     * @throws \Exception
     */
    public function testExtendedNames(): void
    {
        $nameDays = new NameDays('name-days-lv-extended');
        $names    = $nameDays->getNames("09-24")->toArray();

        $this->assertSame($names, ["Agrits", "Agrons", "Steidzīte", "Steiga"]);
    }

    public function testException(): void
    {
        $this->expectException(\Exception::class);
        new NameDays('test-exception');
    }
}
