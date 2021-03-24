<?php

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;
use Okcomputer\Matryoshka\Cacheable;

abstract class TestCase extends PHPUnit\Framework\TestCase
{

    protected function setUp(): void
    {
        $this->setUpDatabase();
        $this->migrateTables();

    }

    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
        
    }

    protected function migrateTables() 
    {
        DB::schema()->create('posts', function ($table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
    }

    protected function makePost()
    {
        $post = new Post;
        $post->title = 'Some title';
        $post->save();
        return $post;
    }
}

class Post extends Model
{
    use Cacheable;

}