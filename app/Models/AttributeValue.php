<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'attribute_id', 'is_deleted'];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }
}
