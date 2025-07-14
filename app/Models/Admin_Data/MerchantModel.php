<?php

namespace App\Models\Admin_Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantModel extends Model
{
    use HasFactory;
    protected $table = 'merchant';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'address',
        'contact_number',
        'email',
        'profile_picture',
        'valid_id_picture',
        'username',
        'password',
        'user_role',
        'status',
        'remember_token',
        'date',
        'created_at',
        'updated_at',
    ];
}
