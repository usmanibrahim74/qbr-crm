<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupItem;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function items(){
        return $this->hasMany(GroupItem::class);
    }

    public function reports(){
        return $this->belongsToMany(Report::class);
    }

    public function reportItems(){
        return $this->hasMany(ReportItem::class);
    }
}
