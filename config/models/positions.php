<?php
class Positions extends ActiveRecord\Model
{
    static $table_name = 'positions';
    static $primary_key = 'id';

    static $has_many = array(
        array('candidates','class_name' => 'Candidates', 'foreign_key' => 'position_id'),
        array('votes','class_name' => 'Votes', 'foreign_key' => 'position_id')
    );
}
