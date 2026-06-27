<?php


namespace Job\Http\Controllers\App;


use App\Http\Controllers\App\CoreController;
use Illuminate\Support\Facades\Mail;
use Job\Http\Requests\App\StoreApplicationRequest;
use Job\Mail\CareerApplicationEmail;
use Job\Models\CareerApplication;
use User\Models\User;

class ApplicationController extends CoreController
{
    public function store(StoreApplicationRequest $request)
    {
        $store = CareerApplication::create([
            'career_id' => $request->career_id,
            'salutation' => $request->salutation,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'street' => $request->street,
            'plz' => $request->plz,
            'number' => $request->number,
            'earliest_start_of_work' => $request->earliest_start_of_work,
            'land' => $request->land,
            'attentive_to_business_through' => $request->attentive_to_business_through,
            'place_of_residence' => $request->place_of_residence,
            'salary_expectations' => $request->salary_expectations,
            'internal_application' => $request->internal_application,
            'data_protection' => $request->data_protection,
            'admission_to_talent_pool' => $request->admission_to_talent_pool,
            'file_write_to' => $request->file_write_to,
            'file_total_package' => $request->file_total_package,
            'file_miscellaneous' => $request->file_miscellaneous,
            'file_testimonials' => $request->file_testimonials,
            'file_curriculum' => $request->file_curriculum,
        ]);

        try {
            Mail::to(config('mail.emails.info'))->send(new CareerApplicationEmail($store));
        } catch (\Exception $exception) {

        }

        return $this->successResponse($store);
    }
}
