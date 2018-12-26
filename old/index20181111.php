<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Riffing</title>
    <style type="text/css">
    .popover{
        max-width:800px;
    }
    </style>
  </head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" hidden="true">
        <a class="navbar-brand" href="#">Home</a>
    </nav>
    <div class="row">
        <div class="col-md">
            <h1>Riffing</h1>
            <div id="playerbuttons">
                <p>
                    <button type="button" class="btn btn-secondary" id="sortdash" onClick="sortDash()">Sort AZ</button>
                    <button type="button" class="btn btn-secondary" id="sortdash3">Sort Age</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton" onClick="pauseGame()">Pause Game</button>
                </p>
            </div>
            <div id="devdash">
                <p>
                    <button type="button" class="btn btn-primary" id="testbutton" onClick="printStats()">Press Me</button>
                    <button type="button" class="btn btn-secondary" id="sortdash2">Sort ID</button>
                    <button type="button" class="btn btn-secondary" id="testbutton3" onClick="addNPC()">Add NPC</button>
                    <button type="button" class="btn btn-secondary" id="murderbutton" onClick="killRandom()">Kill</button>
                    <button type="button" class="btn btn-secondary" id="speedbutton" onClick="toggleSpeed()">Toggle Speed</button>
                </p>
            </div>
            <div id="stats">
                <p><small>Sim started: <span id="startTime"></span></small><br>
                Year <span id="years">1</span> | Day <span id="counter"></span> | Population: <span id="population"></span> (<span id="fpop"></span> F / <span id="mpop"></span> M) <!--  CC: <span id="coicou"></span> --></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div id="dashpanel"></div>
            <div id="footpanel">
                <button type="button" class="btn btn-secondary" onClick="sortDash()">Sort AZ</button> 
                <button type="button" class="btn btn-secondary" onClick="pauseGame()">Pause Game</button> 
                <!-- <button type="button" class="btn btn-secondary" onClick="hidePop()">Clear Popovers</button> -->
            </div>
        </div>
        <div class="col-md" id="status-dash">
            <hr>
            <div id="petdash"></div>
            <div id="petpanel"></div>
            <div id="metapanel"></div>
            <hr>
            <div id="temptext" style="height: 50px"></div>
            <div id="textlog"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalbody">This is the modal.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="utilities.js"></script>
<script>

// Update 201811100923: re-factored textLog and addNPC to make them cleaner and more self-contained
// Update 201811101109: fixed commitments outlasting death, added mysterious stranger event, re-worked incest warning on whup
// Update 201811101451: re-did full info panel to remove 'relatives' and move fave activities up, highlighted relatives in relationship list; added kill button; moved speed toggle to devdash; customized mysterious stranger to be more mysterious
// Update 201811101609: reworked the meetPeopleTwo function to use rootRead to weight odds; removed attraction decay from evolveRelationships; added modal click to 'Relationships'; reworked charinfopanel to use tables instead of list
// Update 201811101850: a bunch of work with the fullcharinfopanel; made it harder for npcs to commit; 
// Update 201811102318: changed textlog to prepend; fixed popCalc
//  notes: current game on year 87, running for ~90 min, pop 91, seeing relatives normalize as the population expands and cousins are 'forgotten' so that new pop isn't all related to one another; also, old people get super unhappy as their peers/friends die off; performance definitely slowing around year 100; year 158, pop 143, super slow (also ~14000 projectmaterial)
// Update 201811111310: I don't think it's slowing down because of display issues - I think it's the recursion. I need to make the loops smaller. realized updateDash was updating all char panels, regardless of whether npc was alive or dead. changed that.
//  Notes: left it running overnight (about 7 hours) - colony at year 200, pop 160, npc.length==700; families have all stabilized with a 'normal' amount of relatives; there's more incest than I would've expected, but seems to be because there are some people with 13 beauty; still far less actual sex than I would expect - average coicou for npcs is only a few times a year; I suspect it's actually because as the colony expands, the meetpeopletwo function actually isn't weighted enough - they don't interact with the same person often enough; looking closely, it seems the incest is mostly between senior citizens. hmmm.
//  Notes: going to embark on separating some functions out
// Update 201811120800: fixed the character death using displayCHarPanels resetting the order of npcs; now it just uses jquery to remove the dom element. yay. also made kill characters not break/crash the game if no characters left
//  Notes: left it running overnight, at ~50 seconds/100 years, year 275, pop 80 npc.length=1091
var charPanels = [];

