<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suporttracker extends Model
{
    use HasFactory;

    protected $table = 'suporttrackers';

    protected $fillable = [
        "subject",
        "issues",
        "created_by",
        "created_tag",
        
    ];


    public function supportMessageTrackers()
    {
        return $this->hasMany(Supportmessagetracker::class, 'id', 'ticket_id');
    }
}
