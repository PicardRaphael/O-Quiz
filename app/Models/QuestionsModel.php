<?php

namespace oQuiz\Models;

use oQuiz\Utils\Database;

class QuestionsModel extends BaseModel
{
    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $anecdote;
    private $wiki;

    const TABLE_NAME = 'questions';

    protected function insert()
    {
    }

    protected function update()
    {
    }

    public static function getQuestionsByQuizId(int $quizId)
    {
        $sql = '
            SELECT *
            FROM '.static::TABLE_NAME.'
            WHERE id_quiz = :id
        ';

        // Il y a un paramètre de requête => obligatoirement "prepare"
        $pdoStatement = Database::getPDO()->prepare($sql);

        // Je fais mes "binds"
        $pdoStatement->bindValue(':id', $quizId, \PDO::PARAM_INT);

        // J'exécute ma requête préparée
        $pdoStatement->execute();

        // Je retourne un tableau d'Objets CommunityModel
        // self::class => FQCN de ma classe
        // static::class est valable aussi
        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public static function nbrQuestions(int $questionId)
    {
        $sql = '
        SELECT COUNT(question) as nombre_questions
        FROM '.static::TABLE_NAME.'
        WHERE id_quiz = :id';
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bindValue(':id', $questionId, \PDO::PARAM_INT);

        $pdoStatement->execute();

        return $pdoStatement->fetch();
    }

    /**
     * Get the value of id_quiz.
     */
    public function getId_quiz()
    {
        return $this->id_quiz;
    }

    /**
     * Set the value of id_quiz.
     *
     * @return self
     */
    public function setId_quiz(int $id_quiz)
    {
        if (!empty($id_quiz)) {
            $this->id_quiz = $id_quiz;
        }
    }

    /**
     * Get the value of question.
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * Set the value of question.
     *
     * @return self
     */
    public function setQuestion(string $question)
    {
        if (!empty($question)) {
            $this->question = $question;
        }
    }

    /**
     * Get the value of prop1.
     */
    public function getProp1(): string
    {
        return $this->prop1;
    }

    /**
     * Set the value of prop1.
     *
     * @return self
     */
    public function setProp1(string $prop1)
    {
        if (!empty($prop1)) {
            $this->prop1 = $prop1;
        }
    }

    /**
     * Get the value of prop2.
     */
    public function getProp2(): string
    {
        return $this->prop2;
    }

    /**
     * Set the value of prop2.
     *
     * @return self
     */
    public function setProp2(string $prop2)
    {
        if (!empty($prop2)) {
            $this->prop2 = $prop2;
        }
    }

    /**
     * Get the value of prop3.
     */
    public function getProp3(): string
    {
        return $this->prop3;
    }

    /**
     * Set the value of prop3.
     *
     * @return self
     */
    public function setProp3(string $prop3)
    {
        if (!empty($prop3)) {
            $this->prop3 = $prop3;
        }
    }

    /**
     * Get the value of prop4.
     */
    public function getProp4(): string
    {
        return $this->prop4;
    }

    /**
     * Set the value of prop4.
     *
     * @return self
     */
    public function setProp4(string $prop4)
    {
        if (!empty($prop4)) {
            $this->prop4 = $prop4;
        }
    }

    /**
     * Get the value of id_quiz.
     */
    public function getId_level()
    {
        return $this->id_level;
    }

    /**
     * Set the value of id_level.
     *
     * @return self
     */
    public function setId_level(int $id_level)
    {
        if (!empty($id_level)) {
            $this->id_level = $id_level;
        }
    }

    /**
     * Get the value of anecdote.
     */
    public function getAnecdote(): string
    {
        return $this->anecdote;
    }

    /**
     * Set the value of anecdote.
     *
     * @return self
     */
    public function setAnecdote(string $anecdote)
    {
        if (!empty($anecdote)) {
            $this->anecdote = $anecdote;
        }
    }

    /**
     * Get the value of wiki.
     */
    public function getWiki(): string
    {
        return $this->wiki;
    }

    /**
     * Set the value of wiki.
     *
     * @return self
     */
    public function setWiki(string $wiki)
    {
        if (!empty($wiki)) {
            $this->wiki = $wiki;
        }
    }
}
