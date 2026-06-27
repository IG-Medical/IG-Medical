<?php


namespace Product\Http\Controllers\App\Search;


use Category\Models\Category;
use Illuminate\Http\Request;
use Product\Http\Controllers\App\CoreController;
use Product\Http\Resources\App\Product\ProductsResource;
use Product\Models\Product;
use Product\Providers\AppServiceProvider;

class SearchProductsController extends CoreController
{
    use ProductFilter;

    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR . '.search';
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
    }

    public function index(Request $request)
    {
        $pageTitle = trans_module_product('app.search_products');

        $categoryID = $request->category;
        $sub_title = ['' => $pageTitle];

        if (!is_null($categoryID)) {

            $category = Category::select('name')->where('slug', $categoryID)->first();
            if ($category)
                $sub_title = ['' => $category->name];
        }

        meta_data($pageTitle, $pageTitle, $sub_title);

        $allCategories = Category::getCategoriesRoot();
        $productsRelated = $this->productsRelated();
        $asRoute = $this->moduleNamespace;

        return view($this->moduleDirView . '.index', compact('pageTitle', 'allCategories', 'productsRelated', 'asRoute'));
    }

    public function data(Request $request)
    {
        $products = new Product();

        $products = $this->filter($request, $products);

        $products = $this->sort($request, $products);

        $limit = $request->limit ? $request->limit : APP_PER_PAGE;
        $products = $products->paginate($limit);

        $data = ProductsResource::collection($products);
        $meta = collect($products)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }
}
