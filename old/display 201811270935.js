// CommuniSim display.js


function createCharPanel(id) {
    var panel = (
        `
        <div class='card charcard mt-3' id='npc${id}' title="${npc[id].fullName()}">
            <div class='row m-1'>
                <div class='col'>
                    Name: <a href='javascript:;' data-npcid="${id}" onclick='modalFunction(${id}, "full")' class='charname' id='npcname${id}'>${npc[id].fullName()}</a> (<span id='npcgender${id}'>${upCase(npc[id].genderFunc())})</span><br>
                    Age: <span id='npcyears${id}'></span><br>
                    Happiness: <span id='npchappy${id}'></span>
                </div>
                <div class='col text-right'>
                    <a href="javascript:;" class="npcdescriptions card-link" data-id="${id}" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Description" data-content="working..." id="npcdesc${id}">Description</a><br>
                    <a href="javascript:;" class="npcrelationships card-link" data-id="${id}" data-toggle="popover" data-container="body" data-offset="5" data-html="true" title="Relationships" data-content="No friends yet." id="npcrel${id}" onclick="modalFunction(${id},'rel')">Relationships</a><br>
                    <a href="javascript:;" class="npcinteractions card-link" data-toggle="popover" data-container="body" data-id="${id}" data-offset="5" data-html="true" title="Interactions" data-content="Nothing to report." id="npcinteract${id}">Interactions</a>
                </div>
            </div>
            <div class='row m-1'>
                <div class='col'>
                    Location: <span id='npclocation${id}'>${locationList[npc[id].location].title}</span><br>
                    <span id='npcactivity${id}'></span><br>
                </div>
            </div>
        </div>
                
        `
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
        if (typs.indexOf(romanticTypes[char.myTypes[i]]) == -1) {
            typs.push(romanticTypes[char.myTypes[i]]);
        } else {
            if (typct[typs.indexOf(romanticTypes[char.myTypes[i]])]!=undefined) {
                typct[typs.indexOf(romanticTypes[char.myTypes[i]])] ++;
            } else {typct[typs.indexOf(romanticTypes[char.myTypes[i]])] = 2;}
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
        if (typs.indexOf(romanticTypes[char.myTypes[i]]) == -1) {
            typs.push(romanticTypes[char.myTypes[i]]);
        } else {
            if (typct[typs.indexOf(romanticTypes[char.myTypes[i]])]!=undefined) {
                typct[typs.indexOf(romanticTypes[char.myTypes[i]])] ++;
            } else {typct[typs.indexOf(romanticTypes[char.myTypes[i]])] = 2;}
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

function aboutPanel() {
    return (`
        <div class="gamepage" id="aboutpage">
            <div class="row m-3">
                <div class="col">
                    CommuniSim is a social simulation toy. Wait for it...<br>
                    Currently in active development.<br>
                    2018.11.27: v.0.1.2<br>
                    2018.11.24: v.0.1.1<br>
                </div>
            </div>
            <div class="row m-3">
                <div class="col" id="aboutstats"></div>
            </div>
            <div class="row m-3">
                <div class="col" id="gamecontrols">
                <button class="btn btn-primary gamecontrolbuttons" id="savegamebutton" onClick="lfSaveGame()">Save Game</button> <button class="btn btn-warning gamecontrolbuttons" id="resetgamebutton" onClick="resetGame()">Reset Game</button><br>
                <span id="gamecontrolstatus"></span>
                </div>
            </div>
        </div>
    `)
}

const disNav = `<li id="navdiscovery" class="nav-item"><a class="nav-link" href="#" onClick="navTest('dis')">Outside</a></li>`

function mainPanel() {
    return (`
    <div class="gamepage" id="mainpage">
        <div class="row">
            <div class="col-md">
                <div id="stats">
                    <small>Sim started: <span id="startTime"></span></small><br>
                    Year <span id="years" class="years">1</span> | Day <span class="counter" id="counter"></span> | Population: <span class="population" id="population"></span> (<span class="fpop" id="fpop"></span> F / <span class="mpop" id="mpop"></span> M)
                </div>
                <div class="mt-3" id="playerbuttons">
                    <p>
                        <button type="button" class="btn btn-secondary" id="sortdash" onClick="sortDash()">Sort AZ</button>
                        <button type="button" class="btn btn-secondary" id="sortdash3" onClick="sortDash('age')">Sort by Age</button>
                        <button type="button" class="btn btn-secondary" id="pausebutton" onClick="pauseGame()">Pause Game</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="mb-3" id="dashpanel"></div>
            </div>
            <div class="col-md" id="status-dash">
                <hr>
                <div id="petdash"></div>
                <div id="petpanel"></div>
                <div id="metapanel"></div>
                <hr>
                <div id="temptext" style="height: 50px"></div>
                <div class="m-3 text-center"><button type="button" class="btn btn-primary" id="historybutton" onClick="modalHistory()">Show Full History</button>
                <button type="button" class="btn btn-primary" id="historybutton" onClick="saveHistory()">Export History</button></div>
                <div id="textlog"></div>
            </div>
        </div>
    </div>
    `)
}

function createDevDash() {
    return (`
    <div class="mt-1" id="devdash">
        <p>
            <button type="button" class="btn btn-primary" id="testbutton" onClick="printStats()">Press Me O</button>
            <button type="button" class="btn btn-secondary" id="sortdash2" onClick="sortDash('id')";>Sort ID</button>
            <button type="button" class="btn btn-secondary" id="addnpc" onClick="addNPC()">Add NPC</button>
            <button type="button" class="btn btn-secondary" id="murderbutton" onClick="killRandom()">Kill</button>
            <button type="button" class="btn btn-secondary" id="murderbutton" onClick="changeLocation()">cLoc</button>
            <button type="button" class="btn btn-secondary" id="speedbutton" onClick="toggleSpeed()">Toggle Speed</button>
        </p>
    </div>
    <div class="mt-1" id="devdash2">
        <p>
            <button type="button" class="btn btn-primary" id="testbutton1" onClick="testButton1()">Test 1</button>
            <button type="button" class="btn btn-secondary" id="testbutton2" onClick="testButton2()";>Test 2</button>
            <button type="button" class="btn btn-secondary" id="testbutton3" onClick="testButton3()">Test 3</button>
        </p>
    </div>
`)}

function discoveryPanel() {
    return `
    <div class="gamepage" id="discoverypage">
        <div class="row mt-3">
            <div class="col-md">
            Year <span id="years" class="years">1</span> | Day <span class="counter" id="counter"></span> | Total Communities: <span id="localecount"></span> | World Population: <span id="worldpop"></span> 
                <div class="mt-3" id="discoverybuttons">
                    <p>
                        <button type="button" class="btn btn-secondary" id="disdash1" onClick="sortLocales()">Sort AZ</button>
                        <button type="button" class="btn btn-secondary" id="disdash2" onClick="sortLocales('pop')">Sort by Pop</button>
                        <button type="button" class="btn btn-secondary" id="disdash2" onClick="sortLocales('distance')">Sort by Distance</button>
                        <button type="button" class="btn btn-secondary" id="dispausebutton" onClick="pauseGame()">Pause Game</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div id="disdashleft">
                    <div id="locpanel">
                    </div>
                </div>
            </div>
            <div class="col-md" id="disdashright">
                <hr>
                There is something here.<br>
                <hr>
            </div>
        </div>
    </div>
    `
}

function createLocalePanel(id) {
    var su = "";
    var len = localeList[id].families.length;
    for (var i=0;i<len;i++) {
        if (i == len-1) {
            su += (localeList[id].families[i]);
        } else {
            su += (localeList[id].families[i] + ", ");
        }
    }
    var panel = (
        `
        <div class='card loccard mt-3' id='loc${id}' title="${localeList[id].name}" data-distance="${localeList[id].distance()}">
            <div class='row m-1'>
                <div class='col'>
                    Name: <a href='javascript:;' data-locid='${id}' onclick='modalFunction("${id}")' class='locname' id='locname${id}'>${localeList[id].name}</a><br>
                    Population: <span id="locpop${id}">${localeList[id].population}</span><br>
                    Distance: ${localeList[id].distance()} li<br>
                </div>
                <div class='col text-right'>
                </div>
            </div> 
            <div class='row m-1'>
                <div class='col'>
                    Surnames: ${su}<br>
                </div>
            </div>
        </div>
        `
    )
    return panel;
}

// NAV NAVBAR functions

function navTest(para) {
    hidePop();
    restoreReset();
    $(".nav-item").removeClass("active");
    $(".nav-item").removeClass("glow");
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

// sort functions

function sortLocales(method) {
    var $divs = $("div.loccard");
    var mod = 1;
    if (locReverser == 1) {
        mod = mod * -1;
        locReverser = 0;
    } else {locReverser = 1}
    $divs.sort(function(a,b){
        if ($(a).attr("title")<$(b).attr("title")) {return -mod};
        if ($(a).attr("title")>$(b).attr("title")) {return mod};
        return 0;
    });
    if (method=="distance") {
        $divs.sort(function(a,b){
            if (parseInt($(a).attr("data-distance"))<parseInt($(b).attr("data-distance"))) {return -mod};
            if (parseInt($(a).attr("data-distance"))>parseInt($(b).attr("data-distance"))) {return mod};
        return 0;
        });
    }
    if (method=="pop") {
        $divs.sort(function(a,b){
        if (parseInt($(a).attr("data-pop"))<parseInt($(b).attr("data-pop"))) {return -mod};
        if (parseInt($(a).attr("data-pop"))>parseInt($(b).attr("data-pop"))) {return mod};
        return 0;
        });
    }
    $("#locpanel").html("");
    for (var i=0;i<$divs.length;i++) {
        $("#locpanel").append($divs[i]);
    }
    $('[data-toggle="popover"]').popover();
}

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
        $("#dashpanel").append($divs[i]);
    }
    $('[data-toggle="popover"]').popover();
}