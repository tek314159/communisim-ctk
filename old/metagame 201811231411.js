// META Game

// PET

var petTimer;
function petType() {
    this.alive = 0;
    this.name = "bob";
    this.happy = 0;
    this.old = 0;
    this.hunger = 0;
}
var pet = new petType;
var petTimeGap = 30 * 1000; // 30 seconds per turn
var petHungerThreshold = 2; // 2 is 1 minute at petTimeGap=30000

function petLoop() {
    var now = new Date();
    var timeDiff = (now - petTimer);
    if (timeDiff > petTimeGap && pet.alive == 1) {
        // console.log(pet.old);
        pet.old ++;
        pet.hunger ++;
        // console.log(pet);
        // console.log(timeDiff);
        if (pet.hunger > petHungerThreshold) {
            petStatusDisplay("Pet is hungry.");
        } else if (pet.happy > 10) {
            var cho = pickFrom(liveNPC);
            petStatusDisplay(`Pet is playing with ${npc[cho].firstName}.`);
        } else if (pet.happy < -10) {
            petStatusDisplay("Pet is unhappy.");
        } else {petStatusDisplay("Pet is resting.");}
        petTimer = now;
    }
    // if (pet.alive == 1) {console.log(timeDiff + " minutes passed");}
}

var petDash = (
    '<p><button type="button" class="btn btn-primary" id="soothebutton" onClick="soothePet()">Soothe</button> ' + 
    '<button type="button" class="btn btn-primary" id="rewardbutton" onClick="rewardPet()">Reward</button> ' + 
    '<button type="button" class="btn btn-success" id="rewardbutton" onClick="feedPet()">Feed</button> ' + 
    '<button type="button" class="btn btn-danger" id="punishbutton" onClick="punishPet()">Punish</button></p>'

);

var petPanel = (
    "Pet.<br>" +
    "<span id='petpanelstatus'></span><br><hr>"
);

function startPet() {
    petTimer = new Date();
    pet.alive = 1;
    // var now = new Date();
    // var timeDiff = (now - petTimer);
    // console.log(timeDiff + " is timediff");
    $("#petdash").html(petDash);
    $("#petpanel").html(petPanel);
    $("#petdash").show();
    petStatusDisplay("Pet is active.");
}

function petStatusDisplay(para) {
    $("#petpanelstatus").hide();
    $("#petpanelstatus").html(para);
    $("#petpanelstatus").fadeIn();
}

function soothePet() {
    pet.happy ++;
    petStatusDisplay("Pet is soothed.");
}

function rewardPet() {
    pet.happy ++;
    petStatusDisplay("Pet is appreciative.");
}

function punishPet() {
    pet.happy --;
    petStatusDisplay("Pet is reprimanded.");
}

function feedPet() {
    if (pet.hunger > 0) {
        pet.hunger = 0;
        petStatusDisplay("Pet has been fed.");
    } else {
        petStatusDisplay("Pet is not hungry.");
    }
}

// PROJ PROJECT Building

var projectMaterial = 0;
var teamLeader;
var leaderActive = 0;
var leaderMinAge = 16;
var monumentActive = 0;
function filterValue(obj, key, value) {
    return obj.find(function(v){ return v[key] === value});
  }
function filterIndex(obj, key, value) {
    return obj.findIndex(function(v){ return v[key] === value});
  }
var monumentList = [
    {
        title: "progress",
        display: "Monument to Progress",
        description: function() {return "This is a monument to the work and industry of the community."},
        active: 0,
        requirements: function() {
            if (projectMaterial > 151) {
                return 1;
            } else {return 0}
        },
        effect: function() {
            console.log("progress monument effect")
        },
        invocation: function() {
            return "functional"
        }
    },
    {
        title: "discovery",
        display: "Monument to Discovery",
        description: function() {return "This monument celebrates the exploration of lands outside of and far from home."},
        active: 0,
        requirements: function() {
            if (projectMaterial > 152) {
                return 1;
            } else {return 0}
        },
        effect: function() {
            console.log("discovery monument effect");
            $("main").append(discoveryPanel2());
            $("#discoverypage").hide();
            $("#navhome").after(disNav);
            var yuhg = filterIndex(regActivities, "title", "explore")
            console.log(yuhg)
            regActivities[yuhg].active = 1;
        },
        invocation: function() {
            return "functional"
        }
    }
]
const monumentActiveThreshold = 150;
const leaderActiveThreshold = 15; // min pop to set leader

