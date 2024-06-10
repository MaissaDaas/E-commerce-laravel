<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','images','is_active'];

    // Cette méthode définit une relation entre le modèle Category et le modèle Product.   
    public function products(){
        // une catégorie peut avoir plusieurs produits. Eloquent va chercher à associer la clé étrangère category_id dans le modèle Product à l'identifiant de la catégorie correspondante.
        return $this->hasMany(Product::class);
    }
}
