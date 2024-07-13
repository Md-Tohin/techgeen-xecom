<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id','name', 'slug','category_type','ordering_number', 'description', 'meta_title','meta_description','meta_keywords','is_deleted'];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'name');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

}
