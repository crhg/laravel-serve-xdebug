# SUMMARY

Built-in server command with xdebug option available

# INSTALL

```console
composer require --dev crhg/laravel-serve-xdebug
```

# DESCRIPTION

Once installed, a new artisan command `serve:xdebug` is added.

This is almost the same as the original `serve` command, but inherits the option to configure the xdebug related settings given to PHP when it starts up to the built-in server.
This makes debugging in combination with PhpStorm etc. easier.

## Example of use with PhpStorm

Add the setting to launch `artisan serve:xdebug` using 'Run → Edit Configurations' menu.

* Add 'PHP Script' with '+'
* `File:` -- Select the artisan command script
* `Arguments:` -- Set `serve:xdebug`

After that, you can use the debugger by specifying the setting by Run → Debug and activating the built-in server.

Remember to start listening for PHP debug connection. (It will be toggled with the icon like a telephone on the top-right)