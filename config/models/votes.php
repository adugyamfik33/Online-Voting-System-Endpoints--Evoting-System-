<?php
class Votes extends ActiveRecord\Model
{
    static $table_name = 'votes';
    static $primary_key = 'id';

    static $belongs_to = array(
        array('positions','class_name' => 'Positions', 'foreign_key' => 'position_id'),
        array('candidates','class_name' => 'Candidates', 'foreign_key' => 'candidate_id'),
        array('voters','class_name' => 'Voters', 'foreign_key' => 'voters_id')
    );
}
