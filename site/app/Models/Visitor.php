<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table="visitors";
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $increment = true;
    public $timestamp = false;


}
