<?php

namespace autoxloo\yii2\config\editor\interfaces;

/**
 * Interface ContentRunnerInterface
 */
interface ContentRunnerInterface
{
    /**
     * Gets config content.
     *
     * @param string $path Path to config file.
     *
     * @return mixed Returns config content.
     */
    public function getContent(string $path);

    /**
     * Saves `$content` to file.
     *
     * @param string $path
     * @param mixed $content
     *
     * @return bool Returns whether content was put successfully.
     */
    public function putContent(string $path, $content): bool;

    /**
     * Returns widget class which allows to show and edit content. Uses in form field.
     *
     * @return string
     */
    public function getWidgetClass(): string;

    /**
     * Returns config for widget class.
     *
     * @return array
     */
    public function getWidgetConfig(): array;
}
