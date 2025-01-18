<?php 

class DISwipe
{
    function HandleSwipe($id, $swipeRight)
    {
        try 
        {
            $response = new Response();

            $pokemon = $this->GetPokemonSwipes($id);
            if ($pokemon == null) {
                $response->SetMessage("Failed to retrieve (or create) record");
                $response->SetStatusCode(400);
            }

            $this->UpdatePokemonSwipe($id, $swipeRight);

            //Add to response
            $pokemon->Swipes++;
            if ($swipeRight) {
                $pokemon->RightSwipes++;
            } else {
                $pokemon->LeftSwipes++;
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

    function GetPokemonSwipes($id) 
    {
        $DB = new MySql();
        $DB->query("SELECT * FROM PokeSwipes WHERE Id = ".$DB->cleanString($id));
                
        if ($DB->resultCount() == 0) 
        {
            $pokemon = $this->InsertPokemon($id);
        } 
        else 
        {   
            while ($row = $DB->fetchObject())
            {
                $pokemon = new Swipe($row);
            }
        }
        return $pokemon;
    }

    function InsertPokemon($id) 
    {
        $DIPokemon = new DIPokemon();
        $pkmnResponse = $DIPokemon->GetPokemon($id);

        if ($pkmnResponse != null && $pkmnResponse->Payload != null) {
            $pkmn = $pkmnResponse->Payload;

            $DB = new MySql();
            $DB->query("INSERT INTO PokeSwipes (Id, Name) VALUES (".$pkmn->ID.",'".$pkmn->Name."')");

            $pokemon = new Swipe();
            $pokemon->ID = $pkmn->ID;
            $pokemon->Swipes = 0;
            $pokemon->LeftSwipes = 0;
            $pokemon->RightSwipes = 0;
            $pokemon->Desirability = 0;

        }
        return $pokemon;
    }

    function UpdatePokemonSwipe($id, $swipeRight) 
    {
        $DB = new MySql();
        $sql = "UPDATE PokeSwipes SET ";
        if ($swipeRight) {
            $sql .= "RightSwipes = RightSwipes + 1";
        } else {            
            $sql .= "LeftSwipes = LeftSwipes + 1";
        }
        $sql .= " WHERE Id = ".$DB->cleanString($id);
        echo $sql;
        $DB->query($sql);
    }
}