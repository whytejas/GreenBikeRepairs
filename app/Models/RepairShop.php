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
}
