<?php

namespace User\Http\Controllers\AdminPanel\User;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Language\Http\Resources\AdminPanel\LanguageResource;
use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\StoreUserBasicInfoRequest;
use User\Http\Resources\AdminPanel\UserBasicInfoResource;
use User\Models\User;
use User\Models\UserProfile;

class UserBasicInfoController extends CoreController
{
    private $userId;
    private $DIR_IMAGE_UPLOADS = User::DIR_IMAGE_UPLOADS;

    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->userId = request('userId');
    }

    public function index()
    {
        $this->authorized();

        $asRoute = $this->moduleNamespace;
        $user = new UserBasicInfoResource($this->model::with('profile.country')->find($this->userId));

        meta_data($this->pageTitle, $this->breadcrumbsTitle, [
            route_admin($asRoute . '.index') => $this->pageTitle,
            route_admin('user.index') . '?id=' . $user->id => $user->full_name,
            '' . 'Basic Info',
        ]);

        $singleTitle = $this->singleTitle;

        $countries = CountryResource::collection(Country::getCountries());

        $DIR_IMAGE_UPLOADS = $this->DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.basic_info.index', compact(
            'singleTitle',
            'asRoute',
            'user',
            'countries',
            'DIR_IMAGE_UPLOADS',
        ));
    }

    public function store(StoreUserBasicInfoRequest $request)
    {
        $updateUser = DB::transaction(function () use ($request) {

            $user = $this->model::find($request->userId);
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->personal_photo = $request->personal_photo;
            $user->save();

            $profile = $user->profile()->update([
                'gender' => $request->gender,
                'about_me' => $request->bio,
                'date_birth' => $request->date_birth,
                'country_id' => $request->country,
                'nationality_id' => $request->nationality,
                'city' => $request->city,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'postal_code' => $request->postal_code,
                'cv' => $request->cv,
            ]);
            return $profile;
        });
        return $this->successResponse($updateUser);
    }
}
