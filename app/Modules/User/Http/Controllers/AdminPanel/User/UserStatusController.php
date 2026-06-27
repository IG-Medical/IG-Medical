<?php


namespace User\Http\Controllers\AdminPanel\User;

use User\Http\Controllers\AdminPanel\CoreController;
use User\Models\User;
use User\Models\UserStatus;

class UserStatusController extends CoreController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function accept($id)
    {

        $accept = $this->model::findOrFail($id)->update([
            'status_id' => UserStatus::ACCEPTED // accepted
        ]);
        return response()->json([
            'status' => $accept ? true : false,
            'message' => $accept ? 'The user has been accepted' : 'Error',
        ]);
    }

    public function reject($id)
    {

        $reject = $this->model::findOrFail($id)->update([
            'status_id' => UserStatus::REJECTED  // rejected
        ]);
        return response()->json([
            'status' => $reject ? true : false,
            'message' => $reject ? 'The user has been rejected' : 'Error',
        ]);
    }

    public function unblock($id)
    {

        $unblock = $this->model::findOrFail($id)->update([
            'status_id' => UserStatus::ACCEPTED  // rejected
        ]);
        return response()->json([
            'status' => $unblock ? true : false,
            'message' => $unblock ? 'The user has been unblocked' : 'Error',
        ]);
    }

    public function block($id)
    {

        $block = $this->model::findOrFail($id)->update([
            'status_id' => UserStatus::BLOCKED  // rejected
        ]);

        return response()->json([
            'status' => $block ? true : false,
            'message' => $block ? 'The user has been blocked' : 'Error',
        ]);
    }

}
