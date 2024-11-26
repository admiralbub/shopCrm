<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
class Feedback extends Model
{
    use HasFactory,AsSource,Filterable;
    protected $table = 'feedbacks';
    protected $fillable = [
        'id',
        'comment',
        'user_name',
        'email',
        'product_id',
        'response',
        'rating',
        'created_at',
        'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopeAvailable($q) {
        $q->where("status",1);
    }
}
