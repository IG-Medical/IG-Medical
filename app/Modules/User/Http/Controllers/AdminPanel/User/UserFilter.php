<?php


namespace User\Http\Controllers\AdminPanel\User;


trait UserFilter
{

    protected function filterUser($users, $request)
    {
        $filter = json_decode($request->filter);

        if ($request->has('id') && !is_null($request->id) && empty($filter->text) &&
            empty($filter->user_id) && empty($filter->full_name) &&
            empty($filter->email) && empty($filter->date_birth) && empty($filter->created_at) &&
            empty($filter->gender) && empty($filter->type) &&
            empty($filter->job_title) && empty($filter->country) && empty($filter->city) && empty($filter->status) &&
            empty($filter->verify_mobile) && empty($filter->verify_email)
            && empty($filter->hourly_price->from) && empty($filter->hourly_price->to)) {
            $users = $users->where('id', (int)$request->id);
        }

        if ($filter) {

            if (!empty($filter->text)) {
                $users = $users->where(function ($query) use ($filter) {
                    $query->where('full_name', 'LIKE', "%$filter->text%")->orwhere('email', 'LIKE', "%$filter->text%");
                });
            }
            if ($filter->user_id) {
                $users = $users->where('id', (int)$filter->user_id);
            }

            if ($filter->full_name) {
                $users = $users->where('full_name', 'LIKE', "%$filter->full_name%");
            }
            if ($filter->email) {
                $users = $users->where('email', 'LIKE', "%$filter->email%");
            }
            if ($filter->created_at) {
                $users = $users->whereDate('created_at', '=', $filter->created_at);
            }
            if ($filter->gender) {
                $users = $users->whereHas('profile', function ($q) use ($filter) {
                    $q->where('gender', $filter->gender);
                });
            }
            if (isset($filter->mobile) && !empty($filter->mobile)) {
                $users = $users->where('mobile', "$filter->mobile");
            }

            if ($filter->job_title) {
                $users = $users->whereHas('profile', function ($q) use ($filter) {
                    $q->where('job_title', 'LIKE', "%$filter->job_title%");
                });
            }
            if ($filter->country) {
                $users = $users->whereHas('profile', function ($q) use ($filter) {
                    $q->where('country_id', $filter->country->id);
                });
            }
            if ($filter->city) {
                $users = $users->whereHas('profile', function ($q) use ($filter) {
                    $q->where('city', 'LIKE', "%$filter->city%");
                });
            }
            if ($filter->status) {
                $users = $users->where('user_status', (int)$filter->status);
            }
            if ($filter->verify_mobile) {
                $users = $users->whereNotNull('mobile_verified_at');
            }
            if ($filter->un_verify_mobile) {
                $users = $users->whereNull('mobile_verified_at');
            }
            if ($filter->verify_email) {
                $users = $users->whereNotNull('email_verified_at');
            }
            if ($filter->un_verify_email) {
                $users = $users->whereNull('email_verified_at');
            }

            if ($filter->userProfessionsSelected) {
                $users = $users->whereHas('professions', function ($query) use ($filter) {
                    $query->whereIn('professions.id', collect($filter->userProfessionsSelected)->map(function ($q) {
                        return $q->id;
                    }));
                });
            }

            if ($filter->userSkillsSelected) {
                $users = $users->whereHas('skills', function ($query) use ($filter) {
                    $query->whereIn('skills.id', collect($filter->userSkillsSelected)->map(function ($q) {
                        return $q->id;
                    }));
                });
            }
            if ($filter->hourly_price->from || $filter->hourly_price->to) {
                $min = $filter->hourly_price->from;
                $max = $filter->hourly_price->to;
                $users = $users->whereHas('profile', function ($query) use ($min, $max) {
                    $query->whereBetween('hourly_rate', [$min, $max]);
                });
            }
        }
        return $users;
    }


    public function fullName($filter, $users)
    {
        if (empty($filter->text)) {
            return null;
        }

        return $users = $users->where(function ($query) use ($filter) {
            $query->where('full_name', 'LIKE', "%$filter->text%")->orwhere('email', 'LIKE', "%$filter->text%");
        });
    }

    public function userID()
    {

    }
}
