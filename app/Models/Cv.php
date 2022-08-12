<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $table = 'cvs';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'file',
        'date',
        'id_user',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id_user', 'id');
    }
}
