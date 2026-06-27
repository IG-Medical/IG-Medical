<?php


namespace User\Http\Controllers\App;


use Illuminate\Support\Facades\DB;
use User\Http\Requests\App\StoreUpdateProfileRequest;
use User\Http\Resources\App\UserResources;
use User\Models\User;
use User\Models\UserProfile;
use User\Models\UserSkill;

class UserUpdateProfileController extends CoreController
{
    public function __construct(User $model)
    {
        $this->subDirView = 'profile';
        parent::__construct($model);
    }


    public function edit()
    {
        meta_data(trans_module_user('app.home'), trans_module_user('app.home'), [
            route_app('user.profile.index') => trans_module_user('app.profile'),
            '' => trans_module_user('app.edit'),
        ]);

        $pageTitle = trans_module_user('app.edit_profile');
        $moduleNamespace = $this->moduleNamespace;

        $data = User::with('profile', 'profile.region', 'profile.city', 'profile.profession.skills')->findOrFail(user()->id);

        $user = new UserResources($data);

        $DIR_IMAGE_UPLOADS = User::DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.' . $this->subDirView . '.edit',
            compact('pageTitle', 'moduleNamespace', 'user', 'DIR_IMAGE_UPLOADS')
        );
    }

    public function update(StoreUpdateProfileRequest $request)
    {
        $update = DB::transaction(function () use ($request) {

            $user = user();
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->image = $request->image;
            $user->save();

            $profile = UserProfile::where('user_id', $user->id)->update([
                'about_me' => $request->bio,
                'telephone' => $request->phone,
                'region_id' => $request->region,
                'city_id' => $request->city,
                'street' => $request->street,
                'house_number' => $request->house_number,
                'postal_code' => $request->postal_code,
                'range_salary_id' => $request->range_salary,
                'profession_id' => isset($request->professions['id']) || count($request->professions) > 0 ? $request->professions['id'] : null,
            ]);
            $skills = [];

            $this->deleteSkills();
            if (isset($request->skills)) {
                foreach ($request->skills as $skill) {
                    if ($skill['id']) {
                        $skills[] = [
                            'user_id' => $user->id,
                            'skill_id' => $skill['id'],
                        ];
                    }
                }
            }

            UserSkill::insert($skills);

            return $profile;
        });

        return $this->successResponse($update);
    }

    private function deleteSkills()
    {
        UserSkill::where('user_id', user()->id)->delete();
    }
}
