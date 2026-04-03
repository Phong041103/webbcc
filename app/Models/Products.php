<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function category()
{
    return $this->belongsTo(Categories::class, 'category_id');
}
    protected $fillable = ['tensp', 'image', 'mota','gia','quantity','category_id', 'created_at', 'updated_at'];
}

?>
