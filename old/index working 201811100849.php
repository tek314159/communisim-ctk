<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Riffing</title>
    <style type="text/css">
    .popover{
        max-width:800px;
    }
    </style>
  </head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" hidden="true">
        <a class="navbar-brand" href="#">Home</a>
    </nav>
    <div class="row">
        <div class="col-md">
            <h1>Riffing</h1>
            <div id="playerbuttons">
                <p>
                    <button type="button" class="btn btn-secondary" id="sortdash">Sort AZ</button>
                    <button type="button" class="btn btn-secondary" id="sortdash2">Sort ID</button>
                    <button type="button" class="btn btn-secondary" id="sortdash3">Sort Age</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton">Pause Game</button>
                    <button type="button" class="btn btn-secondary" id="speedbutton">Toggle Speed</button>
                </p>
            </div>
            <div id="devdash">
                <p>
                    <button type="button" class="btn btn-primary" id="testbutton">Press Me</button>
                    <button type="button" class="btn btn-secondary" id="testbutton3">Add NPC</button>
                </p>
            </div>
            <div id="stats">
                <p><small>Sim started: <span id="startTime"></span></small><br>
                Year <span id="years">1</span> | Day <span id="counter"></span> | Population: <span id="population"></span> (<span id="fpop"></span> F / <span id="mpop"></span> M) CC: <span id="coicou"></span></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div id="dashpanel"></div>
            <div id="footpanel"><button type="button" class="btn btn-secondary" id="popbutton">Clear Popovers</button></div>
        </div>
        <div class="col-md" id="status-dash">
            <hr>
            <div id="petdash"></div>
            <div id="petpanel"></div>
            <div id="metapanel"></div>
            <hr>
            <div id="temptext" style="height: 50px"></div>
            <div id="textlog"></div>
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
<script>

var charPanels = [];

function dLc() {
    specialEvents.push(
        {
            "title":"is best",
            "active":1,
            "description":"incest restriction lifted",
            "odds":3000,
            "checkOccurrance": function() {
                if (randomInt(1,this.odds) == 1) {
                    return 1;
                } else {
                    return 0;
                }
            },
            "effect": function() {
                incRestrict = 1;
                textLog += (textLogPrefix() + "<strong>taboo porn</strong> became popular.<br>");
                postEventQueue.push([counter+365,function(){incRestrict=3;textLog+=(textLogPrefix() + "<strong>taboo porn</strong> is no longer popular.<br>")}])
            },
            "flavortext":"Something happens!!"
        }
    );
    romanticTypes.push(
        {
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
        },
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
        "Emi", "Sun Lei", "Melody", "Jingjing", "Donna", "Kink", "Chang Ying", "Yvonne", "Cyndi", "Elana", "Zhou Jie", "Claire", "Michelle", "Baby", "Angelababy", "Felicity", "Alison"
    );
    boyNames.push(
        "Tek"
    );
    ageAwake = 8;
    minAge = 8;
    maxAge = 13;
    genderRatio = 40;
    $("#devdash").show();
    $("#footpanel").show();
    // placeholder function
    console.log("coming not any time soon");
}

var textLog = "";

function textLogPrefix() {
    var pref = ("Year " + thisYear() + ", day " + (counter%365) + ", ");
    return pref;
}

var hairColors = [
    "brown","black","chestnut","blonde","red","strawberry blonde","golden","dirty blond","auburn","brunette","dark brown","light blonde","ginger","Titian"
]

var eyeColors = [
    "brown","blue","grey","green","hazel","dark","amber"
]

