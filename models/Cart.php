<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "Orders".
 *
 * @property int $id_film
 * @property int $id_session
 * @property int $id_customer
 * @property float $price
 * @property string $time
 * @property string $status_order
 *
 * @property Customer $customer
 * @property Session $session
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'No table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_film', 'amount', 'price'], 'required'],
            [['id_session', 'id_customer'], 'integer'],
            [['price'], 'number'],
            [['time'], 'safe'],
            [['status_order'], 'string', 'max' => 255],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['id_customer' => 'id_customer']],
            [['id_session'], 'exist', 'skipOnError' => true, 'targetClass' => Session::class, 'targetAttribute' => ['id_session' => 'id_session']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_session' => 'Id Session',
            'id_customer' => 'Id Customer',
            'price' => 'Price',
            'time' => 'Time',
            'status_order' => 'Status Order',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id_customer' => 'id_customer']);
    }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::class, ['id_session' => 'id_session']);
    }
}
