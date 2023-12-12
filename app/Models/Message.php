<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'email', 'phone', 'subject', 'message', 'apartment_id'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
