// META Game

var projectMaterial = 0;
var teamLeader;
var leaderActive = 0;
var leaderMinAge = 16;
var monumentActive = 0;

function metaLoop() {
    updateMetaDash();
    if (projectMaterial % 200 == 0 && leaderActive == 0 && projectMaterial > 1) {
        console.log("projmat is 200 , spawning leader");
        chooseLeader();
        leaderActive = 1;
    }
    if (teamLeader != undefined && npc[teamLeader].alive == 0) {
        leaderActive = 0;
        $("#leader").html("Leader died. Will choose another leader.");
    }
}

function metaPanel() {
    return ("<div id='metapanel'>Project Material: <span id='projmat'></span><br></div><div id='leader'></div>");
}

function setupMetaDash() {
    $("#metapanel").html(metaPanel());
}

function updateMetaDash() {
    $("#projmat").text(projectMaterial);
    if (projectMaterial > 400 && monumentActive == 0) {
        var jih = "<div id='monument'>Monument goes here.</div>"
        $("#metapanel").append(jih)
        monumentActive = 1;
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
    var proplscore = 0;
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
    $("#leader").html(ldr.fullName() + " has become community leader.");
}

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

function petLoop() {
    var now = new Date();
    var timeDiff = Math.floor((now - petTimer) / 1000 / 30);
    if (timeDiff > 0 && pet.alive == 1) {
        // console.log(pet.old);
        pet.old ++;
        pet.hunger --;
        // console.log(pet);
        // console.log(timeDiff);
        if (pet.happy > 10) {
            var cho = pickFrom(liveNPC);
            $("#petpanelstatus").html("Pet is playing with " + npc[cho].firstName + ".");
        } else if (pet.happy < -10) {
            $("#petpanelstatus").html("Pet is unhappy.");
        } else {$("#petpanelstatus").html("Pet is resting.");}
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
    $("#petpanelstatus").html("Pet is active.");
    $("#petdash").show();
}

function soothePet() {
    pet.happy ++;
    $("#petpanelstatus").html("Pet is soothed.");
}

function rewardPet() {
    pet.happy ++;
    $("#petpanelstatus").html("Pet is appreciative.");
}

function punishPet() {
    pet.happy --;
    $("#petpanelstatus").html("Pet is reprimanded.");
}

function feedPet() {
    pet.happy --;
    $("#petpanelstatus").html("Pet has been fed.");
}