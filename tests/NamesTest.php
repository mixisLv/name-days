<?php
/*
 * This file is part of the Comparator package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Comparator;

use mixisLv\NameDays\NameDays;
use PHPUnit\Framework\TestCase;

final class NamesTest extends TestCase
{
    public function testNamesArray()
    {
        $nameDays = new NameDays();
        $names    = $nameDays->names("09-29")->toArray();

        $this->assertSame($names, ['Miķelis', 'Mikus', 'Miks', 'Mihails']);
    }

    public function testNamesString()
    {
        $nameDays = new NameDays();
        $names    = $nameDays->names("09-29")->toString();

        $this->assertSame($names, 'Miķelis, Mikus, Miks, Mihails');
    }

    public function testNamesKey()
    {
        $nameDays = new NameDays();
        $key      = $nameDays->date("MiKuS")->key();

        $this->assertSame($key, '09-29');
    }

    public function testNameKeyNotFound()
    {
        $nameDays = new NameDays();
        $key      = $nameDays->date("name-not-found")->key();

        $this->assertSame($key, '09-29');
    }

    public function testExtendedNames()
    {
        $nameDays = new NameDays('name-days-lv-extended');
        $names    = $nameDays->names("09-24")->toArray();

        $this->assertSame($names, ["Agrits", "Agrons", "Steidzīte", "Steiga"]);
    }

    /**
     * @expectedException     \Exception
     */
    public function testException()
    {
        new NameDays('test-exception');
    }
}
