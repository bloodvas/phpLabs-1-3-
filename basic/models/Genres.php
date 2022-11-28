<?php
namespace app\models;
use yii\db\ActiveRecord;

class Genres extends ActiveRecord
{
    public function getBooks() {
        return $this->hasMany(Books::class, [ "genresId" => "id"]);
    }
}