// CommuniSim utilities.js

const tenArray = [1,2,3,4,5,6,7,8,9,10]
const tenWeightScale = [1,1,2,2,5,6,7,8,9,1];
const gayWeightScale = [1,7,4,2,3,3,8,10,30,1];
const characterCount = 12;

var gameStartTime;
var loopTiming = []
var fullLoopTime = [];
var meetTiming = [];
var loopTimingDetail = [];
var birthRate = [];

var stats = {
    totalBirths: 0,
    totalDeaths: 0,
    outmigration: 0,
    inmigration: 0
}

var counter = 0;
var popCap = 95;
var minAge = 13;
var maxAge = 19;
var paused = false;
var loopTime = 500;
var npc = [];
var liveNPC = [];
var puberty = 12;
var menopause = 45;
var genderRatio = 47; // percent male
// var charPanels = [];
var textLog = [];
var postEventQueue = [];

var resetwarning = 0;
var textLogPointer = 0;
var speedToggle = 0;
var reverser = 0;
var locReverser = 0;

var MIGVAR = {
    migrateMinAge: 14,
}

// Interaction Variables
var kissReq = 200; // min attraction to try to kiss
var kissBackReq = 50; // min attraction to return kiss
var socialNormConstant = 5000; // lower number makes it easier to break social norms
var pregBaseOdds = 80; // base odds of getting pregnant (at puberty) are 1 in pregBaseOdds

// Romantic Type Variables
var typeStandard = 3;

