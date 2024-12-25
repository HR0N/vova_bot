<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorsCheck extends Model
{
    protected $table = 'errors_checks'; /* <== OPTIONAL */
    use HasFactory;

    protected $fillable = [
        'was_mistake',
    ];
}