var girlNames = [
    'Aaliyah', 'Abbey', 'Abbie', 'Abbigail', 'Abby', 'Abigail', 'Abril', 'Ada', 'Adaline', 'Adalyn', 'Adalynn', 'Addilyn', 'Addison', 'Addisyn', 'Addyson', 'Adelaide', 'Adelina', 'Adeline', 'Adelyn', 'Adelynn', 'Adrian', 'Adriana', 'Adrianna', 'Adrianne', 'Adrienne', 'Aileen', 'Aimee', 'Ainsley', 'Aisha', 'Aja', 'Alaina', 'Alana', 'Alani', 'Alanna', 'Alayna', 'Aleah', 'Aleena', 'Alejandra', 'Alessandra', 'Alexa', 'Alexandra', 'Alexandrea', 'Alexandria', 'Alexia', 'Alexis', 'Alexus', 'Alice', 'Alicia', 'Alina', 'Alisa', 'Alisha', 'Alison', 'Alissa', 'Alivia', 'Aliyah', 'Allie', 'Allison', 'Allisson', 'Ally', 'Allyson', 'Alma', 'Alondra', 'Alysha', 'Alyson', 'Alyssa', 'Amanda', 'Amara', 'Amari', 'Amaya', 'Amber', 'Amelia', 'America', 'Amie', 'Amina', 'Amira', 'Amiyah', 'Amy', 'Amya', 'Ana', 'Anabelle', 'Anahi', 'Analia', 'Anastasia', 'Anaya', 'Andrea', 'Angel', 'Angela', 'Angelia', 'Angelica', 'Angelina', 'Angelique', 'Angie', 'Anika', 'Anissa', 'Anita', 'Anitra', 'Aniya', 'Aniyah', 'Ann', 'Anna', 'Annabel', 'Annabella', 'Annabelle', 'Annalise', 'Anne', 'Annette', 'Annie', 'Annika', 'Antoinette', 'Antonia', 'Anya', 'April', 'Arabella', 'Araceli', 'Aria', 'Ariah', 'Ariana', 'Arianna', 'Ariel', 'Ariella', 'Arielle', 'Ariyah', 'Arlene', 'Arya', 'Ashanti', 'Ashely', 'Ashlee', 'Ashleigh', 'Ashley', 'Ashlie', 'Ashly', 'Ashlyn', 'Ashlynn', 'Ashton', 'Asia', 'Aspen', 'Athena', 'Aubree', 'Aubrey', 'Aubrie', 'Audra', 'Audrey', 'Audrina', 'Aurora', 'Autumn', 'Ava', 'Averie', 'Avery', 'Aviana', 'Avianna', 'Ayanna', 'Ayla', 'Aylin', 'Bailee', 'Bailey', 'Barbara', 'Baylee', 'Beatrice', 'Beatriz', 'Becky', 'Belinda', 'Bella', 'Bernadette', 'Beth', 'Bethany', 'Betsy', 'Betty', 'Beverly', 'Bianca', 'Billie', 'Blair', 'Blake', 'Blakely', 'Blanca', 'Bobbi', 'Bobbie', 'Bonnie', 'Braelyn', 'Braelynn', 'Brandi', 'Brandie', 'Brandy', 'Breana', 'Breanna', 'Breanne', 'Brenda', 'Brenna', 'Bria', 'Briana', 'Brianna', 'Brianne', 'Bridget', 'Bridgett', 'Bridgette', 'Briella', 'Brielle', 'Brinley', 'Brisa', 'Bristol', 'Britany', 'Britney', 'Brittani', 'Brittany', 'Brittney', 'Brittni', 'Brook', 'Brooke', 'Brooklyn', 'Brooklynn', 'Bryanna', 'Brylee', 'Brynlee', 'Brynn', 'Cadence', 'Caitlin', 'Caitlyn', 'Cali', 'Calista', 'Callie', 'Cameron', 'Camila', 'Camilla', 'Camille', 'Camryn', 'Candace', 'Candice', 'Candy', 'Cara', 'Carey', 'Cari', 'Carina', 'Carissa', 'Carla', 'Carley', 'Carlie', 'Carly', 'Carmen', 'Carol', 'Carolina', 'Caroline', 'Carolyn', 'Carrie', 'Carter', 'Casandra', 'Casey', 'Cassandra', 'Cassidy', 'Cassie', 'Cataleya', 'Catalina', 'Catherine', 'Cathy', 'Catrina', 'Cayla', 'Caylee', 'Cecilia', 'Cecily', 'Celeste', 'Celia', 'Celina', 'Celine', 'Chanda', 'Chandler', 'Chandra', 'Chanel', 'Chantel', 'Charity', 'Charlee', 'Charleigh', 'Charlene', 'Charley', 'Charlie', 'Charlotte', 'Chasity', 'Chastity', 'Chelsea', 'Chelsey', 'Chelsie', 'Cheri', 'Cherie', 'Cheryl', 'Cheyanne', 'Cheyenne', 'Chloe', 'Chrissy', 'Christa', 'Christen', 'Christi', 'Christian', 'Christie', 'Christin', 'Christina', 'Christine', 'Christopher', 'Christy', 'Chrystal', 'Chyna', 'Ciara', 'Ciera', 'Cierra', 'Cindy', 'Claire', 'Clara', 'Clare', 'Clarissa', 'Claudia', 'Colette', 'Colleen', 'Connie', 'Constance', 'Cora', 'Corinne', 'Cortney', 'Courtney', 'Cristal', 'Cristina', 'Cristy', 'Crystal', 'Cynthia', 'Dahlia', 'Daisy', 'Dakota', 'Daleyza', 'Dalia', 'Dana', 'Danica', 'Daniela', 'Daniella', 'Danielle', 'Danika', 'Danna', 'Daphne', 'Dara', 'Darby', 'Darcy', 'Darian', 'Darla', 'Darlene', 'Dawn', 'Dayana', 'Dayanara', 'Dayna', 'Deana', 'Deanna', 'Debbie', 'Deborah', 'Debra', 'Deja', 'Delaney', 'Delilah', 'Demetria', 'Demi', 'Dena', 'Denise', 'Desirae', 'Desiree', 'Destinee', 'Destiny', 'Devin', 'Devon', 'Diamond', 'Diana', 'Diane', 'Dianna', 'Dina', 'Dominique', 'Donna', 'Dora', 'Doris', 'Dorothy', 'Dulce', 'Dylan', 'Ebony', 'Eden', 'Edith', 'Eileen', 'Elaina', 'Elaine', 'Eleanor', 'Elena', 'Eliana', 'Elianna', 'Elisa', 'Elisabeth', 'Elise', 'Elisha', 'Elissa', 'Eliza', 'Elizabeth', 'Ella', 'Elle', 'Ellen', 'Elliana', 'Ellie', 'Eloise', 'Elsa', 'Elsie', 'Elyse', 'Ember', 'Emely', 'Emerson', 'Emersyn', 'Emery', 'Emilee', 'Emilia', 'Emilie', 'Emily', 'Emma', 'Emmalyn', 'Erica', 'Ericka', 'Erika', 'Erin', 'Esmeralda', 'Esperanza', 'Essence', 'Esther', 'Estrella', 'Eva', 'Evangeline', 'Eve', 'Evelyn', 'Evelynn', 'Everleigh', 'Everly', 'Evie', 'Faith', 'Fallon', 'Farrah', 'Fatima', 'Felicia', 'Felicity', 'Fernanda', 'Finley', 'Fiona', 'Frances', 'Francesca', 'Freya', 'Gabriela', 'Gabriella', 'Gabrielle', 'Gail', 'Gemma', 'Gena', 'Genesis', 'Genevieve', 'Georgia', 'Gia', 'Gianna', 'Gillian', 'Gina', 'Ginger', 'Giselle', 'Gisselle', 'Giuliana', 'Glenda', 'Gloria', 'Grace', 'Gracelyn', 'Gracelynn', 'Gracie', 'Gretchen', 'Guadalupe', 'Gwendolyn', 'Hadley', 'Hailee', 'Hailey', 'Hailie', 'Haleigh', 'Haley', 'Halle', 'Hallie', 'Hanna', 'Hannah', 'Harley', 'Harlow', 'Harmony', 'Harper', 'Hattie', 'Haven', 'Hayden', 'Haylee', 'Hayley', 'Haylie', 'Hazel', 'Heather', 'Heaven', 'Heidi', 'Helen', 'Helena', 'Henley', 'Hilary', 'Hillary', 'Hollie', 'Holly', 'Hope', 'Hunter', 'Imani', 'India', 'Infant', 'Ingrid', 'Irene', 'Iris', 'Irma', 'Isabel', 'Isabela', 'Isabella', 'Isabelle', 'Isis', 'Isla', 'Itzel', 'Ivy', 'Izabella', 'Jackie', 'Jacklyn', 'Jaclyn', 'Jacqueline', 'Jacquelyn', 'Jada', 'Jade', 'Jaden', 'Jadyn', 'Jaelyn', 'Jaiden', 'Jailene', 'Jaime', 'Jaimie', 'Jaleesa', 'Jalisa', 'Jaliyah', 'Jami', 'Jamie', 'Jana', 'Janae', 'Janay', 'Jane', 'Janel', 'Janell', 'Janelle', 'Janet', 'Janette', 'Janice', 'Janie', 'Janine', 'Janiya', 'Janiyah', 'Janna', 'Jaqueline', 'Jaslene', 'Jasmin', 'Jasmine', 'Jayda', 'Jayden', 'Jayla', 'Jaylah', 'Jayleen', 'Jaylynn', 'Jayme', 'Jazlyn', 'Jazmin', 'Jazmine', 'Jean', 'Jeanette', 'Jeanine', 'Jeanne', 'Jeannette', 'Jeannie', 'Jena', 'Jenifer', 'Jenna', 'Jennie', 'Jennifer', 'Jenny', 'Jesse', 'Jessica', 'Jessie', 'Jill', 'Jillian', 'Jimena', 'Jo', 'Joan', 'Joann', 'Joanna', 'Joanne', 'Jocelyn', 'Jodi', 'Jodie', 'Jody', 'Johanna', 'Jolene', 'Joni', 'Jordan', 'Jordyn', 'Joselyn', 'Josephine', 'Josie', 'Journee', 'Journey', 'Joy', 'Joyce', 'Juanita', 'Judith', 'Judy', 'Julia', 'Juliana', 'Julianna', 'Julianne', 'Julie', 'Juliet', 'Juliette', 'Julissa', 'June', 'Juniper', 'Justice', 'Justine', 'Kacie', 'Kadence', 'Kaelyn', 'Kaia', 'Kaila', 'Kailee', 'Kailey', 'Kailyn', 'Kaitlin', 'Kaitlyn', 'Kaitlynn', 'Kala', 'Kaleigh', 'Kaley', 'Kali', 'Kaliyah', 'Kamila', 'Kamryn', 'Kara', 'Karen', 'Kari', 'Karin', 'Karina', 'Karissa', 'Karla', 'Karrie', 'Kasey', 'Kassandra', 'Kassidy', 'Katarina', 'Kate', 'Katelyn', 'Katelynn', 'Katharine', 'Katherine', 'Kathleen', 'Kathryn', 'Kathy', 'Katie', 'Katina', 'Katlyn', 'Katrina', 'Katy', 'Kayden', 'Kaydence', 'Kayla', 'Kaylee', 'Kayleigh', 'Kaylie', 'Kaylin', 'Keely', 'Kehlani', 'Keira', 'Keisha', 'Kelley', 'Kelli', 'Kellie', 'Kelly', 'Kelsey', 'Kelsi', 'Kelsie', 'Kendall', 'Kendra', 'Kenley', 'Kennedi', 'Kennedy', 'Kensley', 'Kenya', 'Kenzie', 'Keri', 'Kerri', 'Kerrie', 'Kerry', 'Keshia', 'Khadijah', 'Khloe', 'Kiana', 'Kiara', 'Kiera', 'Kierra', 'Kiersten', 'Kiley', 'Kim', 'Kimberlee', 'Kimberley', 'Kimberly', 'Kimora', 'Kinley', 'Kinsley', 'Kira', 'Kirby', 'Kirsten', 'Kirstie', 'Kisha', 'Kizzy', 'Kourtney', 'Krista', 'Kristal', 'Kristen', 'Kristi', 'Kristie', 'Kristin', 'Kristina', 'Kristine', 'Kristy', 'Krystal', 'Krystina', 'Krystle', 'Kyla', 'Kylee', 'Kyleigh', 'Kylie', 'Kyra', 'Lacey', 'Laci', 'Lacie', 'Lacy', 'Ladonna', 'Laila', 'Lainey', 'Lakeisha', 'Lakesha', 'Lakisha', 'Lana', 'Laney', 'Lara', 'Larissa', 'Lashonda', 'Latanya', 'Latasha', 'Latisha', 'Latonya', 'Latosha', 'Latoya', 'Latrice', 'Laura', 'Laurel', 'Lauren', 'Laurie', 'Lauryn', 'Lawanda', 'Layla', 'Lea', 'Leah', 'Leann', 'Leanna', 'Leanne', 'Lee', 'Leeann', 'Leia', 'Leigh', 'Leighton', 'Leila', 'Leilani', 'Lena', 'Lennon', 'Lesley', 'Leslie', 'Lesly', 'Leticia', 'Lexi', 'Lexie', 'Lexus', 'Lia', 'Liana', 'Liberty', 'Lila', 'Lilah', 'Lilian', 'Liliana', 'Lilith', 'Lillian', 'Lilliana', 'Lillie', 'Lilly', 'Lily', 'Lilyana', 'Linda', 'Lindsay', 'Lindsey', 'Lisa', 'Litzy', 'Liza', 'Lizbeth', 'Lizette', 'Lola', 'London', 'Londyn', 'Lora', 'Lorelei', 'Lorena', 'Loretta', 'Lori', 'Lorie', 'Lorraine', 'Lucia', 'Luciana', 'Lucille', 'Lucy', 'Luna', 'Luz', 'Lydia', 'Lyla', 'Lynda', 'Lyndsay', 'Lyndsey', 'Lynette', 'Lynn', 'Lyric', 'Mabel', 'Macey', 'Maci', 'Macie', 'Mackenzie', 'Macy', 'Madalyn', 'Maddison', 'Madeleine', 'Madeline', 'Madelyn', 'Madelynn', 'Madilyn', 'Madilynn', 'Madison', 'Madisyn', 'Madyson', 'Maegan', 'Maeve', 'Maggie', 'Magnolia', 'Maia', 'Maisie', 'Makayla', 'Makenna', 'Makenzie', 'Malaysia', 'Malia', 'Malinda', 'Maliyah', 'Mallory', 'Mandi', 'Mandy', 'Maranda', 'Marcella', 'Marci', 'Marcia', 'Marcie', 'Marcy', 'Marely', 'Margaret', 'Margarita', 'Margot', 'Maria', 'Mariah', 'Mariana', 'Marianne', 'Maribel', 'Maricela', 'Marie', 'Mariela', 'Marilyn', 'Marina', 'Marisa', 'Marisol', 'Marissa', 'Maritza', 'Marjorie', 'Marla', 'Marlee', 'Marlena', 'Marlene', 'Marley', 'Marquita', 'Marsha', 'Martha', 'Mary', 'Maryam', 'Matilda', 'Maureen', 'Maya', 'Mayra', 'Mckayla', 'Mckenna', 'Mckenzie', 'Mckinley', 'Meagan', 'Meaghan', 'Megan', 'Meghan', 'Melanie', 'Melany', 'Melina', 'Melinda', 'Melisa', 'Melissa', 'Melody', 'Mercedes', 'Meredith', 'Mia', 'Micaela', 'Michaela', 'Michele', 'Michelle', 'Mikaela', 'Mikayla', 'Mila', 'Miley', 'Millie', 'Mindy', 'Mira', 'Miracle', 'Miranda', 'Mireya', 'Miriam', 'Misti', 'Misty', 'Mollie', 'Molly', 'Monica', 'Monique', 'Montana', 'Morgan', 'Moriah', 'Mya', 'Myla', 'Mylee', 'Myra', 'Nadia', 'Nadine', 'Nakia', 'Nancy', 'Naomi', 'Natalee', 'Natalia', 'Natalie', 'Nataly', 'Natasha', 'Nathalie', 'Nayeli', 'Nevaeh', 'Nia', 'Nichole', 'Nicole', 'Nicolette', 'Nikita', 'Nikki', 'Nina', 'Noelle', 'Noemi', 'Nora', 'Norah', 'Norma', 'Nova', 'Nyah', 'Nyla', 'Nylah', 'Oakley', 'Octavia', 'Olga', 'Olive', 'Olivia', 'Ophelia', 'Paige', 'Paislee', 'Paisley', 'Pamela', 'Paola', 'Paris', 'Parker', 'Patrice', 'Patricia', 'Paula', 'Paulina', 'Payton', 'Peggy', 'Penelope', 'Penny', 'Perla', 'Peyton', 'Phoebe', 'Phoenix', 'Piper', 'Precious', 'Presley', 'Priscilla', 'Quinn', 'Rachael', 'Rachel', 'Rachelle', 'Raegan', 'Raelyn', 'Raelynn', 'Ramona', 'Randi', 'Raquel', 'Raven', 'Reagan', 'Rebecca', 'Rebekah', 'Reese', 'Regan', 'Regina', 'Remi', 'Remington', 'Renata', 'Renee', 'Rhiannon', 'Rhonda', 'Rihanna', 'Riley', 'Rita', 'River', 'Roberta', 'Robin', 'Robyn', 'Rochelle', 'Ronda', 'Rosa', 'Rosalie', 'Rosanna', 'Rose', 'Rosemary', 'Rowan', 'Roxanne', 'Royalty', 'Rubi', 'Ruby', 'Ruth', 'Ryan', 'Rylee', 'Ryleigh', 'Rylie', 'Sabrina', 'Sade', 'Sadie', 'Sage', 'Sally', 'Samantha', 'Samara', 'Sandra', 'Sandy', 'Saniya', 'Saniyah', 'Sara', 'Sarah', 'Sarai', 'Sasha', 'Savanah', 'Savanna', 'Savannah', 'Sawyer', 'Saylor', 'Scarlet', 'Scarlett', 'Selah', 'Selena', 'Selina', 'Serena', 'Serenity', 'Shaina', 'Shameka', 'Shamika', 'Shana', 'Shanda', 'Shania', 'Shanice', 'Shanika', 'Shaniqua', 'Shanna', 'Shannon', 'Shantel', 'Shari', 'Sharon', 'Shauna', 'Shawn', 'Shawna', 'Shayla', 'Shayna', 'Sheena', 'Sheila', 'Shelbi', 'Shelby', 'Shelia', 'Shelley', 'Shelly', 'Sheri', 'Sherlyn', 'Sherri', 'Sherrie', 'Sherry', 'Sheryl', 'Shirley', 'Shonda', 'Shyanne', 'Sidney', 'Sienna', 'Sierra', 'Silvia', 'Simone', 'Skye', 'Skyla', 'Skylar', 'Skyler', 'Sloane', 'Sofia', 'Sommer', 'Sonia', 'Sonja', 'Sonya', 'Sophia', 'Sophie', 'Stacey', 'Staci', 'Stacie', 'Stacy', 'Stefanie', 'Stella', 'Stephani', 'Stephanie', 'Stephany', 'Summer', 'Susan', 'Susana', 'Suzanne', 'Sydney', 'Sylvia', 'Tabatha', 'Tabitha', 'Talia', 'Tamara', 'Tameka', 'Tami', 'Tamia', 'Tamika', 'Tamiko', 'Tammi', 'Tammie', 'Tammy', 'Tania', 'Tanisha', 'Tanya', 'Tara', 'Taryn', 'Tasha', 'Tatiana', 'Tatum', 'Tatyana', 'Tayler', 'Taylor', 'Teagan', 'Tenley', 'Tennille', 'Tera', 'Teresa', 'Teri', 'Terra', 'Terri', 'Terry', 'Tess', 'Tessa', 'Thalia', 'Thea', 'Theresa', 'Tia', 'Tiana', 'Tianna', 'Tiara', 'Tierra', 'Tiffani', 'Tiffanie', 'Tiffany', 'Tina', 'Tisha', 'Tomeka', 'Toni', 'Tonia', 'Tonya', 'Tori', 'Tosha', 'Tracey', 'Traci', 'Tracie', 'Tracy', 'Tricia', 'Trina', 'Trinity', 'Trisha', 'Trista', 'Tyler', 'Tyra', 'Valentina', 'Valeria', 'Valerie', 'Vanessa', 'Vera', 'Veronica', 'Vicki', 'Vickie', 'Vicky', 'Victoria', 'Violet', 'Virginia', 'Vivian', 'Viviana', 'Vivienne', 'Wanda', 'Wendi', 'Wendy', 'Whitley', 'Whitney', 'Willa', 'Willow', 'Winter', 'Wren', 'Ximena', 'Yadira', 'Yaretzi', 'Yasmin', 'Yasmine', 'Yesenia', 'Yolanda', 'Yoselin', 'Yulissa', 'Yvette', 'Yvonne', 'Zara', 'Zaria', 'Zariah', 'Zoe', 'Zoey', 'Zuri', 'Zoie'
]

