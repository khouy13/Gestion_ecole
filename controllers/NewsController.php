<?php
class NewsController
{
    public static function insert()
    {
        if (isset($_POST['news_content']) && !empty($_POST['news_content']) && isset($_POST['news_statut'])) {
            $new = $_POST['news_content'];
            $statut = $_POST['news_statut'];
            $id = News::insert($new, $statut);
            $target_dirP = "assets/News/";
            $nameImage = basename(rand(0, 100000000000) . "_" . str_replace('\'', '_', $_FILES["img"]["name"]));
            $target_image = $target_dirP . $nameImage;
            //#################################"   Upload file  ###############################"
            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_image)) {
                $target_image = null;
            }
            News::insertDetail($id, $_POST['desc'], $target_image);
        }
        Redirect::to('news');
    }
    public static function update()
    {
        if (isset($_POST['news_id']) && !empty($_POST['news_id']) && isset($_POST['news_content']) && !empty($_POST['news_content']) && isset($_POST['news_statut'])) {
            $new_id = $_POST['news_id'];
            $new_content = $_POST['news_content'];
            $statut = $_POST['news_statut'];
            print_r($_FILES);
            News::update($new_content, $statut, $new_id);
            if (!empty($_FILES["img"]["name"])) {
                $target_dirP = "assets/News/";
                $nameImage = basename(rand(0, 100000000000) . "_" . str_replace('\'', '_', $_FILES["img"]["name"]));
                $target_image = $target_dirP . $nameImage;
                //#################################"   Upload file  ###############################"
                if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_image)) {
                    $target_image = null;
                }
                News::updateDetails($new_id, $_POST['desc'], $target_image);
            } else {
                News::updateDetails($new_id, $_POST['desc']);
            }
        }
        Redirect::to('news');
    }
    public static function delete()
    {
        if (isset($_POST['news_id']) && !empty($_POST['news_id'])) {
            $new = $_POST['news_id'];
            News::delete($new);
        }
        Redirect::to('news');
    }
    public static function get()
    {
        if ($_SESSION['user_info']['statut'] == '2') {
            $news = News::get(1);
        } else {
            $news = News::get(2);
        }

        return $news;
    }
    public static function getAll()
    {
        if ($_SESSION['user_info']['statut'] == '1') {
            $news = News::getAll(1, 2);
        } else if ($_SESSION['user_info']['statut'] == '2') {
            $news = News::getAll(1);
        } else {
            $news = News::getAll(2);
        }

        return $news;
    }
    public static function getNew()
    {
        if (!isset($_POST['id'])) {
            Redirect::to('home');
        }
        $new = News::getNew($_POST['id']);
        if (($_SESSION['user_info']['statut'] == 3 and $new['news_statut'] == 1) || ($_SESSION['user_info']['statut'] == 2 and $new['news_statut'] == 2)) {
            Redirect::to('home');
        }
        return $new;
    }
}
