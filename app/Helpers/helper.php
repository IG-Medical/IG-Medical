<?php

if (!function_exists('share_social_media')) {
    function share_social_media($type, $url = null)
    {
        if (is_null($url))
            $url = url()->current();

        $social_media = [
            'instagram' => 'https://www.instagram.com/create/story' . $url,
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
            'twitter' => 'https://twitter.com/intent/tweet?url=' . $url . '&text=',
            'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $url . '&media=&description=',
            'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=&summary=&source=',
        ];
        return $social_media[$type];
    }
}

if (!function_exists('getSlugId')) {
    function getSlugId($slug)
    {
        if (is_null($slug))
            return null;

        return last(explode('-', $slug));
    }
}

function default_array_lang()
{
    $array = [];
    foreach (languages() as $key => $value)
        $array[$key] = null;

    return $array;
}

function is_favorite($id)
{
    if (user())
        return \Product\Models\Wishlist::where('user_id', user()->id)->where('product_id', $id)->count();
}

if (!function_exists('male')) {
    function male($lang = null)
    {
        return trans('app.genders.male', [], $lang);
    }
}

if (!function_exists('female')) {
    function female($lang = null)
    {
        return trans('app.genders.female', [], $lang);
    }
}

if (!function_exists('male_and_female')) {
    function male_and_female($lang = null)
    {
        return trans('app.genders.male_and_female', [], $lang);
    }
}

if (!function_exists('genders')) {
    function genders($male_and_female = false)
    {
        $genders = [
            MALE => male(),
            FEMALE => female()
        ];
        if ($male_and_female) {
            $genders[MALE_AND_FEMALE] = male_and_female();
        }
        return $genders;
    }
}

if (!function_exists('paypal_config')) {
    function paypal_config($key)
    {
        if (config('paypal.mode') == 'sandbox' && $key != 'currency') {
            $key = 'sandbox_' . $key;
        }
        return config('paypal.' . $key);
    }
}

if (!function_exists('get_order_number')) {
    function get_order_number($id)
    {
        return '#ORD' . str_pad($id, 5, "0", STR_PAD_LEFT);
    }
}

if (!function_exists('flash_success')) {
    function flash_success($message)
    {
        return session()->flash('success_message', $message);
    }
}

if (!function_exists('flash_error')) {
    function flash_error($message)
    {
        return session()->flash('error_message', $message);
    }
}

if (!function_exists('getLogo')) {
    function getLogo($type = null)
    {
        $logo = collect(getSettings())->where('key', 'header_logo')->first();
        return isset($logo) ? $logo->value : logoHeader();
    }
}

if (!function_exists('logoHeader')) {
    function logoHeader()
    {
        return asset_app('images/logo.svg');
    }
}

if (!function_exists('calculate_total_after_discount')) {
    function calculate_total_after_discount($total, $percentage)
    {
        return $total - calculate_value_discount($total, $percentage);
    }
}

if (!function_exists('calculate_value_discount')) {
    function calculate_value_discount($total, $percentage)
    {
        return ($total * $percentage) / 100;
    }
}

if (!function_exists('redirectToBack')) {
    function redirectToBack($message = null, $isJson = false)
    {
        if (session()->previousUrl()) {
            return $isJson ? back()->getTargetUrl() : back()->with('warning_message', $message);
        }
        return $isJson ? route_app('home.index') : redirect()->route('app.home.index')->with('warning_message', $message);
    }
}


if (!function_exists('generateUniqId')) {
    function generateUniqId($limit = 20)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}