function dLc() {
    specialEvents.push(
        {
            "title":"is best",
            "active":1,
            "description":"incest restriction lifted",
            "odds":3000,
            "checkOccurrance": function() {
                for (var m=0;m<postEventQueue.length;m++) {
                    if (postEventQueue[m][2]==this.title) {return 0}
                }
                if (randomInt(1,this.odds) == 1) {
                    return 1;
                } else {
                    return 0;
                }
            },
            "effect": function() {
                incRestrict = 1;
                textLog.push([counter,("<strong>taboo porn</strong> became popular.")]);
                postEventQueue.push([counter+365,function(){incRestrict=3;textLog.push([counter, "<strong>taboo porn</strong> is no longer popular."])}, this.title])
            },
            "flavortext":"Something happens!!"
        }
    );
    romanticTypes.push(
        {
            "title":"family",
            "description":"person is attracted to relatives",
            "active":1,
            typeTest: function(persona, personb) {
                if (personb.beauty >= 6 && persona.relatives[npc.indexOf(personb)] != undefined) {
                    return typeStandard * 2;
                } else {
                    return 0;
                }
            }
        },
        {
            "title":"pedo",
            "description":"person is attracted to prepubescent",
            "active":1,
            typeTest: function(persona, personb) {
                if (personb.ageInYears < 11) {
                    return typeStandard;
                } else {
                    return 0;
                }
            }
        }
    );
    girlNames.push(
        "Emi", "Sun Lei", "Melody", "Jingjing", "Donna", "Kink", "Chang Ying", "Yvonne", "Cyndi", "Elana", "Zhou Jie", "Claire", "Michelle", "Baby", "Angelababy", "Felicity", "Alison", "Bingbing", "Rachel", "Amanda", "Alexandra"
    );
    boyNames.push(
        "Tek"
    );
    ageAwake = 8;
    minAge = 8;
    maxAge = 13;
    genderRatio = 40;
    loopTime = 1;
    $("#devdash").show();
    // placeholder function
    console.log("coming not any time soon");
}

var textLog = [];

var postEventQueue = [];

