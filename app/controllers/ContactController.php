<?php


namespace app\controllers;

use app\forms\ContactForm;

/**
 * Class ContactController
 * @package app\controllers
 */
class ContactController extends Controller
{
    private $form;
    public function __construct()
    {
        parent::__construct();
        $this->form = new ContactForm();
    }

    /**
     * Sets contact page
     *
     * @param array $params
     * @param array|null $gets
     */
    function process(array $params, array $gets = null)
    {
        $this->head['page_title'] = $this->head['page_title'] . " | Contact";
        $this->data["form"] = $this->form->create(function (){
            echo "<p class='messageSent'>Message was sent successfully</p>";
        });
        $this->setView('default');
    }
}