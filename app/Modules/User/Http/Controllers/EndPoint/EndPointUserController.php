<?php


namespace User\Http\Controllers\EndPoint;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use User\Models\User;
use User\Models\UserStatus;


class EndPointUserController extends Controller
{

    public function search(Request $request)
    {
        $users = new User();

        //first name and last name
        $users = $users->orwhere(function ($query) use ($request) {
            $query->orwhere('full_name', 'LIKE', "%$request->q%");
        });

        //email
        $users = $users->orwhere('email', $request->q);


        //id
        $users = $users->orwhere('id', $request->q);

        //uniq_id
        $users = $users->orwhere('uniq_id', $request->q);

        $users = $users->select('id', 'full_name', 'email')
            ->where('status_id', UserStatus::ACCEPTED)
            ->get();

        return response()->json($users);
    }
}
