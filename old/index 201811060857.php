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
                    <button type="button" class="btn btn-secondary" id="testbutton2">S Up</button>
                    <button type="button" class="btn btn-secondary" id="testbutton3">S Down</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton">Pause Game</button>
                    <div id="dashpanel">
                        <p>Year <span id="years">1</span> | Day <span id="counter"></span></p>
                    </div>
                </p>
            </div>
            <div class="col" id="status-dash">
                <div id="temptext" style="height: 100px"></div>
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
    'Aaliyah', 'Abbey', 'Abbie', 'Abbigail', 'Abby', 'Abigail', 'Abril', 'Ada', 'Adaline', 'Adalyn', 'Adalynn', 'Addilyn', 'Addison', 'Addisyn', 'Addyson', 'Adelaide', 'Adelina', 'Adeline', 'Adelyn', 'Adelynn', 'Adrian', 'Adriana', 'Adrianna', 'Adrianne', 'Adrienne', 'Aileen', 'Aimee', 'Ainsley', 'Aisha', 'Aja', 'Alaina', 'Alana', 'Alani', 'Alanna', 'Alayna', 'Aleah', 'Aleena', 'Alejandra', 'Alessandra', 'Alexa', 'Alexandra', 'Alexandrea', 'Alexandria', 'Alexia', 'Alexis', 'Alexus', 'Alice', 'Alicia', 'Alina', 'Alisa', 'Alisha', 'Alison', 'Alissa', 'Alivia', 'Aliyah', 'Allie', 'Allison', 'Allisson', 'Ally', 'Allyson', 'Alma', 'Alondra', 'Alysha', 'Alyson', 'Alyssa', 'Amanda', 'Amara', 'Amari', 'Amaya', 'Amber', 'Amelia', 'America', 'Amie', 'Amina', 'Amira', 'Amiyah', 'Amy', 'Amya', 'Ana', 'Anabelle', 'Anahi', 'Analia', 'Anastasia', 'Anaya', 'Andrea', 'Angel', 'Angela', 'Angelia', 'Angelica', 'Angelina', 'Angelique', 'Angie', 'Anika', 'Anissa', 'Anita', 'Anitra', 'Aniya', 'Aniyah', 'Ann', 'Anna', 'Annabel', 'Annabella', 'Annabelle', 'Annalise', 'Anne', 'Annette', 'Annie', 'Annika', 'Antoinette', 'Antonia', 'Anya', 'April', 'Arabella', 'Araceli', 'Aria', 'Ariah', 'Ariana', 'Arianna', 'Ariel', 'Ariella', 'Arielle', 'Ariyah', 'Arlene', 'Arya', 'Ashanti', 'Ashely', 'Ashlee', 'Ashleigh', 'Ashley', 'Ashlie', 'Ashly', 'Ashlyn', 'Ashlynn', 'Ashton', 'Asia', 'Aspen', 'Athena', 'Aubree', 'Aubrey', 'Aubrie', 'Audra', 'Audrey', 'Audrina', 'Aurora', 'Autumn', 'Ava', 'Averie', 'Avery', 'Aviana', 'Avianna', 'Ayanna', 'Ayla', 'Aylin', 'Bailee', 'Bailey', 'Barbara', 'Baylee', 'Beatrice', 'Beatriz', 'Becky', 'Belinda', 'Bella', 'Bernadette', 'Beth', 'Bethany', 'Betsy', 'Betty', 'Beverly', 'Bianca', 'Billie', 'Blair', 'Blake', 'Blakely', 'Blanca', 'Bobbi', 'Bobbie', 'Bonnie', 'Braelyn', 'Braelynn', 'Brandi', 'Brandie', 'Brandy', 'Breana', 'Breanna', 'Breanne', 'Brenda', 'Brenna', 'Bria', 'Briana', 'Brianna', 'Brianne', 'Bridget', 'Bridgett', 'Bridgette', 'Briella', 'Brielle', 'Brinley', 'Brisa', 'Bristol', 'Britany', 'Britney', 'Brittani', 'Brittany', 'Brittney', 'Brittni', 'Brook', 'Brooke', 'Brooklyn', 'Brooklynn', 'Bryanna', 'Brylee', 'Brynlee', 'Brynn', 'Cadence', 'Caitlin', 'Caitlyn', 'Cali', 'Calista', 'Callie', 'Cameron', 'Camila', 'Camilla', 'Camille', 'Camryn', 'Candace', 'Candice', 'Candy', 'Cara', 'Carey', 'Cari', 'Carina', 'Carissa', 'Carla', 'Carley', 'Carlie', 'Carly', 'Carmen', 'Carol', 'Carolina', 'Caroline', 'Carolyn', 'Carrie', 'Carter', 'Casandra', 'Casey', 'Cassandra', 'Cassidy', 'Cassie', 'Cataleya', 'Catalina', 'Catherine', 'Cathy', 'Catrina', 'Cayla', 'Caylee', 'Cecilia', 'Cecily', 'Celeste', 'Celia', 'Celina', 'Celine', 'Chanda', 'Chandler', 'Chandra', 'Chanel', 'Chantel', 'Charity', 'Charlee', 'Charleigh', 'Charlene', 'Charley', 'Charlie', 'Charlotte', 'Chasity', 'Chastity', 'Chelsea', 'Chelsey', 'Chelsie', 'Cheri', 'Cherie', 'Cheryl', 'Cheyanne', 'Cheyenne', 'Chloe', 'Chrissy', 'Christa', 'Christen', 'Christi', 'Christian', 'Christie', 'Christin', 'Christina', 'Christine', 'Christopher', 'Christy', 'Chrystal', 'Chyna', 'Ciara', 'Ciera', 'Cierra', 'Cindy', 'Claire', 'Clara', 'Clare', 'Clarissa', 'Claudia', 'Colette', 'Colleen', 'Connie', 'Constance', 'Cora', 'Corinne', 'Cortney', 'Courtney', 'Cristal', 'Cristina', 'Cristy', 'Crystal', 'Cynthia', 'Dahlia', 'Daisy', 'Dakota', 'Daleyza', 'Dalia', 'Dana', 'Danica', 'Daniela', 'Daniella', 'Danielle', 'Danika', 'Danna', 'Daphne', 'Dara', 'Darby', 'Darcy', 'Darian', 'Darla', 'Darlene', 'Dawn', 'Dayana', 'Dayanara', 'Dayna', 'Deana', 'Deanna', 'Debbie', 'Deborah', 'Debra', 'Deja', 'Delaney', 'Delilah', 'Demetria', 'Demi', 'Dena', 'Denise', 'Desirae', 'Desiree', 'Destinee', 'Destiny', 'Devin', 'Devon', 'Diamond', 'Diana', 'Diane', 'Dianna', 'Dina', 'Dominique', 'Donna', 'Dora', 'Doris', 'Dorothy', 'Dulce', 'Dylan', 'Ebony', 'Eden', 'Edith', 'Eileen', 'Elaina', 'Elaine', 'Eleanor', 'Elena', 'Eliana', 'Elianna', 'Elisa', 'Elisabeth', 'Elise', 'Elisha', 'Elissa', 'Eliza', 'Elizabeth', 'Ella', 'Elle', 'Ellen', 'Elliana', 'Ellie', 'Eloise', 'Elsa', 'Elsie', 'Elyse', 'Ember', 'Emely', 'Emerson', 'Emersyn', 'Emery', 'Emilee', 'Emilia', 'Emilie', 'Emily', 'Emma', 'Emmalyn', 'Erica', 'Ericka', 'Erika', 'Erin', 'Esmeralda', 'Esperanza', 'Essence', 'Esther', 'Estrella', 'Eva', 'Evangeline', 'Eve', 'Evelyn', 'Evelynn', 'Everleigh', 'Everly', 'Evie', 'Faith', 'Fallon', 'Farrah', 'Fatima', 'Felicia', 'Felicity', 'Fernanda', 'Finley', 'Fiona', 'Frances', 'Francesca', 'Freya', 'Gabriela', 'Gabriella', 'Gabrielle', 'Gail', 'Gemma', 'Gena', 'Genesis', 'Genevieve', 'Georgia', 'Gia', 'Gianna', 'Gillian', 'Gina', 'Ginger', 'Giselle', 'Gisselle', 'Giuliana', 'Glenda', 'Gloria', 'Grace', 'Gracelyn', 'Gracelynn', 'Gracie', 'Gretchen', 'Guadalupe', 'Gwendolyn', 'Hadley', 'Hailee', 'Hailey', 'Hailie', 'Haleigh', 'Haley', 'Halle', 'Hallie', 'Hanna', 'Hannah', 'Harley', 'Harlow', 'Harmony', 'Harper', 'Hattie', 'Haven', 'Hayden', 'Haylee', 'Hayley', 'Haylie', 'Hazel', 'Heather', 'Heaven', 'Heidi', 'Helen', 'Helena', 'Henley', 'Hilary', 'Hillary', 'Hollie', 'Holly', 'Hope', 'Hunter', 'Iesha', 'Imani', 'India', 'Infant', 'Ingrid', 'Irene', 'Iris', 'Irma', 'Isabel', 'Isabela', 'Isabella', 'Isabelle', 'Isis', 'Isla', 'Itzel', 'Ivy', 'Izabella', 'Jackie', 'Jacklyn', 'Jaclyn', 'Jacqueline', 'Jacquelyn', 'Jada', 'Jade', 'Jaden', 'Jadyn', 'Jaelyn', 'Jaiden', 'Jailene', 'Jaime', 'Jaimie', 'Jaleesa', 'Jalisa', 'Jaliyah', 'Jami', 'Jamie', 'Jana', 'Janae', 'Janay', 'Jane', 'Janel', 'Janell', 'Janelle', 'Janet', 'Janette', 'Janice', 'Janie', 'Janine', 'Janiya', 'Janiyah', 'Janna', 'Jaqueline', 'Jaslene', 'Jasmin', 'Jasmine', 'Jayda', 'Jayden', 'Jayla', 'Jaylah', 'Jayleen', 'Jaylynn', 'Jayme', 'Jazlyn', 'Jazmin', 'Jazmine', 'Jean', 'Jeanette', 'Jeanine', 'Jeanne', 'Jeannette', 'Jeannie', 'Jena', 'Jenifer', 'Jenna', 'Jennie', 'Jennifer', 'Jenny', 'Jesse', 'Jessica', 'Jessie', 'Jill', 'Jillian', 'Jimena', 'Jo', 'Joan', 'Joann', 'Joanna', 'Joanne', 'Jocelyn', 'Jodi', 'Jodie', 'Jody', 'Johanna', 'Jolene', 'Joni', 'Jordan', 'Jordyn', 'Joselyn', 'Josephine', 'Josie', 'Journee', 'Journey', 'Joy', 'Joyce', 'Juanita', 'Judith', 'Judy', 'Julia', 'Juliana', 'Julianna', 'Julianne', 'Julie', 'Juliet', 'Juliette', 'Julissa', 'June', 'Juniper', 'Justice', 'Justine', 'Kacie', 'Kadence', 'Kaelyn', 'Kaia', 'Kaila', 'Kailee', 'Kailey', 'Kailyn', 'Kaitlin', 'Kaitlyn', 'Kaitlynn', 'Kala', 'Kaleigh', 'Kaley', 'Kali', 'Kaliyah', 'Kamila', 'Kamryn', 'Kara', 'Karen', 'Kari', 'Karin', 'Karina', 'Karissa', 'Karla', 'Karrie', 'Kasey', 'Kassandra', 'Kassidy', 'Katarina', 'Kate', 'Katelyn', 'Katelynn', 'Katharine', 'Katherine', 'Kathleen', 'Kathryn', 'Kathy', 'Katie', 'Katina', 'Katlyn', 'Katrina', 'Katy', 'Kayden', 'Kaydence', 'Kayla', 'Kaylee', 'Kayleigh', 'Kaylie', 'Kaylin', 'Keely', 'Kehlani', 'Keira', 'Keisha', 'Kelley', 'Kelli', 'Kellie', 'Kelly', 'Kelsey', 'Kelsi', 'Kelsie', 'Kendall', 'Kendra', 'Kenley', 'Kennedi', 'Kennedy', 'Kensley', 'Kenya', 'Kenzie', 'Keri', 'Kerri', 'Kerrie', 'Kerry', 'Keshia', 'Khadijah', 'Khloe', 'Kiana', 'Kiara', 'Kiera', 'Kierra', 'Kiersten', 'Kiley', 'Kim', 'Kimberlee', 'Kimberley', 'Kimberly', 'Kimora', 'Kinley', 'Kinsley', 'Kira', 'Kirby', 'Kirsten', 'Kirstie', 'Kisha', 'Kizzy', 'Kourtney', 'Krista', 'Kristal', 'Kristen', 'Kristi', 'Kristie', 'Kristin', 'Kristina', 'Kristine', 'Kristy', 'Krystal', 'Krystina', 'Krystle', 'Kyla', 'Kylee', 'Kyleigh', 'Kylie', 'Kyra', 'Lacey', 'Laci', 'Lacie', 'Lacy', 'Ladonna', 'Laila', 'Lainey', 'Lakeisha', 'Lakesha', 'Lakisha', 'Lana', 'Laney', 'Lara', 'Larissa', 'Lashonda', 'Latanya', 'Latasha', 'Latisha', 'Latonya', 'Latosha', 'Latoya', 'Latrice', 'Laura', 'Laurel', 'Lauren', 'Laurie', 'Lauryn', 'Lawanda', 'Layla', 'Lea', 'Leah', 'Leann', 'Leanna', 'Leanne', 'Lee', 'Leeann', 'Leia', 'Leigh', 'Leighton', 'Leila', 'Leilani', 'Lena', 'Lennon', 'Lesley', 'Leslie', 'Lesly', 'Leticia', 'Lexi', 'Lexie', 'Lexus', 'Lia', 'Liana', 'Liberty', 'Lila', 'Lilah', 'Lilian', 'Liliana', 'Lilith', 'Lillian', 'Lilliana', 'Lillie', 'Lilly', 'Lily', 'Lilyana', 'Linda', 'Lindsay', 'Lindsey', 'Lisa', 'Litzy', 'Liza', 'Lizbeth', 'Lizette', 'Logan', 'Lola', 'London', 'Londyn', 'Lora', 'Lorelei', 'Lorena', 'Loretta', 'Lori', 'Lorie', 'Lorraine', 'Lucia', 'Luciana', 'Lucille', 'Lucy', 'Luna', 'Luz', 'Lydia', 'Lyla', 'Lynda', 'Lyndsay', 'Lyndsey', 'Lynette', 'Lynn', 'Lyric', 'Mabel', 'Macey', 'Maci', 'Macie', 'Mackenzie', 'Macy', 'Madalyn', 'Maddison', 'Madeleine', 'Madeline', 'Madelyn', 'Madelynn', 'Madilyn', 'Madilynn', 'Madison', 'Madisyn', 'Madyson', 'Maegan', 'Maeve', 'Maggie', 'Magnolia', 'Maia', 'Maisie', 'Makayla', 'Makenna', 'Makenzie', 'Malaysia', 'Malia', 'Malinda', 'Maliyah', 'Mallory', 'Mandi', 'Mandy', 'Maranda', 'Marcella', 'Marci', 'Marcia', 'Marcie', 'Marcy', 'Marely', 'Margaret', 'Margarita', 'Margot', 'Maria', 'Mariah', 'Mariana', 'Marianne', 'Maribel', 'Maricela', 'Marie', 'Mariela', 'Marilyn', 'Marina', 'Marisa', 'Marisol', 'Marissa', 'Maritza', 'Marjorie', 'Marla', 'Marlee', 'Marlena', 'Marlene', 'Marley', 'Marquita', 'Marsha', 'Martha', 'Mary', 'Maryam', 'Matilda', 'Maureen', 'Maya', 'Mayra', 'Mckayla', 'Mckenna', 'Mckenzie', 'Mckinley', 'Meagan', 'Meaghan', 'Megan', 'Meghan', 'Melanie', 'Melany', 'Melina', 'Melinda', 'Melisa', 'Melissa', 'Melody', 'Mercedes', 'Meredith', 'Mia', 'Micaela', 'Michaela', 'Michele', 'Michelle', 'Mikaela', 'Mikayla', 'Mila', 'Miley', 'Millie', 'Mindy', 'Mira', 'Miracle', 'Miranda', 'Mireya', 'Miriam', 'Misti', 'Misty', 'Mollie', 'Molly', 'Monica', 'Monique', 'Montana', 'Morgan', 'Moriah', 'Mya', 'Myla', 'Mylee', 'Myra', 'Nadia', 'Nadine', 'Nakia', 'Nancy', 'Naomi', 'Natalee', 'Natalia', 'Natalie', 'Nataly', 'Natasha', 'Nathalie', 'Nayeli', 'Nevaeh', 'Nia', 'Nichole', 'Nicole', 'Nicolette', 'Nikita', 'Nikki', 'Nina', 'Noelle', 'Noemi', 'Nora', 'Norah', 'Norma', 'Nova', 'Nyah', 'Nyla', 'Nylah', 'Oakley', 'Octavia', 'Olga', 'Olive', 'Olivia', 'Ophelia', 'Paige', 'Paislee', 'Paisley', 'Pamela', 'Paola', 'Paris', 'Parker', 'Patrice', 'Patricia', 'Paula', 'Paulina', 'Payton', 'Peggy', 'Penelope', 'Penny', 'Perla', 'Peyton', 'Phoebe', 'Phoenix', 'Piper', 'Precious', 'Presley', 'Priscilla', 'Quinn', 'Rachael', 'Rachel', 'Rachelle', 'Raegan', 'Raelyn', 'Raelynn', 'Ramona', 'Randi', 'Raquel', 'Raven', 'Reagan', 'Rebecca', 'Rebekah', 'Reese', 'Regan', 'Regina', 'Remi', 'Remington', 'Renata', 'Renee', 'Rhiannon', 'Rhonda', 'Rihanna', 'Riley', 'Rita', 'River', 'Roberta', 'Robin', 'Robyn', 'Rochelle', 'Ronda', 'Rosa', 'Rosalie', 'Rosanna', 'Rose', 'Rosemary', 'Rowan', 'Roxanne', 'Royalty', 'Rubi', 'Ruby', 'Ruth', 'Ryan', 'Rylee', 'Ryleigh', 'Rylie', 'Sabrina', 'Sade', 'Sadie', 'Sage', 'Sally', 'Samantha', 'Samara', 'Sandra', 'Sandy', 'Saniya', 'Saniyah', 'Sara', 'Sarah', 'Sarai', 'Sasha', 'Savanah', 'Savanna', 'Savannah', 'Sawyer', 'Saylor', 'Scarlet', 'Scarlett', 'Selah', 'Selena', 'Selina', 'Serena', 'Serenity', 'Shaina', 'Shameka', 'Shamika', 'Shana', 'Shanda', 'Shania', 'Shanice', 'Shanika', 'Shaniqua', 'Shanna', 'Shannon', 'Shantel', 'Shari', 'Sharon', 'Shauna', 'Shawn', 'Shawna', 'Shayla', 'Shayna', 'Sheena', 'Sheila', 'Shelbi', 'Shelby', 'Shelia', 'Shelley', 'Shelly', 'Sheri', 'Sherlyn', 'Sherri', 'Sherrie', 'Sherry', 'Sheryl', 'Shirley', 'Shonda', 'Shyanne', 'Sidney', 'Sienna', 'Sierra', 'Silvia', 'Simone', 'Skye', 'Skyla', 'Skylar', 'Skyler', 'Sloane', 'Sofia', 'Sommer', 'Sonia', 'Sonja', 'Sonya', 'Sophia', 'Sophie', 'Stacey', 'Staci', 'Stacie', 'Stacy', 'Stefanie', 'Stella', 'Stephani', 'Stephanie', 'Stephany', 'Summer', 'Susan', 'Susana', 'Suzanne', 'Sydney', 'Sylvia', 'Tabatha', 'Tabitha', 'Talia', 'Tamara', 'Tameka', 'Tami', 'Tamia', 'Tamika', 'Tamiko', 'Tammi', 'Tammie', 'Tammy', 'Tania', 'Tanisha', 'Tanya', 'Tara', 'Taryn', 'Tasha', 'Tatiana', 'Tatum', 'Tatyana', 'Tayler', 'Taylor', 'Teagan', 'Tenley', 'Tennille', 'Tera', 'Teresa', 'Teri', 'Terra', 'Terri', 'Terry', 'Tess', 'Tessa', 'Thalia', 'Thea', 'Theresa', 'Tia', 'Tiana', 'Tianna', 'Tiara', 'Tierra', 'Tiffani', 'Tiffanie', 'Tiffany', 'Tina', 'Tisha', 'Tomeka', 'Toni', 'Tonia', 'Tonya', 'Tori', 'Tosha', 'Tracey', 'Traci', 'Tracie', 'Tracy', 'Tricia', 'Trina', 'Trinity', 'Trisha', 'Trista', 'Tyler', 'Tyra', 'Valentina', 'Valeria', 'Valerie', 'Vanessa', 'Vera', 'Veronica', 'Vicki', 'Vickie', 'Vicky', 'Victoria', 'Violet', 'Virginia', 'Vivian', 'Viviana', 'Vivienne', 'Wanda', 'Wendi', 'Wendy', 'Whitley', 'Whitney', 'Willa', 'Willow', 'Winter', 'Wren', 'Ximena', 'Yadira', 'Yaretzi', 'Yasmin', 'Yasmine', 'Yesenia', 'Yolanda', 'Yoselin', 'Yulissa', 'Yvette', 'Yvonne', 'Zara', 'Zaria', 'Zariah', 'Zoe', 'Zoey', 'Zuri', 'Zoie'
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

