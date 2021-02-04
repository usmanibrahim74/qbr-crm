<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'contact_name',
        'contact_number',
        'contact_email',
        'notes',
        'description',
        'logo'
    ];

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
