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
        max-width:800px;
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
                    <button type="button" class="btn btn-secondary" id="testbutton3">Add NPC</button>
                    <button type="button" class="btn btn-secondary" id="pausebutton">Pause Game</button>
                    <p><small>Sim started: <span id="startTime"></span></small><p>
                    <p>Year <span id="years">1</span> | Day <span id="counter"></span> | Population: <span id="population"></span> (<span id="fpop"></span> F / <span id="mpop"></span> M)</p>
                    <div id="dashpanel">
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

var charPanels = [];

var hairColors = [
    "brown","black","chestnut","blonde","red"
]

var eyeColors = [
    "brown","blue","grey","green"
]

var girlNames = [
    'Aaliyah', 'Abbey', 'Abbie', 'Abbigail', 'Abby', 'Abigail', 'Abril', 'Ada', 'Adaline', 'Adalyn', 'Adalynn', 'Addilyn', 'Addison', 'Addisyn', 'Addyson', 'Adelaide', 'Adelina', 'Adeline', 'Adelyn', 'Adelynn', 'Adrian', 'Adriana', 'Adrianna', 'Adrianne', 'Adrienne', 'Aileen', 'Aimee', 'Ainsley', 'Aisha', 'Aja', 'Alaina', 'Alana', 'Alani', 'Alanna', 'Alayna', 'Aleah', 'Aleena', 'Alejandra', 'Alessandra', 'Alexa', 'Alexandra', 'Alexandrea', 'Alexandria', 'Alexia', 'Alexis', 'Alexus', 'Alice', 'Alicia', 'Alina', 'Alisa', 'Alisha', 'Alison', 'Alissa', 'Alivia', 'Aliyah', 'Allie', 'Allison', 'Allisson', 'Ally', 'Allyson', 'Alma', 'Alondra', 'Alysha', 'Alyson', 'Alyssa', 'Amanda', 'Amara', 'Amari', 'Amaya', 'Amber', 'Amelia', 'America', 'Amie', 'Amina', 'Amira', 'Amiyah', 'Amy', 'Amya', 'Ana', 'Anabelle', 'Anahi', 'Analia', 'Anastasia', 'Anaya', 'Andrea', 'Angel', 'Angela', 'Angelia', 'Angelica', 'Angelina', 'Angelique', 'Angie', 'Anika', 'Anissa', 'Anita', 'Anitra', 'Aniya', 'Aniyah', 'Ann', 'Anna', 'Annabel', 'Annabella', 'Annabelle', 'Annalise', 'Anne', 'Annette', 'Annie', 'Annika', 'Antoinette', 'Antonia', 'Anya', 'April', 'Arabella', 'Araceli', 'Aria', 'Ariah', 'Ariana', 'Arianna', 'Ariel', 'Ariella', 'Arielle', 'Ariyah', 'Arlene', 'Arya', 'Ashanti', 'Ashely', 'Ashlee', 'Ashleigh', 'Ashley', 'Ashlie', 'Ashly', 'Ashlyn', 'Ashlynn', 'Ashton', 'Asia', 'Aspen', 'Athena', 'Aubree', 'Aubrey', 'Aubrie', 'Audra', 'Audrey', 'Audrina', 'Aurora', 'Autumn', 'Ava', 'Averie', 'Avery', 'Aviana', 'Avianna', 'Ayanna', 'Ayla', 'Aylin', 'Bailee', 'Bailey', 'Barbara', 'Baylee', 'Beatrice', 'Beatriz', 'Becky', 'Belinda', 'Bella', 'Bernadette', 'Beth', 'Bethany', 'Betsy', 'Betty', 'Beverly', 'Bianca', 'Billie', 'Blair', 'Blake', 'Blakely', 'Blanca', 'Bobbi', 'Bobbie', 'Bonnie', 'Braelyn', 'Braelynn', 'Brandi', 'Brandie', 'Brandy', 'Breana', 'Breanna', 'Breanne', 'Brenda', 'Brenna', 'Bria', 'Briana', 'Brianna', 'Brianne', 'Bridget', 'Bridgett', 'Bridgette', 'Briella', 'Brielle', 'Brinley', 'Brisa', 'Bristol', 'Britany', 'Britney', 'Brittani', 'Brittany', 'Brittney', 'Brittni', 'Brook', 'Brooke', 'Brooklyn', 'Brooklynn', 'Bryanna', 'Brylee', 'Brynlee', 'Brynn', 'Cadence', 'Caitlin', 'Caitlyn', 'Cali', 'Calista', 'Callie', 'Cameron', 'Camila', 'Camilla', 'Camille', 'Camryn', 'Candace', 'Candice', 'Candy', 'Cara', 'Carey', 'Cari', 'Carina', 'Carissa', 'Carla', 'Carley', 'Carlie', 'Carly', 'Carmen', 'Carol', 'Carolina', 'Caroline', 'Carolyn', 'Carrie', 'Carter', 'Casandra', 'Casey', 'Cassandra', 'Cassidy', 'Cassie', 'Cataleya', 'Catalina', 'Catherine', 'Cathy', 'Catrina', 'Cayla', 'Caylee', 'Cecilia', 'Cecily', 'Celeste', 'Celia', 'Celina', 'Celine', 'Chanda', 'Chandler', 'Chandra', 'Chanel', 'Chantel', 'Charity', 'Charlee', 'Charleigh', 'Charlene', 'Charley', 'Charlie', 'Charlotte', 'Chasity', 'Chastity', 'Chelsea', 'Chelsey', 'Chelsie', 'Cheri', 'Cherie', 'Cheryl', 'Cheyanne', 'Cheyenne', 'Chloe', 'Chrissy', 'Christa', 'Christen', 'Christi', 'Christian', 'Christie', 'Christin', 'Christina', 'Christine', 'Christopher', 'Christy', 'Chrystal', 'Chyna', 'Ciara', 'Ciera', 'Cierra', 'Cindy', 'Claire', 'Clara', 'Clare', 'Clarissa', 'Claudia', 'Colette', 'Colleen', 'Connie', 'Constance', 'Cora', 'Corinne', 'Cortney', 'Courtney', 'Cristal', 'Cristina', 'Cristy', 'Crystal', 'Cynthia', 'Dahlia', 'Daisy', 'Dakota', 'Daleyza', 'Dalia', 'Dana', 'Danica', 'Daniela', 'Daniella', 'Danielle', 'Danika', 'Danna', 'Daphne', 'Dara', 'Darby', 'Darcy', 'Darian', 'Darla', 'Darlene', 'Dawn', 'Dayana', 'Dayanara', 'Dayna', 'Deana', 'Deanna', 'Debbie', 'Deborah', 'Debra', 'Deja', 'Delaney', 'Delilah', 'Demetria', 'Demi', 'Dena', 'Denise', 'Desirae', 'Desiree', 'Destinee', 'Destiny', 'Devin', 'Devon', 'Diamond', 'Diana', 'Diane', 'Dianna', 'Dina', 'Dominique', 'Donna', 'Dora', 'Doris', 'Dorothy', 'Dulce', 'Dylan', 'Ebony', 'Eden', 'Edith', 'Eileen', 'Elaina', 'Elaine', 'Eleanor', 'Elena', 'Eliana', 'Elianna', 'Elisa', 'Elisabeth', 'Elise', 'Elisha', 'Elissa', 'Eliza', 'Elizabeth', 'Ella', 'Elle', 'Ellen', 'Elliana', 'Ellie', 'Eloise', 'Elsa', 'Elsie', 'Elyse', 'Ember', 'Emely', 'Emerson', 'Emersyn', 'Emery', 'Emilee', 'Emilia', 'Emilie', 'Emily', 'Emma', 'Emmalyn', 'Erica', 'Ericka', 'Erika', 'Erin', 'Esmeralda', 'Esperanza', 'Essence', 'Esther', 'Estrella', 'Eva', 'Evangeline', 'Eve', 'Evelyn', 'Evelynn', 'Everleigh', 'Everly', 'Evie', 'Faith', 'Fallon', 'Farrah', 'Fatima', 'Felicia', 'Felicity', 'Fernanda', 'Finley', 'Fiona', 'Frances', 'Francesca', 'Freya', 'Gabriela', 'Gabriella', 'Gabrielle', 'Gail', 'Gemma', 'Gena', 'Genesis', 'Genevieve', 'Georgia', 'Gia', 'Gianna', 'Gillian', 'Gina', 'Ginger', 'Giselle', 'Gisselle', 'Giuliana', 'Glenda', 'Gloria', 'Grace', 'Gracelyn', 'Gracelynn', 'Gracie', 'Gretchen', 'Guadalupe', 'Gwendolyn', 'Hadley', 'Hailee', 'Hailey', 'Hailie', 'Haleigh', 'Haley', 'Halle', 'Hallie', 'Hanna', 'Hannah', 'Harley', 'Harlow', 'Harmony', 'Harper', 'Hattie', 'Haven', 'Hayden', 'Haylee', 'Hayley', 'Haylie', 'Hazel', 'Heather', 'Heaven', 'Heidi', 'Helen', 'Helena', 'Henley', 'Hilary', 'Hillary', 'Hollie', 'Holly', 'Hope', 'Hunter', 'Iesha', 'Imani', 'India', 'Infant', 'Ingrid', 'Irene', 'Iris', 'Irma', 'Isabel', 'Isabela', 'Isabella', 'Isabelle', 'Isis', 'Isla', 'Itzel', 'Ivy', 'Izabella', 'Jackie', 'Jacklyn', 'Jaclyn', 'Jacqueline', 'Jacquelyn', 'Jada', 'Jade', 'Jaden', 'Jadyn', 'Jaelyn', 'Jaiden', 'Jailene', 'Jaime', 'Jaimie', 'Jaleesa', 'Jalisa', 'Jaliyah', 'Jami', 'Jamie', 'Jana', 'Janae', 'Janay', 'Jane', 'Janel', 'Janell', 'Janelle', 'Janet', 'Janette', 'Janice', 'Janie', 'Janine', 'Janiya', 'Janiyah', 'Janna', 'Jaqueline', 'Jaslene', 'Jasmin', 'Jasmine', 'Jayda', 'Jayden', 'Jayla', 'Jaylah', 'Jayleen', 'Jaylynn', 'Jayme', 'Jazlyn', 'Jazmin', 'Jazmine', 'Jean', 'Jeanette', 'Jeanine', 'Jeanne', 'Jeannette', 'Jeannie', 'Jena', 'Jenifer', 'Jenna', 'Jennie', 'Jennifer', 'Jenny', 'Jesse', 'Jessica', 'Jessie', 'Jill', 'Jillian', 'Jimena', 'Jo', 'Joan', 'Joann', 'Joanna', 'Joanne', 'Jocelyn', 'Jodi', 'Jodie', 'Jody', 'Johanna', 'Jolene', 'Joni', 'Jordan', 'Jordyn', 'Joselyn', 'Josephine', 'Josie', 'Journee', 'Journey', 'Joy', 'Joyce', 'Juanita', 'Judith', 'Judy', 'Julia', 'Juliana', 'Julianna', 'Julianne', 'Julie', 'Juliet', 'Juliette', 'Julissa', 'June', 'Juniper', 'Justice', 'Justine', 'Kacie', 'Kadence', 'Kaelyn', 'Kaia', 'Kaila', 'Kailee', 'Kailey', 'Kailyn', 'Kaitlin', 'Kaitlyn', 'Kaitlynn', 'Kala', 'Kaleigh', 'Kaley', 'Kali', 'Kaliyah', 'Kamila', 'Kamryn', 'Kara', 'Karen', 'Kari', 'Karin', 'Karina', 'Karissa', 'Karla', 'Karrie', 'Kasey', 'Kassandra', 'Kassidy', 'Katarina', 'Kate', 'Katelyn', 'Katelynn', 'Katharine', 'Katherine', 'Kathleen', 'Kathryn', 'Kathy', 'Katie', 'Katina', 'Katlyn', 'Katrina', 'Katy', 'Kayden', 'Kaydence', 'Kayla', 'Kaylee', 'Kayleigh', 'Kaylie', 'Kaylin', 'Keely', 'Kehlani', 'Keira', 'Keisha', 'Kelley', 'Kelli', 'Kellie', 'Kelly', 'Kelsey', 'Kelsi', 'Kelsie', 'Kendall', 'Kendra', 'Kenley', 'Kennedi', 'Kennedy', 'Kensley', 'Kenya', 'Kenzie', 'Keri', 'Kerri', 'Kerrie', 'Kerry', 'Keshia', 'Khadijah', 'Khloe', 'Kiana', 'Kiara', 'Kiera', 'Kierra', 'Kiersten', 'Kiley', 'Kim', 'Kimberlee', 'Kimberley', 'Kimberly', 'Kimora', 'Kinley', 'Kinsley', 'Kira', 'Kirby', 'Kirsten', 'Kirstie', 'Kisha', 'Kizzy', 'Kourtney', 'Krista', 'Kristal', 'Kristen', 'Kristi', 'Kristie', 'Kristin', 'Kristina', 'Kristine', 'Kristy', 'Krystal', 'Krystina', 'Krystle', 'Kyla', 'Kylee', 'Kyleigh', 'Kylie', 'Kyra', 'Lacey', 'Laci', 'Lacie', 'Lacy', 'Ladonna', 'Laila', 'Lainey', 'Lakeisha', 'Lakesha', 'Lakisha', 'Lana', 'Laney', 'Lara', 'Larissa', 'Lashonda', 'Latanya', 'Latasha', 'Latisha', 'Latonya', 'Latosha', 'Latoya', 'Latrice', 'Laura', 'Laurel', 'Lauren', 'Laurie', 'Lauryn', 'Lawanda', 'Layla', 'Lea', 'Leah', 'Leann', 'Leanna', 'Leanne', 'Lee', 'Leeann', 'Leia', 'Leigh', 'Leighton', 'Leila', 'Leilani', 'Lena', 'Lennon', 'Lesley', 'Leslie', 'Lesly', 'Leticia', 'Lexi', 'Lexie', 'Lexus', 'Lia', 'Liana', 'Liberty', 'Lila', 'Lilah', 'Lilian', 'Liliana', 'Lilith', 'Lillian', 'Lilliana', 'Lillie', 'Lilly', 'Lily', 'Lilyana', 'Linda', 'Lindsay', 'Lindsey', 'Lisa', 'Litzy', 'Liza', 'Lizbeth', 'Lizette', 'Logan', 'Lola', 'London', 'Londyn', 'Lora', 'Lorelei', 'Lorena', 'Loretta', 'Lori', 'Lorie', 'Lorraine', 'Lucia', 'Luciana', 'Lucille', 'Lucy', 'Luna', 'Luz', 'Lydia', 'Lyla', 'Lynda', 'Lyndsay', 'Lyndsey', 'Lynette', 'Lynn', 'Lyric', 'Mabel', 'Macey', 'Maci', 'Macie', 'Mackenzie', 'Macy', 'Madalyn', 'Maddison', 'Madeleine', 'Madeline', 'Madelyn', 'Madelynn', 'Madilyn', 'Madilynn', 'Madison', 'Madisyn', 'Madyson', 'Maegan', 'Maeve', 'Maggie', 'Magnolia', 'Maia', 'Maisie', 'Makayla', 'Makenna', 'Makenzie', 'Malaysia', 'Malia', 'Malinda', 'Maliyah', 'Mallory', 'Mandi', 'Mandy', 'Maranda', 'Marcella', 'Marci', 'Marcia', 'Marcie', 'Marcy', 'Marely', 'Margaret', 'Margarita', 'Margot', 'Maria', 'Mariah', 'Mariana', 'Marianne', 'Maribel', 'Maricela', 'Marie', 'Mariela', 'Marilyn', 'Marina', 'Marisa', 'Marisol', 'Marissa', 'Maritza', 'Marjorie', 'Marla', 'Marlee', 'Marlena', 'Marlene', 'Marley', 'Marquita', 'Marsha', 'Martha', 'Mary', 'Maryam', 'Matilda', 'Maureen', 'Maya', 'Mayra', 'Mckayla', 'Mckenna', 'Mckenzie', 'Mckinley', 'Meagan', 'Meaghan', 'Megan', 'Meghan', 'Melanie', 'Melany', 'Melina', 'Melinda', 'Melisa', 'Melissa', 'Melody', 'Mercedes', 'Meredith', 'Mia', 'Micaela', 'Michaela', 'Michele', 'Michelle', 'Mikaela', 'Mikayla', 'Mila', 'Miley', 'Millie', 'Mindy', 'Mira', 'Miracle', 'Miranda', 'Mireya', 'Miriam', 'Misti', 'Misty', 'Mollie', 'Molly', 'Monica', 'Monique', 'Montana', 'Morgan', 'Moriah', 'Mya', 'Myla', 'Mylee', 'Myra', 'Nadia', 'Nadine', 'Nakia', 'Nancy', 'Naomi', 'Natalee', 'Natalia', 'Natalie', 'Nataly', 'Natasha', 'Nathalie', 'Nayeli', 'Nevaeh', 'Nia', 'Nichole', 'Nicole', 'Nicolette', 'Nikita', 'Nikki', 'Nina', 'Noelle', 'Noemi', 'Nora', 'Norah', 'Norma', 'Nova', 'Nyah', 'Nyla', 'Nylah', 'Oakley', 'Octavia', 'Olga', 'Olive', 'Olivia', 'Ophelia', 'Paige', 'Paislee', 'Paisley', 'Pamela', 'Paola', 'Paris', 'Parker', 'Patrice', 'Patricia', 'Paula', 'Paulina', 'Payton', 'Peggy', 'Penelope', 'Penny', 'Perla', 'Peyton', 'Phoebe', 'Phoenix', 'Piper', 'Precious', 'Presley', 'Priscilla', 'Quinn', 'Rachael', 'Rachel', 'Rachelle', 'Raegan', 'Raelyn', 'Raelynn', 'Ramona', 'Randi', 'Raquel', 'Raven', 'Reagan', 'Rebecca', 'Rebekah', 'Reese', 'Regan', 'Regina', 'Remi', 'Remington', 'Renata', 'Renee', 'Rhiannon', 'Rhonda', 'Rihanna', 'Riley', 'Rita', 'River', 'Roberta', 'Robin', 'Robyn', 'Rochelle', 'Ronda', 'Rosa', 'Rosalie', 'Rosanna', 'Rose', 'Rosemary', 'Rowan', 'Roxanne', 'Royalty', 'Rubi', 'Ruby', 'Ruth', 'Ryan', 'Rylee', 'Ryleigh', 'Rylie', 'Sabrina', 'Sade', 'Sadie', 'Sage', 'Sally', 'Samantha', 'Samara', 'Sandra', 'Sandy', 'Saniya', 'Saniyah', 'Sara', 'Sarah', 'Sarai', 'Sasha', 'Savanah', 'Savanna', 'Savannah', 'Sawyer', 'Saylor', 'Scarlet', 'Scarlett', 'Selah', 'Selena', 'Selina', 'Serena', 'Serenity', 'Shaina', 'Shameka', 'Shamika', 'Shana', 'Shanda', 'Shania', 'Shanice', 'Shanika', 'Shaniqua', 'Shanna', 'Shannon', 'Shantel', 'Shari', 'Sharon', 'Shauna', 'Shawn', 'Shawna', 'Shayla', 'Shayna', 'Sheena', 'Sheila', 'Shelbi', 'Shelby', 'Shelia', 'Shelley', 'Shelly', 'Sheri', 'Sherlyn', 'Sherri', 'Sherrie', 'Sherry', 'Sheryl', 'Shirley', 'Shonda', 'Shyanne', 'Sidney', 'Sienna', 'Sierra', 'Silvia', 'Simone', 'Skye', 'Skyla', 'Skylar', 'Skyler', 'Sloane', 'Sofia', 'Sommer', 'Sonia', 'Sonja', 'Sonya', 'Sophia', 'Sophie', 'Stacey', 'Staci', 'Stacie', 'Stacy', 'Stefanie', 'Stella', 'Stephani', 'Stephanie', 'Stephany', 'Summer', 'Susan', 'Susana', 'Suzanne', 'Sydney', 'Sylvia', 'Tabatha', 'Tabitha', 'Talia', 'Tamara', 'Tameka', 'Tami', 'Tamia', 'Tamika', 'Tamiko', 'Tammi', 'Tammie', 'Tammy', 'Tania', 'Tanisha', 'Tanya', 'Tara', 'Taryn', 'Tasha', 'Tatiana', 'Tatum', 'Tatyana', 'Tayler', 'Taylor', 'Teagan', 'Tenley', 'Tennille', 'Tera', 'Teresa', 'Teri', 'Terra', 'Terri', 'Terry', 'Tess', 'Tessa', 'Thalia', 'Thea', 'Theresa', 'Tia', 'Tiana', 'Tianna', 'Tiara', 'Tierra', 'Tiffani', 'Tiffanie', 'Tiffany', 'Tina', 'Tisha', 'Tomeka', 'Toni', 'Tonia', 'Tonya', 'Tori', 'Tosha', 'Tracey', 'Traci', 'Tracie', 'Tracy', 'Tricia', 'Trina', 'Trinity', 'Trisha', 'Trista', 'Tyler', 'Tyra', 'Valentina', 'Valeria', 'Valerie', 'Vanessa', 'Vera', 'Veronica', 'Vicki', 'Vickie', 'Vicky', 'Victoria', 'Violet', 'Virginia', 'Vivian', 'Viviana', 'Vivienne', 'Wanda', 'Wendi', 'Wendy', 'Whitley', 'Whitney', 'Willa', 'Willow', 'Winter', 'Wren', 'Ximena', 'Yadira', 'Yaretzi', 'Yasmin', 'Yasmine', 'Yesenia', 'Yolanda', 'Yoselin', 'Yulissa', 'Yvette', 'Yvonne', 'Zara', 'Zaria', 'Zariah', 'Zoe', 'Zoey', 'Zuri', 'Zoie'
]

