<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Film".
 *
 * @property int $id_film
 * @property string $name
 * @property int $id_genre
 * @property string|null $photo_path
 * @property int|null $price
 *
 * @property Genre $genre
 * @property SessionFilm[] $sessionFilms
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'id_genre'], 'required'],
            [['id_genre', 'price'], 'integer'],
            [['name', 'photo_path'], 'string', 'max' => 255],
            [['id_genre'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::class, 'targetAttribute' => ['id_genre' => 'id_genre']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_film' => 'Id Film',
            'name' => 'Name',
            'id_genre' => 'Id Genre',
            'photo_path' => 'Photo Path',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::class, ['id_genre' => 'id_genre']);
    }

    /**
     * Gets query for [[SessionFilms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionFilms()
    {
        return $this->hasMany(SessionFilm::class, ['id_film' => 'id_film']);
    }
}
