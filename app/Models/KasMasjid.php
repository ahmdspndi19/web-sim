<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KasMasjid extends Model
{
    use HasFactory;

    
    protected $fillable = ['keterangan','jenis','total'];
    protected $table = 'kas_masjid';

}