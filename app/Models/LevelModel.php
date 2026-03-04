<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    // Menentukan nama tabel (jika tidak mengikuti standar Laravel yang jamak/plural)
    protected $table = 'm_level'; 

    // Menentukan primary key tabel m_level
    protected $primaryKey = 'level_id'; 

    // Relasi ke UserModel: satu level memiliki banyak user
    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}