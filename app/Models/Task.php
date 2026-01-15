<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * =================================================================================================
 *  Task Model (The "To-Do" Item Template)
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this class as the sticky note template.
 *  It represents a single task in your to-do list.
 * 
 *  It tells Laravel how to talk to the "tasks" table in your database.
 */
class Task extends Model
{
    // HAS FACTORY: Allows us to create many fake tasks quickly for testing purposes.
    use HasFactory;

    /**
     *  The "fillable" property.
     * 
     *  ANALOGY:
     *  These are the only fields we trust a user to fill in directly.
     *  It's like saying: "You can write on the 'text' line and check the 'completed' box,
     *  but you can't rewrite the ID or the created_at timestamp."
     * 
     * @var array
     */
    protected $fillable = [
        'text',      // The actual content of the task (e.g., "Buy Milk")
        'completed', // The status: is it done? (true/false)
    ];

    /**
     *  The "casts" property.
     * 
     *  ANALOGY:
     *  Databases often store specialized data as simple numbers (0 or 1).
     *  This tells Laravel: "When you read the 'completed' column, please turn that 0 or 1 
     *  into a real 'false' or 'true' boolean value for me to use in PHP."
     * 
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
    ];
}
