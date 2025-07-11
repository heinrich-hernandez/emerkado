<?php

namespace App\Models\Admin_Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;
    
    protected $table = 'admin';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'user_role',
        'created_at',
    ];

    public function reviews(){ 
        return $this->hasMany(Review_AccountModel::class, 'review_id', 'user_id');
        // First 'review_id' is the foreign key in review_account db
        // Second 'user_id' is the local key (primary key) in admin db
    }

}
