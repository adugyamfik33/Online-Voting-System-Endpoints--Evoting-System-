<?php
class Verify extends ActiveRecord\Model
{
    static $table_name = 'verify';
    static $primary_key = 'id';

    static $belongs_to = array(
        array('voters','class_name' => 'Voters', 'foreign_key' => 'voters_id')
    );
}
