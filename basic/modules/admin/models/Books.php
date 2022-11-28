<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $booksname
 * @property string|null $description
 * @property string|null $release_date
 * @property int|null $authorsId
 * @property int|null $genresId
 *
 * @property Authors $authors
 * @property Comments[] $comments
 * @property Genres $genres
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['release_date'], 'safe'],
            [['authorsId', 'genresId'], 'integer'],
            [['booksname'], 'string', 'max' => 255],
            [['authorsId'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['authorsId' => 'id']],
            [['genresId'], 'exist', 'skipOnError' => true, 'targetClass' => Genres::class, 'targetAttribute' => ['genresId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'booksname' => 'Назавние',
            'description' => 'Описание',
            'release_date' => 'Дата публикации',
            'authorsId' => 'Идентификатор автора',
            'genresId' => 'Идентификатор жанра',
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::class, ['id' => 'authorsId']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['bookId' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasOne(Genres::class, ['id' => 'genresId']);
    }
}
