<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class RepairShop extends Model
{
    use Searchable;

    // Define searchable data for Algolia
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,

        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function remainingSlots()
    {
        return 5 - $this->bookings()->whereDate('booking_date', today())->count();
    }
}
