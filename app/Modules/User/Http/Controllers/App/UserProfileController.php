<?php


namespace User\Http\Controllers\App;


use Illuminate\Http\Request;
use User\Models\User;

class UserProfileController extends CoreController
{

    public function __construct(User $model)
    {
        $this->subDirView = 'profile';
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        $id = $request->id ? getSlugId($request->id) : (user() ? user()->id : null);

        if (is_null($id)) {
            return redirectToBack(trans('messages . is_login'));
        }

        if ($request->id) {
            $user = $this->getUserById($id, true);
        } else {
            $user = User::with('profile.city', 'profile.region', 'profile.salaryRange', 'skills')->findOrFail($id);
        }

        meta_data(trans_module_user('app.home'), trans_module_user('app.home'), [
            route_app('user.retiree.index') => trans_module_user('app.retirees'),
            '' => $user->full_name,
        ]);

        $pageTitle = trans_module_user('app.profile');
        $moduleNamespace = $this->moduleNamespace;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('pageTitle', 'moduleNamespace', 'user')
        );

    }


    private function getUserById($id = null, $type = null)
    {
        return User::with('profile.city', 'profile.region', 'profile.salaryRange', 'skills')->where('uniq_id', $id)->firstOrFail();
    }
}
