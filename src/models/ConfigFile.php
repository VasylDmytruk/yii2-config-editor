<?php

namespace autoxloo\yii2\config\editor\models;

use autoxloo\yii2\config\editor\interfaces\ContentRunnerInterface;
use yii\base\Model;

/**
 * Class ConfigFile
 */
class ConfigFile extends Model
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var ContentRunnerInterface
     */
    protected $contentRunner;

    /**
     * @var string
     */
    private $content;


    /**
     * ConfigFile constructor.
     *
     * @param ContentRunnerInterface $contentRunner
     * @param array $config
     */
    public function __construct(ContentRunnerInterface $contentRunner, $config = [])
    {
        $this->contentRunner = $contentRunner;

        parent::__construct($config);
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['path'], 'string'],
            [['path', 'content'], 'safe'],
            [['path'], 'validatePath'],
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param mixed $params the value of the "params" given in the rule
     * @param \yii\validators\InlineValidator $validator related InlineValidator instance.
     * This parameter is available since version 2.0.11.
     */
    public function validatePath($attribute, $params, $validator)
    {
        if (!file_exists($this->path)) {
            $validator->addError($this, $attribute, 'The value "{value}" is not exist file path.');
        }
    }

    /**
     * Saves ConfigFile.
     *
     * @return bool Returns true if saved successfully.
     */
    public function save(): bool
    {
        $saved = false;

        if ($this->validate()) {
            $saved = $this->contentRunner->putContent($this->path, $this->content);
        }

        return $saved;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $this->content = $this->contentRunner->getContent($this->path);

        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Gets content widget class
     *
     * @return string
     */
    public function getWidgetClass(): string
    {
        return $this->contentRunner->getWidgetClass();
    }

    /**
     * Gets config for widget class.
     *
     * @return array
     */
    public function getWidgetConfig(): array
    {
        return $this->contentRunner->getWidgetConfig();
    }
}
