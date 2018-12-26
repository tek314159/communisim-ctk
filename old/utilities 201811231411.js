// CommuniSim utilities.js

$("#petdash").hide();
$("#devdash").hide();

var hairColors = ["brown","black","chestnut","blonde","red","strawberry blonde","golden","dirty blond","auburn","brunette","dark brown","light blonde","ginger","Titian"]
var eyeColors = ["brown","blue","grey","green","hazel","dark","amber"]

var tenArray = [1,2,3,4,5,6,7,8,9,10]
var tenWeightScale = [1,1,2,2,5,6,7,8,9,1];
var gayWeightScale = [1,7,4,2,3,3,8,10,30,1];

var birthRate = [];

function textLogPrefix() {
    var pref = (`Year ${thisYear()}, day ${parseYear(counter).day}, `);
    return pref;
}

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

var incRestrict = 15;
var normStandard = 2;
var ageAwake = 15;
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

var coiCou = 0;
var paused = false;
var minAge = 13;
var maxAge = 19;
var characterCount = 12;
var loopTime = 500;
var npc = [];
var liveNPC = [];
var counter = 0;
var puberty = 12;
var menopause = 45;
var genderRatio = 50; // percent male
var charPanels = [];
var textLog = [];
var postEventQueue = [];

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
    d+= ("<br>Honor: " + p.honor + "<br>");
    d+= ("Gender Pref: " + p.genderPref + "<br>");
    // d+= ("Coitus Counter: " + p.coitusCounter + "<br>")
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

function createCharPanel(id) {
    var panel = (
        "<div class='card charcard mt-3' id='npc"+id+"'><div class='row m-1'><div class='col'>Name: <a href='javascript:;' data-npcid='"+id+"' onclick='modalFunction(" + id + ", "+'"full"' +")' class='charname'><span id='npcname" + id + "'>" + npc[id].fullName() + "<strong><a href='javascript:;'></strong></span></a> (<span id='npcgender" + id + "'>" + upCase(npc[id].genderFunc()) + "</span>)<br>" +
        "Age: <span id='npcyears" + id + "'></span><br>" +
        "Happiness: <span id='npchappy" +id+"'></span></div>" +
        "<div class='col text-right'>" + 
        '<a href="javascript:;" class="npcdescriptions card-link" data-id="' + id + '" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Description" data-content="working..." id="npcdesc' + id + '">Description</a><br>' + 
        '<a href="javascript:;" class="npcrelationships card-link" data-id="' + id + '" data-toggle="popover" data-container="body" data-offset="5" data-html="true" title="Relationships" data-content="No friends yet." id="npcrel' + id + '" onclick="modalFunction(' + id + ', ' + "'rel'" + ')" >Relationships</a><br>' +
        '<a href="javascript:;" class="npcinteractions card-link" data-toggle="popover" data-container="body" data-id="' + id + '" data-offset="5" data-html="true" title="Interactions" data-content="Nothing to report." id="npcinteract' + id + '">Interactions</a>' +
        "</div></div>" + 
        "<div class='row m-1'><div class='col'>"+
        "Location: <span id='npclocation"+id+"'>" + locationList[npc[id].location].title + "</span><br>"+
        "<span id='npcactivity"+id+"'></span>"+
        "<br></div></div>" + "</div>"
    )
    return panel;
}

