<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'content', 'status_id'];

    public function statu ()
    {
        return $this->belongsTo(Statu::class);
    }
}
