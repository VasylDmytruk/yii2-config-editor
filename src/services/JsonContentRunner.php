<?php

namespace autoxloo\yii2\config\editor\services;

use autoxloo\yii2\config\editor\helpers\VarDumper;
use autoxloo\yii2\config\editor\interfaces\ContentRunnerInterface;
use Yii;
use yii\base\BaseObject;
use yii\helpers\Json;

/**
 * Class JsonContentRunner
 */
class JsonContentRunner extends BaseObject implements ContentRunnerInterface
{
    /**
     * Gets config content.
     *
     * @param string $path
     *
     * @return mixed|string
     */
    public function getContent(string $path)
    {
        $content = '';

        if (file_exists($path)) {
            $fileContent = require $path;
            $content = Json::encode($fileContent);
        }

        return $content;
    }

    /**
     * Saves `$content` to file.
     *
     * @param string $path
     * @param mixed $content
     *
     * @return bool
     */
    public function putContent(string $path, $content): bool
    {
        $success = true;

        try {
            if (file_exists($path)) {
                $contentToSave = $this->getContentToSave($content);
                $putContentResult = file_put_contents($path, $contentToSave);
                $success = ($putContentResult !== false);
            }
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), self::class);
            $success = false;
        }

        return $success;
    }

    protected function getContentToSave($content): string
    {
        $contentToSave = '';

        if (is_string($content)) {
            $configData = Json::decode($content);

            $contentToSave = $this->wrapContent(VarDumper::dumpAsString($configData));
        } else {
            Yii::error('Content must be a string', self::class);
        }

        return $contentToSave;
    }

    protected function wrapContent(string $content): string
    {
        $wrappedContent = '<?php' . PHP_EOL . PHP_EOL . 'return ' . $content . ';' . PHP_EOL;

        return $wrappedContent;
    }

    /**
     * Returns widget class which allows to show and edit content.
     *
     * @return string
     */
    public function getWidgetClass(): string
    {
        return \kdn\yii2\JsonEditor::class;
    }

    /**
     * Returns config for widget class.
     *
     * @return array
     */
    public function getWidgetConfig(): array
    {
        return [];
    }
}
