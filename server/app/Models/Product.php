<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Spécifiez les champs autorisés à être remplis
    protected $fillable = ['name', 'category_id'];

    /**
     * Relation : Un produit appartient à une catégorie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
