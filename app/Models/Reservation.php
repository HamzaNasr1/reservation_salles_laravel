<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Reservation extends Model
{
    use HasFactory;
     protected $fillable = ['room_id','user_name', 'date','start_time','end_time'];
    
    public function room()
    {
        return $this->belongsTo(Room::class);
        #belongsTo() pour définir la relation inverse entre Reservation et Room
        #indiquant que chaque réservation appartient à une salle spécifique
    }


}
