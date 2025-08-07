<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboPurchase extends Model
{
    protected $table = 'combo_purchase';
    
    protected $fillable = [
        'purchase_title', 
        'purchase_description', 
        'purchase_price', 
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
