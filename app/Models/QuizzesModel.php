<?php

namespace oQuiz\Models;

use oQuiz\Utils\Database;

class QuizzesModel extends BaseModel
{
    private $title;
    private $description;
    private $id_author;

    const TABLE_NAME = 'quizzes';

    protected function insert()
    {
    }

    protected function update()
    {
    }

    public static function getQuizsByAuthorId(int $authorId)
    {
        $sql = '
            SELECT *
            FROM '.static::TABLE_NAME.'
            INNER JOIN users ON users.id = '.static::TABLE_NAME.'.id_author
            WHERE users.id = :id
        ';
        // Il y a un paramètre de requête => obligatoirement "prepare"
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':id', $authorId, \PDO::PARAM_INT);

        // J'exécute ma requête préparée
        $pdoStatement->execute();

        // Je retourne un tableau d'Objets CommunityModel
        // self::class => FQCN de ma classe
        // static::class est valable aussi
        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /* -----GETTER/SETTER----- */

    /**
     * Get the value of title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     *
     * @return self
     */
    public function setTitle(string $title)
    {
        if (!empty($title)) {
            $this->title = $title;
        }
    }

    /**
     * Get the value of description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description.
     *
     * @return self
     */
    public function setDescription(string $description)
    {
        if (!empty($description)) {
            $this->description = $description;
        }
    }

    /**
     * Get the value of id_author.
     */
    public function getId_author()
    {
        return $this->id_author;
    }

    /**
     * Set the value of id_author.
     *
     * @return self
     */
    public function setId_author(int $id_author)
    {
        if (!empty($id_author)) {
            $this->id_author = $id_author;
        }
    }
}
