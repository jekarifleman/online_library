<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $id;
    protected $type_id;
    protected $category_id;
    protected $name;
    protected $authors;
    protected $description;
}
