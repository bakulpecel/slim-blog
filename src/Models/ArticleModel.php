<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class ArticleModel extends Model
{
    protected $table        = 'articles';
    protected $primaryKey   = 'id';
    protected $fillable     = ['title', 'content', 'deleted'];
    public $timestamps = true;
}