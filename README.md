Yii2 config editor
==================
Web interface to edit yii2 config files.

> Note: Be carefull while editing config file, if you put wrong content, you will damage website. Make sure you have file backup! 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist autoxloo/yii2-config-editor "*"
```

or add

```
"autoxloo/yii2-config-editor": "*"
```

to the require section of your `composer.json` file.

Config
------

In your config add:

```php
'modules' => [
    'editor' => [
        'class' => \autoxloo\yii2\config\editor\ConfigEditorModule::class,
        // You can set PhpContentRunner (default), JsonContentRunner 
        // or any other class which implements ContentRunnerInterface 
        'contentRunnerClass' => \autoxloo\yii2\config\editor\services\PhpContentRunner::class, // default
        'configFilesList' => [
            // list of files to allow edit
        ],
    ],
],
```

Usage
-----

Once the module is installed and configured, you can use it.
If your module name is `editor`, than available routes are:

* `/editor/editor/index` - List of config files to edit (`ConfigEditorModule::configFilesList`).
* `/editor/editor/edit/{id}` - Edit page of config file.

ContentRunner
-------------

ContentRunner is class which implements `autoxloo\yii2\config\editor\interfaces\ContentRunnerInterface`.
It allows to work with config file in different manner (json editor, php file editor...).

Available ContentRunners:

* `autoxloo\yii2\config\editor\services\PhpContentRunner` (default) Allows to edit 
php files as they are with php highlight. Uses `\conquer\codemirror\CodemirrorWidget`. 
You can extend this class to change `PhpContentRunner::getWidgetConfig()` 
to set own config for widget.
* `autoxloo\yii2\config\editor\services\JsonContentRunner` Allows to edit
files via json editor (widget `\kdn\yii2\JsonEditor`). 
Note: it not saves comments.
