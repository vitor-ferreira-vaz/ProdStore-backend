<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAcessTokens extends Model
{
    protected $table = 'personal_access_tokens';

    protected $fillable = [
        'token'
    ];
}
