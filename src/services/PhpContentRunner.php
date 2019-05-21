<?php

namespace autoxloo\yii2\config\editor\services;

use autoxloo\yii2\config\editor\interfaces\ContentRunnerInterface;
use yii\base\BaseObject;

/**
 * Class PhpContentRunner
 */
class PhpContentRunner extends BaseObject implements ContentRunnerInterface
{

    /**
     * Gets config content.
     *
     * @param string $path Path to config file.
     *
     * @return mixed|string Returns config content.
     */
    public function getContent(string $path)
    {
        $content = '';

        if (file_exists($path)) {
            $content = file_get_contents($path);
        }

        return $content;
    }

    /**
     * Saves `$content` to file.
     *
     * @param string $path
     * @param mixed $content
     *
     * @return bool Returns whether content was put successfully.
     */
    public function putContent(string $path, $content): bool
    {
        $saved = true;

        try {
            if (file_exists($path)) {
                $putResult = file_put_contents($path, $content);
                $saved = ($putResult !== false);
            }
        } catch (\Throwable $e) {
            $saved = false;
        }

        return $saved;
    }

    /**
     * Returns widget class which allows to show and edit content.
     *
     * @return string
     */
    public function getWidgetClass(): string
    {
        return \conquer\codemirror\CodemirrorWidget::class;
    }

    /**
     * Returns config for widget class.
     *
     * @return array
     */
    public function getWidgetConfig(): array
    {
        return [
            'preset' => 'php',
            'options' => ['rows' => 30],
        ];
    }
}