var socialNorms = [ // 1 means don't do it; 0 means ok
    {
        "title":"incest",
        "description":"no sex with relatives",
        normTest: function(persona, personb) {
            if (persona.relatives[npc.indexOf(personb)] != undefined) {
                //console.log("inc test failed");
                return 1;
            } else {
                //console.log("inc test passed");
                return 0;
            }
        }
    },
    {
        "title":"awakening",
        "description":"at least a minimum age",
        normTest: function(persona, personb) {
            if (persona.ageInYears() <= 8 || personb.ageInYears() <= 8) {
                //console.log("inc test failed");
                return 1;
            } else {
                //console.log("inc test passed");
                return 0;
            }
        }
    },
    {
        "title":"monogamy",
        "description":"don't cheat",
        normTest: function(persona, personb) {
            var sigo = commitmentCheck(persona, personb);

            //console.log("monogamy testing");
            /* for (var i=0;i<persona.rTwo.length;i++) {
                if (persona.rTwo[i] != undefined) {
                    if ((persona.rTwo[i].romance > 100 || persona.rTwo[i].coitus > 1) && i != npc.indexOf(personb)) {
                        sigo ++;
                        //console.log("sigo 1 up");
                    }
                }
            }
            for (var i=0;i<personb.rTwo.length;i++) {
                if (personb.rTwo[i] != undefined) {
                    if ((personb.rTwo[i].romance > 100 || personb.rTwo[i].coitus > 1) && i != npc.indexOf(persona)) {
                        sigo ++;
                        //console.log("sigo 2 up");
                    }
                }
            } */
            if (sigo > 0) {
                console.log(persona.firstName + " monogamy test failed " + personb.firstName);
                return 1;
            } else {
                console.log(persona.firstName + " monogamy test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"age appropriate",
        "description":"no sex with people outside an appropriate age range",
        normTest: function(persona, personb) {
            //console.log(persona.firstName + " age test " + personb.firstName);
            var agemax = persona.ageInYears() + 2;
            var agemin = persona.ageInYears() - 2;
            if (persona.ageInYears() >= 18 || personb.ageInYears() >= 18) {
                agemax = (persona.ageInYears() - 7) * 2;
                agemin = Math.floor((persona.ageInYears() / 2) + 7);
            }
            //console.log(persona.firstName + " max " + agemax + " min " + agemin);
            if (personb.ageInYears() <= agemax && personb.ageInYears() >= agemin) {
                //console.log("age test passed");
                return 0;
            } else {
                //console.log("age test failed");
                return 1;
            }
        }
    }
];

var paused = false;
var minAge = 5;
var maxAge = 15;
var characterCount = 8;
var loopTime = 100;
var npc = [];
var counter = 0;
var puberty = 12;

function person(firstname, age, gender) {
    this.firstName = firstname;
    this.gender = gender;
    this.birthday = Math.floor(Math.random() * 365);
    this.ageInDays = (age*365 + (365-this.birthday));
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        return a;};
    this.hair = pickFrom(hairColors);
    this.eyes = pickFrom(eyeColors);
    this.happiness = 0;
    this.genderPref = randomInt(1, 10); // 10 is full hetero; 1 is full homo
    this.beauty = randomInt(1, 10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.honor = randomInt(1, 10);
    this.relationships = [];
    this.myTypes = [];
    this.rTwo = [];
    this.relatives = [];
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
    this.coitus = 0;
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

function rootRead(n) {
    return Math.floor(n ** 0.5);
}

function commitmentCheck(persona, personb) {
    console.log("comchceck");
    var sigo = 0;
    for (var i=0;i<persona.rTwo.length;i++) {
        if (persona.rTwo[i] != undefined) {
            if (persona.rTwo[i].commitment > 0 && i != npc.indexOf(personb)) {
                sigo ++;
                console.log("comsigo 1 up");
            }
        }
    }
    for (var i=0;i<personb.rTwo.length;i++) {
        if (personb.rTwo[i] != undefined) {
            if (personb.rTwo[i].commitment > 0 && i != npc.indexOf(persona)) {
                sigo ++;
                console.log("comsigo 2 up");
            }
        }
    }
    return sigo;
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
        var bonus = 1;
        if (personb.beauty > 7 || (personb.beauty - persona.beauty) > 2) {
            bonus ++;
        }
        for (k=0;k<persona.myTypes.length;k++) {
            bonus += persona.myTypes[k].typeTest(persona, personb);
        }
        persona.rTwo[npc.indexOf(personb)].attraction += bonus;
    }
    whupEee(persona, personb);
}

function whupEee(persona, personb) {
    if (persona.rTwo[npc.indexOf(personb)].attraction > 100) {
        if (randomInt(1,3) == 1) {
            $("#temptext").html(persona.firstName + " reaches out to kiss " + personb.firstName + ". ");
            if (personb.rTwo[npc.indexOf(persona)].attraction > 50) {
                $("#temptext").append(personb.firstName + " kisses her back.<br>");
                persona.rTwo[npc.indexOf(personb)].romance ++;
                personb.rTwo[npc.indexOf(persona)].romance ++;
                var w = 0;
                for (var i=0;i<socialNorms.length;i++) {
                    w += socialNorms[i].normTest(persona, personb);
                }
                if (w == 0 && persona.rTwo[npc.indexOf(personb)].romance > 60) {
                    //console.log("testing commitment");
                    var sti = commitmentCheck(persona, personb);
                    //console.log(sti);
                    //console.log(persona.rTwo[npc.indexOf(personb)].commitment);
                    if (persona.rTwo[npc.indexOf(personb)].commitment == 0 && sti == 0) {
                        //console.log("commit up");
                        persona.rTwo[npc.indexOf(personb)].commitment ++;
                    }
                }
                if (w == 0 && randomInt(1,5) == 1) {
                    if (persona.rTwo[npc.indexOf(personb)].coitus == 0) {
                        console.log("first whup");
                        $("#textlog").append("On day " + counter + ", " + persona.firstName + " (age " + persona.ageInYears() + ") and " + personb.firstName + " (age " + personb.ageInYears() + ")  slept together for the first time.<br>");
                    }
                    $("#temptext").append(persona.firstName + " and " + personb.firstName + " slept together.<br>");
                    persona.rTwo[npc.indexOf(personb)].coitus ++;
                    personb.rTwo[npc.indexOf(persona)].coitus ++;
                }
            } else {
                $("#temptext").append(personb.firstName + " pulls away.<br>");
            }
        }
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
    }
    if (persona.rTwo[npc.indexOf(personb)].romance > 10) {
        description += ("They fool around. ");
    } else if (persona.rTwo[npc.indexOf(personb)].attraction > 100) {
        description += (persona.firstName + " is attracted to " + personb.firstName + ". ");
    }
    if (persona.relatives[npc.indexOf(personb)] != undefined) {
        description += (persona.firstName + " is " + personb.firstName + "'s " + persona.relatives[npc.indexOf(personb)] + ". ")
    }
    if (persona.rTwo[npc.indexOf(personb)].coitus > 0) {
        description += ("They have slept together. ");
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

function meetPeopleTwo() {
    for (var i=0;i<npc.length;i++) {
        var iter = i;
        var p = [];
        for (j=0;j<npc.length;j++) {
            r = npc[iter].summary(j);
            if (r != undefined) {
                if (r.friendship > 100) {
                    p.push(100);
                } else {
                    p.push(r.friendship);
                }
            } else {
                p.push(1);
            }
        }
        var u = weightedChooser(npc, p);
        while (npc.indexOf(u) == iter) {
            u = weightedChooser(npc, p);
        }
        interactWith(npc[iter], u);
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
    makeRelative(pickFrom(npc));
    displayCharPanel();
}

function makeRelative(n) {
    var jk;
    do {
        jk = pickFrom(npc);
    }
    while (jk == n);
    console.log(n);
    if (findDiff(jk.ageInYears(), n.ageInYears()) > 15) {
        if (jk.ageInYears() > n.ageInYears()) {
            jk.relatives[npc.indexOf(n)] = "child";
            n.relatives[npc.indexOf(jk)] = "parent";
        } else {
            jk.relatives[npc.indexOf(n)] = "parent";
            n.relatives[npc.indexOf(jk)] = "child";
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

function displayCharPanel() {
    for (i=0;i<npc.length;i++) {
        $("#dashpanel").append(
            "<hr><div class='row' id='npc"+i+"'><div class='col-8'>Name: <span id='npcname" + i + "'><strong>" + npc[i].firstName + "</strong></span><br>" +
            "Age in years: <span id='npcyears" + i + "'>"  + npc[i].ageInYears() + "</span><br>" +
            "Happiness quotient: <span id='npchappy" +i+"'>" + npc[i].happiness + "</span><br>" +
            "<span id='npcactivity"+i+"'></span><br>" +
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover click" data-offset="5" data-html="true" title="Relationships" data-content="She has no friends yet." id="npcrel' + i + '">Relationships</a></div>' +
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
$("#testbutton2").click(function() {loopTime += 15;});
$("#testbutton3").click(function() {if (loopTime > 45) {loopTime -= 15;}});
$("#pausebutton").click(function() {pauseGame();});

</script>
  </body>
</html>