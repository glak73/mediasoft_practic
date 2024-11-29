<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Action;
class Checklist extends Model
{
    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class);
}
public function actions()
{
    return $this->hasMany(Action::class);
}
}
