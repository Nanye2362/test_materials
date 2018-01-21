<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TbMaterials;

/**
 * Description of Material
 *
 * @author lzh
 */
class MaterialsController extends Controller {

    public $enableCsrfValidation = false;

    public function actionGetMaterials() {
        $materials = TbMaterials::find()->asArray()->all();

        $flag = Yii::$app->request->post('flag');
        if ($flag == 'M') {
            $table = '<table border="1" cellspacing="0" cellpadding="0" id="userList" align="center">
                    <tr align="center">
                    <td>id</td>
                    <td>材料唯一码</td>
                    <td>材料名称</td>
                    <td>材料单价</td>
                    <td>材料存库数量</td>
                    <td>材料描述</td>
                    <td>操作</td>
                    </tr>';

            foreach ($materials as $material) {
                $content = "<tr>
                    <td> " . $material['ID'] . "</td>
                    <td> " . $material['CODE'] . "</td>
                    <td> " . $material['NAME'] . "</td>
                    <td> " . $material['PRICE'] . "</td>
                    <td> " . $material['STORAGE'] . "</td>
                    <td> " . $material['DESCRIPTION'] . "</td>
                    <td>
                    <a href='' id='delete_material' data='" . $material['ID'] . "'> 删</a>
                    <a href='http://localhost/Yii2.0/web/site/edit-material?id='" . $material['ID'] . "> 改</a>                   
                    </td>
                </tr>";
                $table = $table . $content;
            }
        } else if ($flag == 'P') {
            $table = '<table border="1" cellspacing="0" cellpadding="0" id="userList" align="center">
                    <tr align="center">
                    <td>勾选</td>
                    <td>id</td>
                    <td>材料唯一码</td>
                    <td>材料名称</td>
                    <td>材料单价</td>
                    <td>材料存库数量</td>
                    <td>材料描述</td>
                    <td>选择数量</td>
                    </tr>';

            foreach ($materials as $material) {
                $content = "<tr>
                    <td> <input type='checkbox' name='m_select' id='" . $material['ID'] . "' data-storage='" . $material['STORAGE'] . "'></td>
                    <td> " . $material['ID'] . "</td>
                    <td> " . $material['CODE'] . "</td>
                    <td> " . $material['NAME'] . "</td>
                    <td> " . $material['PRICE'] . "</td>
                    <td> " . $material['STORAGE'] . "</td>
                    <td> " . $material['DESCRIPTION'] . "</td>
                    <td> <input type='number' name='m_count' class='m_count' id='m_count_" . $material['ID'] . "' min='0' max='" . $material['STORAGE'] . "'></td>
                </tr>";
                $table = $table . $content;
            }
        }
        echo $html = $table . '</table>';
    }

    public function actionCreateMaterial() {
        $return = new \stdClass();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $save_result = $this->saveMaterialInfo(Yii::$app->request->post());

        if ($save_result) {
            $return->success = TRUE;
        } else {
            $return->success = FALSE;
            $return->error_msg = 'dbError';
        }
        $response->data = $return;
    }

    protected function saveMaterialInfo($save_data) {
        if (is_array($save_data)) {
            $material_info = new TbMaterials();
            $material_info->setAttributes($save_data);
            $save_result = $material_info->save(false);
            return $save_result;
        }
    }

    public function actionDeleteMaterial() {
        $delete_result = TbMaterials::deleteAll('ID=:ID', [':ID' => Yii::$app->request->post('ID')]);
        $return = new \stdClass();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $return->success = TRUE;
        $response->data = $return;
    }

    public function actionUpdateMaterial() {
        $return = new \stdClass();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $update_result = TbMaterials::updateAll(Yii::$app->request->post(), 'ID=:ID', [':ID' => Yii::$app->request->post('ID')]);

        if ($update_result > 0) {
            $return->success = TRUE;
        } else {
            $return->success = FALSE;
            $return->error_msg = 'dbError';
        }
        $response->data = $return;
    }

}