var boyNames = [
    'Aaden', 'Aarav', 'Aaron', 'Aarush', 'Abdiel', 'Abdullah', 'Abel', 'Abraham', 'Abram', 'Ace', 'Adam', 'Adan', 'Aden', 'Adonis', 'Adrian', 'Adriel', 'Adrien', 'Aedan', 'Agustin', 'Ahmad', 'Ahmed', 'Aidan', 'Aiden', 'Aidyn', 'Alan', 'Albert', 'Alberto', 'Alden', 'Aldo', 'Alec', 'Alejandro', 'Alessandro', 'Alex', 'Alexander', 'Alexis', 'Alexzander', 'Alfonso', 'Alfred', 'Alfredo', 'Ali', 'Alijah', 'Allan', 'Allen', 'Alonso', 'Alonzo', 'Alvaro', 'Alvin', 'Amare', 'Amari', 'Ameer', 'Amir', 'Anders', 'Anderson', 'Andre', 'Andres', 'Andrew', 'Andy', 'Angel', 'Angelo', 'Anthony', 'Antoine', 'Antonio', 'Antony', 'Antwan', 'Archer', 'Ari', 'Ariel', 'Arjun', 'Armando', 'Armani', 'Arnav', 'Aron', 'Arthur', 'Arturo', 'Aryan', 'Asa', 'Asher', 'Ashton', 'Atticus', 'August', 'Augustus', 'Austin', 'Avery', 'Axel', 'Ayaan', 'Aydan', 'Ayden', 'Aydin', 'Barrett', 'Barry', 'Beau', 'Beckett', 'Beckham', 'Ben', 'Benjamin', 'Bennett', 'Benson', 'Bentlee', 'Bentley', 'Bently', 'Bernard', 'Billy', 'Blaine', 'Blaise', 'Blake', 'Blaze', 'Bo', 'Bobby', 'Bode', 'Bodhi', 'Boston', 'Brad', 'Braden', 'Bradford', 'Bradley', 'Brady', 'Bradyn', 'Braeden', 'Braiden', 'Branden', 'Brandon', 'Branson', 'Brantley', 'Braxton', 'Brayan', 'Brayden', 'Braydon', 'Braylen', 'Braylon', 'Brendan', 'Brenden', 'Brendon', 'Brennan', 'Brennen', 'Brent', 'Brett', 'Brian', 'Brice', 'Bridger', 'Brock', 'Broderick', 'Brodie', 'Brody', 'Brogan', 'Bronson', 'Brooks', 'Bruce', 'Bruno', 'Bryan', 'Bryant', 'Bryce', 'Brycen', 'Bryson', 'Byron', 'Cade', 'Caden', 'Cael', 'Caiden', 'Cain', 'Cale', 'Caleb', 'Callen', 'Callum', 'Calvin', 'Camden', 'Camdyn', 'Cameron', 'Camren', 'Camron', 'Camryn', 'Cannon', 'Carl', 'Carlos', 'Carmelo', 'Carsen', 'Carson', 'Carter', 'Case', 'Casen', 'Casey', 'Cash', 'Cason', 'Cayden', 'Cedric', 'Cesar', 'Chace', 'Chad', 'Chadwick', 'Chaim', 'Chance', 'Chandler', 'Channing', 'Charles', 'Charlie', 'Chase', 'Chris', 'Christian', 'Christopher', 'Clarence', 'Clark', 'Clay', 'Clayton', 'Clifford', 'Clifton', 'Clint', 'Clinton', 'Cody', 'Cohen', 'Colby', 'Cole', 'Coleman', 'Colin', 'Collin', 'Colt', 'Colten', 'Colton', 'Conner', 'Connor', 'Conor', 'Conrad', 'Cooper', 'Corbin', 'Corey', 'Cortez', 'Cory', 'Craig', 'Cristian', 'Cristofer', 'Cristopher', 'Cruz', 'Cullen', 'Curtis', 'Cyrus', 'Dakota', 'Dale', 'Dallas', 'Dalton', 'Damari', 'Damarion', 'Damian', 'Damien', 'Damion', 'Damon', 'Dana', 'Dane', 'Dangelo', 'Daniel', 'Danny', 'Dante', 'Darian', 'Darien', 'Darin', 'Dario', 'Darius', 'Darnell', 'Darrell', 'Darren', 'Darryl', 'Darwin', 'Daryl', 'Dashawn', 'Davian', 'David', 'Davin', 'Davion', 'Davis', 'Davon', 'Dawson', 'Dax', 'Daxton', 'Daylen', 'Dayton', 'Deacon', 'Dean', 'Deandre', 'Deangelo', 'Declan', 'Deegan', 'Demarcus', 'Demarion', 'Demetrius', 'Dennis', 'Deon', 'Derek', 'Derick', 'Derrick', 'Deshawn', 'Desmond', 'Devan', 'Deven', 'Devin', 'Devon', 'Devyn', 'Dexter', 'Diego', 'Dilan', 'Dillon', 'Dominic', 'Dominick', 'Dominik', 'Dominique', 'Don', 'Donald', 'Donnie', 'Donovan', 'Donte', 'Dorian', 'Douglas', 'Drake', 'Draven', 'Drew', 'Duane', 'Duncan', 'Dustin', 'Dwayne', 'Dwight', 'Dylan', 'Ean', 'Earl', 'Easton', 'Eddie', 'Eden', 'Edgar', 'Edison', 'Eduardo', 'Edward', 'Edwin', 'Efrain', 'Eli', 'Elian', 'Elias', 'Elijah', 'Eliot', 'Elliot', 'Elliott', 'Ellis', 'Emanuel', 'Emerson', 'Emery', 'Emiliano', 'Emilio', 'Emmanuel', 'Emmett', 'Emmitt', 'Enrique', 'Enzo', 'Eric', 'Erick', 'Erik', 'Ernest', 'Ernesto', 'Esteban', 'Ethan', 'Eugene', 'Evan', 'Everett', 'Ezekiel', 'Ezequiel', 'Ezra', 'Fabian', 'Felipe', 'Felix', 'Fernando', 'Finley', 'Finn', 'Finnegan', 'Fisher', 'Fletcher', 'Francis', 'Francisco', 'Franco', 'Frank', 'Frankie', 'Franklin', 'Fred', 'Freddy', 'Frederick', 'Fredrick', 'Gabriel', 'Gael', 'Gage', 'Gaige', 'Garrett', 'Gary', 'Gauge', 'Gavin', 'Gavyn', 'Geoffrey', 'George', 'Gerald', 'Gerardo', 'Giancarlo', 'Gianni', 'Gibson', 'Gideon', 'Gilbert', 'Gilberto', 'Giovani', 'Giovanni', 'Giovanny', 'Glen', 'Glenn', 'Grady', 'Graham', 'Grant', 'Grayson', 'Greg', 'Gregory', 'Greyson', 'Griffin', 'Guillermo', 'Gunnar', 'Gunner', 'Gustavo', 'Haiden', 'Hamza', 'Hank', 'Harley', 'Harold', 'Harper', 'Harrison', 'Harry', 'Hassan', 'Hayden', 'Hayes', 'Heath', 'Hector', 'Henry', 'Herbert', 'Hezekiah', 'Holden', 'Houston', 'Howard', 'Hudson', 'Hugh', 'Hugo', 'Humberto', 'Hunter', 'Ian', 'Ibrahim', 'Ignacio', 'Iker', 'Irvin', 'Isaac', 'Isai', 'Isaiah', 'Isaias', 'Ishaan', 'Isiah', 'Ismael', 'Israel', 'Issac', 'Ivan', 'Izaiah', 'Izayah', 'Jabari', 'Jace', 'Jack', 'Jackie', 'Jackson', 'Jacob', 'Jacoby', 'Jaden', 'Jadiel', 'Jadon', 'Jadyn', 'Jaeden', 'Jagger', 'Jaiden', 'Jaidyn', 'Jaime', 'Jair', 'Jairo', 'Jake', 'Jakob', 'Jakobe', 'Jalen', 'Jamal', 'Jamar', 'Jamari', 'Jamarion', 'James', 'Jameson', 'Jamie', 'Jamir', 'Jamison', 'Jared', 'Jaron', 'Jarrod', 'Jase', 'Jasiah', 'Jason', 'Jasper', 'Javier', 'Javion', 'Javon', 'Jax', 'Jaxen', 'Jaxon', 'Jaxson', 'Jaxton', 'Jay', 'Jayce', 'Jaycob', 'Jayden', 'Jaydin', 'Jaydon', 'Jaylen', 'Jaylin', 'Jaylon', 'Jayson', 'Jayvion', 'Jean', 'Jedidiah', 'Jeff', 'Jefferson', 'Jeffery', 'Jeffrey', 'Jencarlos', 'Jensen', 'Jeramiah', 'Jeremiah', 'Jeremy', 'Jerimiah', 'Jermaine', 'Jerome', 'Jerry', 'Jesse', 'Jessie', 'Jesus', 'Jett', 'Jimmy', 'Joaquin', 'Jody', 'Joe', 'Joel', 'Joey', 'Johan', 'Johann', 'John', 'Johnathan', 'Johnathon', 'Johnny', 'Jon', 'Jonah', 'Jonas', 'Jonathan', 'Jonathon', 'Jordan', 'Jorden', 'Jordyn', 'Jorge', 'Jose', 'Joseph', 'Joshua', 'Josiah', 'Josue', 'Jovani', 'Jovanni', 'Juan', 'Judah', 'Jude', 'Julian', 'Julien', 'Julio', 'Julius', 'Junior', 'Justice', 'Justin', 'Justus', 'Kade', 'Kaden', 'Kadyn', 'Kaeden', 'Kael', 'Kai', 'Kaiden', 'Kale', 'Kaleb', 'Kamari', 'Kamden', 'Kameron', 'Kamron', 'Kamryn', 'Kane', 'Kareem', 'Karl', 'Karson', 'Karter', 'Kasen', 'Kash', 'Kason', 'Kayden', 'Kayson', 'Keagan', 'Keaton', 'Keegan', 'Keenan', 'Keith', 'Kellan', 'Kellen', 'Kelly', 'Kelvin', 'Kendall', 'Kendrick', 'Kenneth', 'Kenny', 'Keon', 'Kerry', 'Kevin', 'Keyon', 'Khalil', 'Kian', 'Kieran', 'Killian', 'King', 'Kingsley', 'Kingston', 'Kirk', 'Knox', 'Kobe', 'Kody', 'Koen', 'Kolby', 'Kole', 'Kolten', 'Kolton', 'Konner', 'Konnor', 'Korbin', 'Krish', 'Kristian', 'Kristopher', 'Kurt', 'Kylan', 'Kyle', 'Kyler', 'Kymani', 'Kyron', 'Kyson', 'Lamar', 'Lamont', 'Lance', 'Landen', 'Landon', 'Landry', 'Landyn', 'Lane', 'Larry', 'Lathan', 'Lawrence', 'Lawson', 'Layne', 'Layton', 'Leandro', 'Lee', 'Legend', 'Leighton', 'Leland', 'Lennon', 'Lennox', 'Leo', 'Leon', 'Leonard', 'Leonardo', 'Leonel', 'Leonidas', 'Leroy', 'Levi', 'Lewis', 'Liam', 'Lincoln', 'Lionel', 'Logan', 'London', 'Lonnie', 'Lorenzo', 'Louis', 'Luca', 'Lucas', 'Lucian', 'Luciano', 'Luis', 'Luka', 'Lukas', 'Luke', 'Lyric', 'Madden', 'Maddox', 'Major', 'Makai', 'Makhi', 'Malachi', 'Malakai', 'Malaki', 'Malcolm', 'Malik', 'Manuel', 'Marc', 'Marcel', 'Marcelo', 'Marco', 'Marcos', 'Marcus', 'Mario', 'Mark', 'Markus', 'Marley', 'Marlon', 'Marquis', 'Marshall', 'Martin', 'Marvin', 'Mason', 'Mateo', 'Mathew', 'Mathias', 'Matias', 'Matteo', 'Matthew', 'Matthias', 'Maurice', 'Mauricio', 'Maverick', 'Max', 'Maxim', 'Maximilian', 'Maximiliano', 'Maximo', 'Maximus', 'Maxwell', 'Maxx', 'Mayson', 'Mekhi', 'Melvin', 'Memphis', 'Menachem', 'Messiah', 'Micah', 'Michael', 'Micheal', 'Miguel', 'Mike', 'Miles', 'Milo', 'Misael', 'Mitchell', 'Mohamed', 'Mohammad', 'Mohammed', 'Moises', 'Morgan', 'Moses', 'Moshe', 'Muhammad', 'Myles', 'Nash', 'Nasir', 'Nathan', 'Nathanael', 'Nathaniel', 'Nehemiah', 'Neil', 'Nelson', 'Nicholas', 'Nickolas', 'Nico', 'Nicolas', 'Nigel', 'Niko', 'Nikolai', 'Nikolas', 'Noah', 'Noe', 'Noel', 'Nolan', 'Norman', 'Octavio', 'Odin', 'Oliver', 'Omar', 'Omari', 'Orion', 'Orlando', 'Oscar', 'Osvaldo', 'Owen', 'Pablo', 'Parker', 'Patrick', 'Paul', 'Paxton', 'Payton', 'Pedro', 'Peter', 'Peyton', 'Philip', 'Phillip', 'Phoenix', 'Pierce', 'Pierre', 'Porter', 'Pranav', 'Preston', 'Prince', 'Quentin', 'Quincy', 'Quinn', 'Quinten', 'Quintin', 'Quinton', 'Rafael', 'Raiden', 'Ralph', 'Ramiro', 'Ramon', 'Randall', 'Randy', 'Raphael', 'Rashad', 'Raul', 'Ray', 'Rayan', 'Rayden', 'Raylan', 'Raymond', 'Reagan', 'Reece', 'Reed', 'Reese', 'Reginald', 'Reid', 'Remington', 'Remy', 'Rene', 'Rex', 'Rey', 'Rhett', 'Rhys', 'Ricardo', 'Richard', 'Ricky', 'Riley', 'River', 'Robert', 'Roberto', 'Rocco', 'Roderick', 'Rodney', 'Rodolfo', 'Rodrigo', 'Rogelio', 'Roger', 'Rohan', 'Roland', 'Rolando', 'Roman', 'Romeo', 'Ronald', 'Ronaldo', 'Ronan', 'Ronin', 'Ronnie', 'Rory', 'Ross', 'Rowan', 'Roy', 'Royce', 'Ruben', 'Rudy', 'Russell', 'Ryan', 'Ryder', 'Ryker', 'Rylan', 'Ryland', 'Rylee', 'Sage', 'Salvador', 'Salvatore', 'Sam', 'Samir', 'Samson', 'Samuel', 'Santiago', 'Santino', 'Santos', 'Saul', 'Sawyer', 'Scott', 'Seamus', 'Sean', 'Sebastian', 'Semaj', 'Sergio', 'Seth', 'Shane', 'Shannon', 'Shaun', 'Shawn', 'Sidney', 'Silas', 'Simon', 'Sincere', 'Skylar', 'Skyler', 'Solomon', 'Sonny', 'Soren', 'Spencer', 'Stacy', 'Stanley', 'Stefan', 'Stephen', 'Sterling', 'Steve', 'Steven', 'Stuart', 'Sullivan', 'Sylas', 'Talan', 'Talon', 'Tanner', 'Tate', 'Tatum', 'Taylor', 'Teagan', 'Terrance', 'Terrell', 'Terrence', 'Terry', 'Theo', 'Theodore', 'Thomas', 'Timothy', 'Titus', 'Tobias', 'Toby', 'Todd', 'Tomas', 'Tommy', 'Tony', 'Trace', 'Tracy', 'Travis', 'Trent', 'Trenton', 'Trevon', 'Trevor', 'Trey', 'Tripp', 'Tristan', 'Tristen', 'Tristian', 'Tristin', 'Triston', 'Troy', 'Trystan', 'Tucker', 'Ty', 'Tyler', 'Tyree', 'Tyrell', 'Tyrese', 'Tyrone', 'Tyson', 'Uriah', 'Uriel', 'Urijah', 'Valentin', 'Valentino', 'Van', 'Vance', 'Vaughn', 'Vernon', 'Vicente', 'Victor', 'Vincent', 'Vincenzo', 'Wade', 'Walker', 'Walter', 'Warren', 'Waylon', 'Wayne', 'Wesley', 'Westin', 'Weston', 'Will', 'William', 'Willie', 'Wilson', 'Winston', 'Wyatt', 'Xander', 'Xavi', 'Xavier', 'Xzavier', 'Yadiel', 'Yael', 'Yahir', 'Yair', 'Yandel', 'Yehuda', 'Yosef', 'Yusuf', 'Zachariah', 'Zachary', 'Zachery', 'Zack', 'Zackary', 'Zackery', 'Zaid', 'Zaiden', 'Zain', 'Zaire', 'Zander', 'Zane', 'Zavier', 'Zayden', 'Zayne', 'Zechariah', 'Zion'
]
var postEventQueue = [];

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
            for (var j=0;j<npc.length;j++) {
                lvrcount += npc[j].isAttached();
            }
            if (lvrcount > 2) {
                do {
                    choice = pickFrom(npc);
                }
                while (choice.isAttached() == 0 || choice.alive == 0);
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
                textLog += (textLogPrefix() + choice.firstName + " and " + lover + " <strong>broke up.</strong><br>")
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
            textLog += (textLogPrefix() + "the drinking water took on a <strong>strange flavor</strong>.<br>");
            postEventQueue.push([counter+365,function(){socialNormConstant = orisoc;kissBackReq = orikbr;textLog+=(textLogPrefix() + "<strong>water</strong> has returned to normal.<br>")}])
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"thanos",
        "active":1,
        "description":"malthusian dynamics at work",
        "odds":200,
        "checkOccurrance": function() {
            if (popCalc().pop > 80 && randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            do {
                mire = pickFrom(npc);
            } while (mire.alive == 0)
            textLog += (textLogPrefix() + mire.firstName + " died of <strong>food shortage</strong> brought on by an unsustainable population.<br>");
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
            textLog += (textLogPrefix() + " the community adopted a <strong>pet</strong>.<br>");
        },
        "flavortext":"Something happens!!"
    },
    {
        "title":"tragic death",
        "active":1,
        "description":"another one bites the dust",
        "odds":3000,
        "checkOccurrance": function() {
            if (randomInt(1,this.odds) == 1) {
                return 1;
            } else {
                return 0;
            }
        },
        "effect": function() {
            var mire;
            do {
                mire = pickFrom(npc);
            } while (mire.alive == 0)
            textLog += (textLogPrefix() + mire.firstName + " had a <strong>tragic accident</strong>.<br>");
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
            do {
                subject = pickFrom(npc);
            } while (subject.alive == 0);
            do {
                object = pickFrom(npc);
            } while (subject == object || object.alive == 0);
            interactWith(subject, object);
            subject.rTwo[npc.indexOf(object)].attraction += 15000;
            subject.rTwo[npc.indexOf(object)].romance += 50;
            object.rTwo[npc.indexOf(subject)].attraction += 15000;
            object.rTwo[npc.indexOf(subject)].romance += 50;
            textLog += (textLogPrefix() + subject.firstName + " had a <strong>remarkable day</strong> with " + object.firstName + ".<br>");
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
            do {
                subject = pickFrom(npc);
            } while (subject.alive == 0);
            do {
                object = pickFrom(npc);
            } while (subject == object || object.alive == 0);
            interactWith(subject, object);
            subject.rTwo[npc.indexOf(object)].friendship -= 15000;
            subject.rTwo[npc.indexOf(object)].romance -= 50;
            object.rTwo[npc.indexOf(subject)].friendship -= 15000;
            object.rTwo[npc.indexOf(subject)].romance -= 50;
            textLog += (textLogPrefix() + subject.firstName + " had a <strong>fight</strong> with " + object.firstName + ".<br>");
        },
        "flavortext":"Someone died!"
    }
]

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
            if (personb.rTwo[npc.indexOf(persona)].friendship < 0) {
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

// ACT ACTIVITIES section

var regActivities = [
    {
        "title":"read",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is reading.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 9);
            return hch;
        }
    },
    {
        "title":"watch TV",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is watching TV.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 2);
            return hch;
        }
    },
    {
        "title":"instagram",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is social networking.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 3);
            return hch;
        }
    },
    {
        "title":"walk",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is taking a walk.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.athletics, 3);
            return hch;
        }
    },
    {
        "title":"run",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is jogging.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 3 - findDiff(char.athletics, 7);
            return hch;
        }
    },
    {
        "title":"project",
        "active":1,
        "reqFunction": function() {if (randomInt(1,100) == 1) {return 1} else {return 0}},
        "flavortext":" is working on the project.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            projectMaterial += 1;
            var hch = 3 - findDiff(char.athletics, 7);
            return hch;
        }
    },
    {
        "title":"cinema",
        "active":1,
        "reqFunction": function() {return 1},
        "flavortext":" is watching a film.",
        "enjoyFunction": function(char) {
            char.actTwo[regActivities.indexOf(this)].count ++;
            var hch = 5 - findDiff(char.intellect, 6);
            return hch;
        }
    }
]

