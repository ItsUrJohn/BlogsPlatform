<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'description',
        'avatar',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && file_exists(public_path('storage/' . $this->avatar))) {
            return asset('storage/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?background=667eea&color=fff&name=' . urlencode($this->name) . '&size=80&rounded=true';
    }
}