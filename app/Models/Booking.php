<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'repair_shop_id', 'booking_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairShop()
    {
        return $this->belongsTo(RepairShop::class);
    }
}
