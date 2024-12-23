<?php

namespace app\modules\panel\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $product_id
 * @property string $product_name
 * @property int $product_price
 */
class ProductModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'product_price'], 'required'],
            [['product_price'], 'integer'],
            [['product_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'product_price' => Yii::t('app', 'Product Price'),
        ];
    }
}
