<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportItem extends Model
{
    use HasFactory;

    protected $fillable = [

        'group_item_id',
        'group_id',
        'report_id',
        'status',
        'notes',
        'solution',
        'qtr',
        'target_year',
        'budget',

    ];

    public function groupItem(){
        return $this->belongsTo(GroupItem::class);
    }
}
