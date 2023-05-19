<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;
class PagesController extends Controller
{
    public function __construct()
    {
        // get all the settings and bind it  in a container
        app()->singleton('settings', function () {
            return generalSettingsApi();
        });
        // dd(app('settings'));
        //get menu data for top banner
        app()->singleton('categories', function () {
            return getMenuData(2);
        });
        app()->singleton('sidebar', function () {
            return getPageData(59, $sorting = 'POS');
        });
        // dd(app('sidebar'));
    }

    //home Page
    public function index()
    {
        $data = getPageData(4, $sorting = 'POS');

        $recipes = getPageData(8, $sorting = 'POS');
        // dd($data);
        $categories = getAllCategoriesData();
        $products = showAllProductsSorted('high_to_low');

        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view(
            'home',
            compact('data', 'categories', 'products', 'recipes')
        );
    }

    // about us page
    public function about()
    {
        $data = getPageData(3, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('about', compact('data'));
    }
    // history page
    public function history()
    {
        $data = getPageData(38, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('history', compact('data'));
    }

    // team page
    public function team()
    {
        $data = getPageData(19, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('team', compact('data'));
    }

    public function categoryProducts(
        Request $request,
        $category_id,
        $category_name,
        $subcategory_id = null,
        $subcategory_name = null
    ) {
        //  dd($request);
        //Get the Home Page Content
        $data = getPageData(1, $sorting = 'POS');
        // sort products option
        $orderby = $request->query('sort', 'none');
        $by = $request->sort;
        // dd($orderby);
        //get all products from the CMS
        $category = getCategoryDataSorted($category_id, 'latest'); //
        // dd($category);
        if (!is_null($subcategory_id) && !is_null($subcategory_name)) {
            $category = getCategoryDataSorted($subcategory_id, 'latest'); //'latest'
        }

        $category_products = [];
        foreach ($category->products as $p) {
            array_push($category_products, $p);
        }

        // Sort products in array
        // dd(collect($category_products));
        if ($orderby === 'price_low_to_high') {
            $n = sizeof($category_products);
            for ($i = 1; $i < $n; $i++) {
                for ($j = $n - 1; $j >= $i; $j--) {
                    if (
                        $category_products[$j - 1]->firstVariant->price >
                        $category_products[$j]->firstVariant->price
                    ) {
                        $tmp = $category_products[$j - 1]->firstVariant->price;
                        $category_products[$j - 1]->firstVariant->price =
                            $category_products[$j]->firstVariant->price;
                        $category_products[$j]->firstVariant->price = $tmp;
                    }
                }
            }
        } elseif ($orderby === 'price_high_to_low') {
            $n = sizeof($category_products);
            for ($i = 1; $i < $n; $i++) {
                for ($j = $n - 1; $j >= $i; $j--) {
                    if (
                        $category_products[$j - 1]->firstVariant->price <
                        $category_products[$j]->firstVariant->price
                    ) {
                        $tmp = $category_products[$j - 1]->firstVariant->price;
                        $category_products[$j - 1]->firstVariant->price =
                            $category_products[$j]->firstVariant->price;
                        $category_products[$j]->firstVariant->price = $tmp;
                    }
                }
            }
        }

        $products = $category_products;
        //get all tags
        $tags = getAllTagsData();
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        // dd($category);
        return view(
            'products.products',
            compact(
                'data',
                'category',
                'products',
                'tags',
                'category_name',
                'subcategory_name'
            )
        );
    }

    //product details page
    public function productDetails($product_id, $product_name)
    {
        //get product details by id
        $product = getProductData($product_id);
        // dd($product);

        //get products of the same category
        $related_products = [];

        foreach ($product->relatedProducts as $p) {
            if (!in_array($p, $related_products) & ($p->id != $product_id)) {
                array_push($related_products, $p);
            }
        }
        $tempArr = array_unique(array_column($related_products, 'id'));
        $related_products = array_intersect_key($related_products, $tempArr);

        // getting the variants options
        $options = [];
        if (isset($product->option1_name)) {
            $options['option1_name'] = [
                'name' => $product->option1_name,
                'options' => [],
            ];
        }
        if (isset($product->option2_name)) {
            $options['option2_name'] = [
                'name' => $product->option2_name,
                'options' => [],
            ];
        }
        if (isset($product->option3_name)) {
            $options['option3_name'] = [
                'name' => $product->option3_name,
                'options' => [],
            ];
        }
        foreach ($product->variants as $variant) {
            if (
                isset($variant->option1_value) &&
                isset($options['option1_name']['options']) &&
                !in_array(
                    $variant->option1_value,
                    $options['option1_name']['options']
                )
            ) {
                array_push(
                    $options['option1_name']['options'],
                    $variant->option1_value
                );
            }
            if (
                isset($variant->option2_value) &&
                isset($options['option2_name']['options']) &&
                !in_array(
                    $variant->option2_value,
                    $options['option2_name']['options']
                )
            ) {
                array_push(
                    $options['option2_name']['options'],
                    $variant->option2_value
                );
            }
            if (
                isset($variant->option3_value) &&
                isset($options['option3_name']['options']) &&
                !in_array(
                    $variant->option3_value,
                    $options['option3_name']['options']
                )
            ) {
                array_push(
                    $options['option3_name']['options'],
                    $variant->option3_value
                );
            }
        }

        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($product->seo_title, false);
        SEOTools::setDescription($product->seo_description);
        SEOMeta::setKeywords($product->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'product');
        // SEOTools::opengraph()->addImage($product->photoGallery[0]->lg_img);

        return view(
            'products.product_details',
            compact('product', 'related_products', 'options')
        );
    }

    public function shop()
    {
        //Get the Home Page Content
        $data = getPageData(1, $sorting = 'POS');

        //get all products from the CMS
        $products = showAllProductsSorted('price_high_to_low');
        // dd($products);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');

        return view('shop', compact('data', 'products'));
    }

    // recipes
    public function recipes()
    {
        $data = getPageData(44, $sorting = 'POS');
        $featured = getPageData(100, $sorting = 'POS');
        // dd($featured);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('recipes', compact('data', 'featured'));
    }

    // recipe details
    public function recipe_details($id)
    {
        // dd($id);
        $data = getPageData($id, $sorting = 'POS');
        // get id of page similar

        // get page recipes
        $recipes = getPageData(44, $sorting = 'POS');
        $similar = getPageData(100, $sorting = 'POS');
        // dd($similar);
        if ($similar) {
        }

        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('recipe_details', compact('data', 'recipes', 'similar'));
    }

    // packing
    public function packing()
    {
        $data = getPageData(6, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();

        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('packing', compact('data'));
    }

    // faq
    public function faq()
    {
        $data = getPageData(52, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();

        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('faq', compact('data'));
    }

    // terms and conditions
    public function terms()
    {
        $data = getPageData(53, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();

        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('terms', compact('data'));
    }

    //privacy policy
    public function privacy()
    {
        $data = getPageData(54, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('privacy', compact('data'));
    }

    // contact page
    public function contact()
    {
        $data = getPageData(1, $sorting = 'POS');
        // dd($data);
        //get url of the page
        $url = url()->current();
        SEOTools::setTitle($data->seo_title, false);
        SEOTools::setDescription($data->seo_description);
        SEOMeta::setKeywords($data->seo_keywords);
        SEOTools::opengraph()->setUrl(getenv('APP_URL'));
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        return view('contact', compact('data'));
    }
    // search page
    public function getSearchData(Request $request)
    {
        $data = getSearchBarData($request->all());
        return view('search', compact('data'));
    }
    // search option 2
    public function smart_search(Request $request)
    {
        $total_row = 0;
        $data = getSearchBarData($request->all());
        // dd($data);
        foreach ($data as $product) {
            $total_row++;
        }
        $output = '';
        // $total_row =  $data->count();
        if ($total_row > 0) {
            foreach ($data as $product) {
                if ($product->seo_url) {
                    $seo_url = str_replace(
                        ' ',
                        '-',
                        preg_replace(
                            '/[^a-z0-9]/',
                            '-',
                            strtolower($product->seo_url)
                        )
                    );
                } else {
                    $seo_url = str_replace(
                        ' ',
                        '-',
                        preg_replace(
                            '/[^a-z0-9]/',
                            '-',
                            strtolower($product->title)
                        )
                    );
                }
                $output .=
                    '<li><a href="/product-' .
                    $product->id .
                    '-' .
                    $seo_url .
                    '">' .
                    $product->title .
                    '</a><li>';
            }
        } else {
            $output .= '<li>No data found<li>';
        }

        return $output;
    }
}
