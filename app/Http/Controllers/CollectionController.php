<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // добавление тэга в материал
    public function addTag()
    {
    	if (!isset($_GET['material_id']) || empty(trim($_GET['tag_id']))) {
    		return "error create tag";
    	}

    	$materialId = htmlspecialchars($_GET['material_id']);
        $tagId = htmlspecialchars($_GET['tag_id']);

    	$collection = new \App\Models\Collection;
		$collection = $collection->insert(
		  ['material_id' => $materialId, 'tag_id' => $tagId]
		);

    	return json_encode(["added tag to material", $collection]);
    }

    // удаление тэга из материала
    public function deleteTag()
    {
    	if (!isset($_GET['material_id']) || empty(trim($_GET['tag_id']))) {
    		return "error delete tag from material";
    	}

        $materialId = htmlspecialchars($_GET['material_id']);
        $tagId = htmlspecialchars($_GET['tag_id']);

    	$tag = new \App\Models\Collection;
		$tag = $tag->where('material_id', $materialId)->where('tag_id', $tagId)->delete();

    	return json_encode(["deleted tag from material", $tag]);
    }
}