var popCap = 80;
var specialEvents = [
    {
        "title":"breakup",
        "active":1,
        "description":"two lovers",
        "odds":300,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var choice;
            var lover;
            var lvrcount = 0;
            for (var j=0;j<npc.length;j++) {
                lvrcount += npc[j].isAttached();
            }
            if (lvrcount > 2) {
                do {
                    choice = pickFrom(npc);
                }
                while (choice.isAttached() == 0 || choice.alive == 0);
                for (var k=0;k<choice.rTwo.length;k++) {
                    if (choice.rTwo[k] != undefined) {
                        if (choice.rTwo[k].commitment > 0) {
                            choice.rTwo[k].commitment = 0;
                            choice.rTwo[k].friendship = Math.floor(choice.rTwo[k].friendship / 2);
                            choice.rTwo[k].attraction = Math.floor(choice.rTwo[k].attraction / 2);
                            choice.rTwo[k].romance = 20;
                            npc[k].rTwo[npc.indexOf(choice)].commitment = 0;
                            npc[k].rTwo[npc.indexOf(choice)].friendship = Math.floor(npc[k].rTwo[npc.indexOf(choice)].friendship / 2);
                            npc[k].rTwo[npc.indexOf(choice)].attraction = Math.floor(npc[k].rTwo[npc.indexOf(choice)].attraction / 2);
                            npc[k].rTwo[npc.indexOf(choice)].romance = 20;
                            lover = npc[k].firstName;
                        }
                    }
                }
                textLog.push([counter, (choice.firstName + " and " + lover + " <strong>broke up.</strong>")]);
                } else {
                    // console.log(("day " + counter + " " + this.title + " event failed"));
            }
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"strange water",
        "active":1,
        "description":"inhibitions lowered",
        "odds":3000,
        "checkOccurrance": function() {
            for (var m=0;m<postEventQueue.length;m++) {
                if (postEventQueue[m][2]==this.title) {return 0}
            }
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var orisoc = socialNormConstant;
            var orikbr = kissBackReq;
            socialNormConstant = 100;
            kissBackReq = -5000;
            textLog.push([counter, "the drinking water took on a <strong>strange flavor</strong>."]);
            postEventQueue.push([counter+90,function(){socialNormConstant = orisoc;kissBackReq = orikbr;textLog.push([counter, "<strong>water</strong> has returned to normal."])},this.title])
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"mysterious stranger",
        "active":1,
        "description":"community ++",
        "odds":3000,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            this.odds = this.odds * 2;
            addNPC();
            var stranger = npc[npc.length-1];
            stranger.ageInDays = (randomInt((25*365), (65*365)));
            stranger.beauty = (randomInt(8, 10));
            stranger.intellect = (randomInt(7, 10));
            stranger.honor = (randomInt(1, 5));
            textLog.push([counter, "the community welcomed " + stranger.firstName + ", a <strong>mysterious stranger</strong>, into their midst."]);
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"thanos",
        "active":1,
        "description":"malthusian dynamics at work",
        "odds":200,
        "checkOccurrance": function() {
            if (popCalc().pop > popCap && randomInt(1,(this.odds - popCalc().pop)) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            do {
                mire = pickFrom(npc);
            } while (mire.alive == 0)
            textLog.push([counter, (mire.firstName + " died of <strong>food shortage</strong> brought on by an unsustainable population.")]);
            killCharacter(mire);
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"pet adoption",
        "active":1,
        "description":"pet meta game begins",
        "odds":10*365,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            startPet();
            this.active = 0;
            textLog.push([counter, " the community adopted a <strong>pet</strong>."]);
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"tragic death",
        "active":1,
        "description":"another one bites the dust",
        "odds":3000,
        "checkOccurrance": function() {
            if (popCalc().pop < 3) {return 0}
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            do {
                mire = pickFrom(npc);
            } while (mire.alive == 0)
            textLog.push([counter, (mire.firstName + " had a <strong>tragic accident</strong>.")]);
            killCharacter(mire);
        },
        "flavortext":"Someone died!"
    },
    {
        "title":"remarkable day",
        "active":1,
        "description":"love at first sight",
        "odds":1000,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var subject;
            var object;
            do {
                subject = pickFrom(npc);
            } while (subject.alive == 0);
            do {
                object = pickFrom(npc);
            } while (subject == object || object.alive == 0);
            interactWith(subject, object);
            subject.rTwo[npc.indexOf(object)].attraction += 15000;
            subject.rTwo[npc.indexOf(object)].romance += 50;
            object.rTwo[npc.indexOf(subject)].attraction += 15000;
            object.rTwo[npc.indexOf(subject)].romance += 50;
            textLog.push([counter, (subject.firstName + " had a <strong>remarkable day</strong> with " + object.firstName + ".")]);
        },
        "flavortext":"Someone died!"
    },
    {
        "title":"chaojia",
        "active":1,
        "description":"fight",
        "odds":1000,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var subject;
            var object;
            do {
                subject = pickFrom(npc);
            } while (subject.alive == 0);
            do {
                object = pickFrom(npc);
            } while (subject == object || object.alive == 0);
            interactWith(subject, object);
            subject.rTwo[npc.indexOf(object)].friendship -= 15000;
            subject.rTwo[npc.indexOf(object)].romance -= 50;
            object.rTwo[npc.indexOf(subject)].friendship -= 15000;
            object.rTwo[npc.indexOf(subject)].romance -= 50;
            textLog.push([counter, (subject.firstName + " had a <strong>fight</strong> with " + object.firstName + ".")]);
        },
        "flavortext":"Someone died!"
    }
]

var typeStandard = 3;
var romanticTypes = [
    {
        "title":"happy people",
        "description":"person is attracted to happy people",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.happiness >= 1000) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"beautiful people",
        "description":"person is attracted to beautiful people",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.beauty >= 8) {
                return typeStandard;
            } else if (personb.beauty <=4) {
                return -1;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"pregnant people",
        "description":"person is attracted to pregnant people",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.pregnant == 1) {
                return typeStandard * 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"bimbos",
        "description":"person is attracted to beautiful dumb people",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.beauty >= 7 && personb.intellect <= 3) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"likes a challenge",
        "description":"person is attracted to people who don't like her",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.rTwo[npc.indexOf(persona)].friendship < 0) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"younger",
        "description":"person is attracted to younger",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.ageInYears < persona.ageInYears) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"older",
        "description":"person is attracted to older",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.ageInYears > persona.ageInYears) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"blondes",
        "description":"person is attracted to blondes",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.hair == "blonde" || personb.hair =="golden" || personb.hair == "dirty blond" || personb.hair =="light blonde") {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"idealist",
        "description":"person wants it all",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.beauty>=7 && personb.intellect>=7 && personb.social>=7 && personb.athletics>=7) {
                return typeStandard;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"promiscuous",
        "description":"person wants them all",
        "active":1,
        typeTest: function(persona, personb) {
            return typeStandard;
        }
    },
    {
        "title":"smart people",
        "description":"person is attracted to smart people",
        "active":1,
        typeTest: function(persona, personb) {
            if (personb.intellect >= 8) {
                return typeStandard;
            } else if (personb.intellect <= 4) {
                return -1;
            } else {
                return 0;
            }
        }
    }
];