function fullCharInfoPanel(char) {
    var g;
    if (char.gender == 0) {g = "F"} else {g = "M"}
    var d = "";
    var typs = [];
    var typct = [];
    var typd;
    for (var i=0;i<char.myTypes.length;i++) {
        if (typs.indexOf(char.myTypes[i]) == -1) {
            typs.push(char.myTypes[i]);
        } else {
            if (typct[typs.indexOf(char.myTypes[i])]!=undefined) {
                typct[typs.indexOf(char.myTypes[i])] ++;
            } else {typct[typs.indexOf(char.myTypes[i])] = 2;}
        }
    }
    for (var k=0;k<typs.length;k++) {
        if (typct[k]!=undefined) {
            typd = typct[k];
        } else {
            typd = "";
        }
        d += ("<li>" + upCase(typs[k].title) + " " + typd + "</li>");
    }
    /* var r = "";
    for (var l=0;l<char.relatives.length;l++) {
        if (char.relatives[l] != undefined) {
            r += ("<li>" + upCase(relaParser(char, npc[l])) + ": " + npc[l].firstName + "</li>")
        }
    } */
    var ra = "";
    var raray = [];
    var lv = "";
    for (var s=0;s<liveNPC.length;s++) {
        if (char.rTwo[liveNPC[s]] != undefined) {
            if (char.rTwo[liveNPC[s]].commitment > 0) {
                lv = ("Lover: " + npc[liveNPC[s]].firstName + "<br>");
            }
            raray.push(char.rTwo[liveNPC[s]]);
        }
    }
    raray.sort((a,b) => (a.rName > b.rName) ? 1 : ((b.rName > a.rName) ? -1 : 0)); 
    for (var h=0;h<raray.length;h++) {
        var rela = "";
        var lvr = "";
        if (raray[h].commitment >= 1) {lvr = " (<strong>lover</strong>)"}
        if (char.relatives[raray[h].originalIndex] != undefined) {rela = (" (<strong>" + relaParser(char, npc[raray[h].originalIndex]) + "</strong>)")};
        ra += ("<tr><th scope='row'>" + (h+1) + "</th><td>" + raray[h].rName + lvr + rela + "</td><td>" + upCase(npc[raray[h].originalIndex].genderFunc()) +"</td><td>" + npc[raray[h].originalIndex].ageInYears() + "</td><td>" + raray[h].friendship + "</td><td>" + raray[h].attraction + "</td><td>" + raray[h].romance + "</td><td>" + raray[h].interactions + "</td><td>" + raray[h].coitus + "</td></tr>")
    }
    var aa = "";
    var aaray = [];
    for (var o=0;o<char.actTwo.length;o++) {
        if (char.actTwo[o] != undefined) {
            aaray.push(char.actTwo[o]);
        }
    }
    aaray.sort((a,b) => (a.count < b.count) ? 1 : ((b.count < a.count) ? -1 : 0)); 
    for (var q=0;q<3;q++) {
        aa += ("<tr><td>" + upCase(aaray[q].aName) + "</td><td>" + aaray[q].count + "</td></tr>");
    }
    var pnl = (
        "<div class='row'><div class='col'>" +
        "Name: " + char.fullName() + " (" + g + ")<br>" +
        "Age: " + char.ageInYears() + "<br>" +
        "Happiness: " + char.happiness + "<br>" +
        "Beauty: " + char.beauty + "<br>" +
        "Eyes: " + char.eyes + "<br>" +
        "Hair: " + char.hair + "<br>" +
        "</div><div class='col'>" +
        "Athletics: " + char.athletics + "<br>" +
        "Intellect: " + char.intellect + "<br>" +
        "Social: " + char.social + "<br>" +
        "Honor: " + char.honor + "<br>" +
        "Focus: " + char.focus + "<br>" +
        "</div><div class='col'>" +
        "Gender Pref: " + char.genderPref + "<br>" +
        "Coitus Counter: " + char.coitusCounter + "<br>" +
        "</div></div><hr>" + // close out the row
        "<div class='row'><div class='col'>" +
        "Types:<br><ul>" +
        d + "</ul>" +
        lv + "<br>" +
        "</div><div class='col'>" +
        "<p>Favorite Activities:</p><table class='table table-sm'>" +
        aa + "</table>" +
        "</div></div>" + // close out the row
        "<div class='row'><div class='col'>" +
        '<table class="table table-sm"><thead><tr><th scope="col"></th><td>Relationships</td><td></td><td>Age</td><td>Friendship</td><td>Attraction</td><td>Romance</td><td>Interactions</td><td>Coitus</td> </tr> </thead><tbody>' +
        ra + "</tbody></table>" +
        "</div></div>"
    )
    return pnl;
}

