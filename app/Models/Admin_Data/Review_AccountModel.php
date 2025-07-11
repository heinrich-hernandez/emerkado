<?php

namespace App\Models\Admin_Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review_AccountModel extends Model
{
    use HasFactory;
    protected $table = 'review_account';

    // Define the primary key column
    protected $primaryKey = 'review_id';

    // If the primary key is not auto-incrementing
    public $incrementing = false;

    protected $fillable = [
        'id',
        'review_id',
        'reviewer_id',
        'account_id',
        'review_description',
        'date'
    ];

    public function coop_review()
    {
        return $this->belongsTo(CoopModel::class, 'review_id', 'user_id');
        // First 'review_id' is the foreign key in review_account db
        // Second 'user_id' is the local key (primary key) in coop db
    }

    public function reviewer()
    {
        return $this->belongsTo(AdminModel::class, 'reviewer_id', 'user_id');
    }
}