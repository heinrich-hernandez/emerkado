<?php

namespace App\Models\Admin_Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoopModel extends Model
{
    use HasFactory;
    protected $table = 'coop';

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
        'agency_affiliation',
        'agency_affiliation_name',
        'username',
        'password',
        'user_role',
        'status',
        'date',
        'business_discription',
        'review_status',
        'reviewed_by',
        'created_at',
        'updated_at'
    ];

    public function reviews(){ 
        return $this->hasMany(Review_AccountModel::class, 'review_id', 'user_id');
        // First 'review_id' is the foreign key in review_account db
        // Second 'user_id' is the local key (primary key) in coop db
    }
}
