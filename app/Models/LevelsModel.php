<?php

namespace oQuiz\Models;

class LevelsModel extends BaseModel
{
    private $name;

    const TABLE_NAME = 'levels';

    protected function insert()
    {
    }

    protected function update()
    {
    }

    /**
     * Get the value of name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name.
     *
     * @return self
     */
    public function setName(string $name)
    {
        if (!empty($name)) {
            $this->name = $name;
        }
    }
}
