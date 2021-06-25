<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    // добавление url в материал
    public function addUrl()
    {
    	if (!isset($_GET['material_id'])
            || empty(trim($_GET['material_id']))
            || !isset($_GET['url'])
            || empty(trim($_GET['url']))
        ) {
    		return "error create url";
    	}

    	$materialId = htmlspecialchars($_GET['material_id']);
        $url = htmlspecialchars($_GET['url']);
        $urlName = htmlspecialchars($_GET['url_name'] ?? $url);

    	$urls = new \App\Models\Url;
		$urls = $urls->insert(
		  ['material_id' => $materialId, 'url' => $url, 'title' => $urlName,]
		);

    	return json_encode(["added url", $urls]);
    }

    // обновление url в материале
    public function updateUrl()
    {
        if (!isset($_GET['url']) 
            || empty(trim($_GET['url']))
            || !isset($_GET['url_id']) 
            || empty(trim($_GET['url_id']))
        ) {
            return "error update url";
        }

        $urlId = htmlspecialchars($_GET['url_id']);
        $url = htmlspecialchars($_GET['url']);
        $urlName = htmlspecialchars($_GET['url_name'] ?? $url);

        $urls = new \App\Models\Url;
        $urls = $urls->where('id', $urlId)->update(
            [
                'url' => $url,
                'title' => $urlName,
            ]
        );

        return json_encode(["updated url", $urls]);
    }

    // удаление url из материала
    public function deleteUrl()
    {
    	if (!isset($_GET['url_id']) || empty(trim($_GET['url_id']))) {
    		return "error delete tag from material";
    	}

        $urlId = htmlspecialchars($_GET['url_id']);

    	$urls = new \App\Models\Url;
		$urls = $urls->where('id', $urlId)->delete();

    	return json_encode(["deleted url", $urlId]);
    }
}
