<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Customer".
 *
 * @property int $id_customer
 * @property int $id_user
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $telephone
 *
 * @property Orders[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'surname', 'email', 'telephone'], 'required'],
            [['id_user'], 'integer'],
            [['name', 'surname', 'email', 'telephone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'id_user' => 'Id User',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'telephone' => 'Telephone',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_customer' => 'id_customer']);
    }
}
