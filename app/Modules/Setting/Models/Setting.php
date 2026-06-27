<?php

namespace Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $guarded = [];

    public const DIR_BREADCRUMBS_UPLOADS = 'breadcrumbs';
    public const DIR_LOGO_UPLOADS = 'logo';
    public const DIR_FEATURE_UPLOADS = 'features';
    public const DIR_ABOUT_US_UPLOADS = 'about-us';
    public const DIR_CERTIFICATIONS_UPLOADS = 'certifications';

    public const PAGE_CUSTOM_CSS_JS = 'custom-css-js';
    public const PAGE_GENERAL = 'general';
    public const PAGE_MAINTENANCE = 'maintenances';
    public const PAGE_SITE = 'site';
    public const PAGE_MAIL = 'mail';
    public const PAGE_SOCIAL_MEDIA_LINKS = 'social-media-links';
    public const PAGE_LOGO = 'logo';
    public const PAGE_CONTACT_INFO = 'contact-info';
    public const PAGE_FEATURES = 'features';
    public const PAGE_HOME_PAGE = 'home-page';
    public const PAGE_ABOUT_US = 'about-us';
    public const PAGE_CERTIFICATIONS = 'certifications';
    public const PAGE_BREADCRUMBS = 'breadcrumbs';
    public const PAGE_PAGE_TITLES = 'titles';
    public const DIR_SLIDER_VIDEO_UPLOADS = 'slider-video';


    public function getValueAttribute($data)
    {
        if (is_null($data))
            return null;

        $arrayFeature = ['feature_1', 'feature_2', 'feature_3', 'feature_4', 'feature_5'];

        if (in_array($this->key, array_merge([
            'address', 'site_name', 'welcome_text', 'footer_about_site', 'sub_title_featured_categories',
            'about_us_page', 'certifications_page', 'home_page_about_us_section', 'home_page_product_section', 'home_page_companies_section'], $arrayFeature))) {
            // Safely attempt to unserialize; avoid warnings on malformed data
            if (!is_array($data)) {
                $unserialized = @unserialize($data);

                // If unserialize fails (and it's not the special serialized false "b:0;"),
                // fall back to returning the raw value to avoid PHP warnings.
                if ($unserialized === false && $data !== 'b:0;') {
                    return $data;
                }

                $data = $unserialized;
            }

            if (in_array($this->key, $arrayFeature)) {
                if (isset($data['icon'])) {
                    if (isset($data['icon']['path']))
                        unset($data['icon']['path']);

                    if (isset($data['icon']['name']))
                        unset($data['icon']['name']);


                    if (isset($data['icon']['file_link'])) {
                        $fileLink = $data['icon']['file_link'];
                        $data['icon'] = $fileLink;
                        $data['icon_url'] = assetUpload(self::DIR_FEATURE_UPLOADS . '/' . $fileLink);
                    } else {
                        if (!is_array($data['icon'])) {
                            $data['icon_url'] = assetUpload(self::DIR_FEATURE_UPLOADS . '/' . $data['icon']);
                        } else {
                            $data['icon_url'] = null;
                        }
                    }
                }
            }
            if ($this->key === 'about_us_page') {
                if (isset($data['section2']['feather'])) {
                    $feather = $data['section2']['feather'];
                    foreach ($feather as $k1 => $f) {
                        if (isset($f['image'])) {
                            $image = $f['image'];
                            foreach (languages() as $key => $value) {

                                if (isset($image[$key])) {
                                    if (isset($image[$key]['path']))
                                        unset($data['section2']['feather'][$k1]['image'][$key]['path']);

                                    if (isset($image[$key]['name']))
                                        unset($data['section2']['feather'][$k1]['image']['name']);

                                    if (isset($image[$key]['file_link'])) {
                                        $fileLink = $image[$key]['file_link'];
                                        $data['section2']['feather'][$k1]['image'][$key] = $fileLink;
                                        $data['section2']['feather'][$k1]['image_url'][$key] = $image[$key] ? assetUpload(self::DIR_ABOUT_US_UPLOADS . '/' . $fileLink) : null;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($this->key === 'certifications_page') {

                if (isset($data['images'])) {
                    $images = $data['images'];
                    foreach ($images as $k1 => $f) {

                        if (isset($f['image'])) {
                            $image = $f['image'];

                            foreach (languages() as $key => $value) {
                                if (isset($image[$key])) {
                                    if (isset($image[$key]['path']))
                                        unset($data['images'][$k1]['image'][$key]['path']);

                                    if (isset($image[$key]['name']))
                                        unset($data['images'][$k1]['image']['name']);

                                    if (isset($image[$key]['file_link'])) {
                                        $fileLink = $image[$key]['file_link'];
                                        $data['images'][$k1]['image'][$key] = $fileLink;
                                        $data['images'][$k1]['image_url'][$key] = $image[$key] ? assetUpload(self::DIR_CERTIFICATIONS_UPLOADS . '/' . $fileLink) : null;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
            return $data;
        }


        if (in_array($this->key, ['header_logo', 'header_logo1', 'footer_logo', 'favicon', 'app_link_background'])) {
            return assetUpload(self::DIR_LOGO_UPLOADS . '/' . $data);
        }

        if ($this->key === 'slider_video') {
            return $data ? assetUpload(self::DIR_SLIDER_VIDEO_UPLOADS . '/' . $data) : null;
        }

        if (in_array($this->key, ['breadcrumb_about_us', 'breadcrumb_customized', 'breadcrumb_contact_us', 'breadcrumb_ig_world', 'breadcrumb_job', 'breadcrumb_news', 'breadcrumb_public_page', 'breadcrumb_certifications', 'breadcrumb_sales', 'breadcrumb_technical'])) {

            return [
                'url' => assetUpload(self::DIR_BREADCRUMBS_UPLOADS . '/' . $data),
                'file' => $data,
            ];
        }
        return $data;
    }


    public static function getSettings()
    {
        return Cache::remember('settings', CACHE_TTL, function () {
            return self::select('key', 'value')->get();
        });
    }
}