// LOC LOCATION section

var locationList = [

]



// ACT ACTIVITIES section

var regActivities = [
    {
        "title":"read",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is reading.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 9);
            return hch;
        }
    },
    {
        "title":"watch TV",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is watching TV.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 2);
            return hch;
        }
    },
    {
        "title":"paint",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is painting.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 5);
            return hch;
        }
    },
    {
        "title":"instagram",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is social networking.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 3);
            return hch;
        }
    },
    {
        "title":"walk",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is taking a walk.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.athletics, 3);
            return hch;
        }
    },
    {
        "title":"run",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is jogging.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 3 - findDiff(char.athletics, 7);
            return hch;
        }
    },
    {
        "title":"chess",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {var opponent; do {opponent = pickFrom(npc);} while (opponent == char); return (char.firstName + " is playing chess with " + opponent.firstName + ".")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 2 - findDiff(char.intellect, 9);
            return hch;
        }
    },
    {
        "title":"project",
        "active":1,
        "reqFunction": function() {if (randomInt(1,100) == 1) {return 1} else {return 0}},
        "flavorText": function(char) {return (char.firstName + " is working on the project.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            projectMaterial += 1;
            var hch = 3 - findDiff(char.athletics, 7);
            return hch;
        }
    },
    {
        "title":"cinema",
        "active":1,
        "reqFunction": function() {return 1},
        "flavorText": function(char) {return (char.firstName + " is watching a film.")},
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 6);
            return hch;
        }
    }
]

