<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';

    public $timestamps = true;

    protected $table = 'oeis_users';

    protected $fillable = [
        'user_fname',
        'user_lname',
        'user_role',
        'user_email',
        'user_password',
        'user_img',
        'user_insert_proj',
        'user_permission',
        'user_major',
        'created_at',
        'updated_at'
    ];
}
