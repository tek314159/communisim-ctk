// CommuniSim working.js

function changeLocation() {
    var chiu = pickFrom(npc);
    var tarloc;
    do {tarloc = pickFrom(locationList)} while (locationList.indexOf(tarloc) == chiu.location);
    chiu.changeLocation(locationList.indexOf(tarloc));
    console.log(chiu.firstName + " is moving ");
    // console.log(locationList);
    //console.log(pickFrom(npc).doActivity());
    //console.log(pickFrom(npc).chooseActivity());
}

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
        /* {
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
        }, */
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
            for (var j=0;j<liveNPC.length;j++) {
                lvrcount += npc[liveNPC[j]].isAttached();
            }
            if (lvrcount > 2) {
                do {
                    choice = npc[pickFrom(liveNPC)];
                }
                while (choice.isAttached() == 0);
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
        "odds":150,
        "checkOccurrance": function() {
            if (popCalc().pop > popCap && randomInt(1,(this.odds - popCalc().pop)) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            mire = npc[pickFrom(liveNPC)];
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
            mire = npc[pickFrom(liveNPC)];
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
            subject = npc[pickFrom(liveNPC)];
            do {
                object = npc[pickFrom(liveNPC)];
            } while (subject == object);
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
            subject = npc[pickFrom(liveNPC)];
            do {
                object = npc[pickFrom(liveNPC)];
            } while (subject == object);
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

// ACT ACTIVITIES section

var regActivities = [
    {
        "title":"read",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is reading.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.intellect, 9);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"watch TV",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is watching TV.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.intellect, 2);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"paint",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is painting.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.intellect, 5);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"instagram",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is social networking.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.intellect, 3);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"walk",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is taking a walk.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.athletics, 3);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"run",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is jogging.")},
        "enjoyFunction": function(char) {
            var hch = 3 - findDiff(char.athletics, 7);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"chess",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {var opponent; do {opponent = pickFrom(liveNPC);} while (opponent == char.oIndex); return (char.firstName + " is playing chess with " + npc[opponent].firstName + ".")},
        "enjoyFunction": function(char) {
            var hch = 2 - findDiff(char.intellect, 9);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"project",
        "active":1,
        "reqFunction": function(char) {if (randomInt(1,10) == 1) {return 1} else {return 0}},
        "flavorText": function(char) {return (char.firstName + " is working on the project.")},
        "enjoyFunction": function(char) {
            projectMaterial += 1;
            var hch = 3 - findDiff(char.athletics, 7);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    },
    {
        "title":"cinema",
        "active":1,
        "reqFunction": function(char) {return 1},
        "flavorText": function(char) {return (char.firstName + " is watching a film.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.intellect, 6);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            return this.flavorText(char);
        }
    }
]

// LOC LOCATION section

var locationList = [
    {
        "title":"spawning room",
        "residents": []
    },
    {
        "title":"location 2",
        "residents": []
    }
]

// VAR VARIABLE section

function actType(n) {
    this.aName = n.title;
    this.count = 0;
    this.happyChange = 0;
    this.pleasureIndex = function(char) {
        return Math.floor((this.happyChange / this.count * 100));
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
    this.changeHappiness = function(val) {this.happiness += val};
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
    this.chooseActivity = function() {
        var ac = [];
        for (var i=0;i<this.actTwo.length;i++) {
            //var u = 0;
            if (this.actTwo[i] != undefined && this.actTwo[i].pleasureIndex() > 0) {
                ac[i] = Math.floor(this.actTwo[i].pleasureIndex());
            } else {
                ac[i] = 1;
            }
        }
        var ch;
        do {
            ch = weightedChooser(regActivities, ac);
        } while (ch.reqFunction(this) == 0)
        //console.log(ch);
        return ch;
    }
    this.doActivity = function(activity) {
        var m = activity;
        /* do {
            m = pickFrom(regActivities);
        } while (m.active != 1 || m.reqFunction() != 1) */
        return m.enjoyFunction(this);;
    }
    this.iMemory = [];
    this.aMemory = [];
    this.relatives = [];
    this.pregnant = 0;
    this.pregnancyStart;
    this.pregnancyParent;
    this.giveBirth = function() {
        if (this.pregnant == 1 && (counter - this.pregnancyStart) > 270 && randomInt(1, 20) == 1) {
            addNPC();
            var newb = npc[npc.length-1];
            var mother = this;
            var char = this;
            var fnum = (char.pregnancyParent);
            var father = npc[fnum];
            newb.birthday = counter;
            newb.ageInDays = 0;
            newb.beauty = randomInt(Math.min(father.beauty, mother.beauty),Math.max(father.beauty, mother.beauty));
            newb.hair = pickFrom([father.hair, mother.hair]);
            newb.eyes = pickFrom([father.eyes, mother.eyes]);
            if (father.isAttached() > 0 && father.rTwo[mother.oIndex].commitment == 1) {
                newb.surName = father.surName;
            } else {newb.surName = mother.surName}
            findRelatives(mother, newb);
            findRelatives(father, newb);
            charPanels[newb.oIndex] = createCharPanel(newb.oIndex);
            $("#npcname" + newb.oIndex).text(newb.fullName());
            $("#npcbeauty" + newb.oIndex).text(newb.beauty);
            $("#npcdesc" + newb.oIndex).attr("data-content",describeCharacter(newb));
            newb.relatives[npc.indexOf(char)] = "parent";
            mother.relatives[npc.length-1] = "child";
            newb.relatives[npc.indexOf(father)] = "parent";
            father.relatives[npc.length-1] = "child";
            textLog.push([counter, (mother.firstName + " (age " + mother.ageInYears() + ") <strong>gave birth</strong> to " + newb.firstName + ".")]);
            mother.pregnant = 0;
            mother.pregnancyStart = undefined;
            mother.pregnancyParent = undefined;
            for (var l=0;l<10;l++) {
                interactWith(mother, newb);
                interactWith(father, newb);
            }
        }
    }
    this.coitusCounter = 0;
    this.isAttached = function() {
        var co = 0;
        for (var i=0;i<this.rTwo.length;i++) {
            if (this.rTwo[i] != undefined) {co += this.rTwo[i].commitment;}
        }
        return co;
    }
    this.location = 0;
    this.changeLocation = function(loc) {
        var newloc = locationList[loc];
        //console.log(locationList[this.location].residents);
        locationList[this.location].residents.splice(locationList[this.location].residents.indexOf(this.oIndex),1);
        newloc.residents.push(this.oIndex);
        this.location = locationList.indexOf(newloc);
        //console.log(this.location);
    }
};

// INT INTERACTION section

var kissReq = 200; // min attraction to try to kiss
var kissBackReq = 50; // min attraction to return kiss
var socialNormConstant = 3000; // lower number makes it easier to break social norms
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

function meetPeopleTwo() {
    for (var i=0;i<liveNPC.length;i++) {
        var iter = i;
        var p = [];
        for (var j=0;j<liveNPC.length;j++) {
                var r = npc[liveNPC[iter]].rTwo[liveNPC[j]];
                var adder = 0;
                if (r != undefined) {
                    if (r.friendship > 0) {adder += Math.floor(rootRead(Math.abs(r.friendship)))} else {adder -= Math.floor(rootRead(r.friendship))};
                    if (r.attraction > 0) {adder += Math.floor(rootRead(Math.abs(r.attraction)))} else {adder -= Math.floor(rootRead(r.attraction))};
                    if (r.commitment == 1) {adder += adder} else {adder -= findDiff(npc[i].ageInYears(),npc[j].ageInYears());}
                    if (npc[liveNPC[iter]].isAttached() == 0 && npc[liveNPC[iter]].relatives[j] != undefined) {adder = Math.floor(adder/2);}
                } 
                if (adder > 0) {
                    p.push(adder);
                }else {
                    p.push(1);
                }
            
        }
        //console.log(p);
        var u;
        do {
            u = weightedChooser(liveNPC, p);
            //console.log(u);
        } while (u == liveNPC[iter])
        // console.log(u + " is u. iter is " + iter);
        // console.log(liveNPC[iter] + " is livenpciter.");
        //console.log("u is");
        //console.log(u);
        var uip = interactWith(npc[liveNPC[iter]], npc[u]);
        if (npc[liveNPC[iter]].iMemory.length > 99) {npc[liveNPC[iter]].iMemory = npc[liveNPC[iter]].iMemory.slice(1)}
        npc[liveNPC[iter]].iMemory.push([counter,u.oIndex,uip]);
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

var gameStartTime;
function gameSetup() {
    gameStartTime = new Date();
    $("#startTime").text(gameStartTime);
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
    for (var i=0;i<liveNPC.length;i++) {
        $("#dashpanel").append("<hr>");
        // console.log(liveNPC[i]);
        $("#dashpanel").append(createCharPanel(liveNPC[i]));
    }
    $("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
}

function masterLoop() { // this is a replacement for dayEnd
    var len = liveNPC.length;
    for (var i=0;i<len;i++) {
        var cur = npc[liveNPC[i]];
        cur.ageInDays++;
        $("#npcactivity" + liveNPC[i]).html(cur.doActivity(cur.chooseActivity()));
        if (cur.pregnant == 1) {cur.giveBirth()}; // replaces resolvePregnancies
        // below replaces evolveRelationships
        for (var j=0;j<liveNPC.length;j++) {
            if (cur.rTwo[liveNPC[j]] != undefined) {
                if (cur.rTwo[liveNPC[j]].friendship > 10) {cur.rTwo[liveNPC[j]].friendship --};
                if (cur.rTwo[liveNPC[j]].attraction > 10 && (counter%100==0)) {cur.rTwo[liveNPC[j]].attraction --};
            }
        }
    }
    counter++;
    meetPeopleTwo();
    resolveDeaths();
    resolveEvents();
}

function gameLoop() {
    if (counter%100 == 0) {loopTiming.push([counter, new Date]);};
    if (counter%1000 == 0) {calcLoopTime();};
    // checkIndices();
    masterLoop();
    metaLoop();
    petLoop();
    updateDash();
}

var textLogPointer = 0;
function updateDash() {
    var len = liveNPC.length;
    for (var i=0;i<len;i++) {
        $("#npc" + liveNPC[i]).attr("title",npc[liveNPC[i]].firstName);
        $("#npc" + liveNPC[i]).attr("data-age",npc[liveNPC[i]].ageInYears());
        $("#npchappy" + liveNPC[i]).html((npc[liveNPC[i]].happiness/counter).toFixed(2));
        $("#npcyears" + liveNPC[i]).html(npc[liveNPC[i]].ageInYears());
        $("#npcrel" + liveNPC[i]).attr("data-content", allRelationships(npc[liveNPC[i]]));
    }
    $("#years").text(Math.floor(counter/365) + 1);
    $("#counter").text(counter%365);
    $("#population").text(popCalc().pop);
    $("#fpop").text(popCalc().f);
    $("#mpop").text(popCalc().m);
    //$("#coicou").text(coiCou);
    var tPadder = 0;
    for (var m=0;m<(textLog.length-textLogPointer);m++) {
        if (textLog[textLogPointer + m][0] == counter) {
            $("#textlog").prepend(textLogPrefix() + textLog[textLogPointer + m][1] + "<br>");
            // console.log("moving pointer");
            tPadder ++;
        }
    }
    textLogPointer += tPadder;
    if (counter == 1) {sortDash();reverser=0;};
}

$(document).ready(gameStart());

$("#sortdash2").click(function() {sortDash("id");});
$("#sortdash3").click(function() {sortDash("age");});