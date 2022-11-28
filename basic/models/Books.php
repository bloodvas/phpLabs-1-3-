<?php
namespace app\models;

use PharIo\Manifest\Author;
use yii\db\ActiveRecord;

class Books extends ActiveRecord
{
    public $cnt;
    public function getAuthor() {
        return $this->hasOne(Authors::class, ['id' => 'authorsId']);
    }

    public function getGenre() {
        return $this->hasOne(Genres::class, ['id' => 'genresId']);
    }
}



