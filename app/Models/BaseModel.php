<?php

namespace oQuiz\Models;

use oQuiz\Utils\Database;
use PDO;

abstract class BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /* Ordre pour les enfants */
    abstract protected function insert();

    abstract protected function update();

    /**
     * Method permettant de sauver l'objet en DB
     * => insert() ou update selon besoin.
     *
     * @return bool
     */
    public function save(): bool
    {
        //Si mon objet n'a pas d'identifiant (auto-incrémente)
        if (empty($this->id)) {
            //Ajout à la bdd
            $insterted = $this->insert();

            return $insterted;
        } else {
            //sinon je modif la ligne existante
            $update = $this->update();

            return $update;
        }
    }

    public static function findAll()
    {
        $sql = 'SELECT * FROM '.static::TABLE_NAME.'';

        $pdoStatement = Database::getPDO()->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);

        return $results;
    }

    public static function find(int $id)
    {
        $sql = 'SELECT *
                FROM '.static::TABLE_NAME.'
                WHERE id = :id
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);

        $pdoStatement->execute();

        return $pdoStatement->fetchObject(static::class);
    }

    /**
     * Methode permettant de supprimer une ligne en DB.
     *
     * @return bool
     */
    public function delete(): bool
    {
        $sql = 'DELETE FROM '.static::TABLE_NAME.' WHERE id = :id';

        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();

        return $deletedRows > 0;
    }

    /**
     * Get the value of id.
     */
    public function getId(): int
    {
        return $this->id;
    }
}
