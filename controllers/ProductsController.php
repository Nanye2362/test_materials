<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TbMaterials;
use app\models\TbProducts;

/**
 * Description of ProductsController
 *
 * @author lzh
 */
class ProductsController extends Controller {

    public $enableCsrfValidation = false;

    public function actionCreateProduct() {
        $return = new \stdClass();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $consumed_materials = Yii::$app->request->post('consumed_materials');

        $update_data = array();
        $sql = '';
        $sql1 = '';
        if (!empty($consumed_materials) && is_array($consumed_materials)) {
            foreach ($consumed_materials as $consumed_material) {
                foreach ($consumed_material as $left_amount) {
                    $arr = explode(':', $left_amount);
                    $update_data[$arr[0]] = $arr[1];
                    $sql .= ' WHEN ' . $arr[0] . ' THEN ' . $arr[1];
                    $sql1 .= $arr[0] . ',';
                }
            }
        }
        $sql1 = rtrim($sql1, ',');

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        $sql_update = '
            UPDATE tb_materials 
                SET tb_materials.`STORAGE` = CASE tb_materials.ID ' . $sql .
                ' END
            WHERE tb_materials.ID IN (' . $sql1 . ')
            ';

        $save_data = array(
            'NAME' => Yii::$app->request->post('NAME'),
            'PRICE' => Yii::$app->request->post('PRICE'),
            'DESCRIPTION' => Yii::$app->request->post('DESCRIPTION'),
        );

        try {
            $db->createCommand($sql_update)->execute();
            $this->saveProductInfo($save_data);
            $transaction->commit();

            $return->success = TRUE;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        $response->data = $return;
    }

    protected function saveProductInfo($save_data) {
        if (is_array($save_data)) {
            $product_info = new TbProducts();
            $product_info->setAttributes($save_data);
            $save_result = $product_info->save(false);
            return $save_result;
        }
    }

}
