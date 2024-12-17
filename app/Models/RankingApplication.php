<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'comments',
        'total_points',
        'handled_by',
    ];

    /**
     * Define the relationship between a RankingApplication and User (Applicant).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship between a RankingApplication and Admin (Handler).
     */
    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    /**
     * Define the relationship between RankingApplication and Certificates.
     * A RankingApplication can have many certificates.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'ranking_application_id');
    }
}
