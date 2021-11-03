<?php


namespace app\controllers;

use app\models\AlbumManager;
use app\models\DbManager;
use app\router\Router;

/**
 * Class AlbumController
 *
 * @package app\controllers
 */
class AlbumController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets album page
     *
     * @param array $params
     * @param array|null $gets
     */
    function process(array $params, array $gets = null)
    {
        $this->head['page_title'] .= " | Album";


        if (isset($params[0])) {
            $this->processSingleAlbum($params[0]);
        } else {
            $this->processDefault();
        }

    }

    /**
     * Sets single album page
     * @param string $albumTitle
     */
    private function processSingleAlbum(string $albumTitle)
    {
        if ($this->albumManager->albumExists($albumTitle)) {
            $this->data["info"] = $this->albumManager->getAlbumInfo($albumTitle);
            $this->data["images"] = $this->albumManager->getAlbumImages($albumTitle);
            $this->setView("singleAlbum");
        } else {
            Router::reroute("album");
        }
    }


    /**
     * Sets main albums page
     */
    private function processDefault()
    {
        $this->setView('default');
        $this->data["albums"] = $this->albumManager->getAlbums();
    }
}