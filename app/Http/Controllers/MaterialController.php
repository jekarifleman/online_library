<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Вывод списком всех материалов на страницу
    public function showAll()
    {
        $materials = new \App\Models\Material;

        $getQuery = isset($_GET['query']) && !empty($_GET['query']) ? htmlspecialchars($_GET['query']) : null;

        if ($getQuery !== null) {
            // поиск в названии категории, имени материала, авторах
            $materialsByQuery = $materials
                            ->join('categories', 'categories.id', '=', 'materials.category_id')
                            ->join('types', 'types.id', '=', 'materials.type_id')
                            ->where('categories.name', 'like', '%' . $getQuery . '%')
                            ->orWhere('materials.name', 'like', '%' . $getQuery . '%')
                            ->orWhere('materials.authors', 'like', '%' . $getQuery . '%')
                            ->select('materials.*', 'categories.name as category_name', 'types.name as type_name')
                            ->get();

            // поиск части слова в тэгах
            $materialsWithTags = $materials
                            ->join('categories', 'categories.id', '=', 'materials.category_id')
                            ->join('types', 'types.id', '=', 'materials.type_id')
                            ->join('collections', 'collections.material_id', '=', 'materials.id')
                            ->join('tags', 'collections.tag_id', '=', 'tags.id')
                            ->where('tags.name', 'like', '%' . $getQuery . '%')
                            ->select('materials.*', 'categories.name as category_name', 'types.name as type_name')
                            ->get();

            // Объединяем результаты двух запросов
            $materials = [];
            foreach ($materialsByQuery as $material) {
                $materials[] = $material;
            }

            foreach ($materialsWithTags as $material) {
                $materials[] = $material;
            }

            $materials = array_unique($materials);
        } else {
            $materials = $materials
                            ->join('categories', 'categories.id', '=', 'materials.category_id')
                            ->join('types', 'types.id', '=', 'materials.type_id')
                            ->select('materials.*', 'categories.name as category_name', 'types.name as type_name')
                            ->get();
        }

        return view('materials.view_all', [
            'title' => 'Материалы',
            'materials' => $materials,
            'getQuery' => $getQuery,
        ]);
    }

    // добавление материала в бд
    public function createMaterial()
    {
        if (!isset($_GET['type_id']) 
            || empty(trim($_GET['type_id']))
            || !isset($_GET['category_id'])
            || empty(trim($_GET['category_id']))
            || !isset($_GET['name'])
            || empty(trim($_GET['name']))
        ) {
            return "error create material";
        }

        $typeId = htmlspecialchars(trim($_GET['type_id']));
        $categoryId = htmlspecialchars(trim($_GET['category_id']));
        $name = htmlspecialchars(trim($_GET['name']));
        $authors = htmlspecialchars(trim($_GET['authors'] ?? ''));
        $description = htmlspecialchars(trim($_GET['description'] ?? ''));

        $material = new \App\Models\Material;
        $material = $material->insert(
            [
                'type_id' => $typeId,
                'category_id' => $categoryId,
                'name' => $name,
                'authors' => $authors,
                'description' => $description,

            ]
        );

        return json_encode(["created material", $material]);
    }

    // обновление материала в бд
    public function deleteMaterial()
    {
        if (!isset($_GET['material_id']) || empty(trim($_GET['material_id']))) {
            return "error delete material";
        }

        $materialId = htmlspecialchars(trim($_GET['material_id']));

        $material = new \App\Models\Material;
        $material = $material->where('id', $materialId)->delete();

        return json_encode(["deleted material", $material]);
    }

    // обновление материала в бд
    public function updateMaterial()
    {
        if (!isset($_GET['type_id']) 
            || empty(trim($_GET['type_id']))
            || !isset($_GET['category_id'])
            || empty(trim($_GET['category_id']))
            || !isset($_GET['name'])
            || empty(trim($_GET['name']))
            || !isset($_GET['material_id'])
            || empty(trim($_GET['material_id']))
        ) {
            return "error update material";
        }

        $materialId = $_GET['material_id'];

        $typeId = htmlspecialchars(trim($_GET['type_id']));
        $categoryId = htmlspecialchars(trim($_GET['category_id']));
        $name = htmlspecialchars(trim($_GET['name']));
        $authors = htmlspecialchars(trim($_GET['authors'] ?? ''));
        $description = htmlspecialchars(trim($_GET['description'] ?? ''));

        $material = new \App\Models\Material;
        $material = $material->where('id', $materialId)->update(
            [
                'type_id' => $typeId,
                'category_id' => $categoryId,
                'name' => $name,
                'authors' => $authors,
                'description' => $description,

            ]
        );

        return json_encode(["updated material", $material]);
    }

    public function showSearchByTag()
    {
        $tagId = isset($_GET['tag_id']) && !empty($_GET['tag_id']) ? htmlspecialchars($_GET['tag_id']) : null;

        $tagName = isset($_GET['tag_name']) && !empty($_GET['tag_name']) ? htmlspecialchars($_GET['tag_name']) : null;

        $materials = new \App\Models\Material;

        // выборка материалов по тэгу (id тэга)
        $materialsWithTags = $materials
                        ->join('categories', 'categories.id', '=', 'materials.category_id')
                        ->join('types', 'types.id', '=', 'materials.type_id')
                        ->join('collections', 'collections.material_id', '=', 'materials.id')
                        ->join('tags', 'collections.tag_id', '=', 'tags.id')
                        ->where('tags.id', $tagId)
                        ->select('materials.*', 'categories.name as category_name', 'types.name as type_name', 'tags.id as tag_id')
                        ->get();

        return view('materials.search_by_tag', [
            'title' => 'Результаты по тэгу' . ' "' . htmlspecialchars($tagName) . '"',
            'materials' => $materialsWithTags,
        ]);
    }

    // Показать страницу конкретного материала.
    public function showProfile($id)
    {
        $materials = new \App\Models\Material;
        $materials = $materials
                        ->join('categories', 'categories.id', '=', 'materials.category_id')
                        ->join('types', 'types.id', '=', 'materials.type_id')
                        ->where('materials.id', '=', $id)
                        ->select('materials.*', 'categories.name as category_name', 'types.name as type_name')
                        ->get();

        if (count($materials) !== 1) {
            return redirect('/404');
        }

        $profileTags = new \App\Models\Collection;
        $profileTags = $profileTags
                        ->join('materials', 'materials.id', '=', 'collections.material_id')
                        ->join('tags', 'tags.id', '=', 'collections.tag_id')
                        ->where('materials.id', '=', $id)
                        ->select('tags.id as tag_id', 'tags.name as tag_name')
                        ->get();

        $allTags = new \App\Models\Tag;
        $allTags = $allTags->all();

        $profileUrls = new \App\Models\Url;
        $profileUrls = $profileUrls
                        ->join('materials', 'materials.id', '=', 'urls.material_id')
                        ->where('materials.id', '=', $id)
                        ->select('urls.*')
                        ->get();

        foreach ($materials as $material) {
            return view('materials.view_profile', [
                'title' => $material->name,
                'material' => $material,
                'profileTags' => $profileTags,
                'allTags' => $allTags,
                'profileUrls' => $profileUrls,
            ]);
        }
    }

    // Показать страницу добавления материала.
    public function showAdd()
    {
        $types = new \App\Models\Type;
        $types = $types->all();

        $categories = new \App\Models\Category;
        $categories = $categories->all();

        return view('materials.add', [
            'title' => 'Добавить материал',
            'types' => $types,
            'categories' => $categories,
        ]);
    }

    // вывод страницы редактирования материала
    public function showEdit($id)
    {
        $materials = new \App\Models\Material;
        $materials = $materials
                        ->join('categories', 'categories.id', '=', 'materials.category_id')
                        ->join('types', 'types.id', '=', 'materials.type_id')
                        ->where('materials.id', '=', $id)
                        ->select('materials.*', 'categories.name as category_name', 'types.name as type_name')
                        ->get();

        if (count($materials) !== 1) {
            return redirect('/404');
        }

        $types = new \App\Models\Type;
        $types = $types->all();

        $categories = new \App\Models\Category;
        $categories = $categories->all();

        foreach ($materials as $material) {
            return view('materials.edit', [
                'title' => 'Редактировать материал',
                'material' => $material,
                'types' => $types,
                'categories' => $categories,
            ]);
        }
    }

    public function rezerv($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
