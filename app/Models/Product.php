<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','brand_id','name', 'slug','images','description','is_active','price','is_featured','in_stock','on_sale'];

    protected $casts =[
        // l'attribut images doit être converti en tableau. C'est utile pour stocker des données JSON dans la base de données et les manipuler facilement en tant que tableau en PHP.
        'images' => 'array',
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
