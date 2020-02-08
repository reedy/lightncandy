<?php
/**
 * Generated by build/gen_test
 */
use LightnCandy\LightnCandy;
use LightnCandy\Runtime;
use LightnCandy\SafeString;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/test_util.php');

class ExpressionTest extends TestCase
{
    /**
     * @covers LightnCandy\Expression::boolString
     */
    public function testOn_boolString() {
        $method = new \ReflectionMethod('LightnCandy\Expression', 'boolString');
        $this->assertEquals('true', $method->invokeArgs(null, array_by_ref(array(
            1
        ))));
        $this->assertEquals('true', $method->invokeArgs(null, array_by_ref(array(
            999
        ))));
        $this->assertEquals('false', $method->invokeArgs(null, array_by_ref(array(
            0
        ))));
        $this->assertEquals('false', $method->invokeArgs(null, array_by_ref(array(
            -1
        ))));
    }
    /**
     * @covers LightnCandy\Expression::listString
     */
    public function testOn_listString() {
        $method = new \ReflectionMethod('LightnCandy\Expression', 'listString');
        $this->assertEquals('', $method->invokeArgs(null, array_by_ref(array(
            array()
        ))));
        $this->assertEquals("'a'", $method->invokeArgs(null, array_by_ref(array(
            array('a')
        ))));
        $this->assertEquals("'a','b','c'", $method->invokeArgs(null, array_by_ref(array(
            array('a', 'b', 'c')
        ))));
    }
    /**
     * @covers LightnCandy\Expression::arrayString
     */
    public function testOn_arrayString() {
        $method = new \ReflectionMethod('LightnCandy\Expression', 'arrayString');
        $this->assertEquals('', $method->invokeArgs(null, array_by_ref(array(
            array()
        ))));
        $this->assertEquals("['a']", $method->invokeArgs(null, array_by_ref(array(
            array('a')
        ))));
        $this->assertEquals("['a']['b']['c']", $method->invokeArgs(null, array_by_ref(array(
            array('a', 'b', 'c')
        ))));
    }
    /**
     * @covers LightnCandy\Expression::analyze
     */
    public function testOn_analyze() {
        $method = new \ReflectionMethod('LightnCandy\Expression', 'analyze');
        $this->assertEquals(array(0, false, array('foo')), $method->invokeArgs(null, array_by_ref(array(
            array('flags' => array('spvar' => 0)), array(0, 'foo')
        ))));
        $this->assertEquals(array(1, false, array('foo')), $method->invokeArgs(null, array_by_ref(array(
            array('flags' => array('spvar' => 0)), array(1, 'foo')
        ))));
    }
    /**
     * @covers LightnCandy\Expression::toString
     */
    public function testOn_toString() {
        $method = new \ReflectionMethod('LightnCandy\Expression', 'toString');
        $this->assertEquals('[a].[b]', $method->invokeArgs(null, array_by_ref(array(
            0, false, array('a', 'b')
        ))));
        $this->assertEquals('@[root]', $method->invokeArgs(null, array_by_ref(array(
            0, true, array('root')
        ))));
        $this->assertEquals('this', $method->invokeArgs(null, array_by_ref(array(
            0, false, null
        ))));
        $this->assertEquals('this.[id]', $method->invokeArgs(null, array_by_ref(array(
            0, false, array(null, 'id')
        ))));
        $this->assertEquals('@[root].[a].[b]', $method->invokeArgs(null, array_by_ref(array(
            0, true, array('root', 'a', 'b')
        ))));
        $this->assertEquals('../../[a].[b]', $method->invokeArgs(null, array_by_ref(array(
            2, false, array('a', 'b')
        ))));
        $this->assertEquals('../[a\'b]', $method->invokeArgs(null, array_by_ref(array(
            1, false, array('a\'b')
        ))));
    }
}

