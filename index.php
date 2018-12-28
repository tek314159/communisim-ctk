<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A free to play social simulation toy."/>
    <meta name="keywords" content="free-to-play, social, simulation, toy, communisim, community">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>CommuniSim</title>
    <link href="https://fonts.googleapis.com/css?family=Assistant|Nunito+Sans" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <style type="text/css"></style>
    <!-- Global site tag (gtag.js) - Google Analytics
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129113601-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-129113601-1');
        </script> -->
  </head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">CommuniSim</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li id="navhome" class="nav-item active">
            <a class="nav-link" href="#" onClick="navTest('home')">Home</a>
          </li>
          <li id="navabout" class="nav-item">
            <a class="nav-link" href="#" onClick="navTest('about')">About</a>
          </li>
        </ul>
        <!--<form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
      </div>
    </nav>
<main role="main" class="container" id="maincontainer">
    <div id="preload">
        CommuniSim is a social simulation toy.<br>
        Currently in active development.<br>
        Simulation loading...
    </div>
</main>
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
<footer class="footer fixed-bottom text-light bg-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col"><a href="#" class="text-muted">communisim.com</a></div>
            <div class="col text-right text-muted">
                <a href="update.html" target="_blank" class="text-muted">Update Log</a> | 
                <a href="http://reddit.com/u/cryptot0t" target="_blank" class="text-muted">Contact Dev</a>
            </div>
        </div>
    </div>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="localforage/dist/localforage.js"></script>
    <script src="sha3.min.js"></script>
    <script src="utilities.js"></script>
    <script src="vnames.js"></script>
    <script src="display.js"></script>
    <script src="metagame.js"></script>
    <script src="working.js"></script>
  </body>
</html>