function relCharInfoPanel(char) {
    var g;
    if (char.gender == 0) {g = "F"} else {g = "M"}
    var d = "";
    var typs = [];
    var typct = [];
    var typd;
    for (var i=0;i<char.myTypes.length;i++) {
        if (typs.indexOf(char.myTypes[i]) == -1) {
            typs.push(char.myTypes[i]);
        } else {
            if (typct[typs.indexOf(char.myTypes[i])]!=undefined) {
                typct[typs.indexOf(char.myTypes[i])] ++;
            } else {typct[typs.indexOf(char.myTypes[i])] = 2;}
        }
    }
    for (var k=0;k<typs.length;k++) {
        if (typct[k]!=undefined) {
            typd = typct[k];
        } else {
            typd = "";
        }
        d += ("<li>" + upCase(typs[k].title) + " " + typd + "</li>");
    }
    /* var r = "";
    for (var l=0;l<char.relatives.length;l++) {
        if (char.relatives[l] != undefined) {
            r += ("<li>" + upCase(relaParser(char, npc[l])) + ": " + npc[l].firstName + "</li>")
        }
    } */
    var ra = "";
    var raray = [];
    var lv = "";
    for (var s=0;s<liveNPC.length;s++) {
        if (char.rTwo[liveNPC[s]] != undefined) {
            if (char.rTwo[liveNPC[s]].commitment > 0) {
                lv = ("Lover: " + npc[liveNPC[s]].firstName + "<br>");
            }
            raray.push(char.rTwo[liveNPC[s]]);
        }
    }
    raray.sort((a,b) => (a.rName > b.rName) ? 1 : ((b.rName > a.rName) ? -1 : 0)); 
    for (var h=0;h<raray.length;h++) {
        var rela = "";
        var lvr = "";
        if (raray[h].commitment >= 1) {lvr = " (<strong>lover</strong>)"}
        if (char.relatives[raray[h].originalIndex] != undefined) {rela = (" (<strong>" + relaParser(char, npc[raray[h].originalIndex]) + "</strong>)")};
        ra += ("<tr><th scope='row'>" + (h+1) + "</th><td>" + raray[h].rName + lvr + rela + "</td><td>" + upCase(npc[raray[h].originalIndex].genderFunc()) +"</td><td>" + npc[raray[h].originalIndex].ageInYears() + "</td><td>" + raray[h].friendship + "</td><td>" + raray[h].attraction + "</td><td>" + raray[h].romance + "</td><td>" + raray[h].interactions + "</td><td>" + raray[h].coitus + "</td></tr>")
    }
    var pnl = (
        "<div class='row'><div class='col'>" +
        "Name: " + char.fullName() + " (" + g + ")<br>" +
        "Age: " + char.ageInYears() + "<br>" +
        "Happiness: " + char.happiness + "<br>" +
        "Beauty: " + char.beauty + "<br>" +
        "</div><div class='col'>" +
        "Athletics: " + char.athletics + "<br>" +
        "Intellect: " + char.intellect + "<br>" +
        "Social: " + char.social + "<br>" +
        "Honor: " + char.honor + "<br>" +
        "</div><div class='col'>" +
        "Gender Pref: " + char.genderPref + "<br>" +
        "Coitus Counter: " + char.coitusCounter + "<br>" +
        "</div></div>" + // close out the row
        "<div class='row mt-3'><div class='col'>" +
        '<table class="table table-sm"><thead><tr><th scope="col"></th><td>Relationships</td><td></td><td>Age</td><td>Friendship</td><td>Attraction</td><td>Romance</td><td>Interactions</td><td>Coitus</td> </tr> </thead><tbody>' +
        ra + "</tbody></table>" +
        "</div></div>"
    )
    return pnl;
}

function addHistory(entry) {
    textLog.push([counter,entry]);
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

function killCharacter(char) {
    //console.log("killing" + char.firstName);
    addHistory((char.fullName() + " died at age " + char.ageInYears() + ". The community mourns."));
    charPanels[char.oIndex] = undefined;
    var char2=char;
    char.alive = 0;
    char.deathday = counter;
    var livelen = liveNPC.length;
    for (var i=0;i<livelen;i++) {
        if (char.rTwo[liveNPC[i]] != undefined) {
            if (npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].happiness -= npc[liveNPC[i]].rTwo[char.oIndex].friendship;
                //console.log(npc[i].firstName + " mourns " + npc[i].rTwo[npc.indexOf(char)].friendship);
            }
            if (char.rTwo[liveNPC[i]].commitment == 1 && npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].rTwo[char.oIndex].commitment = 0;
                npc[liveNPC[i]].rTwo[char.oIndex].happiness -= 10000; // why isn't this making an error?
                npc[liveNPC[i]].happiness -= 10000;
                //console.log("breaking up the dead");
            }
            if (npc[liveNPC[i]].relatives[char.oIndex] == 1 && npc[liveNPC[i]].rTwo[char.oIndex] != undefined) {
                npc[liveNPC[i]].happiness -= 1000;
            }
        }
    }
    liveNPCo = liveNPC.splice(liveNPC.indexOf(char.oIndex),1);
    // $("#npc"+char.oIndex).next().remove();
    $("#npc"+char.oIndex).remove();
    console.log(char.fullName() + " died");
    //npc[char.oIndex] = undefined;
    reverser = 0;
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
    liveNPC.push(npc.length-1);
    locationList[0].residents.push(npc.length-1);
    $("#dashpanel").append(charPanels[charPanels.length-1]);
    //$("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
    reverser = 0;
    console.log("added");
}

