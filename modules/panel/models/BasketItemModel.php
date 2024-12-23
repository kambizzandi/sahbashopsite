<?php

namespace app\modules\panel\models;

use Yii;

/**
 * This is the model class for table "{{%basket_item}}".
 *
 * @property int $basketItem_id
 * @property int $basketItem_basketId
 * @property int $basketItem_productId
 * @property int $basketItem_qty
 *
 * @property Basket $basketItemBasket
 * @property Product $basketItemProduct
 */
class BasketItemModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%basket_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['basketItem_basketId', 'basketItem_productId', 'basketItem_qty'], 'required'],
            [['basketItem_basketId', 'basketItem_productId', 'basketItem_qty'], 'integer'],
            [['basketItem_basketId'], 'exist', 'skipOnError' => true, 'targetClass' => BasketModel::class, 'targetAttribute' => ['basketItem_basketId' => 'basket_id']],
            [['basketItem_productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductModel::class, 'targetAttribute' => ['basketItem_productId' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'basketItem_id' => Yii::t('app', 'Basket Item ID'),
            'basketItem_basketId' => Yii::t('app', 'Basket Item Basket ID'),
            'basketItem_productId' => Yii::t('app', 'Basket Item Product ID'),
            'basketItem_qty' => Yii::t('app', 'Basket Item Qty'),
        ];
    }

    /**
     * Gets query for [[BasketItemBasket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBasketItemBasket()
    {
        return $this->hasOne(BasketModel::class, ['basket_id' => 'basketItem_basketId']);
    }

    /**
     * Gets query for [[BasketItemProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBasketItemProduct()
    {
        return $this->hasOne(ProductModel::class, ['product_id' => 'basketItem_productId']);
    }
}
