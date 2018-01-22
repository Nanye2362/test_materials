<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_products".
 *
 * @property integer $ID
 * @property string $NAME
 * @property integer $PRICE
 * @property integer $STORAGE
 * @property string $DESCRIPTION
 */
class TbProducts extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_products';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['NAME', 'PRICE', 'STORAGE'], 'required'],
            [['PRICE', 'STORAGE'], 'integer'],
            [['DESCRIPTION'], 'string'],
            [['NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'NAME' => 'Name',
            'PRICE' => 'Price',
            'STORAGE' => 'Storage',
            'DESCRIPTION' => 'Description',
        ];
    }

}
