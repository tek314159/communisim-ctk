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
    saveGame();
}

function testButton1() {lfSaveGame();}
function testButton2() {lfRestoreGame()}
function testButton3() {}

function dLc() {
    $("#playerbuttons").append(createDevDash());
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
                addHistory("<strong>taboo porn</strong> became popular.");
                postEventQueue.push([counter+365,function(){incRestrict=3;addHistory(("<strong>taboo porn</strong> is no longer popular."))}, this.title])
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
    // $("#devdash").show();
    // placeholder function
    console.log("coming not any time soon");
}

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
                            lover = npc[k].fullName();
                        }
                    }
                }
                addHistory((choice.fullName() + " and " + lover + " <strong>broke up.</strong>"));
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
            addHistory(("the drinking water took on a <strong>strange flavor</strong>."));
            postEventQueue.push([counter+90,function(){socialNormConstant = orisoc;kissBackReq = orikbr;addHistory(("<strong>water</strong> has returned to normal."))},this.title])
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
            addHistory(("the community welcomed " + stranger.fullName() + ", a <strong>mysterious stranger</strong>, into their midst."));
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"thanos",
        "active":1,
        "description":"malthusian dynamics at work",
        "odds": popCap * 2,
        "checkOccurrance": function() {
            if (popCalc().pop > (popCap+10) && randomInt(1,(this.odds - popCalc().pop)) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            mire = npc[pickFrom(liveNPC)];
            addHistory(((mire.fullName() + " died of <strong>food shortage</strong> brought on by an unsustainable population.")));
            removeCharacter(mire, 'kill');
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"emigration",
        "active":0,
        "description":"a community member departs",
        "odds":5,
        "checkOccurrance": function() {
            var eligibleCount = 0;
            for (let i=0;i<liveNPC.length;i++) {
                if (npc[liveNPC[i]].ageInYears() >= migrateMinAge) {
                    eligibleCount ++;
                }
            }
            if (popCalc().pop > (popCap-5) && randomInt(1,this.odds) == 1 && eligibleCount > 0) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire = npc[pickFrom(liveNPC)];
            var len = liveNPC.length;
            for (let i=0;i<len;i++) {
                if (npc[liveNPC[i]].ageInYears() >= migrateMinAge && npc[liveNPC[i]].happinessQuotient() < mire.happinessQuotient()) {
                    mire = npc[liveNPC[i]];
                }
            }
            var destination = pickFrom(localeList);
            console.log(mire.happinessQuotient());
            if (mire) {
                addHistory(`${mire.fullName()} <strong>left the community</strong> to move to ${destination.name}.`);
                destination.population ++;
                removeCharacter(mire);
            }
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"immigration",
        "active":0,
        "description":"gain a community member",
        "odds":5,
        "checkOccurrance": function() {
            if (popCalc().pop > (popCap-10) && randomInt(1,this.odds) == 1 && eligibleCount > 0) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire = npc[pickFrom(liveNPC)];
            var len = liveNPC.length;
            for (let i=0;i<len;i++) {
                if (npc[liveNPC[i]].ageInYears() >= migrateMinAge && npc[liveNPC[i]].happinessQuotient() < mire.happinessQuotient()) {
                    mire = npc[liveNPC[i]];
                }
            }
            var destination = pickFrom(localeList);
            console.log(mire.happinessQuotient());
            if (mire) {
                addHistory(`${mire.fullName()} <strong>left the community</strong> to move to ${destination.name}.`);
                destination.population ++;
                removeCharacter(mire, 'kill');
            }
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"pet adoption",
        "active":1,
        "description":"pet meta game begins",
        "odds":10*365, // was 10*365; set to 2 for testing
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
            addHistory(("the community adopted a <strong>pet</strong>."));
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
            addHistory(((mire.fullName() + " had a <strong>tragic accident</strong>.")));
            removeCharacter(mire, 'kill');
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
            subject.rTwo[object.oIndex].attraction += 15000;
            subject.rTwo[object.oIndex].romance += 50;
            object.rTwo[subject.oIndex].attraction += 15000;
            object.rTwo[subject.oIndex].romance += 50;
            addHistory(((subject.fullName() + " had a <strong>remarkable day</strong> with " + object.firstName + ".")));
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
            subject.rTwo[object.oIndex].friendship -= 15000;
            subject.rTwo[object.oIndex].romance -= 50;
            object.rTwo[subject.oIndex].friendship -= 15000;
            object.rTwo[subject.oIndex].romance -= 50;
            addHistory(((subject.fullName() + " had a <strong>fight</strong> with " + object.fullName() + ".")));
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
        "title":"explore",
        "active":0,
        "reqFunction": function(char) {if (this.active == 1 && char.ageInYears() > 12) {return 1} else {return 0}},
        "flavorText": function(char) {return (char.firstName + " is exploring the world.")},
        "enjoyFunction": function(char) {
            var hch = 5 - findDiff(char.athletics, 8);
            char.happiness += hch;
            char.actTwo[regActivities.indexOf(this)].count ++;
            char.actTwo[regActivities.indexOf(this)].happyChange += hch;
            disPoints ++;
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
        "flavorText": function(char) {var opponent; do {opponent = pickFrom(liveNPC);} while (opponent == char.oIndex); interactWith(char, npc[opponent]); return (char.firstName + " is playing chess with " + npc[opponent].firstName + ".")},
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
        "reqFunction": function(char) {if (/* char.ageInYears() > 15 &&  */randomInt(1,1) == 1) {return 1} else {return 0}}, // while testing metagame, setting chances to 1:1 (normally 1:10)
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
        "title":"Home",
        "residents": []
    },
    {
        "title":"Location 2",
        "residents": []
    }
]

// VAR VARIABLE section

function actType(n) {
    this.aName = n.title;
    this.count = 0;
    this.happyChange = 0;
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
    this.happinessQuotient = function() {return (this.happiness/this.ageInDays)}
    this.changeHappiness = function(val) {this.happiness += val};
    this.genderFunc = function() {
        if (this.gender == 0) {return "f"} else {return "m"};
    }
    this.genderPref = weightedChooser(tenArray, gayWeightScale);; // 10 is full hetero; 1 is full homo
    this.beauty = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.focus = randomInt(1,10);
    this.honor = weightedChooser(tenArray, tenWeightScale);
    this.myTypes = [];
    this.rTwo = [];
    this.actTwo = [];
    this.pleasureIndex = function(acttype) {
        return Math.floor(((acttype.happyChange / acttype.count) * 100));
    }
    this.chooseActivity = function() {
        var ac = [];
        for (var i=0;i<this.actTwo.length;i++) {
            if (this.actTwo[i] != undefined) {
                if (this.pleasureIndex(this.actTwo[i]) != undefined && this.pleasureIndex(this.actTwo[i]) > 0) {
                    ac[i] = Math.floor(this.pleasureIndex(this.actTwo[i]));
                } else {ac[i] = 1;}
            } else {
                ac[i] = 1;
            }
        }
        var ch;
        do {
            ch = weightedChooser(regActivities, ac);
        } while (ch.reqFunction(this) == 0)
        return ch;
    }
    this.doActivity = function(activity) {
        var m = activity;
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
            stats.totalBirths ++;
            if (birthRate[thisYear()] != undefined) {
                birthRate[thisYear()][0] ++
            } else {birthRate[thisYear()] = [1,0,0]}
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
            // charPanels[newb.oIndex] = createCharPanel(newb.oIndex);
            $("#npcname" + newb.oIndex).text(newb.fullName());
            $("#npcbeauty" + newb.oIndex).text(newb.beauty);
            $("#npcdesc" + newb.oIndex).attr("data-content",describeCharacter(newb));
            newb.relatives[char.oIndex] = "parent";
            mother.relatives[npc.length-1] = "child";
            newb.relatives[father.oIndex] = "parent";
            father.relatives[npc.length-1] = "child";
            addHistory((mother.fullName() + " (age " + mother.ageInYears() + ") <strong>gave birth</strong> to " + newb.fullName() + "."));
            // console.log("adding birth to textlog");
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
        $("#npclocation" + this.oIndex).html(locationList[this.location].title);
        //console.log(this.location);
    }
};

// INT INTERACTION section

function interactWith(persona, personb) {
    if (persona.rTwo[personb.oIndex] == undefined) {
        persona.rTwo[personb.oIndex] = new rType(personb.oIndex);
        personb.rTwo[persona.oIndex] = new rType(persona.oIndex);
    }
    if (persona.alive == 0 || personb.alive == 0) {return 0}

    pleasure = randomInt(5, 15) - findDiff(persona.social, personb.social) - findDiff(persona.intellect, personb.intellect) - findDiff(persona.athletics, personb.athletics);

    // adjust each person's relationship level according to the pleasure quotient
    persona.rTwo[personb.oIndex].friendship += pleasure;
    persona.rTwo[personb.oIndex].interactions ++;

    personb.rTwo[persona.oIndex].friendship += pleasure;
    personb.rTwo[persona.oIndex].interactions ++;

    var aPleasure = 0;
    // adjust for physical attractiveness
    if (persona.beauty > personb.beauty) {
        personb.rTwo[persona.oIndex].friendship += persona.beauty - personb.beauty;
    } else {
        persona.rTwo[personb.oIndex].friendship += personb.beauty - persona.beauty;
        aPleasure += personb.beauty - persona.beauty
    }

    persona.rTwo[personb.oIndex].attraction += calcAttraction(persona, personb);
    if (calcAttraction(persona, personb) > 0) {persona.rTwo[personb.oIndex].friendship += calcAttraction(persona, personb)};
    personb.rTwo[persona.oIndex].attraction += calcAttraction(personb, persona);
    if (persona.rTwo[personb.oIndex].attraction > kissReq) {
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
    if (personb.ageInYears() > persona.ageInYears()) {
        bonus -= Math.floor(rootRead(findDiff(personb.ageInYears(),persona.ageInYears()))) - 2;
    }
    for (k=0;k<persona.myTypes.length;k++) {
        bonus += romanticTypes[persona.myTypes[k]].typeTest(persona, personb);
        // bonus += persona.myTypes[k].typeTest(persona, personb);
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
    w -= persona.rTwo[personb.oIndex].coitus;
    var wadj = Math.floor(persona.rTwo[personb.oIndex].attraction / socialNormConstant);
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
    if (persona.rTwo[personb.oIndex].attraction > kissReq && testSocialNorms(persona, personb) <= 0 && persona.ageInYears() > ageAwake && randomInt(1,(12-persona.social)) == 1) {
        var interactText = persona.firstName + " reaches out to kiss " + personb.firstName + ". ";
        if (personb.rTwo[persona.oIndex].attraction > kissBackReq) {
            interactText += (personb.firstName + " kisses " + persona.oPronoun() + " back.<br>");
            persona.rTwo[personb.oIndex].romance ++;
            personb.rTwo[persona.oIndex].romance ++;
            if (persona.rTwo[personb.oIndex].romance > 60) {
                var sti = commitmentCheck(persona, personb);
                if (persona.rTwo[personb.oIndex].commitment == 0 && sti == 0 && randomInt(1,(21-(persona.honor + persona.focus)) <= 5)) {
                    persona.rTwo[personb.oIndex].commitment ++;
                    addHistory(((persona.fullName() + " promises to be loyal to " + personb.fullName() + ".")));
                }
            }
            if (randomInt(1,5) == 1) {
                if (persona.rTwo[personb.oIndex].coitus == 0) {
                    // console.log("first whup");
                    var suf = (persona.fullName() + " (age " + persona.ageInYears() + ") and " + personb.fullName() + " (age " + personb.ageInYears() + ") slept together for the first time.");
                    if (persona.relatives[personb.oIndex] != undefined) {suf = (persona.fullName() + " (age " + persona.ageInYears() + ") slept with " + personb.fullName() + " (age " + personb.ageInYears() + "), " + persona.pPronoun() + " " + relaParser(persona, personb) +  ", for the first time. They committed <strong>incest</strong>.")}
                    addHistory(suf);
                }
                interactText += (persona.fullName() + " and " + personb.fullName() + " slept together.<br>");
                persona.rTwo[personb.oIndex].coitus ++;
                personb.rTwo[persona.oIndex].coitus ++;
                persona.coitusCounter ++;
                personb.coitusCounter ++;
                if (pregChances(persona, personb) == 1) {
                    if (persona.gender == 0) {
                        persona.pregnant = 1;
                        persona.pregnancyStart = counter;
                        persona.pregnancyParent = personb.oIndex;
                        addHistory((persona.fullName() + " became pregnant."));
                    } else {
                        personb.pregnant = 1;
                        personb.pregnancyStart = counter;
                        personb.pregnancyParent = persona.oIndex;
                        addHistory((personb.fullName() + " became pregnant."));
                    }
                }
            }
        } else {
            persona.rTwo[personb.oIndex].attraction -= calcAttraction(persona, personb) * 10;
            interactText += (personb.firstName + " pulls away.<br>");
        }
        $("#npcinteract" + persona.oIndex).attr("data-content", interactText);
    }
}

function meetPeopleTwo() {
    if (liveNPC.length > 2) {
        for (var i=0;i<liveNPC.length;i++) {
            var iter = i;
            let char = npc[liveNPC[iter]];
            var p = [];
            var llen = liveNPC.length;
            // var meetstart = new Date;
            var atc = char.isAttached();
            for (var j=0;j<llen;j++) {
                    var r = char.rTwo[liveNPC[j]];
                    var adder = 0;
                    if (r != undefined) {
                        adder += Math.floor(r.friendship/100);
                        adder += Math.floor(r.attraction/100);
                        if (r.commitment == 1) {adder += adder} else {adder -= findDiff(char.ageInYears(),npc[liveNPC[j]].ageInYears());}
                        if (atc == 0 && char.relatives[j] != undefined) {adder = Math.floor(adder/4);}
                    } 
                    if (adder < 0) {
                        p.push(1);
                    } else if (adder > char.social) {
                        p.push(adder);
                    } else {
                        p.push(char.social);
                    }
                
            }
            // var pcalc = new Date;
            //console.log(p);
            var u;
            do {
                u = weightedChooser(liveNPC, p);
                //console.log(u);
            } while (u == liveNPC[iter])
            // var interactstart = new Date;
            // console.log(u + " is u. iter is " + iter);
            // console.log(liveNPC[iter] + " is livenpciter.");
            //console.log("u is");
            //console.log(u);
            var uip = interactWith(npc[liveNPC[iter]], npc[u]);
            // var interactend = new Date;
            if (char.iMemory.length > 99) {char.iMemory = char.iMemory.slice(1)}
            char.iMemory.push([counter,u,uip]);
            // var memorytime = new Date;
            /* if ((counter + 1) % 1000 == 0) {
                meetTiming.push([counter,pcalc - meetstart, interactstart - pcalc, interactend - interactstart, memorytime - interactend, char.fullName()]);
                console.log([counter,pcalc - meetstart, interactstart - pcalc, interactend - interactstart, memorytime - interactend, char.fullName()]);
            } */
        }
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
    gameStartTime = new Date();
    setupGamepages();
    $("#startTime").text(gameStartTime);
    dLc();
    for (var i=0;i<characterCount;i++) {
        addNPC();
    }
    makeRelative(pickFrom(npc));
    setupMetaDash();
    printStats();
    hoverInfo();
}

function gameSetupSaveTest() {
    npc = [];
    console.log(npc);
    gameStartTime = new Date();
    setupGamepages();
    $("#startTime").text(gameStartTime);
    dLc();
    setupMetaDash();
    hoverInfo();
    if (localStorage.getItem('comSaveGame') == 1) {
        restoreFromSave();
    } else {
        console.log("creating new game");
        for (var i=0;i<characterCount;i++) {
            addNPC();
        }
        makeRelative(pickFrom(npc));
    }
    printStats();
}
function gameSetupLfSave() {
    npc = [];
    console.log(npc);
    gameStartTime = new Date();
    setupGamepages();
    $("#startTime").text(gameStartTime);
    dLc();
    setupMetaDash();
    hoverInfo();
    if (localStorage.getItem('comSaveGame') == 1) {
        lfRestoreGame();
    } else {
        console.log("creating new game");
        for (var i=0;i<characterCount;i++) {
            addNPC();
        }
        makeRelative(pickFrom(npc));
    }
    printStats();
}

function displayCharPanels() {
    $("#dashpanel").html("");
    for (var i=0;i<liveNPC.length;i++) {
        $("#dashpanel").append(createCharPanel(liveNPC[i]));
    }
    $('[data-toggle="popover"]').popover();
}

function displayLocPanels() {
    $("#locpanel").html("");
    for (var i=0;i<localeList.length;i++) {
        console.log("creating locpanel "+i);
        $("#locpanel").append(createLocalePanel(i));
    }
    $('[data-toggle="popover"]').popover();
}

function masterLoop() { // this is a replacement for dayEnd
    var len = liveNPC.length;
    var loopstarttime = new Date;
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
    var meetstarttime = new Date;
    meetPeopleTwo();
    var deathstarttime = new Date;
    resolveDeaths();
    var eventstarttime = new Date;
    resolveEvents();
    if (((counter + 180) % 365) == 0) {
        if (birthRate[thisYear()] != undefined) {
            birthRate[thisYear()][1] = popCalc().pop;
        } else {birthRate[thisYear()] = [0,popCalc().pop,0]}
    }
    if (((counter) % 365) == 364 && birthRate[thisYear()] != undefined && birthRate[thisYear()][0] != 0) {
        birthRate[thisYear()][2] = (birthRate[thisYear()][0]/(birthRate[thisYear()][1]/1000));
    }
    if (counter % 1000 == 0) {
        var clearstarttime = new Date;
        clearDead();
        var clearendtime = new Date;
        loopTimingDetail.push([counter,meetstarttime-loopstarttime, deathstarttime-meetstarttime, eventstarttime-deathstarttime]);
        console.log([counter,("firstloop " + (meetstarttime-loopstarttime)),("meetloop " + (deathstarttime-meetstarttime)),("deathloop " + (eventstarttime-deathstarttime)),("eventloop " + (clearstarttime - eventstarttime)),("cleardeadloop " + (clearendtime - clearstarttime))]);
    }
}

function gameLoop() {
    var startfullloop = new Date;
    counter++
    // checkIndices();
    masterLoop();
    var metaloopstart = new Date;
    metaLoop();
    var petloopstart = new Date;
    petLoop();
    var dashstarttime = new Date;
    updateDash();
    var endtime = new Date;
    if (counter%100 == 0) {
        loopTiming.push([counter, new Date]);
    };
    if (counter%1000 == 0) {
        calcLoopTime();
        // saveGame();
        console.log("master loop " + (metaloopstart-startfullloop) + "; metaloop " + (petloopstart-metaloopstart) + "; petloop " + (dashstarttime-petloopstart) + "; dash " + (endtime-dashstarttime));
    };
    //hoverInfo();
}

function updateDash() {
    var len = liveNPC.length;
    for (var i=0;i<len;i++) {
        // $("#npc" + liveNPC[i]).attr("title",npc[liveNPC[i]].firstName);
        $("#npc" + liveNPC[i]).attr("data-age",npc[liveNPC[i]].ageInYears());
        $("#npchappy" + liveNPC[i]).html((npc[liveNPC[i]].happinessQuotient()).toFixed(2));
        $("#npcyears" + liveNPC[i]).html(npc[liveNPC[i]].ageInYears());
        // $("#npclocation" + liveNPC[i]).html(locationList[npc[liveNPC[i]].location].title);
    }
    $(".years").text(thisYear());
    $(".counter").html(parseYear(counter).day);
    $(".population").text(popCalc().pop);
    $(".fpop").text(popCalc().f);
    $(".mpop").text(popCalc().m);
    var tPadder = 0;
    for (var m=0;m<(textLog.length-textLogPointer);m++) {
        if (textLog[textLogPointer + m][0] == counter) {
            $("#textlog").prepend("<span class='textlogentry'>" + textLogPrefix() + textLog[textLogPointer + m][1] + "<br></span>");
            // console.log("moving pointer");
            tPadder ++;
        }
    }
    textLogPointer += tPadder;
    var totalTextEntries = $('.textlogentry').length;
    if (totalTextEntries > 300) {$('.textlogentry:last').remove()}
    if (counter == 1) {sortDash();reverser=0;};
    if (counter % 1000 == 0) {
        updateAboutStats();
    }
}

function clearDead() {
    console.log("bring out your dead");
    var len = npc.length;
    for (var i=0;i<len;i++) {
        var char = npc[i];
        var gtc = 0;
        if (char != undefined && char.alive == 0) {
            // console.log(char.firstName + " is dead to check clear");
            // console.log(npc[i].firstName + " is dead");
            for (var j=0;j<char.rTwo.length;j++) {
                if (char.rTwo[j] != undefined && npc[j] != undefined && npc[char.rTwo[j].originalIndex].alive == 1) {
                    //console.log("living relation");
                    gtc ++;
                }
            }
            for (var k=0;k<char.relatives.length;k++) {
                if (npc[k] != undefined && npc[k] != undefined && npc[k].alive == 1) {
                    //console.log("living relative");
                    gtc ++;
                }
            }
            if (gtc == 0) {
                console.log("undefining " + char.fullName());
                delete npc[i];
            }
        }
    }
}

$(document).ready(gameStart());

function saveGame() {
    localStorage.clear();
    console.log("setting");
    localStorage.setItem('comSaveGame', 1);
    localStorage.setItem('npcArray', JSON.stringify(npc));
    localStorage.setItem('currentCounter', counter);
    localStorage.setItem('liveNpcArray', JSON.stringify(liveNPC));
    // localStorage.setItem('textLogArray', JSON.stringify(textLog));
    localStorage.setItem('romanticTypesArray', JSON.stringify(romanticTypes));
    localStorage.setItem('socialNormsArray', JSON.stringify(socialNorms));
    localStorage.setItem('specialEventsArray', JSON.stringify(specialEvents));
    localStorage.setItem('regActivitiesArray', JSON.stringify(regActivities));
    localStorage.setItem('locationListArray', JSON.stringify(locationList));
    localStorage.setItem('localeListArray', JSON.stringify(localeList));
    localStorage.setItem('monumentList', JSON.stringify(monumentList));
    localStorage.setItem('birthRate', JSON.stringify(birthRate));
    localStorage.setItem('stats', JSON.stringify(stats));
    localStorage.setItem('pet',JSON.stringify(pet));
    localStorage.setItem('gameStartTime',gameStartTime.getTime());
    if (petTimer != undefined) {
        localStorage.setItem('petTimer', petTimer.getTime());
    }
    localStorage.setItem('monumentActive', monumentActive);
    localStorage.setItem('leaderActive', leaderActive);
    localStorage.setItem('disPointThreshold', disPointThreshold);
    localStorage.setItem('disPoints', disPoints);
    localStorage.setItem('discoveryActive', discoveryActive);
    localStorage.setItem('projectMaterial', projectMaterial);
    localStorage.setItem('teamLeader', teamLeader);
    $("#gamecontrolstatus").show();
    $("#gamecontrolstatus").html(`Game saved successfully.`);
    $("#gamecontrolstatus").fadeOut();
}

function restoreArray(arr1, arr2) {
    for (let i=0;i<arr2.length;i++) {
        for (var property in arr2[i]) {
            if (arr2[i].hasOwnProperty(property)) {
                // do stuff
                arr1[i][property] = arr2[i][property];
            }
        }
    }
    console.log("restored array");
}

function restoreFromSave() {
    console.log("restoring from save");
    counter = parseInt(localStorage.getItem('currentCounter'));
    monumentActive = parseInt(localStorage.getItem('monumentActive'));
    leaderActive = parseInt(localStorage.getItem('leaderActive'));
    disPointThreshold = parseInt(localStorage.getItem('disPointThreshold'));
    disPoints = parseInt(localStorage.getItem('disPoints'));
    discoveryActive = parseInt(localStorage.getItem('discoveryActive'));
    projectMaterial = parseInt(localStorage.getItem('projectMaterial'));
    teamLeader = parseInt(localStorage.getItem('teamLeader'));
    // textLog = JSON.parse(localStorage.getItem('textLogArray'));
    liveNPC = JSON.parse(localStorage.getItem('liveNpcArray'));
    birthRate = JSON.parse(localStorage.getItem('birthRate'));
    stats = JSON.parse(localStorage.getItem('stats'));
    gameStartTime = new Date(parseInt(localStorage.getItem('gameStartTime')));
    $("#startTime").text(gameStartTime);
    pet = JSON.parse(localStorage.getItem('pet'));
    petTimer = new Date(parseInt(localStorage.getItem('petTimer')));
    locationList = JSON.parse(localStorage.getItem('locationListArray'));
    var npccopy = JSON.parse(localStorage.getItem('npcArray'));
    for (let i=0;i<npccopy.length;i++) {
        if (npccopy[i] != undefined) {
            npc[i] = new person;
            for (var property in npccopy[i]) {
                if (npccopy[i].hasOwnProperty(property)) {
                    // do stuff
                    npc[i][property] = npccopy[i][property];
                }
            }
        }
        console.log("restored " + npc[i].fullName());
    }
    var loccopy = JSON.parse(localStorage.getItem('localeListArray'));
    for (let j=0;j<loccopy.length;j++) {
        localeList[j] = new otherLocale;
        for (var property in loccopy[j]) {
            if (loccopy[j].hasOwnProperty(property)) {
                // do stuff
                localeList[j][property] = loccopy[j][property];
            }
        }
        console.log("restored " + localeList[j].name);
    }
    var romcopy = JSON.parse(localStorage.getItem('romanticTypesArray'));
    restoreArray(romanticTypes, romcopy);
    var normcopy = JSON.parse(localStorage.getItem('socialNormsArray'));
    restoreArray(socialNorms,normcopy);
    var eventcopy = JSON.parse(localStorage.getItem('specialEventsArray'));
    restoreArray(specialEvents,eventcopy);
    var activcopy = JSON.parse(localStorage.getItem('regActivitiesArray'));
    restoreArray(regActivities,activcopy);
    var monucopy = JSON.parse(localStorage.getItem('monumentList'));
    restoreArray(monumentList,monucopy);
    restoreUI();
    //paused = 1;
}

function restoreUI() {
    displayCharPanels();
    if (pet.alive == 1) {
        displayPet();
    }
    if (discoveryActive == 1) {
        displayOutside();
        displayLocPanels();
    }
    var yuhg = filterIndex(monumentList, "title", "progress");
    if (monumentList[yuhg].active == 1) {
        displayAboutStats();
    }
    if (leaderActive == 1) {
        console.log("displaying leader");
        console.log(npc[teamLeader].fullName());
        $("#leader").html(`<p>${npc[teamLeader].fullName()} is community leader.</p>`);
    }
    if (monumentActive == 1) {
        for (let i=0;i<monumentList.length;i++) {
            if (monumentList[i].active == 1) {
                $("#monument").append(createMonumentPanel(i));
            }
        }
    }
    updateAboutStats();
}

function resetGame() {
    if (resetwarning == 0) {
        alert("Warning: This will clear your save and refresh the game from year 1! Try again to proceed.");
        $("#resetgamebutton").removeClass("btn-warning");
        $("#resetgamebutton").addClass("btn-danger");
        resetwarning ++;
    } else {
        localStorage.clear();
        console.log(localStorage);
        console.log("cleared");
        location.reload();
    }
}

function restoreReset() {
    $("#resetgamebutton").removeClass("btn-danger");
    $("#resetgamebutton").addClass("btn-warning");
    resetwarning = 0;
}

function updateGameControlStatus(message) {
    $("#gamecontrolstatus").show();
    $("#gamecontrolstatus").html(message);
    $("#gamecontrolstatus").fadeOut();
}

function lfSaveGame() {
    console.log("setting localforage");
    localStorage.setItem('comSaveGame', 1);
    localforage.setItem('textLog', textLog).then(function() {console.log(`set textLog in localforage`);});
    localforage.setItem('npcArray', JSON.stringify(npc)).then(function() {console.log(`set npc in localforage`);});
    localforage.setItem('currentCounter', counter).then(function() {console.log(`set counter in localforage`);});
    localforage.setItem('liveNpcArray', JSON.stringify(liveNPC)).then(function() {console.log(`set liveNPC in localforage`);});
    localforage.setItem('romanticTypesArray', JSON.stringify(romanticTypes)).then(function() {console.log(`set romanticTypes in localforage`);});
    localforage.setItem('socialNormsArray', JSON.stringify(socialNorms)).then(function() {console.log(`set socialNorms in localforage`);});
    localforage.setItem('specialEventsArray', JSON.stringify(specialEvents)).then(function() {console.log(`set sevents in localforage`);});
    localforage.setItem('regActivitiesArray', JSON.stringify(regActivities)).then(function() {console.log(`set activ in localforage`);});
    localforage.setItem('locationListArray', JSON.stringify(locationList)).then(function() {console.log(`set loca in localforage`);});
    localforage.setItem('localeListArray', JSON.stringify(localeList)).then(function() {console.log(`set locale in localforage`);});
    localforage.setItem('monumentList', JSON.stringify(monumentList)).then(function() {console.log(`set monu in localforage`);});
    localforage.setItem('birthRate', JSON.stringify(birthRate)).then(function() {console.log(`set br in localforage`);});
    localforage.setItem('stats', JSON.stringify(stats)).then(function() {console.log(`set stats in localforage`);});
    localforage.setItem('pet',JSON.stringify(pet)).then(function() {console.log(`set pet in localforage`);});
    localforage.setItem('gameStartTime',gameStartTime.getTime()).then(function() {console.log(`set starttime in localforage`);});
    localforage.setItem('petTimer', petTimer).then(function() {console.log(`set pettime in localforage`);});
    localforage.setItem('monumentActive', monumentActive).then(function() {console.log(`set monuac in localforage`);});
    localforage.setItem('leaderActive', leaderActive).then(function() {console.log(`set leaderac in localforage`);});
    localforage.setItem('disPointThreshold', disPointThreshold).then(function() {console.log(`set dispoithre in localforage`);});
    localforage.setItem('disPoints', disPoints).then(function() {console.log(`set dispoints in localforage`);});
    localforage.setItem('discoveryActive', discoveryActive).then(function() {console.log(`set disactive in localforage`);});
    localforage.setItem('projectMaterial', projectMaterial).then(function() {console.log(`set projmat in localforage`);});
    localforage.setItem('teamLeader', teamLeader).then(function() {console.log(`set teamlead in localforage`);});
    updateGameControlStatus('Game saved.');
}

function lfRestoreGame() {
    /* localforage.getItem('textLog').then(function(value) {
        console.log("got textlog");
    }); */
    localforage.getItem('textLog')
    .then(function(result) {
        console.log("textLog got");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('npcArray');
    })
    .then(function(result) {
        console.log("npcArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('currentCounter');
    })
    .then(function(result) {
        console.log("currentCounter got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('liveNpcArray');
    })
    .then(function(result) {
        console.log("liveNpcArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('romanticTypesArray');
    })
    .then(function(result) {
        console.log("romanticTypesArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('socialNormsArray');
    })
    .then(function(result) {
        console.log("socialNormsArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('specialEventsArray');
    })
    .then(function(result) {
        console.log("specialEventsArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('regActivitiesArray');
    })
    .then(function(result) {
        console.log("regActivitiesArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('locationListArray');
    })
    .then(function(result) {
        console.log("locationListArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('localeListArray');
    })
    .then(function(result) {
        console.log("localeListArray got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('monumentList');
    })
    .then(function(result) {
        console.log("monumentList got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('birthRate');
    })
    .then(function(result) {
        console.log("birthRate got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('stats');
    })
    .then(function(result) {
        console.log("stats got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('pet');
    })
    .then(function(result) {
        console.log("pet got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('gameStartTime');
    })
    .then(function(result) {
        console.log("gameStartTime got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('petTimer');
    })
    .then(function(result) {
        console.log("petTimer got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('monumentActive');
    })
    .then(function(result) {
        console.log("monumentActive got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('leaderActive');
    })
    .then(function(result) {
        console.log("leaderActive got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('disPointThreshold');
    })
    .then(function(result) {
        console.log("disPointThreshold got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('disPoints');
    })
    .then(function(result) {
        console.log("disPoints got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('projectMaterial');
    })
    .then(function(result) {
        console.log("projectMaterial got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('teamLeader');
    })
    .then(function(result) {
        console.log("teamLeader got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        return localforage.getItem('discoveryActive');
    })
    .then(function(result) {
        console.log("discoveryActive got ");
        var originalvariable = result;
        console.log(typeof originalvariable);
        console.log("done");
    })
    .catch(failureCallback);
}

function failureCallback(error) {
    console.log(error);
}

/* list of variables not currently captured in savegame 
var popCap = 95;
var minAge = 13;
var maxAge = 19;
var loopTime = 500;
var puberty = 12;
var menopause = 45;
var genderRatio = 50;
var migrateMinAge = 14;
var kissReq = 200; // min attraction to try to kiss
var kissBackReq = 50; // min attraction to return kiss
var socialNormConstant = 5000; // lower number makes it easier to break social norms
var pregBaseOdds = 90; // base odds of getting pregnant (at puberty) are 1 in pregBaseOdds
var typeStandard = 3;
var incRestrict = 15;
var normStandard = 2;
var ageAwake = 15;
var localeMinPop = 17;
var localeMaxPop = 65;
var localeMinDistance = 50;
var localeMaxDistance = 500;
var leaderMinAge = 16;
var postEventQueue = []; */