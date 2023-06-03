<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TgGroups extends Model
{
    protected $table = 'tg_groups'; /* <== OPTIONAL */
    use HasFactory;

    protected $fillable = [
        'rent_type',
        'group_title',
        'group_id',
        'allow_messages',
        'city',
        'district',
        'price',
        'rooms',
        'request_url',
    ];
}
