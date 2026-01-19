<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatement extends Model
{
    protected $table = 'tratements';

    protected $fillable = [
        'jenis_perawatan',
        'pet_id',
    ];

public function pet()
    {
        return $this->belongsTo(Pet::class,'pet_id');
    }

    public function checkup()
    {
        return $this->hasOne(Checkup::class, 'tratement_id');
    }
    
}
