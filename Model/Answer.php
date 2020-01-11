<?php


namespace Model;


class Answer extends Model
{
    public function addAnswers($id_question, $title){
        $sql = 'INSERT INTO lite_answers(id_questions, title_answers) VALUES(:id,:title)';
        $params = [
            'id' => $id_question,
            'title' =>$title
        ];

        $this->driver->query($sql,$params);
    }

    public function getAnswers($id_quest){
        $sql = 'SELECT title_answers, id_answers FROM lite_answers WHERE id_questions = :id';
        $params = [
            'id' => $id_quest
        ];
        return $this->driver->row($sql,$params);
    }

}