function metaLoop() {
    setLeader();
    checkMonuments();
    updateMetaDash();
}

var disPoints = 0;

function metaPanel() {
    return ("<div id='metapanel'>Project Material: <span id='projmat'></span><br></div><div id='leader'></div>");
}

function setupMetaDash() {
    $("#metapanel").html(metaPanel());
}

function updateMetaDash() {
    $("#projmat").text(projectMaterial);
    if (projectMaterial > monumentActiveThreshold && monumentActive == 0) {
        var jih = "<div id='monument'></div>"
        $("#metapanel").append(jih)
        monumentActive = 1;
    }
    $("#dispoints").html(disPoints);
}

function checkMonuments() {
    var ure;
    for (let i=0;i<monumentList.length;i++) {
        if (monumentList[i].active == 0 && monumentList[i].requirements() == 1) {
            monumentList[i].active = 1;
            //console.log("checking pass")
            ure = (`
                <div class='mt-3' id="${monumentList[i].title}">
                    <button type="button" class="btn btn-info" id="monu-${monumentList[i].title}" onClick="modalMonument(${i})">${monumentList[i].display}</button>
                </div>
            `)
            $("#monument").append(ure)
            monumentList[i].effect();
        }
    }
}

function modalMonument(id) {
    console.log(id);
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html(monumentList[id].display);
    let monuModalBody = (`
        <p>${monumentList[id].description()} </p>
        <p><button type="button" class="btn btn-primary" id="invoke-${monumentList[id].title}" onClick="invokeMonument(${id})">Invoke the ${monumentList[id].display}</button></p>
    `)
    console.log(monuModalBody);
    $("#modalbody").html(monuModalBody);
    $('#exampleModal').modal('show');
}

function setLeader() {
    if (popCalc().pop > leaderActiveThreshold && leaderActive == 0 && projectMaterial > 1) {
        console.log(`threshold ${leaderActiveThreshold} met , spawning leader`);
        chooseLeader();
        leaderActive = 1;
    }
    if (teamLeader != undefined && npc[teamLeader].alive == 0) {
        leaderActive = 0;
        $("#leader").html("Leader died. Will choose another leader.");
    }
}

function chooseLeader() {
    var ldr;
    var tempmin = leaderMinAge;
    do {
        ldr = npc[pickFrom(liveNPC)];
        leaderMinAge --;
    } while (ldr.ageInYears < leaderMinAge)
    var ldrscore = 0;
    for (var l=0;l<ldr.rTwo.length;l++) {
        if (ldr.rTwo[l] != undefined) {
            ldrscore += ldr.rTwo[l].attraction;
            ldrscore += ldr.rTwo[l].friendship;
        }
    }
    var propl;
    var propscore = 0;
    // console.log(ldr.fullName() + " leaderscore is " + ldrscore);
    for (var i=0;i<liveNPC.length;i++) {
        propl = npc[liveNPC[i]];
        propscore = 0;
        for (var l=0;l<propl.rTwo.length;l++) {
            if (propl.rTwo[l] != undefined && propl.ageInYears() > leaderMinAge) {
                propscore += propl.rTwo[l].friendship;
                propscore += propl.rTwo[l].attraction;
            }
        }
        // console.log(propl.fullName() + " propscore is " + propscore);
        if (propscore > ldrscore) {ldr = propl; ldrscore = propscore}
    }
    leaderMinAge = tempmin;
    teamLeader = ldr.oIndex;
    $("#leader").html(`${ldr.fullName()} has become community leader.`);
    addHistory(`${ldr.fullName()} has become <strong>community leader</strong>.`)
}

// DIS DISCOVERY section

var otherCommunityMinPop = 10;
var otherCommunityMaxPop = 100;

function otherCommunity() {
    this.name = pickFrom(placeNames);
    this.population = randomInt(otherCommunityMinPop, otherCommunityMaxPop);
    this.distance = randomInt(100, 1000);

}