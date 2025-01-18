<?php 

class DIPokemon
{
    function GetAllPokemon() 
    {
        $pokemon = GetCache("POKEMON_SHALLOW_LIST");
        if ($pokemon == null) {
            $shallowList = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0"));
            $pokemon = [];
            foreach ($shallowList->results as $pkmn) 
            {
                $newEntry = new Pokemon();
                $newEntry->Name = $pkmn->name;
                
                $urlParts = explode("/", rtrim($pkmn->url, "/"));
                $id = $urlParts[count($urlParts)-1];
                $newEntry->ID = intval($id);

                array_push($pokemon, $newEntry);
            }
            SetCache("POKEMON_SHALLOW_LIST", $pokemon);
        }
        return new Response(200, $pokemon, null);
    }

    function GetPokemon($id)
    {
        $pokemon=GetCache("POKEMON_".$id);
        if ($pokemon == null || $pokemon->Complete == false)
        {
            $pkmn = json_decode(file_get_contents("https://pokeapi.co/api/v2/pokemon/".$id));            
            $pokemon = new Pokemon();
            $pokemon->ID = $id;
            $pokemon->Name = ucfirst($pkmn->name);
            $pokemon->Description = "";
            $pokemon->Height = $pkmn->height;
            $pokemon->Weight = $pkmn->weight;
            
            array_push($pokemon->Images, $pkmn->sprites->other->{'official-artwork'}->front_default);
            array_push($pokemon->Images, $pkmn->sprites->other->{'official-artwork'}->front_shiny);
            array_push($pokemon->Images, $pkmn->sprites->front_default);
            array_push($pokemon->Images, $pkmn->sprites->front_shiny);

            $pokemon->Complete = true;      
            SetCache("POKEMON_".$id, $pokemon);          
        }
        return new Response(200, $pokemon, null);
    }
}

?>