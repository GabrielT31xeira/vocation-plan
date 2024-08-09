<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Holiday extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'holiday';
    public $incrementing = true;
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,"created_by","id");
    }

    public function updater()
    {
        return $this->belongsTo(User::class,"updated_by","id");
    }

    public function participants(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'participants', 'holiday_id', 'user_id');
    }
}
