<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;


    public function getProperty()
    {
        return $this->hasMany(Property::class, 'id', 'property_type_id');
    }
}
