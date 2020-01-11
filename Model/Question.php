<?php


namespace Model;


class Question extends Model
{
    public function addQuestion($title){
        $sql = 'INSERT INTO lite_questions(title_questions) VALUES(:title)';
        $params = [
            'title' =>$title
        ];

        $this->driver->query($sql,$params);
        return $this->driver->lastInsertId();
    }

    public function getQuestions(){
        $sql = 'SELECT id_questions, title_questions FROM lite_questions ORDER BY RAND() LIMIT 1';
        return  $this->driver->column($sql);
    }
}