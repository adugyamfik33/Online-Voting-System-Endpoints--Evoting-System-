<?php
class Candidates extends ActiveRecord\Model
{
    static $table_name = 'candidates';
    static $primary_key = 'id';

    static $belongs_to = array(
        array('positions','class_name' => 'Positions','foreign_key' => 'position_id')
    );
    static $has_many = array(
        array('votes', 'class_name' => 'Votes', 'foreign_key' => 'candidate_id')
    );
}
