<?php
/**
 * Created by IntelliJ IDEA.
 * User: matsui
 * Date: 2019-03-05
 * Time: 22:26
 */

namespace Crhg\LaravelServeXdebug\Console\Commands;


use Illuminate\Support\ProcessUtils;
use Symfony\Component\Process\PhpExecutableFinder;

class ServeCommand extends \Illuminate\Foundation\Console\ServeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve:xdebug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server with xdebug';

    /**
     * Get the full server command.
     *
     * @return string
     */
    protected function serverCommand(): string
    {
        return sprintf('%s %s -S %s:%s %s',
            $this->getPhp(),
            $this->getXdebugOptions(),
            $this->host(),
            $this->port(),
            ProcessUtils::escapeArgument(base_path('server.php'))
        );
    }

    protected function getPhp(): string
    {
        static $php;

        if ($php === null) {
            $php = ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false));
        }

        return $php;
    }

    protected function getXdebugOptions(): string
    {
        static $options;

        if ($options === null) {
            if (extension_loaded('xdebug')) {
                $defaultIniSetting = $this->getDefaultIniSetting();
                $options = collect(\ini_get_all('xdebug', false))
                    ->filter(function ($value, $key) use ($defaultIniSetting) {
                        return $value !== $defaultIniSetting[$key];
                    })
                    ->map(function ($value, $key) {
                        return '-d'.$key.'='.ProcessUtils::escapeArgument($value);
                    })
                    ->implode(' ');
            } else {
                $this->warn('no xdebug extension');
                $options = '';
            }
        }

        return $options;
    }

    protected function getDefaultIniSetting(): array
    {
        $php = $this->getPhp();
        $code = 'echo(json_encode(ini_get_all("xdebug", false)));';

        $json = shell_exec(sprintf('%s -r %s', $php, ProcessUtils::escapeArgument($code)));
        if ($json === null) {
            throw new \RuntimeException('cannot get default ini setting');
        }

        $setting = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('json decode error: '.json_last_error_msg());
        }

        return $setting;
    }
}
