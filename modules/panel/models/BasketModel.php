<?php

namespace app\modules\panel\models;

use app\models\UserModel;
use Yii;

/**
 * This is the model class for table "{{%basket}}".
 *
 * @property int $basket_id
 * @property int $basket_userId
 * @property int $basket_totalPrice
 *
 * @property BasketItem[] $basketItems
 * @property User $basketUser
 */
class BasketModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%basket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['basket_userId', 'basket_totalPrice'], 'required'],
            [['basket_userId', 'basket_totalPrice'], 'integer'],
            [['basket_userId'], 'exist', 'skipOnError' => true, 'targetClass' => UserModel::class, 'targetAttribute' => ['basket_userId' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'basket_id' => Yii::t('app', 'Basket ID'),
            'basket_userId' => Yii::t('app', 'Basket User ID'),
            'basket_totalPrice' => Yii::t('app', 'Basket Total Price'),
        ];
    }

    /**
     * Gets query for [[BasketItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBasketItems()
    {
        return $this->hasMany(BasketItemModel::class, ['basketItem_basketId' => 'basket_id']);
    }

    /**
     * Gets query for [[BasketUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBasketUser()
    {
        return $this->hasOne(UserModel::class, ['user_id' => 'basket_userId']);
    }
}
