<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_url', 'text_overview', 'article_text_body', 'article_url', 'pulled_from_the_file'];
}
