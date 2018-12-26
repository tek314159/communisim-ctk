<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>JS Riffing</title>
    <style type="text/css">
    .popover{
        max-width:600px;
    }
    </style>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Home</a>
        </nav>

        <div class="row">
            <div class="col">
                <h1>Riffing</h1>
                <p>
                    <button type="button" class="btn btn-primary" id="testbutton">Press Me</button>
                    <button type="button" class="btn btn-secondary" id="testbutton2">H Up</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton">Pause Game</button>
                    <div id="dashpanel">
                        <p>Year <span id="years">1</span> | Day <span id="counter"></span></p>
                    </div>
                </p>
            </div>
            <div class="col" id="status-dash">
                <div id="temptext"></div>
                <div id="textlog"></div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});

var hairColors = [
    "brown","black","chestnut","blonde","red"
]

var eyeColors = [
    "brown","blue","grey","green"
]

var girlNames = [
    'Aaliyah', 'Abbigail', 'Abby', 'Abigail', 'Ada', 'Adalyn', 'Addison', 'Addisyn', 'Adelaide', 'Adeline', 'Adelyn', 'Adriana', 'Adrianna', 'Adrienne', 'Aileen', 'Aimee', 'Ainsley', 'Aiyana', 'Alaina', 'Alana', 'Alanna', 'Alayna', 'Aleah', 'Aleena', 'Alejandra', 'Alessandra', 'Alexa', 'Alexandra', 'Alexandria', 'Alexia', 'Alexis', 'Alice', 'Alicia', 'Alina', 'Alisha', 'Alison', 'Alissa', 'Alivia', 'Aliyah', 'Allie', 'Allison', 'Allyson', 'Alma', 'Alondra', 'Alyson', 'Alyssa', 'Amanda', 'Amani', 'Amari', 'Amaya', 'Amber', 'Amelia', 'Amira', 'Amiyah', 'Amy', 'Amya', 'Ana', 'Anabella', 'Anabelle', 'Anahi', 'Anastasia', 'Anaya', 'Andrea', 'Angel', 'Angela', 'Angelica', 'Angelina', 'Angelique', 'Angie', 'Anika', 'Aniya', 'Aniyah', 'Ann', 'Anna', 'Annabella', 'Annabelle', 'Annalise', 'Anne', 'Annie', 'Annika', 'Anya', 'April', 'Arabella', 'Aria', 'Ariana', 'Arianna', 'Ariel', 'Arielle', 'Aryanna', 'Ashlee', 'Ashleigh', 'Ashley', 'Ashlyn', 'Ashlynn', 'Ashton', 'Asia', 'Athena', 'Aubree', 'Aubrey', 'Aubrie', 'Audrey', 'Audrina', 'Aurora', 'Autumn', 'Ava', 'Averie', 'Avery', 'Ayla', 'Aylin', 'Bailee', 'Bailey', 'Barbara', 'Baylee', 'Bella', 'Bethany', 'Bianca', 'Blanca', 'Braelyn', 'Brandi', 'Brandy', 'Breanna', 'Brenda', 'Brenna', 'Bria', 'Briana', 'Brianna', 'Brianne', 'Bridget', 'Brielle', 'Brisa', 'Bristol', 'Britney', 'Brittani', 'Brittany', 'Brittney', 'Brooke', 'Brooklyn', 'Brooklynn', 'Brylee', 'Brynlee', 'Brynn', 'Cadence', 'Caitlin', 'Caitlyn', 'Cali', 'Callie', 'Cameron', 'Camila', 'Camilla', 'Camille', 'Camryn', 'Candace', 'Candice', 'Cara', 'Carissa', 'Carla', 'Carley', 'Carly', 'Carmen', 'Carol', 'Carolina', 'Caroline', 'Carolyn', 'Carrie', 'Casey', 'Cassandra', 'Cassidy', 'Cassie', 'Catherine', 'Caylee', 'Cecilia', 'Celeste', 'Chanel', 'Chantel', 'Charlee', 'Charlie', 'Charlotte', 'Chasity', 'Chelsea', 'Chelsey', 'Chelsie', 'Cheyenne', 'Chloe', 'Christa', 'Christian', 'Christina', 'Christine', 'Christy', 'Ciara', 'Ciera', 'Cierra', 'Cindy', 'Claire', 'Clara', 'Clarissa', 'Claudia', 'Colleen', 'Cora', 'Corinne', 'Cortney', 'Courtney', 'Cristina', 'Crystal', 'Cynthia', 'Daisy', 'Dakota', 'Dana', 'Danica', 'Daniela', 'Daniella', 'Danielle', 'Danika', 'Danna', 'Daphne', 'Dawn', 'Dayana', 'Deanna', 'Deborah', 'Delaney', 'Delilah', 'Denise', 'Desiree', 'Destiny', 'Devin', 'Devon', 'Diamond', 'Diana', 'Diane', 'Dominique', 'Donna', 'Dulce', 'Dylan', 'Ebony', 'Eden', 'Elaina', 'Elaine', 'Eleanor', 'Elena', 'Eliana', 'Elisa', 'Elisabeth', 'Elise', 'Eliza', 'Elizabeth', 'Ella', 'Elle', 'Ellen', 'Elliana', 'Ellie', 'Eloise', 'Emely', 'Emerson', 'Emery', 'Emilee', 'Emilia', 'Emily', 'Emma', 'Erica', 'Ericka', 'Erika', 'Erin', 'Esmeralda', 'Esther', 'Estrella', 'Eva', 'Evangeline', 'Eve', 'Evelyn', 'Faith', 'Farrah', 'Fatima', 'Felicia', 'Fernanda', 'Finley', 'Fiona', 'Frances', 'Francesca', 'Gabriela', 'Gabriella', 'Gabrielle', 'Gemma', 'Genesis', 'Genevieve', 'Georgia', 'Gia', 'Giana', 'Gianna', 'Gina', 'Giselle', 'Giuliana', 'Gloria', 'Grace', 'Gracelyn', 'Gracie', 'Guadalupe', 'Gwendolyn', 'Hadley', 'Hailee', 'Hailey', 'Haley', 'Halle', 'Hallie', 'Hanna', 'Hannah', 'Harley', 'Harmony', 'Harper', 'Hayden', 'Haylee', 'Hayley', 'Hazel', 'Heather', 'Heaven', 'Heidi', 'Helen', 'Helena', 'Hilary', 'Hillary', 'Holly', 'Hope', 'Imani', 'India', 'Irene', 'Iris', 'Isabel', 'Isabela', 'Isabella', 'Isabelle', 'Isla', 'Itzel', 'Ivy', 'Izabella', 'Jaclyn', 'Jacqueline', 'Jacquelyn', 'Jada', 'Jade', 'Jaelyn', 'Jaelynn', 'Jaida', 'Jaime', 'Jaliyah', 'Jamie', 'Jane', 'Janelle', 'Janessa', 'Janet', 'Janiya', 'Janiyah', 'Jasmin', 'Jasmine', 'Jaycee', 'Jayda', 'Jayden', 'Jayla', 'Jayleen', 'Jaylynn', 'Jazlyn', 'Jazmin', 'Jazmine', 'Jeanette', 'Jenna', 'Jennifer', 'Jenny', 'Jessica', 'Jessie', 'Jill', 'Jillian', 'Jimena', 'Joanna', 'Jocelyn', 'Johanna', 'Jordan', 'Jordyn', 'Joselyn', 'Josephine', 'Josie', 'Journey', 'Joy', 'Julia', 'Juliana', 'Julianna', 'Julie', 'Juliet', 'Juliette', 'Julissa', 'June', 'Justice', 'Justine', 'Kadence', 'Kaelyn', 'Kaia', 'Kailey', 'Kailyn', 'Kaitlin', 'Kaitlyn', 'Kaleigh', 'Kali', 'Kaliyah', 'Kamila', 'Kamryn', 'Kara', 'Karen', 'Kari', 'Karina', 'Karissa', 'Karla', 'Kasey', 'Kassandra', 'Kassidy', 'Kate', 'Katelyn', 'Katelynn', 'Katharine', 'Katherine', 'Kathleen', 'Kathryn', 'Katie', 'Katlyn', 'Katrina', 'Kayden', 'Kaydence', 'Kayla', 'Kaylee', 'Kayleigh', 'Kaylie', 'Kaylin', 'Kaylynn', 'Keira', 'Kelley', 'Kelli', 'Kellie', 'Kelly', 'Kelsey', 'Kelsie', 'Kendall', 'Kendra', 'Kenley', 'Kennedi', 'Kennedy', 'Kenzie', 'Khloe', 'Kiana', 'Kiara', 'Kiera', 'Kierra', 'Kiley', 'Kimberly', 'Kimora', 'Kinley', 'Kinsley', 'Kira', 'Kirsten', 'Krista', 'Kristen', 'Kristi', 'Kristin', 'Kristina', 'Kristine', 'Kristy', 'Krystal', 'Kyla', 'Kylee', 'Kyleigh', 'Kylie', 'Kyra', 'Lacey', 'Lacy', 'Laila', 'Lana', 'Laney', 'Larissa', 'Laura', 'Lauren', 'Lauryn', 'Layla', 'Lea', 'Leah', 'Leila', 'Leilani', 'Lena', 'Leslie', 'Lesly', 'Leticia', 'Lexi', 'Lexie', 'Lia', 'Liana', 'Liberty', 'Lila', 'Lilah', 'Lilian', 'Liliana', 'Lillian', 'Lilliana', 'Lillie', 'Lilly', 'Lily', 'Lilyana', 'Linda', 'Lindsay', 'Lindsey', 'Lisa', 'Lizbeth', 'Lola', 'London', 'Londyn', 'Lorelei', 'Lorena', 'Lori', 'Lucia', 'Lucille', 'Lucy', 'Luna', 'Lydia', 'Lyla', 'Lyric', 'Maci', 'Macie', 'Mackenzie', 'Macy', 'Madalyn', 'Madalynn', 'Maddison', 'Madeleine', 'Madeline', 'Madelyn', 'Madelynn', 'Madilyn', 'Madilynn', 'Madison', 'Madisyn', 'Madyson', 'Maeve', 'Maggie', 'Makayla', 'Makenna', 'Makenzie', 'Malia', 'Maliyah', 'Mallory', 'Margaret', 'Maria', 'Mariah', 'Mariana', 'Maribel', 'Marie', 'Marilyn', 'Marina', 'Marisa', 'Marisol', 'Marissa', 'Maritza', 'Marlee', 'Marlene', 'Marley', 'Martha', 'Mary', 'Maya', 'Mayra', 'Mckenna', 'Mckenzie', 'Mckinley', 'Meagan', 'Meaghan', 'Megan', 'Meghan', 'Melanie', 'Melany', 'Melina', 'Melinda', 'Melissa', 'Melody', 'Mercedes', 'Meredith', 'Mia', 'Michaela', 'Michele', 'Michelle', 'Mikaela', 'Mikayla', 'Mila', 'Miley', 'Miracle', 'Miranda', 'Miriam', 'Misty', 'Molly', 'Monica', 'Monique', 'Morgan', 'Mya', 'Myla', 'Nadia', 'Nancy', 'Naomi', 'Natalee', 'Natalia', 'Natalie', 'Nataly', 'Natasha', 'Nayeli', 'Nevaeh', 'Nia', 'Nichole', 'Nicole', 'Nicolette', 'Nikki', 'Nina', 'Noelle', 'Nora', 'Norah', 'Nyla', 'Olive', 'Olivia', 'Paige', 'Paisley', 'Pamela', 'Paola', 'Paris', 'Parker', 'Patricia', 'Paula', 'Payton', 'Penelope', 'Peyton', 'Phoebe', 'Piper', 'Presley', 'Priscilla', 'Quinn', 'Rachael', 'Rachel', 'Rachelle', 'Raegan', 'Randi', 'Raquel', 'Raven', 'Reagan', 'Rebecca', 'Rebekah', 'Reese', 'Regina', 'Renee', 'Rihanna', 'Riley', 'Robin', 'Robyn', 'Rosa', 'Rosalie', 'Rose', 'Rowan', 'Ruby', 'Ruth', 'Rylee', 'Ryleigh', 'Rylie', 'Sabrina', 'Sadie', 'Sage', 'Samantha', 'Sandra', 'Saniyah', 'Sara', 'Sarah', 'Sarai', 'Sasha', 'Savanna', 'Savannah', 'Scarlet', 'Scarlett', 'Selena', 'Serena', 'Serenity', 'Shaina', 'Shana', 'Shanice', 'Shaniqua', 'Shaniya', 'Shannon', 'Sharon', 'Shawna', 'Shayla', 'Shayna', 'Sheila', 'Shelby', 'Sienna', 'Sierra', 'Simone', 'Skye', 'Skyla', 'Skylar', 'Skyler', 'Sloane', 'Sofia', 'Sonia', 'Sophia', 'Sophie', 'Stacey', 'Stacy', 'Stefanie', 'Stella', 'Stephanie', 'Summer', 'Susan', 'Sydney', 'Sylvia', 'Tabitha', 'Talia', 'Tamara', 'Tania', 'Tanisha', 'Tanya', 'Tara', 'Taryn', 'Tasha', 'Tatiana', 'Tatum', 'Tayler', 'Taylor', 'Teagan', 'Tenley', 'Teresa', 'Tessa', 'Theresa', 'Tia', 'Tiana', 'Tiara', 'Tierra', 'Tiffany', 'Tina', 'Toni', 'Tori', 'Tracy', 'Trinity', 'Trisha', 'Tyler', 'Valentina', 'Valeria', 'Valerie', 'Vanessa', 'Veronica', 'Victoria', 'Violet', 'Virginia', 'Vivian', 'Viviana', 'Vivienne', 'Wendy', 'Whitney', 'Willow', 'Ximena', 'Yareli', 'Yasmin', 'Yesenia', 'Yolanda', 'Yvette', 'Yvonne', 'Zariah', 'Zoe', 'Zoey', 'Zoie'
]

