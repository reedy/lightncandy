<?php

require __DIR__ . '/../vendor/autoload.php';

use LightnCandy\LightnCandy;

genTestForClass('Compiler');
genTestForClass('Context');
genTestForClass('Exporter');
genTestForClass('Encoder');
genTestForClass('Expression');
genTestForClass('LightnCandy');
genTestForClass('Parser');
genTestForClass('Partial');
genTestForClass('Runtime');
genTestForClass('SafeString');
genTestForClass('Token');
genTestForClass('Validator');

function genTestForClass($classname) {
    ob_start();

    echo <<<VAR
<?php
/**
 * Generated by build/gen_test
 */
use LightnCandy\\LightnCandy;
use LightnCandy\\Runtime;
use LightnCandy\\SafeString;
use PHPUnit\\Framework\\TestCase;

require_once(__DIR__ . '/test_util.php');

class {$classname}Test extends TestCase
{

VAR
    ;

    $class = new \ReflectionClass("LightnCandy\\$classname");
    foreach ($class->getMethods() as $method) {
        if (strpos($method->getFileName(), $classname) === false) {
            continue;
        }

        if ($method->name === '__construct') {
            continue;
        }

        if ($method->name === '__toString') {
            continue;
        }

        if (preg_match_all('/@expect (.+) when input (.+)( after (.+))?/', $method->getDocComment(), $matched)) {
            echo <<<VAR
    /**
     * @covers LightnCandy\\{$classname}::{$method->name}
     */
    public function testOn_{$method->name}() {
        \$method = new \\ReflectionMethod('LightnCandy\\$classname', '{$method->name}');

VAR
            ;
            if ($method->isPrivate() || $method->isProtected()) {
                echo "        \$method->setAccessible(true);\n";
            }
            foreach ($matched[1] as $idx => $expect) {
                if ($matched[3][$idx]) {
                    echo "      {$matched[3][$idx]}\n";
                }
                echo "        \$this->assertEquals($expect, \$method->invokeArgs(null, array_by_ref(array(\n            {$matched[2][$idx]}\n        ))));\n";
            }
            echo "    }\n";
        }
    }
    echo "}\n?>";

    $fn = "tests/{$classname}Test.php";
    if (!file_put_contents($fn, ob_get_clean())) {
        die("Can not generate tests into file $fn !!\n");
    }
}

