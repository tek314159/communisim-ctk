<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A free to play social simulation toy."/>
    <meta name="keywords" content="free-to-play, social, simulation, toy">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CommuniSim</title>
    <style type="text/css">
    .popover{
        max-width:800px;
    }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129113601-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-129113601-1');
        </script>-->
  </head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" hidden="true">
        <a class="navbar-brand" href="#">Home</a>
    </nav>
    <div class="row">
        <div class="col-md">
            <h1 class="mt-3">CommuniSim</h1>
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
                    <button type="button" class="btn btn-secondary" id="murderbutton" onClick="changeLocation()">cLoc</button>
                    <button type="button" class="btn btn-secondary" id="speedbutton" onClick="toggleSpeed()">Toggle Speed</button>
                </p>
            </div>
            <div id="stats">
                <small>Sim started: <span id="startTime"></span></small><br>
                Year <span id="years">1</span> | Day <span id="counter"></span> | Population: <span id="population"></span> (<span id="fpop"></span> F / <span id="mpop"></span> M) <!--  CC: <span id="coicou"></span> -->
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
            <div class="mt-3 text-center"><button type="button" class="btn btn-primary" id="historybutton" onClick="modalHistory()">Show Full History</button></div>
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
    <script src="metagame.js"></script>
    <script src="working.js"></script>
  </body>
</html>