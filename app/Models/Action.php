<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Checklist;
class Action extends Model
{
    protected $guarded = [];
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