function resolveDeaths() {
    for (var i=0;i<liveNPC.length;i++) {
        if (npc[liveNPC[i]].ageInYears() > 75 && randomInt(1, 20 * 365) == 1) {
            killCharacter(npc[liveNPC[i]]);
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
        paused = true;
    } else {
        paused = false;
    }
    hidePop();
}

var speedToggle = 0;
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
    console.log(counter);
    console.log(npc);
    console.log(locationList);
    console.log(monumentList);
    calcLoopTime();
}

var reverser = 0;
function sortDash(method) {
    var $divs = $("div.charcard").slice(0);
    var mod = 1;
    if (reverser == 1) {
        mod = mod * -1;
        reverser = 0;
    } else {reverser = 1}
    $divs.sort(function(a,b){
        if ($(a).attr("title")<$(b).attr("title")) {return -mod};
        if ($(a).attr("title")>$(b).attr("title")) {return mod};
        return 0;
    });
    if (method=="id") {
        $divs.sort(function(a,b){
        if ($(a).attr("id")<$(b).attr("id")) {return -mod};
        if ($(a).attr("id")>$(b).attr("id")) {return mod};
        return 0;
        });
    }
    if (method=="age") {
        $divs.sort(function(a,b){
        if (parseInt($(a).attr("data-age"))<parseInt($(b).attr("data-age"))) {return -mod};
        if (parseInt($(a).attr("data-age"))>parseInt($(b).attr("data-age"))) {return mod};
        return 0;
        });
    }
    $("#dashpanel").html("");
    for (var i=0;i<$divs.length;i++) {
        //$("#dashpanel").append("<hr>");
        $("#dashpanel").append($divs[i]);
    }
    //$("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
}

function modalFunction(id, type) {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html(npc[id].fullName());
    if (type == 'rel') {
        $("#modalbody").html(relCharInfoPanel(npc[id]));;
    } else if (type == 'full') {
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
    /* uriContent = "data:application/octet-stream," + encodeURIComponent(texttext);
    newWindow = window.open(uriContent, 'neuesDokument'); */
    download(texttext, savename);
}

function download(content, filename, contentType)
{
    if(!contentType) contentType = 'application/octet-stream';
        var a = document.createElement('a');
        var blob = new Blob([content], {'type':contentType});
        a.href = window.URL.createObjectURL(blob);
        a.download = filename;
        a.click();
}

function killRandom() {
    var kTarget;
    var acount = liveNPC.length;
    console.log("start k");
    console.log(acount);
    if (acount >= 3) {
        kTarget = pickFrom(liveNPC);
        killCharacter(npc[kTarget]);
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

function checkIndices() {for (var i=0;i<npc.length;i++) if (npc[i].oIndex != i) {console.log("indices do not match")}}
var loopTiming = []


function hoverInfo() {
    /* $("#testbutton").hover(function() {
        $("#temptext").html("npcintell");
    }, function() {
        $("#temptext").html("");
    }); */
    $(document).on("mouseenter", ".npcrelationships", function() {
        var yuh = $(this).attr("data-id");
        $(this).attr("data-content",allRelationships(npc[yuh]));
        $(this).popover('show');
    });
    $(document).on("mouseleave", ".npcrelationships", function() {
        $(this).popover('hide');
    });
    $(document).on("mouseenter", ".npcinteractions", function() {
        //var yue = $(this).attr("data-id");
        //$(this).attr("data-content",allRelationships(npc[yue]));
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
}

// NAV NAVBAR functions

function navTest(para) {
    $(".nav-item").removeClass("active");
    $(".gamepage").hide();
    if (para == 'about') {
        $("#navabout").addClass("active");
        $("#aboutpage").show();
    }
    if (para == 'home') {
        $("#navhome").addClass("active");
        $("#mainpage").show();
    }
    if (para == 'dis') {
        $("#navdiscovery").addClass("active");
        $("#discoverypage").show();
    }
}

function setupGamepages() {
    $("#loadingtemp").hide();
    $("main").append(mainPanel());
    $("main").append(aboutPanel());
    $("#aboutpage").hide();
}