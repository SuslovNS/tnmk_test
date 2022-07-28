<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;
    //Для правильного отображения вложенных списков использовал этот трейт
    //https://github.com/staudenmeir/laravel-adjacency-list

    protected $fillable = ['parent_id', 'title'];



    public function scopeRoot($query){
        $query->whereNull('parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }
}
