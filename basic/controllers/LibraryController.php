<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Books;
use app\models\Authors;
use app\models\Genres;
use PharIo\Manifest\Author;
use app\models\BookForm;
use app\models\AuthorForm;
use app\models\DateForm;

class LibraryController extends Controller
{
    public function actionBooks()
    {
        $query = Books::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $books = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('books', [
            'books' => $books,
            'pagination' => $pagination,
        ]);
    }

    public function actionAuthors()
    {
        $query = Authors::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $authors = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('authors', [
            'authors' => $authors,
            'pagination' => $pagination,
        ]);
    }

    public function actionGenres()
    {
        $query = Genres::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $genres = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('genres', [
            'genres' => $genres,
            'pagination' => $pagination,
        ]);
    }

    public function actionQuery1()
    {
        $query = Books::find()->with('author','genre');
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $books = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('query1', [
            'books' => $books,
            'pagination' => $pagination,
        ]);
    }   

    public function actionQuery2()
    {
        $query = Books::find()->where("release_date > '1901-01-01'");
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $books = $query->orderBy('release_date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('query2', [
            'books' => $books,
            'pagination' => $pagination,
        ]);
    }

    public function actionQuery3()
    {
        $query = Books::find()->select(['authorsId', 'COUNT(`id`) as cnt'])->groupBy('authorsId')->with('author')->orderBy('cnt');
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countOfBooks = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('query3', [
            'countOfBooks' => $countOfBooks,
            'pagination' => $pagination,
        ]);
    }

    public function actionQuery4()
    {
            $model = new BookForm();
            if ($model->load(Yii::$app->request->post())) {
                // данные в $model удачно проверены
                // делаем что-то полезное с $model ...
                $data = $_POST["BookForm"]["word"];
                Yii::$app->session->setFlash('success','Поиск книги');
                if (isset($data)) {
                    $query = Books::find()->where(['like','booksname',$data]);
                    $pagination = new Pagination([
                        'defaultPageSize' => 5,
                        'totalCount' => $query->count(),
                    ]);
                    $books = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();
                        return $this->render('query4', [
                            'books' => $books,
                            'model' => $model
                        ]);
                }
            } return $this->render('query4', [
                'model' => $model,
            ]); 
    }

    public function actionQuery5()
    {
        $genres = Genres::find()->all();
        $model = new AuthorForm();
        if ($model->load(Yii::$app->request->post())) {
            $data = $_POST['AuthorForm'];
            $id = $_POST['AuthorForm']['id'];
            if ($id != null) {
                $del = Authors::find()->where(['id' => $id])->one()->delete();
            }else if (isset($data) != null) {
                $author = new Authors();
                $author->full_name = $data['name'];
                $author->birth_date = $data['birthday'];
                $author->death_date = $data['death'];
                $author->genre_id = $data['genreId'];
                $author->save();
            }
        }
        $query = Authors::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $authors = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        return $this->render('query5', [
            'genres' => $genres,
            'model' => $model,
            'authors' => $authors,
            'pagination' => $pagination,
        ]);
    }

    public function actionQuery6(){

        $model = new DateForm();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            if ($post["DateForm"]['firstDate'] != null && $post["DateForm"]['secondDate'] != null) {
                $firstDate = $post["DateForm"]['firstDate'];
                $secondDate = $post["DateForm"]['secondDate'];
                $query = Books::find()->where("release_date > '$firstDate' AND release_date < '$secondDate'");
            }else{
                $query = Books::find();
            }
            $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
            ]);
        $books = $query->orderBy('release_date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

            return $this->render('query6', [
                'model' => $model,  
                'books' => $books,
                'pagination' => $pagination,
            ]);
         }else{
            $query = Books::find();
            $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $books = $query->orderBy('release_date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('query6', [
            'model' => $model,
            'books' => $books,
            'pagination' => $pagination,]);
         }
        
    }


}