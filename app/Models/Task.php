<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'description',
        'due_date',
        'status',
        'priority',
    ];

    public static $select_status = [
        'pending' => 'pending', 
        'in_progress' => 'in_progress', 
        'completed' => 'completed', 
    ];
    
    public static $select_priority = [
        'low' => 'low', 
        'medium' => 'medium', 
        'high' => 'high', 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = 
    [
        'id' => 'integer',
        'user_id' => 'integer',
        'description' => 'string',
        'due_date' => 'datetime',
        'status' => 'string',
        'priority' => 'string',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
    ];

    // =========================================================================
    // Relationships
    // =========================================================================

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =========================================================================
    // Getters
    // =========================================================================



    // =========================================================================
    // Methods
    // =========================================================================


}
