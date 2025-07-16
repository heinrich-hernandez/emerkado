<?php

namespace App\Models\Admin_Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerModel extends Model
{
    use HasFactory;
    protected $table = 'buyer';

    protected $fillable = [
        'id',
        'user_id',
        'authorized_representative',
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
        'date',
        'review_status',
        'reviewed_by',
        'created_at',
        'updated_at'
    ];

    public function reviews(){ 
        return $this->hasMany(Review_AccountModel::class, 'review_id', 'user_id');
        // First 'review_id' is the foreign key in review_account db
        // Second 'user_id' is the local key (primary key) in buyer db
    }
}
