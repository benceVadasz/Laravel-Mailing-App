<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mail
 * @package App\Models
 * * @mixin Builder
 */
class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'message', 'id_user_from', 'id_user_to'
    ];

    public $timestamps = false;
}
