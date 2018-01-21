<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_materials".
 *
 * @property integer $ID
 * @property string $CODE
 * @property string $NAME
 * @property integer $PRICE
 * @property integer $STORAGE
 * @property string $DESCRIPTION
 */
class TbMaterials extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_materials';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['CODE', 'NAME', 'PRICE', 'STORAGE'], 'required'],
            [['PRICE', 'STORAGE'], 'integer'],
            [['DESCRIPTION'], 'string'],
            [['CODE'], 'string', 'max' => 40],
            [['NAME'], 'string', 'max' => 100],
            [['CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'CODE' => 'Code',
            'NAME' => 'Name',
            'PRICE' => 'Price',
            'STORAGE' => 'Storage',
            'DESCRIPTION' => 'Description',
        ];
    }

}
