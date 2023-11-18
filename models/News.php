<?php
class News
{
    static public function getNew($id)
    {
        $stm = DB::connect()->prepare("SELECT news.*,news_detail.* FROM news,news_detail WHERE news.news_id=:id and news.news_id=news_detail.news_id ");
        $stm->bindParam(':id', $id);
        $stm->execute();
        $new = $stm->fetch();
        return $new;
    }
    static public function get($statut)
    {
        $stm = DB::connect()->prepare("SELECT news.*,news_detail.* FROM news,news_detail WHERE news.news_statut in (0,'$statut') and news.news_id=news_detail.news_id  ORDER BY news.news_date DESC LIMIT 6");
        $stm->execute();
        $news = $stm->fetchAll();
        return $news;
    }
    static public function getAll($statut, $statut2 = null)
    {
        $stm = DB::connect()->prepare("SELECT news.*,news_detail.* FROM news,news_detail WHERE news.news_statut in (0,:statut,:statut2) and news.news_id=news_detail.news_id ORDER BY news.news_date DESC");
        $stm->bindParam(':statut', $statut);
        $stm->bindParam(':statut2', $statut2);
        $stm->execute();
        $news = $stm->fetchAll();
        return $news;
    }
    static public function insert($new, $statut)
    {
        $db = DB::connect();
        $stm = $db->prepare("INSERT INTO `news`(`news_content`,`news_statut`) VALUES (:val,:statut) ");
        $stm->bindParam(':val', $new);
        $stm->bindParam(':statut', $statut);
        $stm->execute();
        return $db->lastInsertId();
    }
    static public function insertDetail($id, $desc = null, $image = '')
    {
        $stm = DB::connect()->prepare("INSERT INTO `news_detail`(`news_id`, `news_desc`, `news_img`) VALUES (:id,:desc,:image)");
        $stm->bindParam(':id', $id);
        $stm->bindParam(':desc', $desc);
        $stm->bindParam(':image', $image);
        $stm->execute();
        $result = $stm->rowCount();
        return $result;
    }
    static public function update($content, $statut, $id)
    {
        $stm = DB::connect()->prepare("UPDATE `news` SET `news_content`=:content,`news_statut`=:statut WHERE news_id=:id");
        $stm->bindParam(':id', $id);
        $stm->bindParam(':content', $content);
        $stm->bindParam(':statut', $statut);
        $stm->execute();
        $result = $stm->rowCount();
        return $result;
    }
    static public function updateDetails($id, $desc, $image = null)
    {
        if ($image != null) {
            $stm = DB::connect()->prepare("UPDATE `news_detail` SET `news_desc`=:desc,`news_img`=:img WHERE news_id=:id");
            $stm->bindParam(':img', $image);
        } else {
            $stm = DB::connect()->prepare("UPDATE `news_detail` SET `news_desc`=:desc WHERE news_id=:id");
        }
        $stm->bindParam(':id', $id);
        $stm->bindParam(':desc', $desc);
        $stm->execute();
        $result = $stm->rowCount();
        return $result;
    }
    static public function delete($id)
    {
        $stm = DB::connect()->prepare("DELETE FROM `news` WHERE news_id=:id");
        $stm->bindParam(':id', $id);
        $stm->execute();
        $stm = DB::connect()->prepare("DELETE FROM `news_detail` WHERE news_id=:id");
        $stm->bindParam(':id', $id);
        $stm->execute();
        $result = $stm->rowCount();
        return $result;
    }
}
