<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Carbon\Carbon;
class MainSlider extends Model
{
    use HasFactory,AsSource,Filterable;
    protected $fillable = [
        'id',
        'url',
        'created_at',
        'updated_at',
        'center_banner',
        'img',
        'right_banner',
        'status',
        'start_banner_date',
        'end_banner_date',
        'permanent_status'
    ];

    public function scopeAvailable($query)
    {
        return $query->where(function($q) {
            $q->where(function($q) {
                  $q->where('permanent_status', '=', 1);
            })->orWhere(function($q) {
                $q->where('start_banner_date', '<=', Carbon::now())->where('end_banner_date', '>=', Carbon::now());
            });
       });

        
    }
    public function scopeActive($query) {
        $query->where('status',1);
    }
    
    protected $allowedSorts = [
        'id',
        'status'
    ];
}
