<?php


namespace App\Http\ViewComposers;

use App\Models\NavbarItem;
use Category\Models\Category;
use Illuminate\Contracts\View\View;
use Product\Models\Product;


class SiteConstantsComposer
{
    protected $data;

    public function __construct()
    {
        $lang = getAppLocale();
        $welcome_text = getSetting('welcome_text');
        $global_website = getSetting('global_website');
        $favicon = getSetting('favicon');

        $header_logo = getSetting('header_logo');
        $footer_logo = getSetting('footer_logo');
        $headMessage = (is_array($welcome_text) && isset($welcome_text[$lang])) ? $welcome_text[$lang] : null;

        $footer_about_site = getSetting('footer_about_site');
        $footerAboutSite = (is_array($footer_about_site) && isset($footer_about_site[$lang])) ? $footer_about_site[$lang] : null;

        $phone = getSetting('phone');

        $address = getSetting('address');
        $address = (is_array($address) && isset($address[getAppLocale()])) ? $address[getAppLocale()] : null;

        $email = getSetting('email');

        $facebook = getSetting('facebook');
        $twitter = getSetting('twitter');
        $youtube = getSetting('youtube');
        $instagram = getSetting('instagram');
        $linkedin = getSetting('linkedin');

        $categoryFooter = Category::where('is_active', YES)
                ->whereNotNull('parent_id')
                ->orderBy('order_number', 'asc')
                ->limit(7)
                ->get();
        $categoryHeader1 = Category::getCategoriesHeader1();
        $categoryHeader2 = Category::getCategoriesHeader2();

        $navbarItems = NavbarItem::getNavbarItems();

        $this->data = [
            'favicon' => $favicon,
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
            'welcome_text' => $headMessage,
            'footer_about_site' => $footerAboutSite,
            'global_website' => $global_website,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
            'categoryFooter' => $categoryFooter,
            'categoryHeader1' => $categoryHeader1,
            'categoryHeader2' => $categoryHeader2,
            'navbarItems' => $navbarItems,
        ];
    }


    public function compose(View $view)
    {
        $view->with('data', $this->data);
    }
}
