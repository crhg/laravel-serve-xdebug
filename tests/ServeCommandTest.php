<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2019-03-06
 * Time: 07:12
 */

namespace Tests;

use Crhg\LaravelServeXdebug\Console\Commands\ServeCommand;
use PHPUnit\Framework\TestCase;

/**
 * Class ServeCommandTest
 * @package Tests
 * @mixin ServeCommand
 */
class ServeCommandTest extends TestCase
{
    /**
     * @Test
     *
     * @param array  $options
     * @param string $expected
     *
     * @dataProvider getXdebugOptionsProvider
     */
    public function testGetXdebugOptions(array $options, string $expected): void
    {
        foreach ($options as $k => $v) {
            ini_set($k, $v);
        }

        $serveCommand = new ServeCommand();
        $actual = $serveCommand->getXdebugOptions();
        $this->assertSame($expected, $actual);
    }

    public function getXdebugOptionsProvider(): array
    {
        $xdebug_remote_timeout = ini_get('xdebug.remote_timeout') + 1;

        return [
            [[], ''],
            [['xdebug.remote_timeout' => $xdebug_remote_timeout], "-dxdebug.remote_timeout='$xdebug_remote_timeout'"],
        ];
    }
}
