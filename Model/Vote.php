<?php


namespace Model;


class Vote extends Model
{
    public function getVotedUserQA($id_user, $id_answer){
        $sql = 'SELECT id_voting FROM lite_voting WHERE id_user = :id_user AND id_answer = :id_answer';
        $params = [
            'id_user' =>$id_user,
            'id_answer' =>$id_answer
        ];
        return $this->driver->column($sql,$params);
    }
    public function votedUserQA($id_user,$id_questions){
        $sql = 'SELECT lite_voting.id_voting FROM lite_voting, lite_answers WHERE lite_voting.id_answer = lite_answers.id_answers AND lite_answers.id_questions = :id_quest AND lite_answers.id_user = :id_user';
        $params = [
            'id_quest' =>$id_questions,
            'id_user' => $id_user
        ];

        return $this->driver->column($sql,$params);
    }
    public function addVote($id_user, $id_answer){
        $sql = 'INSERT INTO lite_voting(id_user, id_answer) VALUES(:id_user,:id_answer)';
        $params = [
            'id_user' =>$id_user,
            'id_answer' => $id_answer
        ];
        $this->driver->query($sql,$params);
    }

    public function getTotalVoted($id){
        $sql = 'SELECT COUNT(id_answer) AS total FROM lite_voting WHERE id_answer = :id';
        $params = [
            'id' => $id
        ];
        return $this->driver->column($sql,$params);
    }
}