var boyNames = [
    'Aaden', 'Aarav', 'Aaron', 'Aarush', 'Abdiel', 'Abdullah', 'Abel', 'Abraham', 'Abram', 'Ace', 'Adam', 'Adan', 'Aden', 'Aditya', 'Adonis', 'Adrian', 'Adriel', 'Adrien', 'Aedan', 'Agustin', 'Ahmad', 'Ahmed', 'Aidan', 'Aiden', 'Aidyn', 'Alan', 'Albert', 'Alberto', 'Alden', 'Aldo', 'Alec', 'Alejandro', 'Alessandro', 'Alex', 'Alexander', 'Alexis', 'Alexzander', 'Alfonso', 'Alfred', 'Alfredo', 'Ali', 'Alijah', 'Allan', 'Allen', 'Alonso', 'Alonzo', 'Alvaro', 'Alvin', 'Amare', 'Amari', 'Ameer', 'Amir', 'Anders', 'Anderson', 'Andre', 'Andres', 'Andrew', 'Andy', 'Angel', 'Angelo', 'Anthony', 'Antoine', 'Antonio', 'Antony', 'Antwan', 'Archer', 'Ari', 'Ariel', 'Arjun', 'Armando', 'Armani', 'Arnav', 'Aron', 'Arthur', 'Arturo', 'Aryan', 'Asa', 'Asher', 'Ashton', 'Atticus', 'August', 'Augustus', 'Austin', 'Avery', 'Axel', 'Ayaan', 'Aydan', 'Ayden', 'Aydin', 'Barrett', 'Barry', 'Beau', 'Beckett', 'Beckham', 'Ben', 'Benjamin', 'Bennett', 'Benson', 'Bentlee', 'Bentley', 'Bently', 'Bernard', 'Billy', 'Blaine', 'Blaise', 'Blake', 'Blaze', 'Bo', 'Bobby', 'Bode', 'Bodhi', 'Boston', 'Brad', 'Braden', 'Bradford', 'Bradley', 'Brady', 'Bradyn', 'Braeden', 'Braiden', 'Branden', 'Brandon', 'Branson', 'Brantley', 'Braxton', 'Brayan', 'Brayden', 'Braydon', 'Braylen', 'Braylon', 'Brendan', 'Brenden', 'Brendon', 'Brennan', 'Brennen', 'Brent', 'Brett', 'Brian', 'Brice', 'Bridger', 'Brock', 'Broderick', 'Brodie', 'Brody', 'Brogan', 'Bronson', 'Brooks', 'Bruce', 'Bruno', 'Bryan', 'Bryant', 'Bryce', 'Brycen', 'Bryson', 'Byron', 'Cade', 'Caden', 'Cael', 'Caiden', 'Cain', 'Cale', 'Caleb', 'Callen', 'Callum', 'Calvin', 'Camden', 'Camdyn', 'Cameron', 'Camren', 'Camron', 'Camryn', 'Cannon', 'Carl', 'Carlos', 'Carmelo', 'Carsen', 'Carson', 'Carter', 'Case', 'Casen', 'Casey', 'Cash', 'Cason', 'Cayden', 'Cedric', 'Cesar', 'Chace', 'Chad', 'Chadwick', 'Chaim', 'Chance', 'Chandler', 'Channing', 'Charles', 'Charlie', 'Chase', 'Chris', 'Christian', 'Christopher', 'Clarence', 'Clark', 'Clay', 'Clayton', 'Clifford', 'Clifton', 'Clint', 'Clinton', 'Cody', 'Cohen', 'Colby', 'Cole', 'Coleman', 'Colin', 'Collin', 'Colt', 'Colten', 'Colton', 'Conner', 'Connor', 'Conor', 'Conrad', 'Cooper', 'Corbin', 'Corey', 'Cortez', 'Cory', 'Craig', 'Cristian', 'Cristofer', 'Cristopher', 'Cruz', 'Cullen', 'Curtis', 'Cyrus', 'Dakota', 'Dale', 'Dallas', 'Dalton', 'Damari', 'Damarion', 'Damian', 'Damien', 'Damion', 'Damon', 'Dana', 'Dane', 'Dangelo', 'Daniel', 'Danny', 'Dante', 'Darian', 'Darien', 'Darin', 'Dario', 'Darius', 'Darnell', 'Darrell', 'Darren', 'Darryl', 'Darwin', 'Daryl', 'Dashawn', 'Davian', 'David', 'Davin', 'Davion', 'Davis', 'Davon', 'Dawson', 'Dax', 'Daxton', 'Daylen', 'Dayton', 'Deacon', 'Dean', 'Deandre', 'Deangelo', 'Declan', 'Deegan', 'Demarcus', 'Demarion', 'Demetrius', 'Dennis', 'Deon', 'Derek', 'Derick', 'Derrick', 'Deshawn', 'Desmond', 'Devan', 'Deven', 'Devin', 'Devon', 'Devyn', 'Dexter', 'Diego', 'Dilan', 'Dillon', 'Dominic', 'Dominick', 'Dominik', 'Dominique', 'Don', 'Donald', 'Donnie', 'Donovan', 'Donte', 'Dorian', 'Douglas', 'Drake', 'Draven', 'Drew', 'Duane', 'Duncan', 'Dustin', 'Dwayne', 'Dwight', 'Dylan', 'Ean', 'Earl', 'Easton', 'Eddie', 'Eden', 'Edgar', 'Edison', 'Eduardo', 'Edward', 'Edwin', 'Efrain', 'Eli', 'Elian', 'Elias', 'Elijah', 'Eliot', 'Elisha', 'Elliot', 'Elliott', 'Ellis', 'Emanuel', 'Emerson', 'Emery', 'Emiliano', 'Emilio', 'Emmanuel', 'Emmett', 'Emmitt', 'Enrique', 'Enzo', 'Eric', 'Erick', 'Erik', 'Ernest', 'Ernesto', 'Esteban', 'Ethan', 'Eugene', 'Evan', 'Everett', 'Ezekiel', 'Ezequiel', 'Ezra', 'Fabian', 'Felipe', 'Felix', 'Fernando', 'Finley', 'Finn', 'Finnegan', 'Fisher', 'Fletcher', 'Francis', 'Francisco', 'Franco', 'Frank', 'Frankie', 'Franklin', 'Fred', 'Freddy', 'Frederick', 'Fredrick', 'Gabriel', 'Gael', 'Gage', 'Gaige', 'Garrett', 'Gary', 'Gauge', 'Gavin', 'Gavyn', 'Geoffrey', 'George', 'Gerald', 'Gerardo', 'Giancarlo', 'Gianni', 'Gibson', 'Gideon', 'Gilbert', 'Gilberto', 'Giovani', 'Giovanni', 'Giovanny', 'Glen', 'Glenn', 'Grady', 'Graham', 'Grant', 'Grayson', 'Greg', 'Gregory', 'Greyson', 'Griffin', 'Guillermo', 'Gunnar', 'Gunner', 'Gustavo', 'Haiden', 'Hamza', 'Hank', 'Harley', 'Harold', 'Harper', 'Harrison', 'Harry', 'Hassan', 'Hayden', 'Hayes', 'Heath', 'Hector', 'Henry', 'Herbert', 'Hezekiah', 'Holden', 'Houston', 'Howard', 'Hudson', 'Hugh', 'Hugo', 'Humberto', 'Hunter', 'Ian', 'Ibrahim', 'Ignacio', 'Iker', 'Irvin', 'Isaac', 'Isai', 'Isaiah', 'Isaias', 'Ishaan', 'Isiah', 'Ismael', 'Israel', 'Issac', 'Ivan', 'Izaiah', 'Izayah', 'Jabari', 'Jace', 'Jack', 'Jackie', 'Jackson', 'Jacob', 'Jacoby', 'Jaden', 'Jadiel', 'Jadon', 'Jadyn', 'Jaeden', 'Jagger', 'Jaiden', 'Jaidyn', 'Jaime', 'Jair', 'Jairo', 'Jake', 'Jakob', 'Jakobe', 'Jalen', 'Jamal', 'Jamar', 'Jamari', 'Jamarion', 'James', 'Jameson', 'Jamie', 'Jamir', 'Jamison', 'Jared', 'Jaron', 'Jarrod', 'Jase', 'Jasiah', 'Jason', 'Jasper', 'Javier', 'Javion', 'Javon', 'Jax', 'Jaxen', 'Jaxon', 'Jaxson', 'Jaxton', 'Jay', 'Jayce', 'Jaycob', 'Jayden', 'Jaydin', 'Jaydon', 'Jaylen', 'Jaylin', 'Jaylon', 'Jayson', 'Jayvion', 'Jean', 'Jedidiah', 'Jeff', 'Jefferson', 'Jeffery', 'Jeffrey', 'Jencarlos', 'Jensen', 'Jeramiah', 'Jeremiah', 'Jeremy', 'Jerimiah', 'Jermaine', 'Jerome', 'Jerry', 'Jesse', 'Jessie', 'Jesus', 'Jett', 'Jimmy', 'Joaquin', 'Jody', 'Joe', 'Joel', 'Joey', 'Johan', 'Johann', 'John', 'Johnathan', 'Johnathon', 'Johnny', 'Jon', 'Jonah', 'Jonas', 'Jonathan', 'Jonathon', 'Jordan', 'Jorden', 'Jordyn', 'Jorge', 'Jose', 'Joseph', 'Joshua', 'Josiah', 'Josue', 'Jovani', 'Jovanni', 'Juan', 'Judah', 'Jude', 'Julian', 'Julien', 'Julio', 'Julius', 'Junior', 'Justice', 'Justin', 'Justus', 'Kade', 'Kaden', 'Kadyn', 'Kaeden', 'Kael', 'Kai', 'Kaiden', 'Kale', 'Kaleb', 'Kamari', 'Kamden', 'Kameron', 'Kamron', 'Kamryn', 'Kane', 'Kareem', 'Karl', 'Karson', 'Karter', 'Kasen', 'Kash', 'Kason', 'Kayden', 'Kayson', 'Keagan', 'Keaton', 'Keegan', 'Keenan', 'Keith', 'Kellan', 'Kellen', 'Kelly', 'Kelvin', 'Kendall', 'Kendrick', 'Kenneth', 'Kenny', 'Keon', 'Kerry', 'Kevin', 'Keyon', 'Khalil', 'Kian', 'Kieran', 'Killian', 'King', 'Kingsley', 'Kingston', 'Kirk', 'Knox', 'Kobe', 'Kody', 'Koen', 'Kolby', 'Kole', 'Kolten', 'Kolton', 'Konner', 'Konnor', 'Korbin', 'Krish', 'Kristian', 'Kristopher', 'Kurt', 'Kylan', 'Kyle', 'Kyler', 'Kymani', 'Kyron', 'Kyson', 'Lamar', 'Lamont', 'Lance', 'Landen', 'Landon', 'Landry', 'Landyn', 'Lane', 'Larry', 'Lathan', 'Lawrence', 'Lawson', 'Layne', 'Layton', 'Leandro', 'Lee', 'Legend', 'Leighton', 'Leland', 'Lennon', 'Lennox', 'Leo', 'Leon', 'Leonard', 'Leonardo', 'Leonel', 'Leonidas', 'Leroy', 'Levi', 'Lewis', 'Liam', 'Lincoln', 'Lionel', 'Logan', 'London', 'Lonnie', 'Lorenzo', 'Louis', 'Luca', 'Lucas', 'Lucian', 'Luciano', 'Luis', 'Luka', 'Lukas', 'Luke', 'Lyric', 'Madden', 'Maddox', 'Major', 'Makai', 'Makhi', 'Malachi', 'Malakai', 'Malaki', 'Malcolm', 'Malik', 'Manuel', 'Marc', 'Marcel', 'Marcelo', 'Marco', 'Marcos', 'Marcus', 'Mario', 'Mark', 'Markus', 'Marley', 'Marlon', 'Marquis', 'Marshall', 'Martin', 'Marvin', 'Mason', 'Mateo', 'Mathew', 'Mathias', 'Matias', 'Matteo', 'Matthew', 'Matthias', 'Maurice', 'Mauricio', 'Maverick', 'Max', 'Maxim', 'Maximilian', 'Maximiliano', 'Maximo', 'Maximus', 'Maxwell', 'Maxx', 'Mayson', 'Mekhi', 'Melvin', 'Memphis', 'Menachem', 'Messiah', 'Micah', 'Michael', 'Micheal', 'Miguel', 'Mike', 'Miles', 'Milo', 'Misael', 'Mitchell', 'Mohamed', 'Mohammad', 'Mohammed', 'Moises', 'Morgan', 'Moses', 'Moshe', 'Muhammad', 'Myles', 'Nash', 'Nasir', 'Nathan', 'Nathanael', 'Nathaniel', 'Nehemiah', 'Neil', 'Nelson', 'Nicholas', 'Nickolas', 'Nico', 'Nicolas', 'Nigel', 'Niko', 'Nikolai', 'Nikolas', 'Noah', 'Noe', 'Noel', 'Nolan', 'Norman', 'Octavio', 'Odin', 'Oliver', 'Omar', 'Omari', 'Orion', 'Orlando', 'Oscar', 'Osvaldo', 'Owen', 'Pablo', 'Parker', 'Patrick', 'Paul', 'Paxton', 'Payton', 'Pedro', 'Peter', 'Peyton', 'Philip', 'Phillip', 'Phoenix', 'Pierce', 'Pierre', 'Porter', 'Pranav', 'Preston', 'Prince', 'Quentin', 'Quincy', 'Quinn', 'Quinten', 'Quintin', 'Quinton', 'Rafael', 'Raiden', 'Ralph', 'Ramiro', 'Ramon', 'Randall', 'Randy', 'Raphael', 'Rashad', 'Raul', 'Ray', 'Rayan', 'Rayden', 'Raymond', 'Reagan', 'Reece', 'Reed', 'Reese', 'Reginald', 'Reid', 'Remington', 'Remy', 'Rene', 'Rex', 'Rey', 'Rhett', 'Rhys', 'Ricardo', 'Richard', 'Ricky', 'Riley', 'River', 'Robert', 'Roberto', 'Rocco', 'Roderick', 'Rodney', 'Rodolfo', 'Rodrigo', 'Rogelio', 'Roger', 'Rohan', 'Roland', 'Rolando', 'Roman', 'Romeo', 'Ronald', 'Ronaldo', 'Ronan', 'Ronin', 'Ronnie', 'Rory', 'Ross', 'Rowan', 'Roy', 'Royce', 'Ruben', 'Rudy', 'Russell', 'Ryan', 'Ryder', 'Ryker', 'Rylan', 'Ryland', 'Rylee', 'Sage', 'Salvador', 'Salvatore', 'Sam', 'Samir', 'Samson', 'Samuel', 'Santiago', 'Santino', 'Santos', 'Saul', 'Sawyer', 'Scott', 'Seamus', 'Sean', 'Sebastian', 'Semaj', 'Sergio', 'Seth', 'Shane', 'Shannon', 'Shaun', 'Shawn', 'Sidney', 'Silas', 'Simon', 'Sincere', 'Skylar', 'Skyler', 'Solomon', 'Sonny', 'Soren', 'Spencer', 'Stacy', 'Stanley', 'Stefan', 'Stephen', 'Sterling', 'Steve', 'Steven', 'Stuart', 'Sullivan', 'Sylas', 'Talan', 'Talon', 'Tanner', 'Tate', 'Tatum', 'Taylor', 'Teagan', 'Terrance', 'Terrell', 'Terrence', 'Terry', 'Theo', 'Theodore', 'Thomas', 'Timothy', 'Titus', 'Tobias', 'Toby', 'Todd', 'Tomas', 'Tommy', 'Tony', 'Trace', 'Tracy', 'Travis', 'Trent', 'Trenton', 'Trevon', 'Trevor', 'Trey', 'Tripp', 'Tristan', 'Tristen', 'Tristian', 'Tristin', 'Triston', 'Troy', 'Trystan', 'Tucker', 'Ty', 'Tyler', 'Tyree', 'Tyrell', 'Tyrese', 'Tyrone', 'Tyson', 'Ulises', 'Uriah', 'Uriel', 'Urijah', 'Valentin', 'Valentino', 'Van', 'Vance', 'Vaughn', 'Vernon', 'Vicente', 'Victor', 'Vincent', 'Vincenzo', 'Wade', 'Walker', 'Walter', 'Warren', 'Waylon', 'Wayne', 'Wesley', 'Westin', 'Weston', 'Will', 'William', 'Willie', 'Wilson', 'Winston', 'Wyatt', 'Xander', 'Xavi', 'Xavier', 'Xzavier', 'Yadiel', 'Yael', 'Yahir', 'Yair', 'Yandel', 'Yehuda', 'Yosef', 'Yusuf', 'Zachariah', 'Zachary', 'Zachery', 'Zack', 'Zackary', 'Zackery', 'Zaid', 'Zaiden', 'Zain', 'Zaire', 'Zander', 'Zane', 'Zavier', 'Zayden', 'Zayne', 'Zechariah', 'Zion'
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
            if (personb.rTwo[npc.indexOf(persona)].friendship < 0) {
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
        "title":"blondes",
        "description":"person is attracted to blondes",
        typeTest: function(persona, personb) {
            if (personb.hair == "blonde") {
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
                return 5;
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
                return 2;
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
            if (sigo > 0) {
                //console.log(persona.firstName + " monogamy test failed " + personb.firstName);
                return 1;
            } else {
                //console.log(persona.firstName + " monogamy test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"heterosexuality",
        "description":"prefer those of the other gender",
        normTest: function(persona, personb) {
            if (persona.gender == personb.gender) {
                //console.log(persona.firstName + " hetero test failed " + personb.firstName);
                return 2;
            } else {
                //console.log(persona.firstName + " hetero test passed " + personb.firstName);
                return 0;
            }
        }
    },
    {
        "title":"age appropriate",
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
                return 2;
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
var menopause = 45;
var genderRatio = 40; // percent male

var tenArray = [1,2,3,4,5,6,7,8,9,10]
var tenWeightScale = [1,1,2,2,5,6,7,8,9,1];

function pregChances(persona, personb) {
    if (persona.gender == personb.gender) {return 0;}
    var char;
    if (persona.gender == 0) {char = persona} else {char = personb}
    // base odds at puberty are 1 in 5
    var baseodds = 5;
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
    this.ageInDays = (age*365 + (365-this.birthday));
    this.ageInYears = function() {
        a = Math.floor(this.ageInDays/365);
        return a;};
    this.hair = pickFrom(hairColors);
    this.eyes = pickFrom(eyeColors);
    this.happiness = 0;
    this.genderPref = weightedChooser(tenArray, tenWeightScale);; // 10 is full hetero; 1 is full homo
    this.beauty = randomInt(1, 10);
    this.intellect = randomInt(1, 10);
    this.social = randomInt(1, 10);
    this.athletics = randomInt(1,10);
    this.honor = weightedChooser(tenArray, tenWeightScale);
    this.myTypes = [];
    this.rTwo = [];
    this.relatives = [];
    this.pregnant = 0;
    this.pregnancyStart;
    this.coitusCounter = 0;
    this.isAttached = function() {
        var co = 0;
        for (var i=0;i<this.rTwo.length;i++) {
            if (this.rTwo[i] != undefined) {co += this.rTwo[i].commitment;}
        }
        return co;
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

function interactWith(persona, personb) {
    if (persona.rTwo[npc.indexOf(personb)] == undefined) {
        persona.rTwo[npc.indexOf(personb)] = new rType(npc.indexOf(personb));
        personb.rTwo[npc.indexOf(persona)] = new rType(npc.indexOf(persona));
    }

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
    var w = 0;
    for (var i=0;i<socialNorms.length;i++) {
        w += socialNorms[i].normTest(persona, personb);
    }
    var wadj = Math.floor(persona.rTwo[npc.indexOf(personb)].attraction / 500);
    if (w > 0 && wadj > 0) {
        for (var n=0;n<wadj;n++) {
            if (randomInt(1, (persona.honor ** 2)) == 1) {
                w--;
                //console.log(persona.firstName + " is violating social norms.");
            }
        }
    }
    if (persona.rTwo[npc.indexOf(personb)].attraction > 100 && persona.ageInYears() >= 5 && randomInt(1,3) == 1) {
        $("#temptext").html(persona.firstName + " reaches out to kiss " + personb.firstName + ". ");
        if (personb.rTwo[npc.indexOf(persona)].attraction > 50) {
            $("#temptext").append(personb.firstName + " kisses " + personb.oPronoun() + " back.<br>");
            persona.rTwo[npc.indexOf(personb)].romance ++;
            personb.rTwo[npc.indexOf(persona)].romance ++;
            if (w == 0 && persona.rTwo[npc.indexOf(personb)].romance > 60) {
                var sti = commitmentCheck(persona, personb);
                if (persona.rTwo[npc.indexOf(personb)].commitment == 0 && sti == 0) {
                    persona.rTwo[npc.indexOf(personb)].commitment ++;
                    $("#textlog").append("On day " + counter + ", " + persona.firstName + " promises to be loyal to " + personb.firstName + ".<br>");
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
                persona.coitusCounter ++;
                personb.coitusCounter ++;
                if (pregChances(persona, personb) == 1) {
                    if (persona.gender == 0) {
                        persona.pregnant = 1;
                        persona.pregnancyStart = counter;
                        $("#textlog").append("On day " + counter + ", " + persona.firstName + " became pregnant.<br>");
                    } else {
                        personb.pregnant = 1;
                        personb.pregnancyStart = counter;
                        $("#textlog").append("On day " + counter + ", " + personb.firstName + " became pregnant.<br>");
                    }
                }
            }
        } else {
            $("#temptext").append(personb.firstName + " pulls away.<br>");
        }
        
    }
}

function resolvePregnancies() {
    for (var i=0;i<npc.length;i++) {
        if ((counter - npc[i].pregnancyStart) > 270 && randomInt(1, 20) == 1) {
            npc[i].pregnant = 0;
            npc[i].pregnancyStart = undefined;
            addNPC(); $("#dashpanel").append(charPanels[charPanels.length-1]); $('[data-toggle="popover"]').popover();
            var newb = npc[npc.length-1];
            newb.birthday = counter;
            newb.ageInDays = 0;
            for (var k=0;k<npc[i].relatives.length;k++) {
                if (npc[i].relatives[k] != undefined) {
                    if (npc[i].relatives[k] == "child") {
                        newb.relatives[k] = "sibling";
                        npc[k].relatives[npc.length-1] = "sibling"
                    } else if (npc[i].relatives[k] == "parent") {
                        newb.relatives[k] = "grandparent";
                        npc[k].relatives[npc.length-1] = "grandchild"
                    } else if (npc[i].relatives[k] == "sibling") {
                        newb.relatives[k] = "parsib";
                        npc[k].relatives[npc.length-1] = "sibchild"
                    } else if (npc[i].relatives[k] == "sibchild") {
                        newb.relatives[k] = "cousin";
                        npc[k].relatives[npc.length-1] = "cousin"
                    }
                }
                //console.log("need something here");
            }
            newb.relatives[i] = "parent";
            npc[i].relatives[npc.length-1] = "child";
            for (var j=0;j<npc[i].rTwo.length;j++) {
                if (npc[i].rTwo[j] != undefined) {
                    if (npc[i].rTwo[j].commitment == 1) {
                        newb.relatives[j] = "parent";
                        npc[j].relatives[npc.length-1] = "child";
                    }
                }
            }
            $("#textlog").append("On day " + counter + ", " + npc[i].firstName + " (age " + npc[i].ageInYears() + ") gave birth to " + newb.firstName + ".<br>");
            for (var l=0;l<10;l++) {
                interactWith(npc[i], newb);
            }
        }
    }
}

function resolveDeaths() {
    for (var i=0;i<npc.length;i++) {
        if (npc[i].ageInYears() > 75 && npc[i].alive == 1 && randomInt(1, 20 * 365) == 1) {
            npc[i].alive = 0;
            charPanels[i] = undefined;
            $("#textlog").append("On day " + counter + ", " + npc[i].firstName + " died at age " + npc[i].ageInYears() + ".<br>");
            displayCharPanels();        
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
    if (persona.rTwo[npc.indexOf(personb)].commitment > 0) {
        description += ("They are in a relationship. ");
    } else if (persona.rTwo[npc.indexOf(personb)].romance > 10 && persona.ageInYears() >= 6) {
        description += ("They fool around. ");
    } else if (persona.rTwo[npc.indexOf(personb)].attraction > 100 && persona.ageInYears() >= 6) {
        description += (persona.firstName + " is attracted to " + personb.firstName + ". ");
    }
    if (persona.relatives[npc.indexOf(personb)] != undefined) {
        description += (personb.firstName + " is " + persona.firstName + "'s " + relaParser(persona, personb) + ". ")
    }
    if (persona.rTwo[npc.indexOf(personb)].coitus > 0) {
        description += ("They have slept together. ");
    }
    return description;
}

function describeCharacter(n) {
    var p = n;
    var d = "";
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
        d += ("<li>" + p.myTypes[i].title + "</li>");
    }
    d+= "</ul><br>"
    d+= ("Honor: " + p.honor + "<br>");
    d+= ("CoitusCounter: " + p.coitusCounter + "<br>")
    return d;
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

function createCharacter() {
    var g = 0;
    if (randomInt(1,100) <= genderRatio) {g = 1}
    var nam;
    if (g == 1) {nam = pickFrom(boyNames);} else {nam = pickFrom(girlNames);}
    var jk = new person(nam, randomAge(), g);
    var c = randomInt(2, 5);
        for (k=0;k<c;k++) {
            jk.myTypes.push(pickFrom(romanticTypes));
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
            r = npc[iter].rTwo[j];
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
        while (npc.indexOf(u) == iter || npc.indexOf(u).alive == 0) {
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
    var now = new Date();
    $("#startTime").text(now);
    for (var i=0;i<characterCount;i++) {
        addNPC();
    }
    makeRelative(pickFrom(npc));
    //displayCharPanel();
    displayCharPanels();
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
    for (var i=0;i<charPanels.length;i++) {
        if (charPanels[i] != undefined) {
            $("#dashpanel").append(charPanels[i]);
        }
    }
    $('[data-toggle="popover"]').popover();
}

function createCharPanel(id) {
    var panel = (
        "<hr><div class='row charcard' id='npc"+id+"'><div class='col-8'>Name: <span id='npcname" + id + "'><strong></strong></span> (<span id='npcgender" + id + "'></span>)<br>" +
            "Age: <span id='npcyears" + id + "'></span><br>" +
            "Happiness quotient: <span id='npchappy" +id+"'></span><br>" +
            "<span id='npcactivity"+id+"'></span><br>" +
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover click" data-offset="5" data-html="true" title="Relationships" data-content="She has no friends yet." id="npcrel' + id + '">Relationships</a></div>' +
            "<div class='col-4'>Beauty: <span id='npcbeauty" + id + "'></span><br>Athletics: <span id='npcathletics"+id+"'></span><br>Intellect: <span id='npcintellect"+id+"'></span><br>Social: <span id='npcsocial"+id+"'></span><br>" + 
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover click" data-offset="5" data-html="true" title="Description" data-content="Some content inside the popover" id="npcdesc' + id + '">Description</a>' + 
            "</div>"+"</div>"
    )
    return panel;
}

//$("#dashpanel").append(createCharPanel(99));

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
    meetPeopleTwo();
    resolvePregnancies();
    resolveDeaths();
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
        $("#npcname" + i).text(npc[i].firstName);
        var g;
        if (npc[i].gender == 0) {g = "F"} else {g = "M"}
        $("#npcgender" + i).text(g);
        $("#npcbeauty" + i).text(npc[i].beauty);
        $("#npcathletics" + i).text(npc[i].athletics);
        $("#npcintellect" + i).text(npc[i].intellect);
        $("#npcsocial" + i).text(npc[i].social);
        $("#npchappy" + i).html(npc[i].happiness + " | " + (npc[i].happiness/counter).toFixed(2) + " hpd");
        $("#npcyears" + i).html(npc[i].ageInYears());
        var des = "";
        for (var j = 0; j < npc.length; j++) {
            if (describeRelationship(npc[i], npc[j]) != 0 && npc[j].alive == 1) {
                des += (describeRelationship(npc[i], npc[j]) + "<br>");
            }
        }
        var des2 = describeCharacter(npc[i]);
        $("#npcrel" + i).attr("data-content", des);
        $("#npcdesc" + i).attr("data-content", des2);
    }
    $("#counter").text(counter);
    $("#years").text(Math.floor(counter/365) + 1);
    $("#population").text(popCalc().pop);
    $("#fpop").text(popCalc().f);
    $("#mpop").text(popCalc().m);
}

function printStats() {
    console.log(counter);
    console.log(npc);
    for (var i=0;i<npc.length;i++) {
        console.log(npc[i].firstName + npc[i].isAttached());
    }
}

$(document).ready(gameStart());

$("#testbutton").click(function() {printStats();});
$("#testbutton2").click(function() {loopTime += 15;});
$("#testbutton3").click(function() {addNPC(); $("#dashpanel").append(charPanels[charPanels.length-1]);$('[data-toggle="popover"]').popover(); });
$("#pausebutton").click(function() {pauseGame();});

</script>
  </body>
</html>