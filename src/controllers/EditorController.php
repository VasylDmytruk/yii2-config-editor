<?php

namespace autoxloo\yii2\config\editor\controllers;

use autoxloo\yii2\config\editor\ConfigEditorModule;
use autoxloo\yii2\config\editor\models\ConfigFile;
use autoxloo\yii2\config\editor\models\ConfigFileSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class EditorController
 */
class EditorController extends Controller
{
    /**
     * Shows list of ConfigFile items.
     *
     * @return string
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionIndex()
    {
        /* @var ConfigFileSearch $configSearch */
        $configSearch = Yii::$container->get(ConfigFileSearch::class);
        $configPaths = $this->getConfigPaths();
        $dataProvider = $configSearch->search($configPaths);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Gets config paths.
     *
     * @return array
     */
    private function getConfigPaths(): array
    {
        /* @var ConfigEditorModule $module */
        $module = $this->module;

        return $module->configFilesList;
    }

    /**
     * Edits ConfigFile.
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionEdit($id)
    {
        $path = Yii::getAlias($id);

        $configPath = $this->findConfigPath($path);

        if ($configPath->load(Yii::$app->request->post()) && $configPath->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Saved successfully'));

            return $this->redirect(['edit', 'id' => $id]);
        }

        $widgetClass = $configPath->getWidgetClass();
        $widgetConfig = $configPath->getWidgetConfig();

        return $this->render('edit', [
            'configPath' => $configPath,
            'widgetClass' => $widgetClass,
            'widgetConfig' => $widgetConfig,
        ]);
    }

    /**
     * Finds ConfigFile by `$path`.
     *
     * @param string $path
     *
     * @return ConfigFile
     *
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    private function findConfigPath(string $path): ConfigFile
    {
        if (!file_exists($path)) {
            throw new NotFoundHttpException("Path $path not found");
        }

        /* @var ConfigFile $configPath */
        $configPath = Yii::$container->get(ConfigFile::class, [], ['path' => $path]);

        return $configPath;
    }
}
