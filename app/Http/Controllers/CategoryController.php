<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Prod;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::tree()->get()->toTree();
        return view('category.index', compact('categories' ));
    }

    public function settingIndex() {

        $userId = auth()->user()->id;
        if (Sort::where('user_id', $userId)->exists()) {

            $sorty = Sort::where('user_id', $userId)->first();
            $sort = $sorty->cat_ids;
            $categories = Category::orderByRaw("FIELD(id, $sort )")->tree()->get()->toTree();
            return view('category.setting', compact('categories'));

        }else {
            $categories = Category::tree()->get()->toTree();
            return view('category.setting', compact('categories'));
        }
    }

    public function settingSave(Request $request) {
        $user = auth()->user()->id;
        $sort = $request->input('sort');//Получаем отсортированный список id
        Sort::updateOrCreate(
            ['user_id' => $user], ['cat_ids' => $sort]
        );
        return redirect()->route('category.setting.index');
    }

    public function search (Request $request){
        $s = $request->s;
        $prods = Prod::where('fields', 'LIKE', "%{$s}%")->get();
        $prodss = $prods->pluck('category_id')->toArray();
        $pr = implode(',', $prodss);
        $categories = Category::where('id', $pr)->tree()->get()->toTree();
        return view('category.index', compact('categories'));
    }
}
