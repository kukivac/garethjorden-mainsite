<?php


namespace app\controllers;

use app\models\AlbumManager;
use app\models\DbManager;

/**
 * Class PhotosController
 * @package app\controllers
 */
class PhotosController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets photos page
     *
     * @param array $params
     * @param array|null $gets
     */
    function process(array $params, array $gets = null)
    {
        $this->head['page_title'] = $this->head['page_title'] . " | Photos";
        $this->data["images"] = $this->albumManager->getAllImages();
        $this->setView('default');
    }
}