<?php


namespace User\Http\Controllers\App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use User\Http\Requests\App\StoreDeactivateAccountRequest;
use User\Models\DeactivateAccount;
use User\Models\UserStatus;

class DeactivateAccountController extends CoreController
{
    public function __construct(DeactivateAccount $model)
    {
        parent::__construct($model);
    }

    public function store(StoreDeactivateAccountRequest $request)
    {
        DB::transaction(function () use ($request) {
            DeactivateAccount::create([
                'user_id' => user()->id,
                'reason_id' => $request->reason,
                'description' => $request->description,
            ]);
            return user()->update([
                'status_id' => UserStatus::DEACTIVATED
            ]);
        });

        Auth::guard()->logout();
        $request->session()->invalidate();

        return $this->response([
            'redirectTo' => route_app('home.index'),
        ]);
    }
}
