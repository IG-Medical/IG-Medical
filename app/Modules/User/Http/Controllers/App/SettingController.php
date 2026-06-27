<?php


namespace User\Http\Controllers\App;


use Illuminate\Http\Request;
use User\Models\User;

class SettingController extends CoreController
{
    public function __construct(User $model)
    {
        $this->subDirView = 'settings';
        parent::__construct($model);
    }

    public function index()
    {
        $asRoute = $this->moduleRoute;
        $moduleName = $this->moduleNamespace;

        $user = User::findOrFail(user()->id);
        $formatDisplayName = User::formatDisplayName();

        foreach ($formatDisplayName as $key => $name) {

            if ($key === User::FORMAT_DiSPLAY_NAME_FIRST_AND_LAST) {
                $name = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
            }

            if ($key === User::FORMAT_DiSPLAY_NAME_FIRST_AND_L) {
                $name = ucfirst($user->first_name) . ' ' . ucfirst(substr($user->last_name, 0, 1)) . '.';
            }

            if ($key === User::FORMAT_DiSPLAY_NAME_F_AND_L) {
                $name = ucfirst(substr($user->first_name, 0, 1)) . ' ' . ucfirst(substr($user->last_name, 0, 1));
            }

            $formatDisplayName[$key] = $name;
        }

        $preferredContactMethode = User::preferredContactMethode();

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',

            compact('asRoute', 'moduleName', 'user', 'formatDisplayName', 'preferredContactMethode')
        );
    }

    public function store(Request $request)
    {
        $store = user()->update([
            'redirect_after_login' => $request->redirect_after_login_value,
            'receive_notifications_email' => $request->receive_notifications_email,
            'format_display_name' => $request->format_display_name,
            'show_mobile' => $request->show_mobile,
            'telephone_ads' => $request->telephone_ads,
            'email_ads' => $request->email_ads,
            'show_telephone' => $request->show_telephone,
            'show_email' => $request->show_email,
            'preferred_contact_methode' => $request->preferred_contact_methode,
            'appear_on_the_retired_page' => $request->appear_on_the_retired_page,
        ]);
        return $this->successResponse($store);
    }
}