var romanticTypes = [
    {
        "title":"happy people",
        "description":"person is attracted to happy people",
        typeTest: function(persona, personb) {
            if (personb.happiness >= 1000) {
                return 1;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"beautiful people",
        "description":"person is attracted to beautiful people",
        typeTest: function(persona, personb) {
            if (personb.beauty >= 8) {
                return 1;
            } else if (personb.beauty <=4) {
                return -1;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"bimbos",
        "description":"person is attracted to beautiful dumb people",
        typeTest: function(persona, personb) {
            if (personb.beauty >= 7 && personb.intellect <= 3) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"likes a challenge",
        "description":"person is attracted to people who don't like her",
        typeTest: function(persona, personb) {
            if (personb.relationships[npc.indexOf(persona)] < 0) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"pedo",
        "description":"person is attracted to prepubescent",
        typeTest: function(persona, personb) {
            if (personb.ageInYears < 11) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"idealist",
        "description":"person wants it all",
        typeTest: function(persona, personb) {
            if (personb.beauty>=7 && personb.intellect>=7 && personb.social>=7 && personb.athletics>=7) {
                return 2;
            } else {
                return 0;
            }
        }
    },
    {
        "title":"smart people",
        "description":"person is attracted to smart people",
        typeTest: function(persona, personb) {
            if (personb.intellect >= 8) {
                return 1;
            } else if (personb.intellect <= 4) {
                return -1;
            } else {
                return 0;
            }
        }
    }
];

var activities = [
    {
        "nom":"read",
        "flavortext":" is reading.",
        "intellum":9
    },
    {
        "nom":"watchtv",
        "flavortext":" is watching TV.",
        "intellum":2
    },
    {
        "nom":"instagram",
        "flavortext":" is surfing Instagram.",
        "intellum":3
    },
    {
        "nom":"tv",
        "flavortext":" is watching TV.",
        "intellum":4
    },
    {
        "nom":"cinema",
        "flavortext":" is watching a film.",
        "intellum":6
    }
];

var paused = false;
var minAge = 5;
var maxAge = 13;
var characterCount = 8;
var loopTime = 100;
var npc = [];
var counter = 0;

function person(firstname, age, gender) {
    this.firstName = firstname;
    this.birthday = Math.floor(Math.random() * 365);
    this.ageInDays = (age*365 + (365-this.birthday));
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        return a;};
    this.hair = pickFrom(hairColors);
    this.eyes = pickFrom(eyeColors);
    this.happiness = 0;
    this.beauty = randomInt(1, 10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.honor = randomInt(1, 10);
    this.relationships = [];
    this.attractions = [];
    this.romance = [];
    this.gender = gender;
    this.myTypes = [];
    this.romances = [];
    this.rTwo = [];
    this.summary = function(n) {
        return this.rTwo[n];
    }
};

function rType(n) {
    this.originalIndex = n;
    this.friendship = 0;
    this.attraction = 0;
    this.romance = 0;
    this.commitment = 0;
    this.interactions = 0;
};

console.log(romanticTypes);

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

function interactWith(persona, personb) {
    if (persona.rTwo[npc.indexOf(personb)] == undefined) {
        persona.rTwo[npc.indexOf(personb)] = new rType(npc.indexOf(personb));
        personb.rTwo[npc.indexOf(persona)] = new rType(npc.indexOf(persona));
        persona.relationships[npc.indexOf(personb)] = 0;
        personb.relationships[npc.indexOf(persona)] = 0;
    }

    pleasure = randomInt(5, 15) - findDiff(persona.social, personb.social) - findDiff(persona.intellect, personb.intellect) - findDiff(persona.athletics, personb.athletics);

    // adjust each person's relationship level according to the pleasure quotient
    persona.relationships[npc.indexOf(personb)] += pleasure;
    persona.rTwo[npc.indexOf(personb)].friendship += pleasure;
    persona.rTwo[npc.indexOf(personb)].interactions ++;
    personb.relationships[npc.indexOf(persona)] += pleasure;
    personb.rTwo[npc.indexOf(persona)].friendship += pleasure;
    personb.rTwo[npc.indexOf(persona)].interactions ++;

    // adjust for physical attractiveness
    if (persona.beauty > personb.beauty) {
        personb.relationships[npc.indexOf(persona)] += persona.beauty - personb.beauty;
        personb.rTwo[npc.indexOf(persona)].friendship += persona.beauty - personb.beauty;
    } else {
        persona.relationships[npc.indexOf(personb)] += personb.beauty - persona.beauty;
        persona.rTwo[npc.indexOf(personb)].friendship += personb.beauty - persona.beauty;
    }
    // test and adjust for romantic attraction
    if (pleasure > 3) {
        if (persona.attractions[npc.indexOf(personb)] != undefined) {
            bonus = 1;
            if (personb.beauty > 7 || (personb.beauty - persona.beauty) > 2) {
                bonus ++;
            }
            for (k=0;k<persona.myTypes.length;k++) {
                bonus += persona.myTypes[k].typeTest(persona, personb);
                /* if (persona.myTypes[k].typeTest(persona, personb) != 0) {
                    console.log(persona.firstName + " " + persona.myTypes[k].title + " " + personb.firstName + " " + persona.myTypes[k].typeTest(persona, personb));
                } */
            }
            persona.attractions[npc.indexOf(personb)] += bonus;
            persona.rTwo[npc.indexOf(personb)].attraction += bonus;
            if (persona.attractions[npc.indexOf(personb)] > 100) {
                if (randomInt(1,3) == 1) {
                    $("#temptext").html(persona.firstName + " reaches out to kiss " + personb.firstName + ". ");
                    if (personb.attractions[npc.indexOf(persona)] > 50) {
                        $("#temptext").append(personb.firstName + " kisses her back.<br>");
                    } else {
                        $("#temptext").append(personb.firstName + " pulls away.<br>");
                    }
                }
            }
        } else {
            persona.attractions[npc.indexOf(personb)] = 1;
        }
    }
}

function whupEee(persona, personb) {

}

function relationshipDescriptors(number) {
    if (number > 1000) {
        return " loves ";
    } else if (number > 200) {
        return " likes ";
    } else if (number < -1000) {
        return " hates ";
    } else if (number < -200) {
        return " dislikes ";
    } else {
        return " has no opinion of ";
    }
}

function describeRelationship(persona, personb) {
    var description = "";
    if (persona.rTwo[npc.indexOf(personb)] == undefined) {
        return 0;
    } else if (persona.rTwo[npc.indexOf(personb)].friendship > 100 && personb.rTwo[npc.indexOf(persona)].friendship > 100) {
        description += (persona.firstName + " is friends with " + personb.firstName + ". ");
    } else if (persona.rTwo[npc.indexOf(personb)].friendship < -100) {
        description += (persona.firstName + " dislikes " + personb.firstName + ". ");
    } else {
        description += (persona.firstName + " has met " + personb.firstName + ". ");
    }
    if (persona.rTwo[npc.indexOf(personb)].attraction > 100) {
        description += (persona.firstName + " is attracted to " + personb.firstName + ". ");
    }
    return description;
}

function describeCharacter(n) {
    var p = n;
    var d = "";
    d += ("Her hair is " + p.hair + ". ");
    d += ("Her eyes are " + p.eyes + ". ");
    if (p.beauty >= 9) {
        d+= ("She is quite beautiful. ");
    } else if (p.beauty >= 7) {
        d+= ("She is pretty.");
    } else if (p.beauty <= 2) {
        d+=("She is very ugly.")
    } else if (p.beauty <= 4) {
        d+=("She is unattractive.");
    }
    return d;
}

function createCharacter() {
    var jk = new person(pickFrom(girlNames), randomAge(), 0);
    var c = randomInt(2, 5);
        for (k=0;k<c;k++) {
            jk.myTypes.push(pickFrom(romanticTypes));
        }
    return jk;
}

function addNPC() {
    npc.push(createCharacter());
    console.log("added");
}

function meetPeople() {
    for (i=0;i<npc.length;i++) {
        m = pickFrom(npc);
        while (npc.indexOf(m) == i) {
            m = pickFrom(npc);
        }
        interactWith(npc[i], m);
    }
}

function meetPeopleTwo() {
    for (var i=0;i<npc.length;i++) {
        var iter = i;
        var p = [];
        for (j=0;j<npc.length;j++) {
            r = npc[iter].summary(j);
            if (r != undefined) {
                p.push(r.friendship);
            } else {
                p.push(1);
            }
        }
        var u = weightedChooser(npc, p);
        //console.log(p);
        while (npc.indexOf(u) == iter) {
            u = weightedChooser(npc, p);
        }
        interactWith(npc[iter], u);
        //console.log(npc[iter].firstName + " is interacting with " + u.firstName);
    }
}

function gameStart() {
    gameSetup();
    setInterval(function() {
        if (paused == false) {
        gameLoop();
        }
    }, loopTime);
}

function gameSetup() {
    for (var i=0;i<characterCount;i++) {
        addNPC();
    }
    for (i=0;i<npc.length;i++) {
        $("#dashpanel").append(
            "<hr><div class='row' id='npc"+i+"'><div class='col-8'>Name: <span id='npcname" + i + "'><strong>" + npc[i].firstName + "</strong></span><br>" +
            "Age in years: <span id='npcyears" + i + "'>"  + npc[i].ageInYears() + "</span><br>" +
            "Happiness quotient: <span id='npchappy" +i+"'>" + npc[i].happiness + "</span><br>" +
            "<span id='npcactivity"+i+"'></span><br>" +
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover click" data-offset="5" data-html="true" title="Relationships" data-content="Some content inside the popover" id="npcrel' + i + '">Relationships</a></div>' +
            "<div class='col-4'>Beauty: "+npc[i].beauty+"<br>Athletics: "+npc[i].athletics+"<br>Intellect: "+npc[i].intellect+"<br>Social: "+npc[i].social+"<br>" + 
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover click" data-offset="5" data-html="true" title="Description" data-content="Some content inside the popover" id="npcdesc' + i + '">Description</a>' + 
            "</div>"+"</div>"
        );
    }
}

function gameLoop() {
    updateDash();
    dayEnd();
}

function dayEnd() {
    for (var i = 0; i < npc.length; i++) {
        npc[i].ageInDays +=1;
        $("#npcactivity" + i).html(npc[i].firstName + resolveActivity(npc[i]));
    }
    counter++;
    $("#counter").text(counter);
    $("#years").text(Math.floor(counter/365) + 1);
    //meetPeople();
    meetPeopleTwo();
}

function resolveActivity(character) {
    var m = pickFrom(activities);
    var hchange = 5 - findDiff(character.intellect, m.intellum);
    character.happiness += hchange;
    return m.flavortext;
}

function pauseGame() {
    if (paused == false) {
        paused = true;
    } else {
        paused = false;
    }
}

function updateDash() {
    for (var i = 0; i < npc.length; i++) {
        $("#npchappy" + i).html(npc[i].happiness + " | " + (npc[i].happiness/counter).toFixed(2) + " hpd");
        $("#npcyears" + i).html(npc[i].ageInYears());
        var des = "";
        for (var j = 0; j < npc.length; j++) {
            var mip = npc[j];
            if (describeRelationship(npc[i], npc[j]) != 0) {
                des += (describeRelationship(npc[i], npc[j]) + "<br>");
            }
        }
        var des2 = describeCharacter(npc[i]);
        $("#npcrel" + i).attr("data-content", des);
        $("#npcdesc" + i).attr("data-content", des2);
    }
}

function printStats() {
    console.log(counter);
    console.log(npc);
}

$(document).ready(gameStart());

$("#testbutton").click(function() {printStats();});
$("#testbutton2").click(function() {npc[1].happiness += 1;});
$("#pausebutton").click(function() {pauseGame();});

</script>
  </body>
</html>