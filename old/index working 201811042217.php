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
                        <p>Year <span id="years">1</span> | Day <span id="counter"></span></p>
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

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});

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

var romanticTypes = [
    {
        "title":"happy people",
        "description":"person is attracted to happy people",
        typeTest: function(persona, personb) {
            if (personb.happiness >= 1000) {
                return 1;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"beautiful people",
        "description":"person is attracted to beautiful people",
        typeTest: function(persona, personb) {
            if (personb.beauty >= 8) {
                return 1;
            } else if (personb.beauty <=4) {
                return -1;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"bimbos",
        "description":"person is attracted to beautiful dumb people",
        typeTest: function(persona, personb) {
            if (personb.beauty >= 7 && personb.intellect <= 5) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"likes a challenge",
        "description":"person is attracted to people who don't like her",
        typeTest: function(persona, personb) {
            if (personb.relationships[npc.indexOf(persona)] < 0) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"smart people",
        "description":"person is attracted to smart people",
        typeTest: function(persona, personb) {
            if (personb.intellect >= 8) {
                return 1;
            } else if (personb.intellect <= 4) {
                return -1;
            } else {
                return 0;
            }
        }
    }
];

var activities = [
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
    },
    {
        "nom":"cinema",
        "flavortext":" is watching a film.",
        "intellum":6
    }
];

var paused = false;
var minAge = 6;
var maxAge = 13;
var characterCount = 5;
var loopTime = 100;
var npc = [];
var counter = 0;

function person(firstname, age, gender) {
    this.firstName = firstname;
    this.birthday = Math.floor(Math.random() * 365);
    this.ageInDays = (age*365 + (365-this.birthday));
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        return a;};
    this.happiness = 0;
    this.beauty = randomInt(1, 10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.relationships = [];
    this.attractions = [];
    this.gender = gender;
    this.myTypes = [];
};

console.log(romanticTypes);

function pickFrom(array) {
    var choice = Math.floor(Math.random() * array.length);
    return array[choice];
}

function findDiff(a, b) {
    return Math.abs(a-b);
}

function randomAge() {
    var a = Math.floor(Math.random() * (maxAge - minAge)) + minAge;
    return a;
}

function randomInt(min, max) {
    var a = Math.floor(Math.random() * (max + 1 - min)) + min;
    return a;
}

function fiftyFifty() {
    var n = Math.floor(Math.random() * 2);
    return n;
}

function interactWith(persona, personb) {
    pleasure = randomInt(5, 15) - findDiff(persona.social, personb.social) - findDiff(persona.intellect, personb.intellect) - findDiff(persona.athletics, personb.athletics);
    // adjust each person's relationship level according to the pleasure quotient
    if (persona.relationships[npc.indexOf(personb)] != undefined) {
        persona.relationships[npc.indexOf(personb)] += pleasure;
    } else {
        persona.relationships[npc.indexOf(personb)] = pleasure;
    }
    if (personb.relationships[npc.indexOf(persona)] != undefined) {
        personb.relationships[npc.indexOf(persona)] += pleasure;
    } else {
        personb.relationships[npc.indexOf(persona)] = pleasure;
    }
    // adjust for physical attractiveness
    if (persona.beauty > personb.beauty) {
        personb.relationships[npc.indexOf(persona)] += persona.beauty - personb.beauty;
    } else {
        persona.relationships[npc.indexOf(personb)] += personb.beauty - persona.beauty;
    }
    // test and adjust for romantic attraction
    if (pleasure > 3 && personb.beauty > (persona.beauty - 1)) {
        if (persona.attractions[npc.indexOf(personb)] != undefined) {
            persona.attractions[npc.indexOf(personb)] ++;
        } else {
            persona.attractions[npc.indexOf(personb)] = 1;
        }
    }
}

function relationshipDescriptors(number) {
    if (number > 1000) {
        return " loves ";
    } else if (number > 200) {
        return " likes ";
    } else if (number < -1000) {
        return " hates ";
    } else if (number < -200) {
        return " dislikes ";
    } else {
        return " has no opinion of ";
    }
}

function meetPeople() {
    for (i=0;i<npc.length;i++) {
        m = pickFrom(npc);
        while (npc.indexOf(m) == i) {
            m = pickFrom(npc);
        }
        interactWith(npc[i], m);
    }
}

function gameStart() {
    gameSetup();
    setInterval(function() {
        if (paused == false) {
        gameLoop();
        }
    }, loopTime);
}

function gameSetup() {
    for (i=0;i<characterCount;i++) {
        npc.push(new person(pickFrom(girlNames), randomAge(), 0));
    }
    for (i=0;i<npc.length;i++) {
        var c = randomInt(2, 5);
        var l = i;
        for (k=0;k<c;k++) {
            npc[i].myTypes.push(pickFrom(romanticTypes));
        }
    }
    for (i=0;i<npc.length;i++) {
        $("#dashpanel").append(
            "<hr><div class='row' id='npc"+i+"'><div class='col'>Name: <span id='npcname" + i + "'><strong>" + npc[i].firstName + "</strong></span><br>" +
            "Age in years: <span id='npcyears" + i + "'>"  + npc[i].ageInYears() + "</span><br>" +
            "Happiness quotient: <span id='npchappy" +i+"'>" + npc[i].happiness + "</span><br>" +
            "<span id='npcactivity"+i+"'></span><br>" +
            '<a href="#npcrel'+i+'" data-toggle="popover" data-html="true" title="Relationships" data-content="Some content inside the popover" id="npcrel' + i + '">Relationships</a></div>' +
            "<div class='col'>Beauty: "+npc[i].beauty+"<br>Athletics: "+npc[i].athletics+"<br>Intellect: "+npc[i].intellect+"<br>Social: "+npc[i].social+"<br></div>"+"</div>"
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
    }
    counter++;
    $("#counter").text(counter);
    $("#years").text(Math.floor(counter/365) + 1);
    meetPeople();
}

function resolveActivity(character) {
    var m = pickFrom(activities);
    var hchange = 5 - findDiff(character.intellect, m.intellum);
    //console.log(character.firstName + m.flavortext + " " + hchange);
    character.happiness += hchange;
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
        var des = "";
        for (j = 0; j < npc.length; j++) {
            if (j != i) {
                des += (npc[i].firstName + relationshipDescriptors(npc[i].relationships[j]) + npc[j].firstName + "<br>");
                if (npc[i].attractions[j] > 500) {
                    des += (npc[i].firstName + " is in love with " + npc[j].firstName + "<br>");
                } else if (npc[i].attractions[j] > 50) {
                    des += (npc[i].firstName + " is attracted to " + npc[j].firstName + "<br>");
                }
            }
        }
        $("#npcrel" + i).attr("data-content", des);
    }
}

function printStats() {
    console.log(counter);
    console.log(romanticTypes[0].typeTest(npc[0], npc[1]));
    console.log(npc);
}

$(document).ready(gameStart());

$("#testbutton").click(function() {printStats();});
$("#testbutton2").click(function() {npc[1].happiness += 1;});
$("#pausebutton").click(function() {pauseGame();});

</script>
  </body>
</html>