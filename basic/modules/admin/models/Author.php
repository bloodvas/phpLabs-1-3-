<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string|null $full_name
 * @property string $birth_date
 * @property string|null $death_date
 * @property int|null $genre_id
 *
 * @property Basket[] $baskets
 * @property Books[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birth_date'], 'required'],
            [['birth_date', 'death_date'], 'safe'],
            [['genre_id'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'full_name' => 'ФИО',
            'birth_date' => 'Дата рождения',
            'death_date' => 'Дата смерти',
            'genre_id' => 'Идентификатор жанра',
        ];
    }

    /**
     * Gets query for [[Baskets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::class, ['authorsId' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['authorsId' => 'id']);
    }
}
