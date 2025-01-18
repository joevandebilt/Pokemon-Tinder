<?php

class Swipe {
    
    public $ID;
    public $Swipes;
    public $LeftSwipes;
    public $RightSwipes;
    public $Desirability;

    public function __construct($row=null) {
        if ($row != null) 
        {
            $this->ID = intval($row->ID);
            $this->Swipes = intval($row->Swipes);
            $this->LeftSwipes = intval($row->LeftSwipes);
            $this->RightSwipes = intval($row->RightSwipes);
            if ($this->RightSwipes > 0) {
                $this->Desirability = ($this->RightSwipes / $this->Swipes)*100;
            }
        }
    }
}
