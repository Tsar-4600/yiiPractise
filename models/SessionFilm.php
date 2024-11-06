<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Session_Film".
 *
 * @property int $id_session
 * @property int $id_film
 *
 * @property Film $film
 * @property Session $session
 */
class SessionFilm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Session_Film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_session', 'id_film'], 'required'],
            [['id_session', 'id_film'], 'integer'],
            [['id_film'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['id_film' => 'id_film']],
            [['id_session'], 'exist', 'skipOnError' => true, 'targetClass' => Session::class, 'targetAttribute' => ['id_session' => 'id_session']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_session' => 'Id Session',
            'id_film' => 'Id Film',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id_film' => 'id_film']);
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
