<?php

namespace Camagru\Factory;

use Camagru\Entity\Picture;
use Camagru\Model\UserInterface;
use Camagru\Model\PictureInterface;

class PictureManager
{
    private $db;

    const LIMIT = 16;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function create(UserInterface $user, $picture, $overlay)
    {
        $width = 640;
        $height = 480;
        $dest_image = imagecreatetruecolor($width, $height);

        $filename = uniqid('', true).'.png';

        $encodedData = str_replace(' ', '+', $overlay);
        $frame = imagecreatefrompng($encodedData);
        imageAlphaBlending($frame, true);
        imageSaveAlpha($frame, true);

        $encodedData = str_replace(' ', '+', $picture);
        $picture = imagecreatefrompng($encodedData);
        imageAlphaBlending($picture, true);
        imageSaveAlpha($picture, true);

        imagecopy($dest_image, $picture, 0, 0, 0, 0, $width, $height);
        imagecopy($dest_image, $frame, 0, 0, 0, 0, $width, $height);

        imagepng($dest_image, UPLOADS.$filename);
        imagedestroy($dest_image);

        $pic = new Picture();
        $pic->setUserId($user->getId())
            ->setPath('/uploads/'.$filename)
            ->setRealPath(UPLOADS.$filename);

        return $pic;
    }

    public function add(PictureInterface $picture)
    {
        $req = $this->db->prepare('
            INSERT INTO `camagru_picture` (userId, path, realPath)
            VALUES (:userId, :path, :realPath)
        ');
        $req->execute([
            'userId' => $picture->getUserId(),
            'path' => $picture->getPath(),
            'realPath' => $picture->getRealPath(),
        ]);

        return $this;
    }

    public function get($limit = self::LIMIT, $offset = 0, UserInterface $user = null)
    {
        if (isset($user)) {
            $userId = $user->getId();
            $req = $this->db->prepare('
                SELECT * FROM `camagru_picture`
                WHERE userId = :userId
                ORDER BY id DESC
                LIMIT :offset, :limit
            ');
            $req->bindParam(':userId', $userId, \PDO::PARAM_INT);
        } else {
            $req = $this->db->prepare('
                SELECT * FROM `camagru_picture`
                ORDER BY id DESC
                LIMIT :offset, :limit
            ');
        }
        $req->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $req->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $req->execute();

        return $this->fromArray($req->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getById($id)
    {
        $req = $this->db->prepare('
            SELECT * FROM `camagru_picture`
            WHERE id = ?
        ');
        $req->execute([$id]);
        $resp = $req->fetch();
        if ($resp) {
            return $this->fromColumn($resp);
        }

        return false;
    }

    public function delete(PictureInterface $picture)
    {
        $req = $this->db->prepare('
            DELETE FROM `camagru_picture` WHERE id = ?
        ');
        $req->execute([$picture->getId()]);
        unlink($picture->getRealPath);
    }

    public function count(UserInterface $user = null)
    {
        if (isset($user)) {
            $userId = $user->getId();
            $req = $this->db->prepare('
                SELECT COUNT(*) as count FROM `camagru_picture`
                WHERE userId = :userId
            ');
            $req->bindParam(':userId', $userId, \PDO::PARAM_INT);
        } else {
            $req = $this->db->prepare('
                SELECT COUNT(*) as count FROM `camagru_picture`
            ');
        }
        $req->execute();

        return strval($req->fetch()['count']);
    }

    private function fromArray(array $array)
    {
        $pictures = [];
        foreach ($array as $elem) {
            $pictures[] = $this->fromColumn($elem);
        }

        return $pictures;
    }

    private function fromColumn(array $array)
    {
        $array = array_filter($array);
        if (empty($array)) {
            return;
        }
        $picture = new Picture();
        foreach ($array as $key => $value) {
            if (ctype_digit(strval($key))) {
                continue;
            }
            $picture->{'set'.ucfirst($key)}($value);
        }

        return $picture;
    }
}
