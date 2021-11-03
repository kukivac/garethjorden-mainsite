<?php

namespace app\controllers;

use Exception;

/**
 * Controller HandleController
 *
 * @package app\controllers
 */
class HandleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    protected array $data = [];
    protected array $head = [];


    /**
     * Handles ajax requests
     *
     * @param array $params
     * @param array|null $gets
     *
     * @return void
     * @throws Exception
     */
    public function process(array $params, array $gets = null)
    {
        if (isset($params[0])) {
            $function = str_replace("-", "", ucfirst(strtolower($params[0])));
            array_shift($params);
            try {
                call_user_func(array($this, $function), $params, $gets);
            } catch (Exception $e) {
                header($e->getMessage());
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }

    /**
     * @return void
     */
    public function writeView(): void
    {
        $return = array_merge($this->head, $this->data);
        echo(json_encode($return));
    }

    /**
     * Returns image info
     * @param $params
     * @param $gets
     */
    public function getImageText($params, $gets): void
    {
        if (array_key_exists("imageId", $gets)) {
            $imageId = $gets["imageId"];
            $this->data["response"] = $this->albumManager->getImage((int)$imageId);
            if ($this->albumManager->imageExists((int)$imageId)) {
                $image = $this->albumManager->getImage((int)$imageId);
                if ($image["title"] != null || $image["description"] != null) {
                    $this->data["response"] = ["title" => $image["title"], "description" => $image["description"]];
                } else {
                    //http_response_code(404);
                }
            } else {
                // http_response_code(404);
            }
        }
    }
}
