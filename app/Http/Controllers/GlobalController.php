<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class GlobalController extends Controller
{


    function getSubCategoryByMainCategory(Category $category) {
        $category->load("sub_categories");
        return generateSelectOption($category->sub_categories);
    }
}
