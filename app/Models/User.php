<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * =================================================================================================
 *  User Model (The "Member Card" Template)
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this class as the "Member Card" template for your application.
 *  Every time a new person registers, we use this template to create their unique "Member Card"
 *  (User object) that holds their details like name, email, and password.
 * 
 *  This file tells Laravel: "Hey, this is what a 'User' looks like and what they can do."
 */
class User extends Authenticatable
{
    // TRAITS: These are like "superpowers" we borrow from other places.
    // - HasApiTokens: Allows the user to have API keys (like a VIP pass for apps).
    // - HasFactory: Lets us easily create fake users for testing (like printing dummy cards).
    // - Notifiable: Allows us to send emails/notifications to this user.
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     *  The "fillable" property.
     * 
     *  ANALOGY:
     *  Imagine a form with many fields. You don't want people to be able to scribble on *every* part of the form
     *  (like the "Approved By" section).
     * 
     *  This list acts like a whitelist. It says: "It is safe to let people write directly to these specific fields."
     *  Everything else is protected.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /**
     *  The "hidden" property.
     * 
     *  ANALOGY:
     *  When you show your Member Card to someone, you show your name, but you *never* show your secret pin code.
     * 
     *  This list tells Laravel: "When you convert this user to text (JSON) to send to the browser,
     *  HIDE these sensitive fields."
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /**
     *  The "casts" property.
     * 
     *  ANALOGY:
     *  Data in the database is just raw text. It's like writing a date as "2023-01-01" on a piece of paper.
     *  
     *  This tells Laravel: "When you pick up 'email_verified_at', don't just treat it as text. 
     *  Put on your magic glasses and see it as a real Date object so we can do date math with it."
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
