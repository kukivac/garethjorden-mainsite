<?php

namespace app\models;

/**
 * Manager AlbumManager
 *
 * @package app\models
 */
class AlbumManager
{
    /**
     * @param $albumTitle
     *
     * @return bool
     */
    public function albumExists($albumTitle)
    {
        return DbManager::requestAffect("SELECT dash_title FROM album WHERE dash_title=?", [$albumTitle]) == 1;
    }

    /**
     * @param $dashtitle
     *
     * @return array|false|void
     */
    public function getAlbumInfo($dashtitle)
    {
        if (DbManager::requestAffect("SELECT dash_title FROM album WHERE dash_title=?", [$dashtitle]) === 1) {
            $album = DbManager::requestSingle("SELECT * FROM album WHERE album.dash_title=?", [$dashtitle]);
            $images = DbManager::requestMultiple("SELECT * FROM image WHERE album_id = ?", [$album["id"]]);
            $album["images"] = $images;
            return $album;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getAlbums(): array
    {
        $albums = DbManager::requestMultiple("SELECT id,title,dash_title,cover_photo,no_photos,visible FROM album ORDER BY `order` DESC");
        $newAlbums = array();
        foreach ($albums as $album) {
            if ($album["cover_photo"] == Null) {
                $album["cover_photo"] = DbManager::requestUnit("SELECT filename FROM image WHERE album_id = ? ORDER BY id LIMIT 1", [$album["id"]]);
            } else {
                $album["cover_photo"] = DbManager::requestUnit("SELECT filename FROM image WHERE id = ?", [$album["cover_photo"]]);
            }
            array_push($newAlbums, $album);
        }
        return $newAlbums;
    }

    /**
     * @return array
     */
    public function getAlbumsHighlits(): array
    {
        return DbManager::requestMultiple('
        SELECT album.id,album.dash_title,album.title,i.filename as cover_photo FROM album JOIN image i on album.cover_photo = i.id ORDER BY album.`order` DESC
        ');
    }

    /**
     * @param $title
     *
     * @return array
     */
    public function getAlbumImages($title)
    {
        $newImages = array();
        $albumId = DbManager::requestUnit("SELECT id FROM album WHERE dash_title = ?", [$title]);
        $images = DbManager::requestMultiple("SELECT * FROM image WHERE album_id = ? ORDER BY `order` DESC", [$albumId]);
        foreach ($images as $image) {
            if (DbManager::requestUnit("SELECT cover_photo FROM album WHERE id=?", [$albumId]) == $image["id"]) {
                $image["cover_photo"] = true;
            } else {
                $image["cover_photo"] = false;
            }
            array_push($newImages, $image);
        }
        return $newImages;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function imageExists(int $id)
    {
        return DbManager::requestAffect("SELECT id FROM image WHERE id=?", [$id]) == 1;
    }

    /**
     * @return array|void
     */
    public function getAllImages()
    {
        return DbManager::requestMultiple("SELECT * FROM image WHERE album_id IS NULL ORDER BY `order` DESC");
    }

    /**
     * @param $imageId
     *
     * @return array|void
     */
    public function getImage($imageId)
    {
        return DbManager::requestSingle("SELECT * FROM image WHERE id = ?", [$imageId]);
    }

    public function getLandingImageDesktop()
    {
        return DbManager::requestSingle("SELECT desktop FROM landing_page_image where true");
    }
    public function getLandingImageMobile()
    {
        return DbManager::requestSingle("SELECT mobile FROM landing_page_image where true");
    }
}
