<?php


namespace App\Http\Controllers\App;

use App\Http\Requests\App\Email\StoreSubscribeEmailRequest;
use App\Models\Banner;
use App\Models\MailingList;
use Category\Models\Category;
use News\Models\News;
use Product\Models\Product;
use Slider\Models\Slider;
use Testimonial\Models\Testimonial;

class HomeController extends CoreController
{
    public function index()
    {
        $sliders = Slider::getSliders();


        $pageTitle = trans_app('home_page');
        $video_how_it_works = getSetting('video_how_it_works');
        $testimonials = Testimonial::getTestimonials();
        $products = Product::whereNull('product_id')->limit(5)->get();
        $categories = Category::whereNotNull('parent_id')->where('is_featured', YES)->orderBy('created_at', 'asc')->get();
        $categories1 = Category::whereNotNull('parent_id')->orderBy('created_at', 'asc')->get();
        $news = News::limit(3)->orderBy('created_at','desc')->get();

        $home_page_about_us_section = getSetting('home_page_about_us_section');
        $home_page_product_section = getSetting('home_page_product_section');
        $home_page_companies_section = getSetting('home_page_companies_section');

        $sliders_1 = Slider::where('home_page_top', YES)->orderBy('created_at','asc')->get();
        $sliders_2 = Slider::where('home_page_center', YES)->orderBy('created_at','asc')->get();

        $banners = Banner::where('is_active', true)
            ->orderBy('position')
            ->with(['categories' => function($q) {
                $q->orderBy('banner_category.position');
            }])
            ->get();

        $usedCategoryIds = $banners->flatMap(function($banner) {
            return $banner->categories->pluck('id');
        })->unique();

        $freeCategories = Category::where('is_active', 1)
            ->whereNotIn('id', $usedCategoryIds)
            ->whereNotNull('parent_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('app.home.index', compact(
            'sliders',
            'video_how_it_works',
            'pageTitle',
            'testimonials',
            'products',
            'news',
            'categories',
            'categories1',
            'home_page_about_us_section',
            'home_page_product_section',
            'home_page_companies_section',
            'sliders_1',
            'sliders_2',
            'banners',
            'freeCategories'
        ));
    }

    public function showAboutUsPage() {
        $pageTitle = trans_app('about_us');
        $aboutUs = getSetting('about_us_page');

        meta_data($pageTitle, $pageTitle, [
            '' => $pageTitle
        ]);
        $breadcrumb = getSetting('breadcrumb_about_us');

        return view('app.about-us.index', compact(
            'pageTitle','aboutUs','breadcrumb'
        ));
    }

    public function showCertificationsPage() {
        $pageTitle = trans_app('certifications');

        meta_data($pageTitle, $pageTitle, [
            '' => $pageTitle
        ]);
        $certification= getSetting('certifications_page');
        $breadcrumb = getSetting('breadcrumb_certifications');

        return view('app.certifications.index', compact(
            'pageTitle','certification','breadcrumb'
        ));
    }

    public function subscribeEmail(StoreSubscribeEmailRequest $request)
    {
        $create = MailingList::create($request->except(['recaptcha', 'agree']));
        return $this->successResponse($create);
    }
}
