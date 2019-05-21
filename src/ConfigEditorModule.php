<?php

namespace autoxloo\yii2\config\editor;

use autoxloo\yii2\config\editor\interfaces\ContentRunnerInterface;
use autoxloo\yii2\config\editor\services\PhpContentRunner;
use Yii;
use yii\base\Module;

/**
 * Class ConfigEditorModule
 *
 * @property array $configFilesList List of config files to edit
 * @property string $contentRunnerClass Content runner class name, by default [[PhpContentRunner::class]].
 * You can also use [[JsonContentRunner::class]] or your own class which implements [[ContentRunnerInterface]].
 * Write only.
 */
class ConfigEditorModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'autoxloo\yii2\config\editor\controllers';

    /**
     * @var array List of config files to edit
     */
    private $configFilesList = [];

    /**
     * @var string Content saver class name, by default [[PhpContentRunner::class]].
     */
    private $contentRunnerClass = PhpContentRunner::class;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$container->setSingleton(ContentRunnerInterface::class, $this->contentRunnerClass);
    }

    /**
     * @return array
     */
    public function getConfigFilesList(): array
    {
        return $this->configFilesList;
    }

    /**
     * @param array $configFilesList
     */
    public function setConfigFilesList(array $configFilesList): void
    {
        $this->configFilesList = $configFilesList;
    }

    /**
     * @param string $contentRunnerClass
     */
    public function setContentRunnerClass(string $contentRunnerClass): void
    {
        $this->contentRunnerClass = $contentRunnerClass;
    }
}
