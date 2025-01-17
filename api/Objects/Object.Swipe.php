<?php

class Swipe {
    
    public $ID;
    public $Swipes;
    public $LeftSwipes;
    public $RightSwipes;
    public $Desirability;

    public function __construct($row) {
        $this->ID = $row->ID;
        $this->Swipes = $row->Swipes;
        $this->LeftSwipes = $row->LeftSwipes;
        $this->RightSwipes = $row->RightSwipes;
        $this->Desirability = $row->Desirability;
    }
}
