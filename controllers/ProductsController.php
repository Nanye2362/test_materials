<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of ProductsController
 *
 * @author lzh
 */
class ProductsController extends Controller {

    public $enableCsrfValidation = false;

    public function actionCreateProduct() {
        $consumed_materials = Yii::$app->request->post('consumed_materials');

        foreach ($consumed_materials as $consumed_material) {
            foreach ($consumed_material as $left_amount) {
                $arr = explode(':', $left_amount);
                $material_id = $arr[0];
                $storage = $arr[1];
                $update_result = TbMaterials::updateAll(['STORAGE' => $storage], 'ID=:ID', [':ID' => $material_id]);
            }
        }
    }

}
