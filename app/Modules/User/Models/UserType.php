<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public const ADMIN = 1;
    public const NORMAL = 2;

    public const FL = 'fl';
    public const BO = 'bo';

    protected $guarded = [];

    public static function getAll($rows = null, $where = null)
    {
        $data = new static();

        if ($rows == '*' || is_null($rows))
            $rows = '*';

        if (!is_null($where))
            $data = $data->where($where);

        $data = $data->select($rows)->get();
        return $data;
    }

    // Relation

    public function users()
    {
        return $this->hasMany(User::class, 'user_status');
    }
}
