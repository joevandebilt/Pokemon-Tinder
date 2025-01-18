var pokemonList = [];
var queue = [];
var activeCard;

$(document).ready(function () {

    Api("GetPokemonList", null).then((resultList) => {
        pokemonList = resultList;
        GenerateQueue(5);
    });
    RenderWhenReady();
});

function RenderWhenReady() {
    dataReady = setInterval(function () {
        if (queue.filter((card) => card.Complete).length > 0) {
            clearInterval(dataReady);
            RenderNextCard();
        }
    }, 500);
}

function GenerateQueue(queueLength) {
    for (let i = 0; i < queueLength; i++) {
        var idx = getRandomInt(pokemonList.length);
        queue.push(pokemonList[idx]);
        pokemonList.splice(idx, 1);
    }

    GetQueueData();
}

function GetQueueData() {
    var unloadedCards = queue.filter((card) => !card.Complete);
    unloadedCards.forEach(function (card, index) {
        Api("GetPokemon", card.ID).then((pokemon) => {
            queue[index] = pokemon;
        });
    });
}

function RenderNextCard() {
    if (queue.length === 0) {
        if (pokemonList.length === 0) {
            //End of the queue ya wildey
        }
        else {
            GenerateQueue(5);
            RenderWhenReady();
        }
    }

    activeCard = queue.filter((card) => card.Complete)[0];
    $(".card-name").html(activeCard.Name);
    $(".card-height").html('<i class="fa-solid fa-arrows-up-down"></i> ' + (activeCard.Height * 10)/100 + " m");
    $(".card-weight").html('<i class="fa-solid fa-weight-hanging"></i> ' + (activeCard.Weight * 100) / 1000 + " kg");
    $(".card-image").attr("src", activeCard.Images[0]).attr("data-idx", 0);
}

function ChangeImage(direction) {
    var idx = parseInt($(".card-image").attr("data-idx"));
    newIdx = idx + direction;
    if (newIdx < 0) {
        newIdx = activeCard.Images.length - 1;
    } else if (newIdx == activeCard.Images.length) {
        newIdx = 0;
    }
    $(".card-image").attr("src", activeCard.Images[newIdx]).attr("data-idx", newIdx);
}

function Swipe(rightSwipe) {

    var swipeData = {
        ID: activeCard.ID,
        SwipeRight: rightSwipe
    };
    Api("Swipe", swipeData);

    var idxToRemove = queue.indexOf(activeCard)
    queue.splice(idxToRemove, 1);
    RenderNextCard();    

    if (queue.length <=3) {
        GenerateQueue(3);
    }
}

function Api(action, payload) {

    var data = {
        SessionId: 1234,
        Action: action,
        Payload: payload
    };

    return new Promise((resolve, reject) => {
        $.ajax({
            url: "./api/",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function (response) {
                console.log(response);
                resolve(response.Payload);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                reject(error);
            }
        })
    });
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}