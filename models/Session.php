<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Session".
 *
 * @property int $id_session
 * @property string $name_session
 * @property string $time
 * @property float $price_session
 *
 * @property Orders[] $orders
 * @property SessionFilm[] $sessionFilms
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_session', 'time', 'price_session'], 'required'],
            [['time'], 'safe'],
            [['price_session'], 'number'],
            [['name_session'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_session' => 'Id Session',
            'name_session' => 'Name Session',
            'time' => 'Time',
            'price_session' => 'Price Session',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_session' => 'id_session']);
    }

    /**
     * Gets query for [[SessionFilms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionFilms()
    {
        return $this->hasMany(SessionFilm::class, ['id_session' => 'id_session']);
    }
}
