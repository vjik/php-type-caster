<?php

namespace vjik\valueFilterTests;

use PHPUnit\Framework\TestCase;
use vjik\valueFilter\ValueFilter;

class BaseTest extends TestCase
{

    public function testNull()
    {
        $this->assertNull(ValueFilter::make(null)->null()->result());
        $this->assertNull(ValueFilter::make('')->null()->result());
        $this->equalTo(ValueFilter::make(1)->null()->result(), 1);
        $this->assertNull(ValueFilter::make(1)->null(1)->result());
        $this->assertNull(ValueFilter::make(1)->null(0, 1)->result());
        $this->assertNull(ValueFilter::make(1)->null([0, 1])->result());
        $this->assertSame(ValueFilter::make('2')->null(2)->result(), '2');
    }

    public function testInt()
    {
        $this->assertSame(ValueFilter::make('1')->int(), 1);
        $this->assertSame(ValueFilter::make(null)->int(), 0);
        $this->assertSame(ValueFilter::make(null)->null()->int(), null);
    }

    public function testFloat()
    {
        $this->assertSame(ValueFilter::make('12.56')->float(), 12.56);
        $this->assertSame(ValueFilter::make(12.56)->float(), 12.56);
        $this->assertSame(ValueFilter::make('12,56')->float(), 12.56);
        $this->assertSame(ValueFilter::make('1 112,56')->float(), 1112.56);
        $this->assertSame(ValueFilter::make('1a1b1c2.12')->float(['a' => '', 'b' => '', 'c' => 3]), 11132.12);
        $this->assertSame(ValueFilter::make(null)->float(), 0.0);
        $this->assertSame(ValueFilter::make(null)->null()->float(), null);
    }

    public function testString()
    {
        $this->assertSame(ValueFilter::make('42')->string(), '42');
        $this->assertSame(ValueFilter::make(42)->string(), '42');
        $this->assertSame(ValueFilter::make('')->string(), '');
        $this->assertSame(ValueFilter::make('')->null()->string(), null);
        $this->assertSame(ValueFilter::make(null)->string(), '');
        $this->assertSame(ValueFilter::make(null)->null()->string(), null);
    }

    public function testTrim()
    {
        $this->assertSame(ValueFilter::make(' test ')->trim()->result(), 'test');
        $this->assertSame(ValueFilter::make(42)->trim()->result(), '42');
        $this->assertSame(ValueFilter::make(null)->trim()->result(), '');
        $this->assertSame(ValueFilter::make(null)->null()->trim()->result(), null);
        $this->assertSame(ValueFilter::make('')->trim()->result(), '');
        $this->assertSame(ValueFilter::make('')->null()->trim()->result(), null);
        $this->assertSame(ValueFilter::make('aba')->trim('a')->result(), 'b');
    }

    public function testBool()
    {
        $this->assertSame(ValueFilter::make(true)->bool(), true);
        $this->assertSame(ValueFilter::make(false)->bool(), false);
        $this->assertSame(ValueFilter::make(1)->bool(), true);
        $this->assertSame(ValueFilter::make(0)->bool(), false);
        $this->assertSame(ValueFilter::make(0)->bool([0]), true);
        $this->assertSame(ValueFilter::make(0)->bool(0), true);
        $this->assertSame(ValueFilter::make(1)->bool(null, [1]), false);
        $this->assertSame(ValueFilter::make(1)->bool(null, 1), false);
        $this->assertSame(ValueFilter::make(null)->bool(null), true);
        $this->assertSame(ValueFilter::make(1)->bool(null, 1), false);
    }
}
