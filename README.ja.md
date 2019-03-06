# 概要

xdebugオプションが使えるビルトインサーバコマンド

# インストール

```console
composer require --dev crhg/laravel-serve-xdebug
```

# 説明

インストールすると新しいartisanコマンド`serve:xdebug`が追加されます。

これはもともとある`serve`コマンドとほとんど同じですが、起動するときにPHPに与えたxdebug関連の設定を行うオプションを内蔵サーバにも受け継ぐことで、PhpStormなどと組み合わせたデバッグをやりやすくします。

## PhpStormでの使用例

Run→Edit Configurationsで`artisan serve:xdebug`を起動する設定を追加します。

* '+'で'PHP Script'を追加します
* Fileでartisanコマンドのスクリプトを選択します
* Arguments:に`serve:xdebug`と設定します

あとはRun→Debugでその設定を指定して内蔵サーバを起動すればデバッガが使用できます。

Phpのデバッグ接続を有効にするのを忘れないでください。(右上の電話のようなアイコンでトグルします)


