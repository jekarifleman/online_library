<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
	// вывод страницы списка тэгов
    public function showAll()
    {
    	$categories = new \App\Models\Category;
		$categories = $categories->all();

        return view('categories.show', [
            'title' => 'Категории',
            'categories' => $categories
        ]);
    }

    // вывод страницы добавления тэга
    public function showAdd()
    {
        return view('categories.add', [
            'title' => 'Добавить категорию',
        ]);
    }

    // вывод страницы редактирования тэга
    public function showEdit($id)
    {
    	$categories = new \App\Models\Category;
		$categories = $categories->all()->where('id', $id);

		if (count($categories) !== 1) {
	        return redirect('/404');
		}

		foreach ($categories as $category) {
	        return view('categories.edit', [
	            'title' => 'Редактирование категории',
	            'category' => $category
	        ]);
		}
    }

    // добавление тэга в бд
    public function createCategory()
    {
    	if (!isset($_GET['category_name']) || empty(trim($_GET['category_name']))) {
    		return "error create category";
    	}

    	$nameCategory = htmlspecialchars(trim($_GET['category_name']));

    	$category = new \App\Models\Category;
		$category = $category->insert(
		  ['name' => $nameCategory]
		);

    	return json_encode(["created category", $category]);
    }

    // обновление тэга в бд
    public function updateCategory()
    {
    	if (!isset($_GET['category_id']) || !isset($_GET['category_name']) || empty(trim($_GET['category_id'])) || empty(trim($_GET['category_name']))) {
    		return "error update category";
    	}

    	$categoryId = htmlspecialchars(trim($_GET['category_id']));
    	$categoryName = htmlspecialchars(trim($_GET['category_name']));

    	$category = new \App\Models\Category;
		$category = $category->where('id', $categoryId)->update(['name' => $categoryName]);

    	return json_encode(["updated category", $category]);
    }

    // обновление тэга в бд
    public function deleteCategory()
    {
    	if (!isset($_GET['category_id']) || empty(trim($_GET['category_id']))) {
    		return "error delete category";
    	}

    	$categoryId = htmlspecialchars(trim($_GET['category_id']));

    	$category = new \App\Models\Category;
		$category = $category->where('id', $categoryId)->delete();

    	return json_encode(["deleted category", $category]);
    }
}
