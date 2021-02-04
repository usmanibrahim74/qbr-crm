<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_id',
        'user_id',
        'date',
        'summary',
        'quarter',
        'created_at',
        'updated_at',
    ];

    public function groups(){
        return $this->belongsToMany(Group::class);
    }


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function reportItems(){
        return $this->hasMany(ReportItem::class);
    }

    public function reportGroupItems(){
        return $this->hasManyThrough(ReportItem::class,'group_item_id');
    }
}