// Social Norm Variables
var incRestrict = 15;
var normStandard = 2;
var ageAwake = 15;

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
            if (personb.rTwo[persona.oIndex].friendship < 0) {
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

var socialNorms = [ // 1 means don't do it; 0 means ok
    {
        "title":"incest",
        "active":1,
        "description":"no sex with relatives",
        normTest: function(persona, personb) {
            if (persona.relatives[personb.oIndex] != undefined) {
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


function rType(n) {
    this.rName = npc[n].firstName;
    this.originalIndex = n;
    this.friendship = 0;
    this.attraction = 0;
    this.romance = 0;
    this.commitment = 0;
    this.interactions = 0;
    this.coitus = 0;
};


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

function weightedChooser(array1, array2) {
    var k = [];
    var t = 0;
    var arlen = array1.length;
    for (i=0;i<arlen;i++) {
        if (array2[i] > 0) {
            k.push([array1[i], array2[i]]);
            t += array2[i];
        } else {
            k.push([array1[i], 1]);
            t += 1;
        }
    }
    var c = randomInt(0, t);
    var ct = 0;
    var choice = 0;
    while (c > 0) {
        c -= k[ct][1];
        choice = ct;
        ct ++;
    }
    return array1[choice];
}

function thisYear() {
    return (Math.floor(counter/365) + 1);
}

function parseYear(n) {
    let y = (Math.floor(n/365) + 1)
    let d = ((n%365) + 1)
    return {"year":y,"day":d}
}

function rootRead(n) {
    return Math.floor(n ** 0.5);
}

function upCase(string) 
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function textLogPrefix() {
    var pref = (`Year ${thisYear()}, day ${parseYear(counter).day}, `);
    return pref;
}

function addHistory(entry) {
    textLog.push([counter,entry]);
}

function relaParser(subject, object) {
    if (subject.relatives[npc.indexOf(object)] != undefined) {
        if (object.gender == 0) {
            switch (subject.relatives[npc.indexOf(object)]) {
                case "parent": return "mother";
                case "sibling": return "sister";
                case "cousin": return "cousin";
                case "parsib": return "aunt";
                case "sibchild": return "niece";
                case "child": return "daughter";
                case "grandparent": return "grandmother";
                case "grandchild": return "granddaughter";
                default: return "error";
            }
        }
        if (object.gender == 1) {
            switch (subject.relatives[npc.indexOf(object)]) {
                case "parent": return "father";
                case "sibling": return "brother";
                case "cousin": return "cousin";
                case "parsib": return "uncle";
                case "sibchild": return "nephew";
                case "child": return "son";
                case "grandparent": return "grandfather";
                case "grandchild": return "grandson";
                default: return "error";
            }
        }
    }
}

function commitmentCheck(persona, personb) {
    var sigo = 0;
    var rtalen = persona.rTwo.length;
    var rtblen = personb.rTwo.length;
    for (var i=0;i<rtalen;i++) {
        if (persona.rTwo[i] != undefined) {
            if (persona.rTwo[i].commitment > 0 && i != personb.oIndex) {
                sigo ++;
                //console.log("comsigo 1 up");
            }
        }
    }
    for (var i=0;i<rtblen;i++) {
        if (personb.rTwo[i] != undefined) {
            if (personb.rTwo[i].commitment > 0 && i != persona.oIndex) {
                sigo ++;
                //console.log("comsigo 2 up");
            }
        }
    }
    return sigo;
}

function pregChances(persona, personb) {
    if (persona.gender == personb.gender) {return 0;}
    var char;
    if (persona.gender == 0) {char = persona} else {char = personb}
    // base odds at puberty are 1 in 5
    var baseodds = pregBaseOdds;
    var fullchance = Math.floor((menopause - char.ageInYears() + 1) / (menopause - puberty - 1) * 100);
    //console.log(fullchance + " is fullchance");
    var onein = Math.floor(baseodds * 100 / fullchance);
    //console.log(onein + " is onein");
    var odds = randomInt(1, onein);
    if (char.gender == 0 && char.ageInYears() >= puberty && char.ageInYears() <= menopause && char.pregnant == 0 && odds == 1) {
        return 1;
    } else {
        return 0;
    }
}

// DES DESCRIPTION section

function describeRelationship(persona, personb) {
    var description = "";
    if (persona.rTwo[npc.indexOf(personb)] == undefined) {return description;}
    // relatives
    if (persona.relatives[npc.indexOf(personb)] != undefined) {
        description += (personb.firstName + " is " + persona.firstName + "'s " + relaParser(persona, personb) + ". ")
        if (persona.rTwo[npc.indexOf(personb)].friendship > 100) {
            description += "They get along well. ";
        } else if (persona.rTwo[npc.indexOf(personb)].friendship < -50) {
            description += "They don't get along. ";
        }
        if (persona.rTwo[npc.indexOf(personb)].attraction > 5000 && persona.ageInYears() >= 6) {
            description += (upCase(persona.sPronoun()) + " has a crush on " + personb.oPronoun() + ". ");
        } else if (persona.rTwo[npc.indexOf(personb)].attraction > 1000 && persona.ageInYears() >= 6) {
            description += (upCase(persona.sPronoun()) + " finds " + personb.oPronoun() + " attractive. ");
        }
    } else if (persona.rTwo[npc.indexOf(personb)].commitment == 1) {
    // lovers
        description += (personb.firstName + " is " + persona.firstName + "'s <strong>lover</strong>. ");
    } else {
    // friends
        if (persona.rTwo[npc.indexOf(personb)].friendship > 100 && personb.rTwo[npc.indexOf(persona)].friendship > 100) {
            description += (personb.firstName + " is " + persona.firstName + "'s friend. ");
        }
        if (persona.rTwo[npc.indexOf(personb)].romance > 10 && persona.ageInYears() >= 6) {
            description += (upCase(persona.sPronoun())+" and "+personb.firstName+" fool around. ");
        } else if (persona.rTwo[npc.indexOf(personb)].attraction > 100 && persona.ageInYears() >= 6) {
            description += (persona.firstName + " is attracted to " + personb.firstName + ". ");
        }
    }
    // physical relationship
    if (persona.rTwo[npc.indexOf(personb)].coitus > 0) {
        description += ("They have slept together. ");
    }
    return description;
}

function describeCharacter(n) {
    var p = n;
    var d = "";
    var typs = [];
    var typct = [];
    var typd;
    d += (upCase(p.pPronoun()) + " hair is " + p.hair + ". ");
    d += (upCase(p.pPronoun()) + " eyes are " + p.eyes + ". ");
    if (p.beauty >= 9) {
        d+=(upCase(p.sPronoun()) + " is quite beautiful. ");
    } else if (p.beauty >= 7) {
        d+=(upCase(p.sPronoun()) + " is attractive. ");
    } else if (p.beauty <= 2) {
        d+=(upCase(p.sPronoun()) + " is very ugly. ")
    } else if (p.beauty <= 4) {
        d+=(upCase(p.sPronoun()) + " is unattractive. ");
    }
    if (p.pregnant == 1) {
        d+=("She is " + (Math.floor((counter-p.pregnancyStart)/30)) + " months pregnant. ")
    }
    d+= ("<br>Beauty: " + p.beauty + "");
    d+= ("<br>Athletics: " + p.athletics + "");
    d+= ("<br>Intellect: " + p.intellect + "");
    d+= ("<br>Social: " + p.social + "");
    d+= ("<br>Honor: " + p.honor + "");
    d+= ("<br>Gender Pref: " + p.genderPref);
    return d;
}

function allRelationships(char) {
    var des = [];
    var len = liveNPC.length;
    for (var j = 0; j <len; j++) {
        if (char.rTwo[liveNPC[j]] != undefined) {
            if (describeRelationship(char, npc[liveNPC[j]]) != 0 && npc[liveNPC[j]].alive == 1 && (findDiff(char.rTwo[liveNPC[j]].friendship,0) > 500)) {
                des.push((describeRelationship(char, npc[liveNPC[j]])));
            }
        }
    }
    des.sort();
    var dchar = "";
    for (var k=0;k<des.length;k++) {
        dchar += des[k];
        dchar += "<br>";
    }
    return dchar;
}

// BIR BIRTH section

function findRelatives(parent, newb) {
    for (var k=0;k<parent.relatives.length;k++) {
        if (parent.relatives[k] != undefined && npc[k] != undefined) {
            if (parent.relatives[k] == "child") {
                newb.relatives[k] = "sibling";
                npc[k].relatives[newb.oIndex] = "sibling"
            } else if (parent.relatives[k] == "parent") {
                newb.relatives[k] = "grandparent";
                npc[k].relatives[newb.oIndex] = "grandchild"
            } else if (parent.relatives[k] == "sibling") {
                newb.relatives[k] = "parsib";
                npc[k].relatives[newb.oIndex] = "sibchild"
            } else if (parent.relatives[k] == "sibchild") {
                newb.relatives[k] = "cousin";
                npc[k].relatives[newb.oIndex] = "cousin"
            }
        }
    }
}

function removeCharacter(char, meth) {
    let deathage = char.ageInYears();
    char.alive = 0;
    char.deathday = counter;
    var friendHappinessImpact = -1000;
    var relativeHappinessImpact = -1000;
    var livelen = liveNPC.length;
    var finalMessage = (char.fullName() + " was removed from the community")
    if (meth == 'kill') {
        friendHappinessImpact = -10000;
        relativeHappinessImpact = -10000;
        finalMessage = (char.fullName() + " died");
        addHistory((char.fullName() + " <strong>died</strong> at age " + deathage + ". The community mourns."));
        stats.totalDeaths ++;
    }
    for (var i=0;i<livelen;i++) {
        if (char.rTwo[liveNPC[i]] != undefined) {
            if (npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].happiness -= npc[liveNPC[i]].rTwo[char.oIndex].friendship;
            }
            if (char.rTwo[liveNPC[i]].commitment == 1 && npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].rTwo[char.oIndex].commitment = 0;
                npc[liveNPC[i]].happiness += friendHappinessImpact;
            }
            if (npc[liveNPC[i]].relatives[char.oIndex] == 1 && npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].happiness += relativeHappinessImpact;
            }
        }
    }
    liveNPCo = liveNPC.splice(liveNPC.indexOf(char.oIndex),1);
    $("#npc"+char.oIndex).remove();
    console.log(finalMessage);
    reverser = 0;
}

function createCharacter() {
    var g = 0;
    if (randomInt(1,100) <= genderRatio) {g = 1}
    var nam;
    if (g == 1) {nam = pickFrom(boyNames);} else {nam = pickFrom(girlNames);}
    var jk = new Person(nam, pickFrom(surNames), randomAge(), g);
    var c = randomInt(2, 5);
        for (var k=0;k<c;k++) {
            jk.myTypes.push(randomInt(0,(romanticTypes.length-1)));
        }
    for (var l=0;l<regActivities.length;l++) {
        jk.actTwo.push(new actType(regActivities[l]));
    }
    return jk;
}

function addNPC() {
    npc.push(createCharacter());
    npc[npc.length-1].oIndex = npc.length-1;
    // charPanels.push(createCharPanel(npc.length - 1));
    liveNPC.push(npc.length-1);
    locationList[0].residents.push(npc.length-1);
    $("#dashpanel").append(createCharPanel(npc.length-1));
    $('[data-toggle="popover"]').popover();
    reverser = 0;
    console.log("added");
}

function resolveDeaths() {
    for (var i=0;i<liveNPC.length;i++) {
        if (npc[liveNPC[i]].ageInYears() > 75 && randomInt(1, 20 * 365) == 1) {
            console.log("die from old age");
            removeCharacter(npc[liveNPC[i]], 'kill');
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

// SET SETUP game setup section

function makeRelative(n) {
    var jk;
    do {
        jk = pickFrom(npc);
    }
    while (jk == n);
    if (findDiff(jk.ageInYears(), n.ageInYears()) > 15) {
        if (jk.ageInYears() > n.ageInYears()) {
            jk.relatives[npc.indexOf(n)] = "parent";
            n.relatives[npc.indexOf(jk)] = "child";
        } else {
            jk.relatives[npc.indexOf(n)] = "child";
            n.relatives[npc.indexOf(jk)] = "parent";
        }
    } else {
            var rel = pickFrom(["sibling", "cousin"]);
            jk.relatives[npc.indexOf(n)] = rel;
            n.relatives[npc.indexOf(jk)] = rel;
    }
    for (var i=0;i<100;i++) {
        interactWith(jk, n);
    }
}

function popCalc() {
    var pop = liveNPC.length;
    var m = 0;
    var f = 0;
    for (var i=0;i<liveNPC.length;i++) {
        if (npc[liveNPC[i]].gender == 0) {
            f++;
        }
        if (npc[liveNPC[i]].gender == 1) {
            m++;
        }
    };
    return {"pop":pop,"m":m,"f":f};
}

// CON CONTROL section


function pauseGame() {
    if (paused == false) {
        console.log("pausing game");
        paused = true;
    } else {
        console.log("unpausing game");
        paused = false;
    }
    hidePop();
}

function toggleSpeed() {
    if (speedToggle == 0) {
        loopTime = 500;
        speedToggle = 1;
    } else {
        loopTime = 100;
        speedToggle = 0;
    }
}

function calcLoopTime() {
    var secdif = 0;
    if (loopTiming.length > 3) {secdif = ((loopTiming[(loopTiming.length)-1][1].getTime() - loopTiming[(loopTiming.length-2)][1].getTime())/1000)}
    console.log("y:"+thisYear()+";p:"+popCalc().pop+";l="+npc.length+";"+secdif.toFixed(1)+"s; 100 days happens in " + secdif + " seconds");
}

function printStats() {
    //console.log(counter);
    console.log(npc);
    //console.log(locationList);
    //console.log(monumentList);
    //console.log(birthRate);
    console.log(`average birth rate is ${calcBirthRate()}`);
    calcLoopTime();
    localStorage.clear();
}

function displayAboutStats() {
    $("#aboutstats").append((`
    Years Passed: <span class="years"></span>.<span class="counter"></span><br>
    Total Population: <span class="population"></span> (<span class="fpop"></span> F / <span class="mpop"></span> M)<br>
    Total Births: <span id="totalbirths"></span><br>
    Total Deaths: <span id="totaldeaths"></span><br>
    Average Birth Rate: <span id="avgbirthrate"></span> (CBR)<br>
    Average Happiness: <span id="avghappiness"></span><br>
    `))
}

function updateAboutStats() {
    $("#avgbirthrate").html(calcBirthRate().toFixed(2));
    $("#totalbirths").html(stats.totalBirths);
    $("#totaldeaths").html(stats.totalDeaths);
    $("#avghappiness").html(calcAverageHappiness().toFixed(2));
}

function calcAverageHappiness() {
    let hq = 0;
    let len = liveNPC.length;
    for (let i=0;i<len;i++) {
        hq += npc[liveNPC[i]].happinessQuotient();
    }
    return hq/len;
}

function calcBirthRate() {
    let ctr = 0;
    let ctrsum = 0;
    for (let i=0;i<birthRate.length;i++) {
        if (birthRate[i]) {
            ctr++;
            ctrsum += birthRate[i][2];
        }
    }
    return (ctrsum/ctr)
}

function modalFunction(id, type) {
    $("[data-toggle='popover']").popover('hide');
    if (type == 'rel') {
        $("#modaltitle").html(npc[id].fullName());
        $("#modalbody").html(relCharInfoPanel(npc[id]));;
    } else if (type == 'full') {
        $("#modaltitle").html(npc[id].fullName());
        $("#modalbody").html(fullCharInfoPanel(npc[id]));
    } else {
        $("#modalbody").html("testing");
    }
    $('#exampleModal').modal('show');
}

function modalGeneral(title, content) {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html(title);
    $("#modalbody").html(content);
    $('#exampleModal').modal('show');
}

function modalHistory() {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html("The History of the Community");
    var texttext = "";
    for (var i=0;i<textLog.length;i++) {
        texttext += ("Year " + (Math.floor(textLog[i][0]/365)+1) + ", Day " + (textLog[i][0]%365) + ": " + textLog[i][1] + "<br>");
    }
    $("#modalbody").html(texttext);
    $('#exampleModal').modal('show');
}

function saveHistory() {
    var curtime = new Date;
    var texttext = "";
    texttext += ("History begins: " + gameStartTime + "<br>\n");
    texttext += ("History written: " + curtime + "<br><br>\n");
    texttext += "<h3>The History of the Community</h3><br>\n";
    for (var i=0;i<textLog.length;i++) {
        texttext += ("Year " + (Math.floor(textLog[i][0]/365)+1) + ", Day " + (textLog[i][0]%365) + ": " + textLog[i][1] + "<br>\n");
    }
    var savename = ("history-" + curtime.getFullYear() + (curtime.getMonth() + 1) + curtime.getDate() + curtime.getHours() + curtime.getMinutes() + ".html");
    download(texttext, savename);
}

// borrowed functions
function download(content, filename, contentType) {
    if(!contentType) contentType = 'application/octet-stream';
        var a = document.createElement('a');
        var blob = new Blob([content], {'type':contentType});
        a.href = window.URL.createObjectURL(blob);
        a.download = filename;
        a.click();
}

function filterValue(obj, key, value) {
    return obj.find(function(v){ return v[key] === value});
}

function filterIndex(obj, key, value) {
    return obj.findIndex(function(v){ return v[key] === value});
}
// end borrowed functions

function killRandom() {
    var kTarget;
    var acount = liveNPC.length;
    console.log("start k");
    console.log(acount);
    if (acount >= 3) {
        kTarget = pickFrom(liveNPC);
        removeCharacter(npc[kTarget], 'kill');
    }
}

function hidePop() {
    $("[data-toggle='popover']").popover('hide');
    $('.popover').each(function () {
        var tooltip = $(this);
        if (tooltip.attr('style')) {
            tooltip.remove();
          }
      });
}

function checkIndices() {for (var i=0;i<npc.length;i++) if (npc[i] != undefined && npc[i].oIndex != i) {console.log("indices do not match");pauseGame()}}

function hoverInfo() {
    $(document).on("mouseenter", ".npcrelationships", function() {
        var yuh = $(this).attr("data-id");
        $(this).attr("data-content",allRelationships(npc[yuh]));
        $(this).popover('show');
    });
    $(document).on("mouseleave", ".npcrelationships", function() {
        $(this).popover('hide');
    });
    $(document).on("mouseenter", ".npcinteractions", function() {
        $(this).popover('show');
    });
    $(document).on("mouseleave", ".npcinteractions", function() {
        $(this).popover('hide');
    });
    $(document).on("mouseenter", ".npcdescriptions", function() {
        var yue = $(this).attr("data-id");
        $(this).attr("data-content",describeCharacter(npc[yue]));
        $(this).popover('show');
    });
    $(document).on("mouseleave", ".npcdescriptions", function() {
        $(this).popover('hide');
    });
    $(document).on("mouseenter", ".localecard", function() {
        var yue = $(this).attr("data-locid");
        $(this).attr("data-content",localePopover(yue));
        $(this).popover('show');
    });
    $(document).on("mouseleave", ".localecard", function() {
        $(this).popover('hide');
    });
}