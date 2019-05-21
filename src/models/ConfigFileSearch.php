<?php

namespace autoxloo\yii2\config\editor\models;

use yii\data\ArrayDataProvider;

/**
 * Class ConfigFileSearch
 */
class ConfigFileSearch extends ConfigFile
{
    /**
     * Returns ArrayDataProvider of `$items`.
     *
     * @param array $items
     *
     * @return ArrayDataProvider
     */
    public function search(array $items): ArrayDataProvider
    {
        $modelsToSet = [];

        foreach ($items as $item) {
            $modelsToSet[] = ['path' => $item];
        }

        $dataProvider = new ArrayDataProvider(['allModels' => $modelsToSet]);

        return $dataProvider;
    }
}