if (!function_exists('my_public')) {
    function my_public()
    {
        return base_path() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('password_rules')) {
    function password_rules($required = false, $min = '8', $confirmed = false)
    {
        $rules = [
            $required ? 'required' : 'nullable',
            'string',
            'min:' . $min,
            'regex:/^(?=.*?[\u0621-\u064A])(?=.*?[0-9])(?=.*?[؟_(#?)+`=~!@.${%}|^:;<>&*-]).{6,}$/'
        ];
        return $confirmed ? array_merge($rules, ['confirmed']) : $rules;
    }
}

if (!function_exists('mobile_regex')) {
    function mobile_regex($typeOf = 'string')
    {
        if ($typeOf == 'array')
            return ['regex:/^([0-9\s\-\+\(\)]*)$/'];
        return 'regex:/^([0-9\s\-\+\(\)]*)$/';
    }
}

if (!function_exists('aws_is_s3')) {
    function aws_is_s3()
    {
        return config('filesystems.disks.s3.run', false);
    }
}

if (!function_exists('assetUpload')) {
    function assetUpload($path)
    {
        if (aws_is_s3())
            return aws_cnd_url(DIR_UPLOAD($path));
        return asset(DIR_UPLOAD . '/' . $path);
    }
}

if (!function_exists('DIR_UPLOAD')) {
    function DIR_UPLOAD($dir)
    {
        return DIR_UPLOAD . '/' . $dir;
    }
}

if (!function_exists('aws_cnd_url')) {
    function aws_cnd_url($path, $disk = 's3')
    {
        return Illuminate\Support\Facades\Storage::disk($disk)->url($path);
    }
}


if (!function_exists('trans_admin')) {
    function trans_admin($key, $replace = [], $locale = null)
    {
        return trans('admin.' . $key, $replace, $locale);
    }
}

if (!function_exists('trans_app')) {
    function trans_app($key, $replace = [], $locale = null)
    {
        return trans('app.' . $key, $replace, $locale);
    }
}

if (!function_exists('count_segments')) {
    function count_segments(): int
    {
        return count(request()->segments());
    }
}

if (!function_exists('last_segment')) {
    function get_last_segments()
    {
        $request = request();
        return $request->segment(count($request->segments()));
    }
}

if (!function_exists('app_name')) {
    function app_name()
    {
        $name = getSetting('site_name');
        return $name ? $name[getAppLocale()] : config('app.name');
    }
}

if (!function_exists('route_admin')) {
    function route_admin($name = null, $parameter = [])
    {
        return route(ADMIN_ROUTE . '.' . $name, $parameter);
    }
}

if (!function_exists('route_app')) {
    function route_app($name = null, $parameter = [])
    {
        return route(APP_ROUTE . '.' . $name, $parameter);
    }
}

if (!function_exists('getAppLocale')) {
    function getAppLocale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('asset_admin')) {
    function asset_admin($url)
    {
        return asset(ADMIN_PUBLIC_DIR . '/' . $url);
    }
}

if (!function_exists('asset_app')) {
    function asset_app($url)
    {
        return asset(APP_PUBLIC_DIR . '/assets/' . $url);
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->guard()->user();
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        return config('app.locales');
    }
}

if (!function_exists('url_lang')) {
    function url_lang($url = null, $parameters = [])
    {
        return url('/' . getAppLocale() . '/' . $url, $parameters);
    }
}

if (!function_exists('meta')) {
    function meta($key, $value = null)
    {
        if ($value) {
            \App\Services\Meta::set($key, $value);
        }
        return \App\Services\Meta::get($key);
    }
}

if (!function_exists('meta_data')) {
    function meta_data($page_title = '', $breadcrumbs_title = '', $breadcrumbs = [])
    {
        meta('page-title', $page_title);
        meta('breadcrumbs-title', $breadcrumbs_title);
        meta('breadcrumbs', $breadcrumbs);
    }
}

if (!function_exists('active_link_sidebar')) {
    function active_link_sidebar($chosenURl): string
    {
        $segment2 = request()->segment(2);
        $segment3 = request()->segment(3);
        $segment4 = request()->segment(4);
        $segment5 = request()->segment(5);
        $currentURL = 'dashboard';


        if ($segment2)
            $currentURL = $segment2;
        if ($segment3)
            $currentURL = $segment3;
        if ($segment4)
            $currentURL = $segment4;
        if ($segment5)
            $currentURL = $segment5;


        return $currentURL == $chosenURl ? ' m-menu__item--active' : '';
    }
}

if (!function_exists('active_arrow_down_sidebar')) {
    function active_arrow_down_sidebar(array $chosenURl)
    {
        $segment2 = request()->segment(2);
        $segment3 = request()->segment(3);
        $segment4 = request()->segment(4);
        $segment5 = request()->segment(5);
        $currentURL = 'dashboard';

        if ($segment2)
            $currentURL = $segment2;
        if ($segment3)
            $currentURL = $segment3;
        if ($segment4)
            $currentURL = $segment4;
        if ($segment5)
            $currentURL = $segment5;

        return in_array($currentURL, $chosenURl) ? ' m-menu__item--open' : '';
    }
}

if (!function_exists('build_fields')) {
    function build_fields($name, $translate = null, $value = null, $type = "text", $other = null)
    {
        $lang = languages();
        $out = "";
        if (!is_null($other)) {
            $others = "";
            foreach ($other as $key => $o) {
                $others .= "$key ='$o' ";
            }
        } else {
            $others = null;
        }
        $out .= '<div class="row">';

        foreach ($lang as $key => $lan) {
            $newValue = $value != null ? $value[$lan] : null;
            $out .= '<div class="col-md-6 pb-4">';
            $out .= '<div class="form-group m-form__group">';
            $out .= '<label for="' . $name . '.' . $key . '" >' . $translate . ' ' . trans('admin.language') . ' ' . $lan . '</label >';
            if ($type != 'textarea') {

                $out .= '<input type = "' . $type . '" class="form-control m-input"  v-model="' . $name . '.' . $key . '"
                      id = "' . $name . '.' . $key . '" placeholder="' . $translate . ' ' . trans('admin.language') . ' ' . $lan . '" ' . $others . ' value="' . $newValue . '"  />
                      <span class="form-control-feedback" v-if="form.validation&&form.validation[' . $name . '.' . $key . ']">@{{ form.validation[' . $name . '.' . $key . '][0] }}</span>';

            } else {

                $out .= '<textarea  v-model="' . $name . '.' . $key . '"   name="' . $name . '[' . $lan . ']" id = "' . $name . '.' . $key . '" class="form-control"   placeholder="' . $translate . ' ' . trans('admin.language') . ' ' . $lan . '" ' . $others . '>' . $newValue . '</textarea>';

            }
            $out .= '</div >';
            $out .= '</div >';
        }
        $out .= '</div >';
        return $out;
    }
}

if (!function_exists('slugify')) {
    function slugify($text, $separator = '-')
    {
        if (is_null($text)) {
            return "";
        }

        $string = trim($text);
        $string = mb_strtolower($string, 'UTF-8');

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and Persian characters as well
        $string = preg_replace("/[^a-z0-9_\s-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهیأمإيةى]/u", '', $string);

        // Remove multiple dashes or whitespaces or underscores
        $string = preg_replace("/[\s-_]+/", ' ', $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}
