<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{
    protected $table = 'phone_book';

    protected $fillable = ['name','surname','phone','email'];
}
