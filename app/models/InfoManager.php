<?php


namespace app\models;

/**
 * Class InfoManager
 *
 * @package app\models
 */
class InfoManager
{
    /**
     * @return array
     */
    public function getBio()
    {
        return DbManager::requestSingle("SELECT bio_title, bio_description FROM web_info");
    }

    /**
     * @return string
     */
    public function getPageKeywords()
    {
        return DbManager::requestUnit("SELECT default_keywords FROM web_info");
    }

    /**
     * @return string
     */
    public function getPageDescription()
    {
        return DbManager::requestUnit("SELECT default_description FROM web_info");
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return DbManager::requestUnit("SELECT default_title FROM web_info");
    }

    /**
     * @return string
     */
    public function getLandingPageBackground()
    {
        return DbManager::requestUnit("SELECT filename FROM landing_page_image ORDER BY id DESC LIMIT 1");
    }
    /**
     * @return string
     */
    public function getProfileImage()
    {
        return DbManager::requestUnit("SELECT profile_picture FROM web_info ORDER BY id DESC LIMIT 1");
    }

    /**
     * @return string
     */
    public function getTwitterLink()
    {
        return DbManager::requestUnit("SELECT twitter_link FROM web_info");
    }

    /**
     * @return string
     */
    public function getInstagramLink()
    {
        return DbManager::requestUnit("SELECT instagram_link FROM web_info");
    }
    /**
     * @return string
     */
    public static function getContactEmail()
    {
        return DbManager::requestUnit("SELECT email FROM web_info");
    }
}