var incRestrict = 10;
var normStandard = 1;
var ageAwake = 15;
var socialNorms = [ // 1 means don't do it; 0 means ok
    {
        "title":"incest",
        "active":1,
        "description":"no sex with relatives",
        normTest: function(persona, personb) {
            if (persona.relatives[npc.indexOf(personb)] != undefined) {
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
var characterCount = 9;
var loopTime = 100;
var npc = [];
var counter = 0;
var puberty = 12;
var menopause = 45;
var genderRatio = 50; // percent male

var tenArray = [1,2,3,4,5,6,7,8,9,10]
var tenWeightScale = [1,1,2,2,5,6,7,8,9,1];
var gayWeightScale = [1,7,4,2,3,3,8,10,30,1];

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

function actType(n) {
    this.aName = n.title;
    this.count = 0;
}

function person(firstname, age, gender) {
    this.firstName = firstname;
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
    this.relatives = [];
    this.pregnant = 0;
    this.pregnancyStart;
    this.pregnancyParent;
    this.coitusCounter = 0;
    this.isAttached = function() {
        var co = 0;
        for (var i=0;i<this.rTwo.length;i++) {
            if (this.rTwo[i] != undefined) {co += this.rTwo[i].commitment;}
        }
        return co;
    }
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
    for (i=0;i<array1.length;i++) {
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

function fiftyFifty() {
    var n = Math.floor(Math.random() * 2);
    return n;
}

function thisYear() {
    return Math.floor(counter/365);
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

// INT INTERACTION section

var kissReq = 200; // min attraction to try to kiss
var kissBackReq = 50; // min attraction to return kiss
var socialNormConstant = 2000; // lower number makes it easier to break social norms
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

    // adjust for physical attractiveness
    if (persona.beauty > personb.beauty) {
        personb.rTwo[npc.indexOf(persona)].friendship += persona.beauty - personb.beauty;
    } else {
        persona.rTwo[npc.indexOf(personb)].friendship += personb.beauty - persona.beauty;
    }

    persona.rTwo[npc.indexOf(personb)].attraction += calcAttraction(persona, personb);
    if (calcAttraction(persona, personb) > 0) {persona.rTwo[npc.indexOf(personb)].friendship += calcAttraction(persona, personb)};
    personb.rTwo[npc.indexOf(persona)].attraction += calcAttraction(personb, persona);
    if (persona.rTwo[npc.indexOf(personb)].attraction > kissReq) {
        whupEee(persona, personb);
    }
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
    // if (persona.gender != personb.gender) {console.log(persona.firstName + " socnorm w " + wr + w)};
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
                if (persona.rTwo[npc.indexOf(personb)].commitment == 0 && sti == 0) {
                    persona.rTwo[npc.indexOf(personb)].commitment ++;
                    textLog += (textLogPrefix() + persona.firstName + " promises to be loyal to " + personb.firstName + ".<br>");
                }
            }
            if (randomInt(1,5) == 1) {
                if (persona.rTwo[npc.indexOf(personb)].coitus == 0) {
                    // console.log("first whup");
                    textLog += ("Year " + thisYear() + ", day " + (counter%365) + ", " + persona.firstName + " (age " + persona.ageInYears() + ") and " + personb.firstName + " (age " + personb.ageInYears() + ")  slept together for the first time.<br>");
                    if (persona.relatives[npc.indexOf(personb)] != undefined) {textLog += "They committed <strong>incest</strong>.<br>"}
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
                        textLog += (textLogPrefix() + persona.firstName + " became pregnant.<br>");
                    } else {
                        personb.pregnant = 1;
                        personb.pregnancyStart = counter;
                        personb.pregnancyParent = npc.indexOf(persona);
                        textLog += (textLogPrefix() + personb.firstName + " became pregnant.<br>");
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

function commitmentCheck(persona, personb) {
    var sigo = 0;
    for (var i=0;i<persona.rTwo.length;i++) {
        if (persona.rTwo[i] != undefined) {
            if (persona.rTwo[i].commitment > 0 && i != npc.indexOf(personb)) {
                sigo ++;
                //console.log("comsigo 1 up");
            }
        }
    }
    for (var i=0;i<personb.rTwo.length;i++) {
        if (personb.rTwo[i] != undefined) {
            if (personb.rTwo[i].commitment > 0 && i != npc.indexOf(persona)) {
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
    d += "<br>Types:<br><ul>"
    for (var i=0;i<p.myTypes.length;i++) {
        if (typs.indexOf(p.myTypes[i]) == -1) {
            typs.push(p.myTypes[i]);
        } else {
            if (typct[typs.indexOf(p.myTypes[i])]!=undefined) {
                typct[typs.indexOf(p.myTypes[i])] ++;
            } else {typct[typs.indexOf(p.myTypes[i])] = 2;}
        }
    }
    for (var k=0;k<typs.length;k++) {
        if (typct[k]!=undefined) {
            typd = typct[k];
        } else {
            typd = "";
        }
        d += ("<li>" + typs[k].title + " " + typd + "</li>");
    }
    d+= "</ul><br>"
    d+= ("Honor: " + p.honor + "<br>");
    d+= ("Gender Pref: " + p.genderPref + "<br>");
    d+= ("Coitus Counter: " + p.coitusCounter + "<br>")
    return d;
}

function allRelationships(char) {
    var des = [];
    for (var j = 0; j < npc.length; j++) {
        if (describeRelationship(char, npc[j]) != 0 && npc[j].alive == 1) {
            des.push((describeRelationship(char, npc[j])));
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

function findRelatives(parent, newb) {
    for (var k=0;k<parent.relatives.length;k++) {
        if (parent.relatives[k] != undefined) {
            if (parent.relatives[k] == "child") {
                newb.relatives[k] = "sibling";
                npc[k].relatives[npc.indexOf(newb)] = "sibling"
            } else if (parent.relatives[k] == "parent") {
                newb.relatives[k] = "grandparent";
                npc[k].relatives[npc.indexOf(newb)] = "grandchild"
            } else if (parent.relatives[k] == "sibling") {
                newb.relatives[k] = "parsib";
                npc[k].relatives[npc.indexOf(newb)] = "sibchild"
            } else if (parent.relatives[k] == "sibchild") {
                newb.relatives[k] = "cousin";
                npc[k].relatives[npc.indexOf(newb)] = "cousin"
            }
        }
    }
}

function resolvePregnancies() {
    for (var i=0;i<npc.length;i++) {
        if ((counter - npc[i].pregnancyStart) > 270 && randomInt(1, 20) == 1 && npc[i].alive == 1) {
            giveBirth(npc[i]);
        }
    }
}

function giveBirth(char) {
    if (char.pregnant == 1) {
        addNPC(); $("#dashpanel").append(charPanels[charPanels.length-1]); $("#dashpanel").append("<hr>"); $('[data-toggle="popover"]').popover(); reverser = 0;
        var newb = npc[npc.length-1];
        var mother = char;
        var fnum = (char.pregnancyParent);
        var father = npc[fnum];
        newb.birthday = counter;
        newb.ageInDays = 0;
        newb.beauty = Math.floor((father.beauty + mother.beauty)/2) - 1 + randomInt(0,3);
        newb.hair = pickFrom([father.hair, mother.hair]);
        newb.eyes = pickFrom([father.eyes, mother.eyes]);
        findRelatives(mother, newb);
        findRelatives(father, newb);
        // console.log(mother.firstName + " is mother");
        // console.log(father.firstName + " is father");
        newb.relatives[npc.indexOf(char)] = "parent";
        mother.relatives[npc.length-1] = "child";
        newb.relatives[npc.indexOf(father)] = "parent";
        father.relatives[npc.length-1] = "child";
        textLog += (textLogPrefix() + mother.firstName + " (age " + mother.ageInYears() + ") <strong>gave birth</strong> to " + newb.firstName + ".<br>");
        mother.pregnant = 0;
        mother.pregnancyStart = undefined;
        mother.pregnancyParent = undefined;
        for (var l=0;l<10;l++) {
            interactWith(mother, newb);
            interactWith(father, newb);
        }
    }
}

function evolveRelationships() {
    for (var i=0;i<npc.length;i++) {
        for (var j=0;j<npc.length;j++) {
            if (npc[i].rTwo[j] != undefined) {
                if (npc[i].rTwo[j].friendship > 10) {npc[i].rTwo[j].friendship --};
                if (npc[i].rTwo[j].attraction > 10) {npc[i].rTwo[j].attraction --};
                //if (npc[i].rTwo[j].romance > 0) {npc[i].rTwo[j].romance --};
            }
        }
    }
}

function resolveActivity(character) {
    var m;
    do {m = pickFrom(regActivities);}
    while (m.active != 1 || m.reqFunction() != 1)
    character.happiness += m.enjoyFunction(character);
    return m.flavortext;
}

function resolveDeaths() {
    for (var i=0;i<npc.length;i++) {
        if (npc[i].ageInYears() > 75 && npc[i].alive == 1 && randomInt(1, 20 * 365) == 1) {
            killCharacter(npc[i]);
        }
    }
}

function killCharacter(char) {
    textLog += (textLogPrefix() + char.firstName + " died at age " + char.ageInYears() + ".<br>");
    charPanels[npc.indexOf(char)] = undefined;
    char.alive = 0;
    char.deathday = counter;
    for (var i=0;i<char.rTwo.length;i++) {
        if (char.rTwo[i] != undefined) {
            if (npc[i].rTwo[npc.indexOf(char)] != undefined) {
                npc[i].happiness -= npc[i].rTwo[npc.indexOf(char)].friendship;
                console.log(npc[i].firstName + " mourns " + npc[i].rTwo[npc.indexOf(char)].friendship);
            }
        }
    }
    displayCharPanels();
    reverser = 0;
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

function createCharacter() {
    var g = 0;
    if (randomInt(1,100) <= genderRatio) {g = 1}
    var nam;
    if (g == 1) {nam = pickFrom(boyNames);} else {nam = pickFrom(girlNames);}
    var jk = new person(nam, randomAge(), g);
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
    charPanels.push(createCharPanel(npc.length - 1));
    console.log("added");
}

function meetPeopleTwo() {
    for (var i=0;i<npc.length;i++) {
        var iter = i;
        var p = [];
        for (var j=0;j<npc.length;j++) {
            var r = npc[iter].rTwo[j];
            if (r != undefined) {
                var adder = 0;
                if (r.friendship > 100) {
                    adder += 100;
                } else {
                    adder += r.friendship;
                }
                if (r.attraction > 100) {
                    adder += 100;
                } else {
                    adder += r.attraction;
                }
                p.push(adder);
            } else {
                p.push(1);
            }
        }
        var u;
        do {
            u = weightedChooser(npc, p);
        } while (npc.indexOf(u) == iter || npc.indexOf(u).alive == 0)
        interactWith(npc[iter], u);
    }
}

function gameStart() {
    gameSetup();
    gameStarter();
    /* setInterval(function() {
        if (paused == false) {
        gameLoop();
        }
    }, loopTime); */
}

// currently not using gameStarter because gamestart has pause and gamestarter keeps crashing
// except setInterval just crashed, too, so it might be some other function making it freeze. ugh.
// think I found the issue in some event do...whle loop and dead people; going back to gameStarter
function gameStarter() {
    setTimeout(function() {
        if (paused == false) {
          gameLoop();  
        }
        gameStarter();
    }, loopTime);
}

function gameSetup() {
    var now = new Date();
    $("#footpanel").hide();
    $("#petdash").hide();
    $("#devdash").hide();
    $("#footpanel").hide();
    $("#startTime").text(now);
    dLc();
    for (var i=0;i<characterCount;i++) {
        addNPC();
    }
    makeRelative(pickFrom(npc));
    displayCharPanels();
    setupMetaDash();
    printStats();
}

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
    var pop = 0;
    var m = 0;
    var f = 0;
    for (var i=0;i<npc.length;i++) {
        if (npc[i].alive == 1) {
            pop ++;
        }
        if (npc[i].gender == 0) {
            f++;
        }
        if (npc[i].gender == 1) {
            m++;
        }
    };
    return {"pop":pop,"m":m,"f":f};
}

function displayCharPanels() {
    $("#dashpanel").html("");
    var charCopy = charPanels.slice(0);
    charCopy.sort(function (a,b) {return $(a).find("strong").text() > $(b).find("strong").text();})
    for (var i=0;i<charPanels.length;i++) {
        if (charPanels[i] != undefined) {
            $("#dashpanel").append("<hr>");
            $("#dashpanel").append(charPanels[i]);
        }
    }
    $("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
}

function createCharPanel(id) {
    var panel = (
        "<div class='row charcard' id='npc"+id+"'><div class='col-8'>Name: <a href='javascript:;' data-npcid='"+id+"' onclick='modalFunction(" + id + ")' class='charname' data-toggle='modal' data-target='#exampleModal'><span id='npcname" + id + "'><strong><a href='javascript:;'></strong></span></a> (<span id='npcgender" + id + "'></span>)<br>" +
            "Age: <span id='npcyears" + id + "'></span><br>" +
            "Happiness quotient: <span id='npchappy" +id+"'></span><br>" +
            "<span id='npcactivity"+id+"'></span><br>" +
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Relationships" data-content="No friends yet." id="npcrel' + id + '">Relationships</a> | ' +
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Interactions" data-content="Nothing to report." id="npcinteract' + id + '">Snapshot</a></div>' +
            "<div class='col-4'>Beauty: <span id='npcbeauty" + id + "'></span><br>Athletics: <span id='npcathletics"+id+"'></span><br>Intellect: <span id='npcintellect"+id+"'></span><br>Social: <span id='npcsocial"+id+"'></span><br>" + 
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Description" data-content="Some content inside the popover" id="npcdesc' + id + '">Description</a>' + 
            "</div>"+"</div>"
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
    var r = "";
    for (var l=0;l<char.relatives.length;l++) {
        if (char.relatives[l] != undefined) {
            r += ("<li>" + upCase(relaParser(char, npc[l])) + ": " + npc[l].firstName + "</li>")
        }
    }
    var ra = "";
    var raray = [];
    var lv = "";
    for (var s=0;s<npc.length;s++) {
        if (char.rTwo[s] != undefined) {
            if (char.rTwo[s].commitment > 0) {
                lv = npc[s].firstName;
            }
            raray.push(char.rTwo[s]);
        }
    }
    raray.sort((a,b) => (a.rName > b.rName) ? 1 : ((b.rName > a.rName) ? -1 : 0)); 
    for (var h=0;h<raray.length;h++) {
        var rela = "";
        if (char.relatives[raray[h].originalIndex] != undefined) {rela = (" (" + relaParser(char, npc[raray[h].originalIndex]) + ")")};
        ra += ("<li>" + raray[h].rName + rela + " | Friendship: " + raray[h].friendship + " | Attraction: " + raray[h].attraction + " | Romance: " + raray[h].romance + " | Interactions: " + raray[h].interactions + " | Coitus: " + raray[h].coitus + "</li>")
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
        aa += ("<li>" + upCase(aaray[q].aName) + " " + aaray[q].count + "</li>");
    }
    var pnl = (
        "<div class='row'><div class='col'>" +
        "Name: " + char.firstName + " (" + g + ")<br>" +
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
        "</div><div class='col'>" +
        "Lover: " + lv + "<br>" +
        "Relatives:<br><ul>" +
        r + "</ul>" +
        "</div></div><hr>" + // close out the row
        "<div class='row'><div class='col'>" +
        "Relationships:<br><ul>" +
        ra + "</ul>" +
        "</div></div><hr>" + // close out the row
        "<div class='row'><div class='col'>" +
        "Favorite Activities:<br><ul>" +
        aa + "</ul>" +
        "</div></div><hr>" 
    )
    return pnl;
}

function gameLoop() {
    updateDash();
    updateMetaDash();
    dayEnd();
}

function dayEnd() {
    for (var i = 0; i < npc.length; i++) {
        npc[i].ageInDays++;
        $("#npcactivity" + i).html(npc[i].firstName + resolveActivity(npc[i]));
    }
    counter++;
    resolveEvents();
    evolveRelationships();
    meetPeopleTwo();
    resolvePregnancies();
    resolveDeaths();
}

function pauseGame() {
    if (paused == false) {
        paused = true;
    } else {
        paused = false;
    }
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

function updateDash() {
    for (var i = 0; i < npc.length; i++) {
        $("#npcname" + i).text(npc[i].firstName);
        $("#npc" + i).attr("title",npc[i].firstName);
        $("#npc" + i).attr("data-age",npc[i].ageInYears());
        var g;
        if (npc[i].gender == 0) {g = "F"} else {g = "M"}
        $("#npcgender" + i).text(g);
        $("#npcbeauty" + i).text(npc[i].beauty);
        $("#npcathletics" + i).text(npc[i].athletics);
        $("#npcintellect" + i).text(npc[i].intellect);
        $("#npcsocial" + i).text(npc[i].social);
        $("#npchappy" + i).html(npc[i].happiness + " | " + (npc[i].happiness/counter).toFixed(2) + " hpd");
        $("#npcyears" + i).html(npc[i].ageInYears());
        
        $("#npcrel" + i).attr("data-content", allRelationships(npc[i]));
        $("#npcdesc" + i).attr("data-content", describeCharacter(npc[i]));
    }
    $("#counter").text(counter);
    $("#years").text(Math.floor(counter/365) + 1);
    $("#population").text(popCalc().pop);
    $("#fpop").text(popCalc().f);
    $("#mpop").text(popCalc().m);
    $("#coicou").text(coiCou);
    $("#textlog").html(textLog);
}

function printStats() {
    console.log(counter);
    console.log(npc);
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
        $("#dashpanel").append("<hr>");
        $("#dashpanel").append($divs[i]);
    }
    $("#dashpanel").append("<hr>");
    $('[data-toggle="popover"]').popover();
}

$(document).ready(gameStart());

var speedToggle = 0;
var reverser = 0;

function modalFunction(id) {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html(npc[id].firstName);
    $("#modalbody").html(fullCharInfoPanel(npc[id]));
}

$("#sortdash").click(function() {sortDash();});
$("#sortdash2").click(function() {sortDash("id");});
$("#sortdash3").click(function() {sortDash("age");});
$("#testbutton").click(function() {printStats();});
$("#testbutton3").click(function() {addNPC(); $("#dashpanel").append(charPanels[charPanels.length-1]);$('[data-toggle="popover"]').popover(); });
$("#pausebutton").click(function() {pauseGame();});
$("#speedbutton").click(function() {toggleSpeed();});
$("#soothebutton").click(function() {soothePet();});
$("#popbutton").click(function() {hidePop()});

function hidePop() {
    $("[data-toggle='popover']").popover('hide');
    $('.popover').each(function () {
        var tooltip = $(this);
        if (tooltip.attr('style')) {
            tooltip.remove();
          }
      });
}
/* $('html').on('mouseup', function(e) {
    if(!$(e.target).closest('.popover').length) {
        $('.popover').each(function(){
            $(this.previousSibling).popover('hide');
        });
    }
}); */

// META Game

var projectMaterial = 0;

function metaPanel() {
    return ("Project Material: <span id='projmat'></span><br>");
}

function setupMetaDash() {
    $("#metapanel").html(metaPanel());
}

function updateMetaDash() {
    $("#projmat").text(projectMaterial);
}

// PET

var petTimer;
function petType() {
    this.name = "bob";
}
var pet = new petType;

var petDash = (
    '<p><button type="button" class="btn btn-primary" id="soothebutton" onClick="soothePet()">Soothe Pet</button></p>' + 
    '<p><button type="button" class="btn btn-primary" id="soothebutton" onClick="punishPet()">Punish Pet</button></p>'

);

var petPanel = (
    "Pet.<br>" +
    "<span id='petpanelstatus'></span>"
);

function startPet() {
    petTimer = new Date();
    $("#petdash").html(petDash);
    $("#petpanel").html(petPanel);
    $("#petpanelstatus").html("Pet is active." + pet.name + "<br>");
    $("#petpanelstatus").html(petTimer);
    $("#petdash").show();
}

function soothePet() {
    $("#petpanelstatus").html("Pet is soothed.<br>");
}

function punishPet() {
    $("#petpanelstatus").html("Pet is reprimanded.<br>");
}


</script>
  </body>
</html>