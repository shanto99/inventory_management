<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "Menus";

    public function parameters()
    {
        return $this->hasMany(MenuParameter::class, 'MenuID', 'MenuID');
    }
}
