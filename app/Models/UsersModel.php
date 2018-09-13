<?php

namespace oQuiz\Models;

use oQuiz\Utils\Database;
use PDO;

class UsersModel extends BaseModel
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    const TABLE_NAME = 'users';

    protected function insert()
    {
        $sql = 'INSERT INTO '.self::TABLE_NAME.' 
        (first_name, 
        last_name, 
        email, 
        password)
            VALUES 
        (:first_name, 
        :last_name, 
        :email, 
        :password)';
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $pdoStatement->execute();
        $insertedRows = $pdoStatement->rowCount();
        if ($insertedRows > 0) {
            $this->id = Database::getPDO()->lastInsertId();

            return true;
        } else {
            // Retourne false si pas d'insertion ou erreur
            return false;
        }
    }

    protected function update()
    {
    }

    public static function findByEmail(string $email)
    {
        $sql = 'SELECT id FROM '.self::TABLE_NAME.' WHERE email = :email';
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
        $pdoStatement->execute();
        $userId = $pdoStatement->fetchColumn(0);
        if ($userId !== false) {
            return self::find($userId);
        } else {
            return false;
        }
    }

    /**
     * Get the value of first_name.
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name.
     *
     * @return self
     */
    public function setFirst_name($first_name)
    {
        if (!empty($first_name)) {
            $this->first_name = $first_name;
        }
    }

    /**
     * Get the value of last_name.
     */
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name.
     *
     * @return self
     */
    public function setLast_name($last_name)
    {
        if (!empty($last_name)) {
            $this->last_name = $last_name;
        }
    }

    /**
     * Get the value of email.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (!empty($email)) {
            $this->email = $email;
        }
    }

    /**
     * Set the value of password.
     *
     * @return self
     */
    public function setPassword($password)
    {
        if (!empty($password)) {
            $this->password = $password;
        }
    }

    /**
     * Get the value of password.
     */
    public function getPassword()
    {
        return $this->password;
    }
}
