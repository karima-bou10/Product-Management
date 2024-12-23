<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Spécifiez les champs autorisés à être remplis
    protected $fillable = ['name'];

    /**
     * Relation : Une catégorie a plusieurs produits.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Retourne le nombre de produits associés à cette catégorie.
     */
    public function getProductCount()
    {
        return $this->products()->count();
    }
}
