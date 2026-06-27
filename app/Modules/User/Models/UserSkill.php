<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;
use Skill\Models\Skill;

class UserSkill extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    // Relation


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
