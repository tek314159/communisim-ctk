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
const petTimeGap = 30 * 1000; // 30 seconds per turn
const petHungerThreshold = 2; // 2 is 1 minute at petTimeGap=30000
var pet = new petType;

function petLoop() {
    var now = new Date();
    var timeDiff = (now - petTimer);
    if (timeDiff > petTimeGap && pet.alive == 1) {
        pet.old ++;
        pet.hunger ++;
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
    displayPet();
}

function displayPet() {
    $("#petdash").html(petDash);
    $("#petpanel").html(petPanel);
    // $("#petdash").show();
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
var teamLeader = -1;
var leaderActive = 0;
var leaderMinAge = 16;
var monumentActive = 0;

var monumentList = [
    {
        title: "progress",
        condition: 1000,
        display: "Monument to Progress",
        description: function() {return "This is a monument to the work and industry of the community."},
        invokeText: "When invoked, the community will devoted to the production of monuments exalting and celebrating the community's achievements and culture.",
        active: 0,
        requirements: function() {
            if (projectMaterial > 250) {
                return 1;
            } else {return 0}
        },
        effect: function() {
            console.log("progress monument effect");
            addHistory("the community completed a Monument to Progress.");
            displayAboutStats();
        },
        invokedStatus: 0,
        invoke: function() {
            console.log("invoking " + this.title);
            this.invokedStatus = 1;
        },
        uninvoke: function() {
            console.log("uninvoking " + this.title);
            this.invokedStatus = 0;
        }
    },
    {
        title: "discovery",
        condition: 1000,
        display: "Monument to Discovery",
        description: function() {return "This monument celebrates the exploration of lands outside of and far from home."},
        invokeText: "When invoked, the community will devoted itself to the exploration of the land outside, and the establishment of relations with neighboring communities.",
        active: 0,
        requirements: function() {
            if (projectMaterial > 450) {
                return 1;
            } else {return 0}
        },
        effect: function() {
            console.log("discovery monument effect");
            addHistory("the community completed a Monument to Discovery.");
            displayOutside();
            $("#navdiscovery").addClass("glow");
            var yuhg = filterIndex(regActivities, "title", "explore");
            var iur = filterIndex(specialEvents, "title", "emigration");
            console.log(yuhg)
            regActivities[yuhg].active = 1;
            specialEvents[iur].active = 1;
            specialEvents[filterIndex(specialEvents, "title", "immigration")].active = 1;
            discoveryActive = 1;
        },
        invokedStatus: 0,
        invoke: function() {
            console.log("invoking " + this.title);
            this.invokedStatus = 1;
        },
        uninvoke: function() {
            console.log("uninvoking " + this.title)
            this.invokedStatus = 0;
        }
    }
]
const monumentActiveThreshold = 50;
const leaderActiveThreshold = 15; // min pop to set leader

function displayOutside() {
    $("main").append(discoveryPanel());
    $("#discoverypage").hide();
    $("#navhome").after(disNav);
}

function metaLoop() {
    setLeader();
    checkMonuments();
    updateMetaDash();
    discoveryLoop();
}

var disPoints = 0;
var discoveryActive = 0;

function metaPanel() {
    return (`<div id="projectmaterial">Project Material: <span id='projmat'></span></div><div id='leader'></div><div id='monument'></div>`);
}

function setupMetaDash() {
    $("#metapanel").html(metaPanel());
}

function updateMetaDash() {
    $("#projmat").text(projectMaterial);
    if (projectMaterial > monumentActiveThreshold && monumentActive == 0) {
        activateMonument();
    }
    if ((counter % 365) == 0) {
        updateLocales();
    }
    $("#localecount").html(localeList.length);
}

function activateMonument() {
    /* var jih = "<div id='monument'></div>";
    $("#metapanel").append(jih); */
    monumentActive = 1;
}

function createMonumentPanel(id) {
    return (`
       <div class='mt-3' id="${monumentList[id].title}">
                    <button type="button" class="btn btn-info monumentbutton" data-monumentid="${id}" id="monu-${monumentList[id].title}" onClick="modalMonument(${id})">${monumentList[id].display}</button>
                </div>
    `)
}

function checkMonuments() {
    for (let i=0;i<monumentList.length;i++) {
        if (monumentList[i].active == 0 && monumentList[i].requirements() == 1) {
            monumentList[i].active = 1;
            $("#monument").append(createMonumentPanel(i));
            monumentList[i].effect();
        }
    }
}

function modalMonument(id) {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html(monumentList[id].display);
    let mstatus = "";
    if (monumentList[id].invokedStatus == 1) {
        mstatus = `${monumentList[id].display} has been invoked.`
    } else {
        mstatus = `<p><button type="button" class="btn btn-primary invokebutton" id="invoke-${monumentList[id].title}" onClick="invokeMonument(${id})">Invoke the ${monumentList[id].display}</button></p>`
    }
    let monuModalBody = (`
        <div id="monumodalbody">
        <p>${monumentList[id].description()} </p>
        <p>${monumentList[id].invokeText} </p>
        ${mstatus}
        </div>
    `)
    $("#modalbody").html(monuModalBody);
    $('#exampleModal').modal('show');
}

function invokeMonument(mon) {
    $(".invokebutton").hide();
    $("#monumodalbody").append(`${monumentList[mon].display} has been invoked.`);
    $(".monumentbutton").removeClass("btn-success");
    // $(".monumentbutton").css("opacity", "0.5");
    $(".monumentbutton").addClass("btn-info");
    $(`#monu-${monumentList[mon].title}`).removeClass("btn-info");
    $(`#monu-${monumentList[mon].title}`).addClass("btn-success");
    for (let i=0;i<monumentList.length;i++) {
        monumentList[i].uninvoke();
    }
    monumentList[mon].invoke();
}

function setLeader() {
    if (popCalc().pop > leaderActiveThreshold && leaderActive == 0 && projectMaterial > 1) {
        console.log(`threshold ${leaderActiveThreshold} met , spawning leader`);
        chooseLeader();
        leaderActive = 1;
    }
    if (teamLeader != -1 && npc[teamLeader].alive == 0) {
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
    for (var i=0;i<liveNPC.length;i++) {
        propl = npc[liveNPC[i]];
        propscore = 0;
        for (var l=0;l<propl.rTwo.length;l++) {
            if (propl.rTwo[l] != undefined && propl.ageInYears() > leaderMinAge) {
                propscore += propl.rTwo[l].friendship;
                propscore += propl.rTwo[l].attraction;
            }
        }
        if (propscore > ldrscore) {ldr = propl; ldrscore = propscore}
    }
    leaderMinAge = tempmin;
    teamLeader = ldr.oIndex;
    $("#leader").html(`${ldr.fullName()} has become community leader.`);
    addHistory(`${ldr.fullName()} has become <strong>community leader</strong>.`)
}

// DIS DISCOVERY section

var localeMinPop = 17;
var localeMaxPop = 65;
var localeMinDistance = 50;
var localeMaxDistance = 500;
var disPointThreshold = 2;

var localeList = []

function otherLocale() {
    this.name = pickFrom(placeNames);
    this.population = randomInt(localeMinPop, localeMaxPop);
    this.location = {x:0,y:0};
    this.families = [];
    this.distance = function() {return Math.floor(Math.sqrt(this.location.x**2 + this.location.y**2))};
    this.relationship = function() {return 1};
    this.populationGrowth = function() {var growth = 1; if (Math.floor(this.population * 0.003) > 1) {growth = Math.floor(this.population * 0.003)}; this.population += growth} // annual growth
    let sc = randomInt(1,3);
    for (var i=0;i<sc;i++) {
        this.families.push(pickFrom(surNames));
    }
    if (randomInt(1,2) == 1) {this.location.x = randomInt(localeMinDistance, localeMaxDistance)} else {this.location.x = (randomInt(localeMinDistance, localeMaxDistance) * -1)}
    if (randomInt(1,2) == 1) {this.location.y = randomInt(localeMinDistance, localeMaxDistance)} else {this.location.y = (randomInt(localeMinDistance, localeMaxDistance) * -1)}
}

function addLocale() {
    $("#locpanel").append(createLocalePanel(( (localeList.push(new otherLocale)-1) )));
    locReverser = 0;
}

function discoverLocale() {
    addLocale();
    disPointThreshold = 2 ** (localeList.length + 7);
    addHistory(`the community of <strong>${localeList[localeList.length-1].name}</strong> was <strong>discovered</strong>.`)
}

function discoveryLoop() {
    if (discoveryActive == 1 && disPoints > disPointThreshold) {
        discoverLocale();
    }
}

function updateLocales() {
    var len = localeList.length;
    for (let i=0;i<len;i++) {
        localeList[i].populationGrowth();
        $("#locpop"+i).text(localeList[i].population);
    }
    for (let i=0;i<localeList.length;i++) {
        $("#loc"+i).attr("data-pop",localeList[i].population);
    }
    var worldpop = 0;
    for (let i=0;i<localeList.length;i++) {
        worldpop += localeList[i].population;
    }
    $("#worldpop").html(worldpop);
}