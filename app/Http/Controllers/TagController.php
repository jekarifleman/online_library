<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
	// вывод страницы списка тэгов
    public function showAll()
    {
    	$tags = new \App\Models\Tag;
		$tags = $tags->all();

        return view('tags.show', [
            'title' => 'Тэги',
            'tags' => $tags
        ]);
    }

    // вывод страницы добавления тэга
    public function showAdd()
    {
        return view('tags.add', [
            'title' => 'Добавить тег',
        ]);
    }

    // вывод страницы редактирования тэга
    public function showEdit($id)
    {
    	$tags = new \App\Models\Tag;
		$tags = $tags->all()->where('id', $id);

		if (count($tags) !== 1) {
	        return redirect('/404');
		}

		foreach ($tags as $tag) {
	        return view('tags.edit', [
	            'title' => 'Редактирование тэга',
	            'tag' => $tag
	        ]);
		}
    }

    // добавление тэга в бд
    public function createTag()
    {
    	if (!isset($_GET['tag_name']) || empty(trim($_GET['tag_name']))) {
    		return "error create tag";
    	}

    	$nameTag = htmlspecialchars(trim($_GET['tag_name']));

    	$tag = new \App\Models\Tag;
		$tag = $tag->insert(
		  ['name' => $nameTag]
		);

    	return json_encode(["created tag", $tag]);
    }

    // обновление тэга в бд
    public function updateTag()
    {
    	if (!isset($_GET['tag_id']) || !isset($_GET['tag_name']) || empty(trim($_GET['tag_id'])) || empty(trim($_GET['tag_name']))) {
    		return "error update tag";
    	}

    	$tagId = htmlspecialchars(trim($_GET['tag_id']));
    	$tagName = htmlspecialchars(trim($_GET['tag_name']));

    	$tag = new \App\Models\Tag;
		$tag = $tag->where('id', $tagId)->update(['name' => $tagName]);

    	return json_encode(["updated tag", $tag]);
    }

    // обновление тэга в бд
    public function deleteTag()
    {
    	if (!isset($_GET['tag_id']) || empty(trim($_GET['tag_id']))) {
    		return "error delete tag";
    	}

    	$tagId = htmlspecialchars(trim($_GET['tag_id']));

    	$tag = new \App\Models\Tag;
		$tag = $tag->where('id', $tagId)->delete();

    	return json_encode(["deleted tag", $tag]);
    }
}
