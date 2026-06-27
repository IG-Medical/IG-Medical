<?php


namespace Category\Http\Controllers\App\Category;


use Category\Http\Controllers\App\CoreController;
use Category\Http\Resources\AdminPanel\Category\CategoryResource;
use Category\Models\Category;
use Category\Providers\AppServiceProvider;

class CategoryController extends CoreController
{
    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR . '.categories';
    }

    public function index()
    {
        meta_data(trans_module_category('app.categories'), trans_module_category('app.categories'), [
            '' => trans_module_category('app.categories')
        ]);

        $pageTitle = trans_module_category('app.all_categories');
        $allCategories = Category::getCategoriesRoot();

        return view($this->moduleDirView . '.index', compact('pageTitle', 'allCategories'));
    }

    public function all()
    {
        $allCategories = Category::getCategoriesRoot();
        return $this->response($allCategories);
    }
}
