<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ranking extends Authenticatable
{
   public static function get_all_rankings()
   {
        $rankings = self::all();
        return $rankings;
   }
}
