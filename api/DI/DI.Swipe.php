<?php 

class DISwipe
{
    function HandleSwipe($id, $swipeRight)
    {
        try 
        {
            $pokemon = $this->GetPokemon($id);
            if ($pokemon == null) {
                $response->SetMessage("Failed to retrieve (or create) record");
                $response->SetStatusCode(400);
            }

            $this->UpdatePokemonSwipe($id, $swipeRight);

            //Add to response
            if ($swipeRight) {
                $pokemon->RightSwipes++;
            } else {
                $pokemon->$LeftSwipes++;
            }

            $response->SetPayload($pokemon);
            $response->SetStatusCode(200);
        }
        catch (Exception $e) 
        {
            $response->SetStatusCode(500);
            $response->SetMessage('Caught exception: ',  $e->getMessage());
        }
        return $response;

    }

    function GetPokemon($id) 
    {
        $DB = new MySql();
        $DB->query("SELECT * FROM PokeSwipes WHERE Id = ".$id)
                
        if (false) {
            $pokemon = this->InsertPokemon($id)
        }
        return $pokemon;
    }

    function InsertPokemon($id) 
    {

    }

    function UpdatePokemonSwipe($id, $swipeRight) 
    {
        $sql = "UPDATE PokeSwipes SET ";
        if $swipeRight {
            $sql .= "LeftSwipes = LeftSwipes + 1";
        } else {
            $sql .= "RightSwipes = RightSwipes + 1"
        }
        $sql .= " WHERE Id = ".$id;


    }
}