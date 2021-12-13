<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mitem extends Model
{
    use HasFactory;
    protected $table='mitem';
    protected $fillable = [
        'id',
        'code',
        'name',
        'itemptp',
        'id_muom',
        'code_muom',
        'id_muom2',
        'code_muom2',
        'othercode',
        'id_mwhse',
        'code_mwhse',
        'stock',
        'id_mgrp',
        'name_mgrp',
        'id_mvariety',
        'name_mvariety',
        'inactive'];
}
