<?php

namespace Camagru\Factory;

use Camagru\Entity\Comment;
use Camagru\Model\CommentInterface;
use Camagru\Model\PictureInterface;
use Camagru\Model\UserInterface;

class CommentManager
{
    protected $db;

    const LIMIT = 10;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function create(UserInterface $user, PictureInterface $picture, $content)
    {
        $comment = new Comment();
        $comment->setUserId($user->getId())
                ->setPictureId($picture->getId())
                ->setContent($content);

        return $comment;
    }

    public function add(CommentInterface $comment)
    {
        $req = $this->db->prepare('
            INSERT INTO `camagru_comment` (userId, pictureId, content)
            VALUES (:userId, :pictureId, :content)
        ');
        $req->execute([
            'userId' => $comment->getUserId(),
            'pictureId' => $comment->getPictureId(),
            'content' => $comment->getContent(),
        ]);
    }

    public function count(PictureInterface $picture)
    {
        $req = $this->db->prepare('
            SELECT COUNT(*) as count
            FROM `camagru_comment`
            WHERE pictureId = ?
        ');
        $req->execute([$picture->getId()]);

        return strval($req->fetch()['count']);
    }

    public function get(PictureInterface $picture, $limit = self::LIMIT, $offset = 0)
    {
        $req = $this->db->prepare('
            SELECT *
            FROM `camagru_comment` as c, `camagru_user` as u
            WHERE c.userId = u.id
            AND c.pictureId = :pictureId
            ORDER BY c.id DESC
            LIMIT :offset, :limit
        ');
        $pictureId = $picture->getId();
        $req->bindParam(':pictureId', $pictureId, \PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $req->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $req->execute();

        return $this->fromArray($req->fetchAll(\PDO::FETCH_ASSOC));
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
        $picture = new Comment();
        foreach ($array as $key => $value) {
            if (ctype_digit(strval($key))) {
                continue;
            }
            $picture->{'set'.ucfirst($key)}($value);
        }

        return $picture;
    }
}
