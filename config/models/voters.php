<?php
class Voters extends ActiveRecord\Model
{
    static $table_name = 'voters';
    static $primary_key = 'voters_id';

    static $has_many = array(
        array('verify', 'class_name' => 'Verify', 'foreign_key' => 'voters_id'),
        array('votes', 'class_name' => 'Votes', 'foreign_key' => 'voters_id')
    );
}
