<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>JS Riffing</title>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Home</a>
        </nav>

        <div class="row">
            <div class="col">
                <h1>Riffing</h1>
                <p>
                    <button type="button" class="btn btn-primary" id="testbutton">Press Me</button>
                    <button type="button" class="btn btn-secondary" id="testbutton2">Happy Up</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton">Pause Game</button>
                    <div id="dashpanel">
                        <p>Day Number <span id="counter"></span></p>
                    </div>
                </p>
            </div>
            <div class="col" id="status-dash">
                <div id="textlog"></div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

var hairColors = [
    "brown","black","chestnut","blonde","red"
]

var eyeColors = [
    "brown","blue","grey","green"
]

var girlNames = [
    "Claire",
    "Justine",
    "Eveline",
    "Madeline",
    "Katie",
    "Beatrice",
    "Sabrina",
    'Sophia',
    'Emma',
    'Olivia',
    'Isabella',
    'Ava',
    'Mia',
    'Emily',
    'Abigail',
    'Madison',
    'Elizabeth',
    'Charlotte',
    'Avery',
    'Sofia',
    'Chloe',
    'Ella',
    'Harper',
    'Amelia',
    'Aubrey',
    'Addison',
    'Evelyn',
    'Natalie',
    'Grace',
    'Hannah',
    'Zoey',
    'Victoria',
    'Lillian',
    'Lily',
    'Brooklyn',
    'Samantha',
    'Layla',
    'Zoe',
    'Leah',
    'Audrey',
    'Allison',
    'Anna',
    'Savannah',
    'Aaliyah',
    'Gabriella',
    'Camila',
    'Kaylee'
]

var minAge = 6;
var maxAge = 13;
var charNumber = 4;

function person(fn, age) {
    this.firstName = fn;
    this.ageInDays = age*365;
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        return a;};
    this.ageEE = function() {return "mam";};
    this.happiness = 0;
    this.beauty = randomInt(0, 10);
    this.intellect = randomInt(0, 10);
};

var npc = [];

var counter = 0;

var activities = [];

var paused = false;

activities.push(
    {
        "nom":"read",
        "flavortext":" is reading.",
        "intellum":9
    },
    {
        "nom":"watchtv",
        "flavortext":" is watching TV.",
        "intellum":2
    },
    {
        "nom":"instagram",
        "flavortext":" is surfing Instagram.",
        "intellum":3
    }
)        


function pickFrom(array) {
    var choice = Math.floor(Math.random() * array.length);
    return array[choice];
}

function randomAge() {
    var a = Math.floor(Math.random() * (maxAge - minAge)) + minAge;
    return a;
}

function randomInt(min, max) {
    var a = Math.floor(Math.random() * (max - min)) + min;
    return a;
}

function fiftyFifty() {
    var n = Math.floor(Math.random() * 2);
    return n;
}


function gameStart() {
    gameSetup();
    setInterval(function() {
        if (paused == false) {
        gameLoop();
        }
    }, 100);
}

function gameSetup() {
    //npc.push(new person("Beatrice", 5));
    //npc.push(new person("Sabrina", 7));
    //npc.push(new person("Katie", 9));
    for (i=0;i<charNumber;i++) {
        npc.push(new person(pickFrom(girlNames), randomAge()));
    }
    for (i=0;i<npc.length;i++) {
        $("#dashpanel").append(
            "<hr>Name: " + npc[i].firstName + "<br>" +
            "Age in years: <span id='npcyears" + i + "'>"  + npc[i].ageInYears() + "</span><br>" +
            "Happiness quotient: <span id='npchappy" +i+"'>" + npc[i].happiness + "</span><br>" +
            "<span id='npcactivity"+i+"'></span><br>"
        );
    }
}

function gameLoop() {
    updateDash();
    dayEnd();
}

function dayEnd() {
    for (var i = 0; i < npc.length; i++) {
        npc[i].ageInDays +=1;
        $("#npcactivity" + i).html(npc[i].firstName + resolveActivity(npc[i]));
        if (fiftyFifty() == 1) {
            npc[i].happiness += 1;
        } else {
            npc[i].happiness -= 1;
        }
    }
    counter++;
    $("#counter").text(counter);
}

function resolveActivity(character) {
    var m = pickFrom(activities);
    var hchange = 5 - Math.abs(character.intellect - m.intellum);
    //console.log(character.firstName + m.flavortext + " " + hchange);
    character.happiness += hchange;
    //$("#textlog").prepend(character.firstName + " " + m.flavortext + "<br>");
    return m.flavortext;
}

function pauseGame() {
    if (paused == false) {
        paused = true;
    } else {
        paused = false;
    }
}

function updateDash() {
    for (i = 0; i < npc.length; i++) {
        $("#npchappy" + i).html(npc[i].happiness);
        $("#npcyears" + i).html(npc[i].ageInYears());
    }
}

function printStats() {
    console.log(npc);
}

$(document).ready(gameStart());

$("#testbutton").click(function() {printStats();});
$("#testbutton2").click(function() npc[1].happiness += 1;});
$("#pausebutton").click(function() {pauseGame();});

</script>
  </body>
</html>