var incRestrict = 15;
var normStandard = 2;
var ageAwake = 15;
var socialNorms = [ // 1 means don't do it; 0 means ok
    {
        "title":"incest",
        "active":1,
        "description":"no sex with relatives",
        normTest: function(persona, personb) {
            if (persona.relatives[npc.indexOf(personb)] != undefined) {
                //console.log("inc test failed");
                return incRestrict;
            } else {
                //console.log("inc test passed");
                return 0;
            }
        }
    },
    {
        "title":"awakening",
        "active":1,
        "description":"at least a minimum age",
        normTest: function(persona, personb) {
            if (persona.ageInYears() <= ageAwake || personb.ageInYears() <= ageAwake) {
                //console.log("inc test failed");
                return normStandard * 3;
            } else {
                //console.log("inc test passed");
                return 0;
            }
        }
    },
    {
        "title":"monogamy",
        "active":1,
        "description":"don't cheat",
        normTest: function(persona, personb) {
            var sigo = commitmentCheck(persona, personb);
            if (sigo > 0) {
                //console.log(persona.firstName + " monogamy test failed " + personb.firstName);
                return normStandard;
            } else {
                //console.log(persona.firstName + " monogamy test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"heterosexuality",
        "active":1,
        "description":"prefer those of the other gender",
        normTest: function(persona, personb) {
            if (persona.gender == personb.gender) {
                //console.log(persona.firstName + " hetero test failed " + personb.firstName);
                return normStandard;
            } else {
                //console.log(persona.firstName + " hetero test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"consistent sexuality",
        "active":1,
        "description":"be gay or straight",
        normTest: function(persona, personb) {
            if ((persona.gender == personb.gender && persona.genderPref >= 7) || (persona.gender != personb.gender && persona.genderPref <= 3)) {
                //console.log(persona.firstName + " consis test failed " + personb.firstName);
                return normStandard;
            } else  {
                //console.log(persona.firstName + " consis test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"age appropriate",
        "active":1,
        "description":"no sex with people outside an appropriate age range",
        normTest: function(persona, personb) {
            var agemax = persona.ageInYears() + 2;
            var agemin = persona.ageInYears() - 2;
            if (persona.ageInYears() >= 18 || personb.ageInYears() >= 18) {
                agemax = (persona.ageInYears() - 7) * 2;
                agemin = Math.floor((persona.ageInYears() / 2) + 7);
            }
            if (personb.ageInYears() <= agemax && personb.ageInYears() >= agemin) {
                //console.log("age test passed");
                return 0;
            } else {
                //console.log("age test failed");
                return normStandard * 2;
            }
        }
    }
];

// VAR VARIABLE section

function actType(n) {
    this.aName = n.title;
    this.count = 0;
    this.happyChange = 0;
    this.pleasureIndex = function(char) {
        return Math.floor((happyChange / count * 100));
    }
}

function person(firstname, surname, age, gender) {
    this.firstName = firstname;
    this.surName = surname;
    this.fullName = function() {return (this.firstName + " " + this.surName)}
    this.oIndex;
    this.alive = 1;
    this.gender = gender;
    this.oPronoun = function() {
        if (this.gender == 0) {
            return "her";
        } else {
            return "him";
        }
    }
    this.sPronoun = function() {
        if (this.gender == 0) {
            return "she";
        } else {
            return "he";
        }
    }
    this.pPronoun = function() {
        if (this.gender == 0) {
            return "her";
        } else {
            return "his";
        }
    }
    this.birthday = Math.floor(Math.random() * 365);
    this.deathday;
    this.ageInDays = (age*365 + (365-this.birthday));
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        if (this.alive == 0) {a = Math.floor((this.deathday - this.birthday)/365)}
        return a;};
    this.hair = pickFrom(hairColors);
    this.eyes = pickFrom(eyeColors);
    this.happiness = 0;
    this.genderFunc = function() {
        if (this.gender == 0) {return "f"} else {return "m"};
    }
    this.genderPref = weightedChooser(tenArray, gayWeightScale);; // 10 is full hetero; 1 is full homo
    this.beauty = randomInt(1, 10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.focus = randomInt(1,10);
    this.honor = weightedChooser(tenArray, tenWeightScale);
    this.myTypes = [];
    this.rTwo = [];
    this.actTwo = [];
    this.iMemory = [];
    this.aMemory = [];
    this.relatives = [];
    this.pregnant = 0;
    this.pregnancyStart;
    this.pregnancyParent;
    this.coitusCounter = 0;
    this.isAttached = function() {
        var co = 0;
        for (var i=0;i<this.rTwo.length;i++) {
            if (this.rTwo[i] != undefined) {co += this.rTwo[i].commitment;}
        }
        return co;
    }
};

// INT INTERACTION section

var kissReq = 200; // min attraction to try to kiss
var kissBackReq = 50; // min attraction to return kiss
var socialNormConstant = 2000; // lower number makes it easier to break social norms
var pregBaseOdds = 10; // base odds of getting pregnant (at puberty) are 1 in pregBaseOdds

function interactWith(persona, personb) {
    if (persona.rTwo[npc.indexOf(personb)] == undefined) {
        persona.rTwo[npc.indexOf(personb)] = new rType(npc.indexOf(personb));
        personb.rTwo[npc.indexOf(persona)] = new rType(npc.indexOf(persona));
    }
    if (persona.alive == 0 || personb.alive == 0) {return 0}

    pleasure = randomInt(5, 15) - findDiff(persona.social, personb.social) - findDiff(persona.intellect, personb.intellect) - findDiff(persona.athletics, personb.athletics);

    // adjust each person's relationship level according to the pleasure quotient
    persona.rTwo[npc.indexOf(personb)].friendship += pleasure;
    persona.rTwo[npc.indexOf(personb)].interactions ++;

    personb.rTwo[npc.indexOf(persona)].friendship += pleasure;
    personb.rTwo[npc.indexOf(persona)].interactions ++;

    var aPleasure = 0;
    // adjust for physical attractiveness
    if (persona.beauty > personb.beauty) {
        personb.rTwo[npc.indexOf(persona)].friendship += persona.beauty - personb.beauty;
    } else {
        persona.rTwo[npc.indexOf(personb)].friendship += personb.beauty - persona.beauty;
        aPleasure += personb.beauty - persona.beauty
    }

    persona.rTwo[npc.indexOf(personb)].attraction += calcAttraction(persona, personb);
    if (calcAttraction(persona, personb) > 0) {persona.rTwo[npc.indexOf(personb)].friendship += calcAttraction(persona, personb)};
    personb.rTwo[npc.indexOf(persona)].attraction += calcAttraction(personb, persona);
    if (persona.rTwo[npc.indexOf(personb)].attraction > kissReq) {
        whupEee(persona, personb);
    }
    return (pleasure + aPleasure);
}

function calcAttraction(persona, personb) {
    var bonus = 1;
    if (persona.gender == personb.gender) {
        bonus += 5 - persona.genderPref;
    } else {
        bonus += persona.genderPref - 5;
    }
    if (personb.beauty > 7) {bonus++}
    if (personb.beauty > persona.beauty) {bonus++}
    if (personb.ageInDays > persona.ageInYears) {
        bonus -= Math.floor(rootRead(findDiff(personb.ageInYears(),persona.ageInYears()))) - 2;
    }
    for (k=0;k<persona.myTypes.length;k++) {
        bonus += persona.myTypes[k].typeTest(persona, personb);
    }
    return bonus;
}

function testSocialNorms(persona, personb) {
    var w = 0;
    var wr = "";
    for (var i=0;i<socialNorms.length;i++) {
        if (socialNorms[i].active == 1) {
            w += socialNorms[i].normTest(persona, personb);
            // if (socialNorms[i].normTest(persona, personb) > 0) {wr += (socialNorms[i].title + " ")}
        }
    }
    w -= persona.rTwo[npc.indexOf(personb)].coitus;
    var wadj = Math.floor(persona.rTwo[npc.indexOf(personb)].attraction / socialNormConstant);
    if (w > 0 && wadj > 0) {
        for (var n=0;n<wadj;n++) {
            if (randomInt(1, (persona.honor ** 2)) == 1) {
                w--;
            }
        }
        // if (w == 0) {console.log(persona.firstName + " is violating social norms for " + personb.firstName);}
    }
    // if (persona.gender != personb.gender) {console.log(persona.firstName + " socnorm w " + wr + w)};
    return w;
}

function whupEee(persona, personb) {
        // console.log(persona.firstName + " whup function " + personb.firstName);
    if (persona.rTwo[npc.indexOf(personb)].attraction > kissReq && testSocialNorms(persona, personb) <= 0 && persona.ageInYears() > ageAwake && randomInt(1,(12-persona.social)) == 1) {
        // console.log(persona.firstName + " whup pass " + personb.firstName);
        var interactText = persona.firstName + " reaches out to kiss " + personb.firstName + ". ";
        if (personb.rTwo[npc.indexOf(persona)].attraction > kissBackReq) {
            interactText += (personb.firstName + " kisses " + persona.oPronoun() + " back.<br>");
            persona.rTwo[npc.indexOf(personb)].romance ++;
            personb.rTwo[npc.indexOf(persona)].romance ++;
            if (persona.rTwo[npc.indexOf(personb)].romance > 60) {
                var sti = commitmentCheck(persona, personb);
                if (persona.rTwo[npc.indexOf(personb)].commitment == 0 && sti == 0 && randomInt(1,(21-(persona.honor + persona.focus)) <= 5)) {
                    persona.rTwo[npc.indexOf(personb)].commitment ++;
                    textLog.push([counter, (persona.firstName + " promises to be loyal to " + personb.firstName + ".")]);
                }
            }
            if (randomInt(1,5) == 1) {
                if (persona.rTwo[npc.indexOf(personb)].coitus == 0) {
                    // console.log("first whup");
                    var suf = (persona.firstName + " (age " + persona.ageInYears() + ") and " + personb.firstName + " (age " + personb.ageInYears() + ")  slept together for the first time.");
                    if (persona.relatives[npc.indexOf(personb)] != undefined) {suf = (persona.firstName + " (age " + persona.ageInYears() + ") slept with " + personb.firstName + " (age " + personb.ageInYears() + "), " + persona.pPronoun() + " " + relaParser(persona, personb) +  ", for the first time. They committed <strong>incest</strong>.")}
                    textLog.push([counter, suf]);
                }
                interactText += (persona.firstName + " and " + personb.firstName + " slept together.<br>");
                persona.rTwo[npc.indexOf(personb)].coitus ++;
                personb.rTwo[npc.indexOf(persona)].coitus ++;
                coiCou ++;
                persona.coitusCounter ++;
                personb.coitusCounter ++;
                if (pregChances(persona, personb) == 1) {
                    if (persona.gender == 0) {
                        persona.pregnant = 1;
                        persona.pregnancyStart = counter;
                        persona.pregnancyParent = npc.indexOf(personb);
                        textLog.push([counter, (persona.firstName + " became pregnant.")]);
                    } else {
                        personb.pregnant = 1;
                        personb.pregnancyStart = counter;
                        personb.pregnancyParent = npc.indexOf(persona);
                        textLog.push([counter, (personb.firstName + " became pregnant.")]);
                    }
                }
            }
        } else {
            persona.rTwo[npc.indexOf(personb)].attraction -= calcAttraction(persona, personb) * 10;
            interactText += (personb.firstName + " pulls away.<br>");
        }
        $("#npcinteract" + npc.indexOf(persona)).attr("data-content", interactText);
    }
}

function evolveRelationships() {
    for (var i=0;i<npc.length;i++) {
        if (npc[i].alive == 1) {
            for (var j=0;j<npc.length;j++) {
                if (npc[i].rTwo[j] != undefined) {
                    if (npc[i].rTwo[j].friendship > 10) {npc[i].rTwo[j].friendship --};
                    if (npc[i].rTwo[j].attraction > 10 && (counter%100==0)) {npc[i].rTwo[j].attraction --};
                    //if (npc[i].rTwo[j].romance > 0) {npc[i].rTwo[j].romance --};
                }
            }
        }
    }
}

function doActivity(character) {
    var m;
    do {
        m = pickFrom(regActivities);
    } while (m.active != 1 || m.reqFunction() != 1)
    character.happiness += m.enjoyFunction(character);
    return m.flavorText(character);
}

function resolveDeaths() {
    for (var i=0;i<npc.length;i++) {
        if (npc[i].ageInYears() > 75 && npc[i].alive == 1 && randomInt(1, 20 * 365) == 1) {
            killCharacter(npc[i]);
        }
    }
}

function resolveEvents() {
    for (var i=0;i<specialEvents.length;i++) {
        if (specialEvents[i].active == 1 && specialEvents[i].checkOccurrance() == 1) {
            specialEvents[i].effect();
        }
    }
    for (var j=0;j<postEventQueue.length;j++) {
        if (postEventQueue[j][0] == counter) {
            postEventQueue[j][1]();
            postEventQueue.splice(j);
        }
    }
}

function createCharacter() {
    var g = 0;
    if (randomInt(1,100) <= genderRatio) {g = 1}
    var nam;
    if (g == 1) {nam = pickFrom(boyNames);} else {nam = pickFrom(girlNames);}
    var jk = new person(nam, pickFrom(surNames), randomAge(), g);
    var c = randomInt(2, 5);
        for (var k=0;k<c;k++) {
            jk.myTypes.push(pickFrom(romanticTypes));
        }
    for (var l=0;l<regActivities.length;l++) {
        jk.actTwo.push(new actType(regActivities[l]));
    }
    return jk;
}

function addNPC() {
    npc.push(createCharacter());
    npc[npc.length-1].oIndex = npc.length-1;
    charPanels.push(createCharPanel(npc.length - 1));
    $("#dashpanel").append(charPanels[charPanels.length-1]);
    $("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
    reverser = 0;
    console.log("added");
}

function meetPeopleTwo() {
    for (var i=0;i<npc.length;i++) {
        var iter = i;
        var p = [];
        for (var j=0;j<npc.length;j++) {
            var r = npc[iter].rTwo[j];
            if (r != undefined) {
                var adder = 0;
                var varDirection = 0;
                if (r.friendship > 0) {adder += Math.floor(rootRead(Math.abs(r.friendship)))} else {adder -= Math.floor(rootRead(r.friendship))};
                if (r.attraction > 0) {adder += Math.floor(rootRead(Math.abs(r.attraction)))} else {adder -= Math.floor(rootRead(r.attraction))};
                if (r.commitment == 1) {adder += adder} else {adder -= findDiff(npc[i].ageInYears(),npc[j].ageInYears());}
                // console.log(npc[i].firstName + " " + npc[j].firstName + " " + findDiff(npc[i].ageInYears(),npc[j].ageInYears()))
                /* if (r.friendship > 100) {
                    adder += 100;
                } else {
                    adder += r.friendship;
                }
                if (r.attraction > 100) {
                    adder += 100;
                } else {
                    adder += r.attraction;
                } */
                p.push(adder);
            } else {
                p.push(1);
            }
        }
        console.log(p);
        var u;
        do {
            u = weightedChooser(npc, p);
        } while (npc.indexOf(u) == iter || npc.indexOf(u).alive == 0)
        var uip = interactWith(npc[iter], u);
        if (npc[iter].iMemory.length > 99) {npc[iter].iMemory = npc[iter].iMemory.slice(1)}
        npc[iter].iMemory.push([counter,u.oIndex,uip]);
    }
}

function gameStart() {
    gameSetup();
    gameStarter();
}

function gameStarter() {
    setTimeout(function() {
        if (paused == false) {
          gameLoop();  
        }
        gameStarter();
    }, loopTime);
}

function gameSetup() {
    var now = new Date();
    $("#petdash").hide();
    $("#devdash").hide();
    $("#startTime").text(now);
    dLc();
    for (var i=0;i<characterCount;i++) {
        addNPC();
    }
    makeRelative(pickFrom(npc));
    displayCharPanels();
    setupMetaDash();
    printStats();
}

function displayCharPanels() {
    $("#dashpanel").html("");
    var charCopy = charPanels.slice(0);
    // charCopy.sort(function (a,b) {return $(a).find("strong").text() > $(b).find("strong").text();})
    for (var i=0;i<charPanels.length;i++) {
        if (charPanels[i] != undefined) {
            $("#dashpanel").append("<hr>");
            $("#dashpanel").append(charPanels[i]);
        }
    }
    $("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
}

function checkIndices() {for (var i=0;i<npc.length;i++) if (npc[i].oIndex != i) {console.log("indices do not match")}}
var loopTiming = []
function gameLoop() {
    if (counter%100 == 0) {loopTiming.push([counter, new Date]);};
    if (counter%1000 == 0) {calcLoopTime();};
    checkIndices();
    updateDash();
    updateMetaDash();
    dayEnd();
    petLoop();
}

function dayEnd() {
    for (var i = 0; i < npc.length; i++) {
        npc[i].ageInDays++;
        if (npc[i].alive == 1) {
            $("#npcactivity" + i).html(doActivity(npc[i]));
        }
    }
    counter++;
    resolveEvents();
    evolveRelationships();
    meetPeopleTwo();
    resolvePregnancies();
    resolveDeaths();
}

function updateDash() {
    for (var i = 0; i < npc.length; i++) {
        if (npc[i].alive == 1) {
            $("#npc" + i).attr("title",npc[i].firstName);
            $("#npc" + i).attr("data-age",npc[i].ageInYears());
            //$("#npcname" + i).text(npc[i].fullName());
            /* var g;
            if (npc[i].gender == 0) {g = "F"} else {g = "M"}
            $("#npcgender" + i).text(g);
            $("#npcbeauty" + i).text(npc[i].beauty);
            $("#npcathletics" + i).text(npc[i].athletics);
            $("#npcintellect" + i).text(npc[i].intellect);
            $("#npcsocial" + i).text(npc[i].social); */
            $("#npchappy" + i).html(npc[i].happiness + " | " + (npc[i].happiness/counter).toFixed(2) + " hpd");
            $("#npcyears" + i).html(npc[i].ageInYears());
            
            $("#npcrel" + i).attr("data-content", allRelationships(npc[i]));
            $("#npcdesc" + i).attr("data-content", describeCharacter(npc[i]));
        }
    }
    $("#years").text(Math.floor(counter/365) + 1);
    $("#counter").text(counter%365);
    $("#population").text(popCalc().pop);
    $("#fpop").text(popCalc().f);
    $("#mpop").text(popCalc().m);
    //$("#coicou").text(coiCou);
    for (var l=0;l<textLog.length;l++) {
        if (textLog[l][0] == counter) {
            $("#textlog").prepend(textLogPrefix() + textLog[l][1] + "<br>");
        }
    }
    if (counter == 1) {sortDash();reverser=0;};
}

$(document).ready(gameStart());

$("#sortdash2").click(function() {sortDash("id");});
$("#sortdash3").click(function() {sortDash("age");});

// META Game

var projectMaterial = 0;

function metaPanel() {
    return ("Project Material: <span id='projmat'></span><br>");
}

function setupMetaDash() {
    $("#metapanel").html(metaPanel());
}

function updateMetaDash() {
    $("#projmat").text(projectMaterial);
}

// PET

var petTimer;
function petType() {
    this.alive = 0;
    this.name = "bob";
    this.happy = 0;
}
var pet = new petType;

var petDash = (
    '<p><button type="button" class="btn btn-primary" id="soothebutton" onClick="soothePet()">Soothe Pet</button> ' + 
    '<button type="button" class="btn btn-primary" id="soothebutton" onClick="punishPet()">Punish Pet</button></p>'

);

var petPanel = (
    "Pet.<br>" +
    "<span id='petpanelstatus'></span><br><hr>"
);

function startPet() {
    petTimer = new Date();
    pet.alive = 1;
    var now = new Date();
    var timeDiff = (now - petTimer);
    console.log(timeDiff + " is timediff");
    $("#petdash").html(petDash);
    $("#petpanel").html(petPanel);
    $("#petpanelstatus").html("Pet is active.<br>");
    $("#petdash").show();
}

function soothePet() {
    pet.happy ++;
    $("#petpanelstatus").html("Pet is soothed.<br>");
}

function punishPet() {
    pet.happy --;
    $("#petpanelstatus").html("Pet is reprimanded.<br>");
}

function petLoop() {
    var timeDiff = Math.floor((now - petTimer) / 1000 / 60);
    if ((counter % 100) == 0 && pet.alive == 1) {
        if (pet.happy > 10) {
            $("#petpanelstatus").html("Pet is happy.");
        } else if (pet.happy < -10) {
            $("#petpanelstatus").html("Pet is unhappy.");
        } else {$("#petpanelstatus").html("Pet is resting.");}
    }
    var now = new Date();
    // if (pet.alive == 1) {console.log(timeDiff + " minutes passed");}
}

</script>
  </body>
</html>