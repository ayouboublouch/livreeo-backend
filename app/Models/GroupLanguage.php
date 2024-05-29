<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLanguage extends Model
{
    use HasFactory;

    protected $table = 'group_languages';
    
    protected $guarded = ['id'];

    public function schoolList()
    {
        return $this->belongsTo(File::class, 'school_list');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            GroupLanguageArticle::class,
            'group_language_id',
            'article_id'
        )->withPivot('quantity');
    }
}
