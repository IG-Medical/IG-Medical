<?php

namespace Setting\Http\Controllers\AdminPanel\Appearance;


use Setting\Http\Controllers\AdminPanel\CoreController;
use Setting\Models\Setting;

class AppearanceController extends CoreController
{

    public function __construct(Setting $setting)
    {
        $this->subDirView = 'appearance';
        $this->asRoute = 'appearance';
        $this->route = 'appearances';

        if (request('page'))
            $this->routeUrl = route_admin($this->asRoute . '.index', ['page' => request('page')]);

        $permission1 = 'index-general-appearance|index-logo-appearance|index-social-links-appearance|index-contact-info-appearance|index-slider-appearance';

        // $this->middleware('permission:' . $permission1, ['only' => ['index']]);
        parent::__construct($setting);

    }

    public function index($page)
    {
        $pageTitle = $this->getBasenamePage($page);

        meta_data($pageTitle, $pageTitle, [
            '#' => trans('admin.appearance'),
            '' => $pageTitle
        ]);

        $settings = getSettings();
        $DIR_ABOUT_US_UPLOADS = Setting::DIR_ABOUT_US_UPLOADS;
        $DIR_CERTIFICATIONS_UPLOADS = Setting::DIR_CERTIFICATIONS_UPLOADS;
        $moduleNamespace = $this->moduleNamespace;

        $asRoute = $this->getAsRoute($page);

        $singleLabel = $this->getSingleLabel($page);

        return view($this->moduleDirView . '.' . $this->subDirView . '.' . $this->getViewPath($page),
            compact('page', 'settings', 'asRoute', 'singleLabel', 'moduleNamespace', 'DIR_ABOUT_US_UPLOADS', 'DIR_CERTIFICATIONS_UPLOADS')
        );
    }

    private function getSingleLabel($page)
    {
        if ($page === 'sliders')
            $page = trans('admin.slider');

        return $page;
    }

    private function getViewPath($page)
    {
        if ($page === 'sliders')
            $page = 'sliders.index';

        return $page;
    }

    private function getAsRoute($page)
    {
        $route = null;
        if ($page === 'sliders')
            $route = 'appearance.slider';

        return $route;
    }

    private function getBasenamePage($page)
    {
        switch ($page) {
            case PAGE_SOCIAL_MEDIA_LINKS:
                $page = trans_admin('social_links');
                break;
            case PAGE_LOGO:
                $page = trans_admin('logo');
                break;
            case 'sliders':
                $page = trans_admin('sliders');
                break;
            case PAGE_GENERAL:
                $page = trans_admin('general');
                break;
            case 'footer':
                $page = trans_admin('footer');
                break;
            case PAGE_FEATURES:
                $page = trans_admin('features');
                break;
            case PAGE_HOME_PAGE:
                $page = trans_admin('home_page');
                break;
            case PAGE_ABOUT_US:
                $page = trans_admin('about_us');
                break;
            case PAGE_CERTIFICATIONS:
                $page = trans_admin('certifications');
                break;
            case PAGE_BREADCRUMBS:
                $page = trans_module_setting('admin.breadcrumbs');
                break;
            case PAGE_TITLES:
                $page = trans_admin('titles');
                break;
            default:
                $page = trans_admin('contact_info');
                break;

        }

        return $page;
    }
}
