<?php

namespace App\Models;

use App\Contracts\HasImageContract;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model implements HasImageContract
{
    use ImageTrait;
    protected $table = 'phone_book';

    protected $fillable = ['name','surname','phone','email'];

    protected function getTableName()
    {
        return $this->table;
    }
}
