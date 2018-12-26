// CommuniSim utilities.js

$("#petdash").hide();
$("#devdash").hide();

var hairColors = ["brown","black","chestnut","blonde","red","strawberry blonde","golden","dirty blond","auburn","brunette","dark brown","light blonde","ginger","Titian"]
var eyeColors = ["brown","blue","grey","green","hazel","dark","amber"]

var girlNames = ['Aaliyah', 'Abbey', 'Abbie', 'Abbigail', 'Abby', 'Abigail', 'Abril', 'Ada', 'Adaline', 'Adalyn', 'Adalynn', 'Addilyn', 'Addison', 'Addisyn', 'Addyson', 'Adelaide', 'Adelina', 'Adeline', 'Adelyn', 'Adelynn', 'Adrian', 'Adriana', 'Adrianna', 'Adrianne', 'Adrienne', 'Aileen', 'Aimee', 'Ainsley', 'Aisha', 'Aja', 'Alaina', 'Alana', 'Alani', 'Alanna', 'Alayna', 'Aleah', 'Aleena', 'Alejandra', 'Alessandra', 'Alexa', 'Alexandra', 'Alexandrea', 'Alexandria', 'Alexia', 'Alexis', 'Alexus', 'Alice', 'Alicia', 'Alina', 'Alisa', 'Alisha', 'Alison', 'Alissa', 'Alivia', 'Aliyah', 'Allie', 'Allison', 'Allisson', 'Ally', 'Allyson', 'Alma', 'Alondra', 'Alysha', 'Alyson', 'Alyssa', 'Amanda', 'Amara', 'Amari', 'Amaya', 'Amber', 'Amelia', 'America', 'Amie', 'Amina', 'Amira', 'Amiyah', 'Amy', 'Amya', 'Ana', 'Anabelle', 'Anahi', 'Analia', 'Anastasia', 'Anaya', 'Andrea', 'Angel', 'Angela', 'Angelia', 'Angelica', 'Angelina', 'Angelique', 'Angie', 'Anika', 'Anissa', 'Anita', 'Anitra', 'Aniya', 'Aniyah', 'Ann', 'Anna', 'Annabel', 'Annabella', 'Annabelle', 'Annalise', 'Anne', 'Annette', 'Annie', 'Annika', 'Antoinette', 'Antonia', 'Anya', 'April', 'Arabella', 'Araceli', 'Aria', 'Ariah', 'Ariana', 'Arianna', 'Ariel', 'Ariella', 'Arielle', 'Ariyah', 'Arlene', 'Arya', 'Ashanti', 'Ashely', 'Ashlee', 'Ashleigh', 'Ashley', 'Ashlie', 'Ashly', 'Ashlyn', 'Ashlynn', 'Ashton', 'Asia', 'Aspen', 'Athena', 'Aubree', 'Aubrey', 'Aubrie', 'Audra', 'Audrey', 'Audrina', 'Aurora', 'Autumn', 'Ava', 'Averie', 'Avery', 'Aviana', 'Avianna', 'Ayanna', 'Ayla', 'Aylin', 'Bailee', 'Bailey', 'Barbara', 'Baylee', 'Beatrice', 'Beatriz', 'Becky', 'Belinda', 'Bella', 'Bernadette', 'Beth', 'Bethany', 'Betsy', 'Betty', 'Beverly', 'Bianca', 'Billie', 'Blair', 'Blake', 'Blakely', 'Blanca', 'Bobbi', 'Bobbie', 'Bonnie', 'Braelyn', 'Braelynn', 'Brandi', 'Brandie', 'Brandy', 'Breana', 'Breanna', 'Breanne', 'Brenda', 'Brenna', 'Bria', 'Briana', 'Brianna', 'Brianne', 'Bridget', 'Bridgett', 'Bridgette', 'Briella', 'Brielle', 'Brinley', 'Brisa', 'Bristol', 'Britany', 'Britney', 'Brittani', 'Brittany', 'Brittney', 'Brittni', 'Brook', 'Brooke', 'Brooklyn', 'Brooklynn', 'Bryanna', 'Brylee', 'Brynlee', 'Brynn', 'Cadence', 'Caitlin', 'Caitlyn', 'Cali', 'Calista', 'Callie', 'Cameron', 'Camila', 'Camilla', 'Camille', 'Camryn', 'Candace', 'Candice', 'Candy', 'Cara', 'Carey', 'Cari', 'Carina', 'Carissa', 'Carla', 'Carley', 'Carlie', 'Carly', 'Carmen', 'Carol', 'Carolina', 'Caroline', 'Carolyn', 'Carrie', 'Carter', 'Casandra', 'Casey', 'Cassandra', 'Cassidy', 'Cassie', 'Cataleya', 'Catalina', 'Catherine', 'Cathy', 'Catrina', 'Cayla', 'Caylee', 'Cecilia', 'Cecily', 'Celeste', 'Celia', 'Celina', 'Celine', 'Chanda', 'Chandler', 'Chandra', 'Chanel', 'Chantel', 'Charity', 'Charlee', 'Charleigh', 'Charlene', 'Charley', 'Charlie', 'Charlotte', 'Chasity', 'Chastity', 'Chelsea', 'Chelsey', 'Chelsie', 'Cheri', 'Cherie', 'Cheryl', 'Cheyanne', 'Cheyenne', 'Chloe', 'Chrissy', 'Christa', 'Christen', 'Christi', 'Christian', 'Christie', 'Christin', 'Christina', 'Christine', 'Christopher', 'Christy', 'Chrystal', 'Chyna', 'Ciara', 'Ciera', 'Cierra', 'Cindy', 'Claire', 'Clara', 'Clare', 'Clarissa', 'Claudia', 'Colette', 'Colleen', 'Connie', 'Constance', 'Cora', 'Corinne', 'Cortney', 'Courtney', 'Cristal', 'Cristina', 'Cristy', 'Crystal', 'Cynthia', 'Dahlia', 'Daisy', 'Dakota', 'Daleyza', 'Dalia', 'Dana', 'Danica', 'Daniela', 'Daniella', 'Danielle', 'Danika', 'Danna', 'Daphne', 'Dara', 'Darby', 'Darcy', 'Darian', 'Darla', 'Darlene', 'Dawn', 'Dayana', 'Dayanara', 'Dayna', 'Deana', 'Deanna', 'Debbie', 'Deborah', 'Debra', 'Deja', 'Delaney', 'Delilah', 'Demetria', 'Demi', 'Dena', 'Denise', 'Desirae', 'Desiree', 'Destinee', 'Destiny', 'Devin', 'Devon', 'Diamond', 'Diana', 'Diane', 'Dianna', 'Dina', 'Dominique', 'Donna', 'Dora', 'Doris', 'Dorothy', 'Dulce', 'Dylan', 'Ebony', 'Eden', 'Edith', 'Eileen', 'Elaina', 'Elaine', 'Eleanor', 'Elena', 'Eliana', 'Elianna', 'Elisa', 'Elisabeth', 'Elise', 'Elisha', 'Elissa', 'Eliza', 'Elizabeth', 'Ella', 'Elle', 'Ellen', 'Elliana', 'Ellie', 'Eloise', 'Elsa', 'Elsie', 'Elyse', 'Ember', 'Emely', 'Emerson', 'Emersyn', 'Emery', 'Emilee', 'Emilia', 'Emilie', 'Emily', 'Emma', 'Emmalyn', 'Erica', 'Ericka', 'Erika', 'Erin', 'Esmeralda', 'Esperanza', 'Essence', 'Esther', 'Estrella', 'Eva', 'Evangeline', 'Eve', 'Evelyn', 'Evelynn', 'Everleigh', 'Everly', 'Evie', 'Faith', 'Fallon', 'Farrah', 'Fatima', 'Felicia', 'Felicity', 'Fernanda', 'Finley', 'Fiona', 'Frances', 'Francesca', 'Freya', 'Gabriela', 'Gabriella', 'Gabrielle', 'Gail', 'Gemma', 'Gena', 'Genesis', 'Genevieve', 'Georgia', 'Gia', 'Gianna', 'Gillian', 'Gina', 'Ginger', 'Giselle', 'Gisselle', 'Giuliana', 'Glenda', 'Gloria', 'Grace', 'Gracelyn', 'Gracelynn', 'Gracie', 'Gretchen', 'Guadalupe', 'Gwendolyn', 'Hadley', 'Hailee', 'Hailey', 'Hailie', 'Haleigh', 'Haley', 'Halle', 'Hallie', 'Hanna', 'Hannah', 'Harley', 'Harlow', 'Harmony', 'Harper', 'Hattie', 'Haven', 'Hayden', 'Haylee', 'Hayley', 'Haylie', 'Hazel', 'Heather', 'Heaven', 'Heidi', 'Helen', 'Helena', 'Henley', 'Hilary', 'Hillary', 'Hollie', 'Holly', 'Hope', 'Hunter', 'Imani', 'India', 'Infant', 'Ingrid', 'Irene', 'Iris', 'Irma', 'Isabel', 'Isabela', 'Isabella', 'Isabelle', 'Isis', 'Isla', 'Itzel', 'Ivy', 'Izabella', 'Jackie', 'Jacklyn', 'Jaclyn', 'Jacqueline', 'Jacquelyn', 'Jada', 'Jade', 'Jaden', 'Jadyn', 'Jaelyn', 'Jaiden', 'Jailene', 'Jaime', 'Jaimie', 'Jaleesa', 'Jalisa', 'Jaliyah', 'Jami', 'Jamie', 'Jana', 'Janae', 'Janay', 'Jane', 'Janel', 'Janell', 'Janelle', 'Janet', 'Janette', 'Janice', 'Janie', 'Janine', 'Janiya', 'Janiyah', 'Janna', 'Jaqueline', 'Jaslene', 'Jasmin', 'Jasmine', 'Jayda', 'Jayden', 'Jayla', 'Jaylah', 'Jayleen', 'Jaylynn', 'Jayme', 'Jazlyn', 'Jazmin', 'Jazmine', 'Jean', 'Jeanette', 'Jeanine', 'Jeanne', 'Jeannette', 'Jeannie', 'Jena', 'Jenifer', 'Jenna', 'Jennie', 'Jennifer', 'Jenny', 'Jesse', 'Jessica', 'Jessie', 'Jill', 'Jillian', 'Jimena', 'Jo', 'Joan', 'Joann', 'Joanna', 'Joanne', 'Jocelyn', 'Jodi', 'Jodie', 'Jody', 'Johanna', 'Jolene', 'Joni', 'Jordan', 'Jordyn', 'Joselyn', 'Josephine', 'Josie', 'Journee', 'Journey', 'Joy', 'Joyce', 'Juanita', 'Judith', 'Judy', 'Julia', 'Juliana', 'Julianna', 'Julianne', 'Julie', 'Juliet', 'Juliette', 'Julissa', 'June', 'Juniper', 'Justice', 'Justine', 'Kacie', 'Kadence', 'Kaelyn', 'Kaia', 'Kaila', 'Kailee', 'Kailey', 'Kailyn', 'Kaitlin', 'Kaitlyn', 'Kaitlynn', 'Kala', 'Kaleigh', 'Kaley', 'Kali', 'Kaliyah', 'Kamila', 'Kamryn', 'Kara', 'Karen', 'Kari', 'Karin', 'Karina', 'Karissa', 'Karla', 'Karrie', 'Kasey', 'Kassandra', 'Kassidy', 'Katarina', 'Kate', 'Katelyn', 'Katelynn', 'Katharine', 'Katherine', 'Kathleen', 'Kathryn', 'Kathy', 'Katie', 'Katina', 'Katlyn', 'Katrina', 'Katy', 'Kayden', 'Kaydence', 'Kayla', 'Kaylee', 'Kayleigh', 'Kaylie', 'Kaylin', 'Keely', 'Kehlani', 'Keira', 'Keisha', 'Kelley', 'Kelli', 'Kellie', 'Kelly', 'Kelsey', 'Kelsi', 'Kelsie', 'Kendall', 'Kendra', 'Kenley', 'Kennedi', 'Kennedy', 'Kensley', 'Kenya', 'Kenzie', 'Keri', 'Kerri', 'Kerrie', 'Kerry', 'Keshia', 'Khadijah', 'Khloe', 'Kiana', 'Kiara', 'Kiera', 'Kierra', 'Kiersten', 'Kiley', 'Kim', 'Kimberlee', 'Kimberley', 'Kimberly', 'Kimora', 'Kinley', 'Kinsley', 'Kira', 'Kirby', 'Kirsten', 'Kirstie', 'Kisha', 'Kizzy', 'Kourtney', 'Krista', 'Kristal', 'Kristen', 'Kristi', 'Kristie', 'Kristin', 'Kristina', 'Kristine', 'Kristy', 'Krystal', 'Krystina', 'Krystle', 'Kyla', 'Kylee', 'Kyleigh', 'Kylie', 'Kyra', 'Lacey', 'Laci', 'Lacie', 'Lacy', 'Ladonna', 'Laila', 'Lainey', 'Lakeisha', 'Lakesha', 'Lakisha', 'Lana', 'Laney', 'Lara', 'Larissa', 'Lashonda', 'Latanya', 'Latasha', 'Latisha', 'Latonya', 'Latosha', 'Latoya', 'Latrice', 'Laura', 'Laurel', 'Lauren', 'Laurie', 'Lauryn', 'Lawanda', 'Layla', 'Lea', 'Leah', 'Leann', 'Leanna', 'Leanne', 'Lee', 'Leeann', 'Leia', 'Leigh', 'Leighton', 'Leila', 'Leilani', 'Lena', 'Lennon', 'Lesley', 'Leslie', 'Lesly', 'Leticia', 'Lexi', 'Lexie', 'Lexus', 'Lia', 'Liana', 'Liberty', 'Lila', 'Lilah', 'Lilian', 'Liliana', 'Lilith', 'Lillian', 'Lilliana', 'Lillie', 'Lilly', 'Lily', 'Lilyana', 'Linda', 'Lindsay', 'Lindsey', 'Lisa', 'Litzy', 'Liza', 'Lizbeth', 'Lizette', 'Lola', 'London', 'Londyn', 'Lora', 'Lorelei', 'Lorena', 'Loretta', 'Lori', 'Lorie', 'Lorraine', 'Lucia', 'Luciana', 'Lucille', 'Lucy', 'Luna', 'Luz', 'Lydia', 'Lyla', 'Lynda', 'Lyndsay', 'Lyndsey', 'Lynette', 'Lynn', 'Lyric', 'Mabel', 'Macey', 'Maci', 'Macie', 'Mackenzie', 'Macy', 'Madalyn', 'Maddison', 'Madeleine', 'Madeline', 'Madelyn', 'Madelynn', 'Madilyn', 'Madilynn', 'Madison', 'Madisyn', 'Madyson', 'Maegan', 'Maeve', 'Maggie', 'Magnolia', 'Maia', 'Maisie', 'Makayla', 'Makenna', 'Makenzie', 'Malaysia', 'Malia', 'Malinda', 'Maliyah', 'Mallory', 'Mandi', 'Mandy', 'Maranda', 'Marcella', 'Marci', 'Marcia', 'Marcie', 'Marcy', 'Marely', 'Margaret', 'Margarita', 'Margot', 'Maria', 'Mariah', 'Mariana', 'Marianne', 'Maribel', 'Maricela', 'Marie', 'Mariela', 'Marilyn', 'Marina', 'Marisa', 'Marisol', 'Marissa', 'Maritza', 'Marjorie', 'Marla', 'Marlee', 'Marlena', 'Marlene', 'Marley', 'Marquita', 'Marsha', 'Martha', 'Mary', 'Maryam', 'Matilda', 'Maureen', 'Maya', 'Mayra', 'Mckayla', 'Mckenna', 'Mckenzie', 'Mckinley', 'Meagan', 'Meaghan', 'Megan', 'Meghan', 'Melanie', 'Melany', 'Melina', 'Melinda', 'Melisa', 'Melissa', 'Melody', 'Mercedes', 'Meredith', 'Mia', 'Micaela', 'Michaela', 'Michele', 'Michelle', 'Mikaela', 'Mikayla', 'Mila', 'Miley', 'Millie', 'Mindy', 'Mira', 'Miracle', 'Miranda', 'Mireya', 'Miriam', 'Misti', 'Misty', 'Mollie', 'Molly', 'Monica', 'Monique', 'Montana', 'Morgan', 'Moriah', 'Mya', 'Myla', 'Mylee', 'Myra', 'Nadia', 'Nadine', 'Nakia', 'Nancy', 'Naomi', 'Natalee', 'Natalia', 'Natalie', 'Nataly', 'Natasha', 'Nathalie', 'Nayeli', 'Nevaeh', 'Nia', 'Nichole', 'Nicole', 'Nicolette', 'Nikita', 'Nikki', 'Nina', 'Noelle', 'Noemi', 'Nora', 'Norah', 'Norma', 'Nova', 'Nyah', 'Nyla', 'Nylah', 'Oakley', 'Octavia', 'Olga', 'Olive', 'Olivia', 'Ophelia', 'Paige', 'Paislee', 'Paisley', 'Pamela', 'Paola', 'Paris', 'Parker', 'Patrice', 'Patricia', 'Paula', 'Paulina', 'Payton', 'Peggy', 'Penelope', 'Penny', 'Perla', 'Peyton', 'Phoebe', 'Phoenix', 'Piper', 'Precious', 'Presley', 'Priscilla', 'Quinn', 'Rachael', 'Rachel', 'Rachelle', 'Raegan', 'Raelyn', 'Raelynn', 'Ramona', 'Randi', 'Raquel', 'Raven', 'Reagan', 'Rebecca', 'Rebekah', 'Reese', 'Regan', 'Regina', 'Remi', 'Remington', 'Renata', 'Renee', 'Rhiannon', 'Rhonda', 'Rihanna', 'Riley', 'Rita', 'River', 'Roberta', 'Robin', 'Robyn', 'Rochelle', 'Ronda', 'Rosa', 'Rosalie', 'Rosanna', 'Rose', 'Rosemary', 'Rowan', 'Roxanne', 'Royalty', 'Rubi', 'Ruby', 'Ruth', 'Ryan', 'Rylee', 'Ryleigh', 'Rylie', 'Sabrina', 'Sade', 'Sadie', 'Sage', 'Sally', 'Samantha', 'Samara', 'Sandra', 'Sandy', 'Saniya', 'Saniyah', 'Sara', 'Sarah', 'Sarai', 'Sasha', 'Savanah', 'Savanna', 'Savannah', 'Sawyer', 'Saylor', 'Scarlet', 'Scarlett', 'Selah', 'Selena', 'Selina', 'Serena', 'Serenity', 'Shaina', 'Shameka', 'Shamika', 'Shana', 'Shanda', 'Shania', 'Shanice', 'Shanika', 'Shaniqua', 'Shanna', 'Shannon', 'Shantel', 'Shari', 'Sharon', 'Shauna', 'Shawn', 'Shawna', 'Shayla', 'Shayna', 'Sheena', 'Sheila', 'Shelbi', 'Shelby', 'Shelia', 'Shelley', 'Shelly', 'Sheri', 'Sherlyn', 'Sherri', 'Sherrie', 'Sherry', 'Sheryl', 'Shirley', 'Shonda', 'Shyanne', 'Sidney', 'Sienna', 'Sierra', 'Silvia', 'Simone', 'Skye', 'Skyla', 'Skylar', 'Skyler', 'Sloane', 'Sofia', 'Sommer', 'Sonia', 'Sonja', 'Sonya', 'Sophia', 'Sophie', 'Stacey', 'Staci', 'Stacie', 'Stacy', 'Stefanie', 'Stella', 'Stephani', 'Stephanie', 'Stephany', 'Summer', 'Susan', 'Susana', 'Suzanne', 'Sydney', 'Sylvia', 'Tabatha', 'Tabitha', 'Talia', 'Tamara', 'Tameka', 'Tami', 'Tamia', 'Tamika', 'Tamiko', 'Tammi', 'Tammie', 'Tammy', 'Tania', 'Tanisha', 'Tanya', 'Tara', 'Taryn', 'Tasha', 'Tatiana', 'Tatum', 'Tatyana', 'Tayler', 'Taylor', 'Teagan', 'Tenley', 'Tennille', 'Tera', 'Teresa', 'Teri', 'Terra', 'Terri', 'Terry', 'Tess', 'Tessa', 'Thalia', 'Thea', 'Theresa', 'Tia', 'Tiana', 'Tianna', 'Tiara', 'Tierra', 'Tiffani', 'Tiffanie', 'Tiffany', 'Tina', 'Tisha', 'Tomeka', 'Toni', 'Tonia', 'Tonya', 'Tori', 'Tosha', 'Tracey', 'Traci', 'Tracie', 'Tracy', 'Tricia', 'Trina', 'Trinity', 'Trisha', 'Trista', 'Tyler', 'Tyra', 'Valentina', 'Valeria', 'Valerie', 'Vanessa', 'Vera', 'Veronica', 'Vicki', 'Vickie', 'Vicky', 'Victoria', 'Violet', 'Virginia', 'Vivian', 'Viviana', 'Vivienne', 'Wanda', 'Wendi', 'Wendy', 'Whitley', 'Whitney', 'Willa', 'Willow', 'Winter', 'Wren', 'Ximena', 'Yadira', 'Yaretzi', 'Yasmin', 'Yasmine', 'Yesenia', 'Yolanda', 'Yoselin', 'Yulissa', 'Yvette', 'Yvonne', 'Zara', 'Zaria', 'Zariah', 'Zoe', 'Zoey', 'Zuri', 'Zoie']
var boyNames = ['Aaden', 'Aarav', 'Aaron', 'Aarush', 'Abdiel', 'Abdullah', 'Abel', 'Abraham', 'Abram', 'Ace', 'Adam', 'Adan', 'Aden', 'Adonis', 'Adrian', 'Adriel', 'Adrien', 'Aedan', 'Agustin', 'Ahmad', 'Ahmed', 'Aidan', 'Aiden', 'Aidyn', 'Alan', 'Albert', 'Alberto', 'Alden', 'Aldo', 'Alec', 'Alejandro', 'Alessandro', 'Alex', 'Alexander', 'Alexis', 'Alexzander', 'Alfonso', 'Alfred', 'Alfredo', 'Ali', 'Alijah', 'Allan', 'Allen', 'Alonso', 'Alonzo', 'Alvaro', 'Alvin', 'Amare', 'Amari', 'Ameer', 'Amir', 'Anders', 'Anderson', 'Andre', 'Andres', 'Andrew', 'Andy', 'Angel', 'Angelo', 'Anthony', 'Antoine', 'Antonio', 'Antony', 'Antwan', 'Archer', 'Ari', 'Ariel', 'Arjun', 'Armando', 'Armani', 'Arnav', 'Aron', 'Arthur', 'Arturo', 'Aryan', 'Asa', 'Asher', 'Ashton', 'Atticus', 'August', 'Augustus', 'Austin', 'Avery', 'Axel', 'Ayaan', 'Aydan', 'Ayden', 'Aydin', 'Barrett', 'Barry', 'Beau', 'Beckett', 'Beckham', 'Ben', 'Benjamin', 'Bennett', 'Benson', 'Bentlee', 'Bentley', 'Bently', 'Bernard', 'Billy', 'Blaine', 'Blaise', 'Blake', 'Blaze', 'Bo', 'Bobby', 'Bode', 'Bodhi', 'Boston', 'Brad', 'Braden', 'Bradford', 'Bradley', 'Brady', 'Bradyn', 'Braeden', 'Braiden', 'Branden', 'Brandon', 'Branson', 'Brantley', 'Braxton', 'Brayan', 'Brayden', 'Braydon', 'Braylen', 'Braylon', 'Brendan', 'Brenden', 'Brendon', 'Brennan', 'Brennen', 'Brent', 'Brett', 'Brian', 'Brice', 'Bridger', 'Brock', 'Broderick', 'Brodie', 'Brody', 'Brogan', 'Bronson', 'Brooks', 'Bruce', 'Bruno', 'Bryan', 'Bryant', 'Bryce', 'Brycen', 'Bryson', 'Byron', 'Cade', 'Caden', 'Cael', 'Caiden', 'Cain', 'Cale', 'Caleb', 'Callen', 'Callum', 'Calvin', 'Camden', 'Camdyn', 'Cameron', 'Camren', 'Camron', 'Camryn', 'Cannon', 'Carl', 'Carlos', 'Carmelo', 'Carsen', 'Carson', 'Carter', 'Case', 'Casen', 'Casey', 'Cash', 'Cason', 'Cayden', 'Cedric', 'Cesar', 'Chace', 'Chad', 'Chadwick', 'Chaim', 'Chance', 'Chandler', 'Channing', 'Charles', 'Charlie', 'Chase', 'Chris', 'Christian', 'Christopher', 'Clarence', 'Clark', 'Clay', 'Clayton', 'Clifford', 'Clifton', 'Clint', 'Clinton', 'Cody', 'Cohen', 'Colby', 'Cole', 'Coleman', 'Colin', 'Collin', 'Colt', 'Colten', 'Colton', 'Conner', 'Connor', 'Conor', 'Conrad', 'Cooper', 'Corbin', 'Corey', 'Cortez', 'Cory', 'Craig', 'Cristian', 'Cristofer', 'Cristopher', 'Cruz', 'Cullen', 'Curtis', 'Cyrus', 'Dakota', 'Dale', 'Dallas', 'Dalton', 'Damari', 'Damarion', 'Damian', 'Damien', 'Damion', 'Damon', 'Dana', 'Dane', 'Dangelo', 'Daniel', 'Danny', 'Dante', 'Darian', 'Darien', 'Darin', 'Dario', 'Darius', 'Darnell', 'Darrell', 'Darren', 'Darryl', 'Darwin', 'Daryl', 'Dashawn', 'Davian', 'David', 'Davin', 'Davion', 'Davis', 'Davon', 'Dawson', 'Dax', 'Daxton', 'Daylen', 'Dayton', 'Deacon', 'Dean', 'Deandre', 'Deangelo', 'Declan', 'Deegan', 'Demarcus', 'Demarion', 'Demetrius', 'Dennis', 'Deon', 'Derek', 'Derick', 'Derrick', 'Deshawn', 'Desmond', 'Devan', 'Deven', 'Devin', 'Devon', 'Devyn', 'Dexter', 'Diego', 'Dilan', 'Dillon', 'Dominic', 'Dominick', 'Dominik', 'Dominique', 'Don', 'Donald', 'Donnie', 'Donovan', 'Donte', 'Dorian', 'Douglas', 'Drake', 'Draven', 'Drew', 'Duane', 'Duncan', 'Dustin', 'Dwayne', 'Dwight', 'Dylan', 'Ean', 'Earl', 'Easton', 'Eddie', 'Eden', 'Edgar', 'Edison', 'Eduardo', 'Edward', 'Edwin', 'Efrain', 'Eli', 'Elian', 'Elias', 'Elijah', 'Eliot', 'Elliot', 'Elliott', 'Ellis', 'Emanuel', 'Emerson', 'Emery', 'Emiliano', 'Emilio', 'Emmanuel', 'Emmett', 'Emmitt', 'Enrique', 'Enzo', 'Eric', 'Erick', 'Erik', 'Ernest', 'Ernesto', 'Esteban', 'Ethan', 'Eugene', 'Evan', 'Everett', 'Evert', 'Ezekiel', 'Ezequiel', 'Ezra', 'Fabian', 'Felipe', 'Felix', 'Fernando', 'Finley', 'Finn', 'Finnegan', 'Fisher', 'Fletcher', 'Francis', 'Francisco', 'Franco', 'Frank', 'Frankie', 'Franklin', 'Fred', 'Freddy', 'Frederick', 'Fredrick', 'Gabriel', 'Gael', 'Gage', 'Gaige', 'Garrett', 'Gary', 'Gauge', 'Gavin', 'Gavyn', 'Geoffrey', 'George', 'Gerald', 'Gerardo', 'Giancarlo', 'Gianni', 'Gibson', 'Gideon', 'Gilbert', 'Gilberto', 'Giovani', 'Giovanni', 'Giovanny', 'Glen', 'Glenn', 'Grady', 'Graham', 'Grant', 'Grayson', 'Greg', 'Gregory', 'Greyson', 'Griffin', 'Guillermo', 'Gunnar', 'Gunner', 'Gustavo', 'Haiden', 'Hamza', 'Hank', 'Harley', 'Harold', 'Harper', 'Harrison', 'Harry', 'Hassan', 'Hayden', 'Hayes', 'Heath', 'Hector', 'Henry', 'Herbert', 'Hezekiah', 'Holden', 'Houston', 'Howard', 'Hudson', 'Hugh', 'Hugo', 'Humberto', 'Hunter', 'Ian', 'Ibrahim', 'Ignacio', 'Iker', 'Irvin', 'Isaac', 'Isai', 'Isaiah', 'Isaias', 'Ishaan', 'Isiah', 'Ismael', 'Israel', 'Issac', 'Ivan', 'Izaiah', 'Izayah', 'Jabari', 'Jace', 'Jack', 'Jackie', 'Jackson', 'Jacob', 'Jacoby', 'Jaden', 'Jadiel', 'Jadon', 'Jadyn', 'Jaeden', 'Jagger', 'Jaiden', 'Jaidyn', 'Jaime', 'Jair', 'Jairo', 'Jake', 'Jakob', 'Jakobe', 'Jalen', 'Jamal', 'Jamar', 'Jamari', 'Jamarion', 'James', 'Jameson', 'Jamie', 'Jamir', 'Jamison', 'Jared', 'Jaron', 'Jarrod', 'Jase', 'Jasiah', 'Jason', 'Jasper', 'Javier', 'Javion', 'Javon', 'Jax', 'Jaxen', 'Jaxon', 'Jaxson', 'Jaxton', 'Jay', 'Jayce', 'Jaycob', 'Jayden', 'Jaydin', 'Jaydon', 'Jaylen', 'Jaylin', 'Jaylon', 'Jayson', 'Jayvion', 'Jean', 'Jedidiah', 'Jeff', 'Jefferson', 'Jeffery', 'Jeffrey', 'Jencarlos', 'Jensen', 'Jeramiah', 'Jeremiah', 'Jeremy', 'Jerimiah', 'Jermaine', 'Jerome', 'Jerry', 'Jesse', 'Jessie', 'Jesus', 'Jett', 'Jimmy', 'Joaquin', 'Jody', 'Joe', 'Joel', 'Joey', 'Johan', 'Johann', 'John', 'Johnathan', 'Johnathon', 'Johnny', 'Jon', 'Jonah', 'Jonas', 'Jonathan', 'Jonathon', 'Jordan', 'Jorden', 'Jordyn', 'Jorge', 'Jose', 'Joseph', 'Joshua', 'Josiah', 'Josue', 'Jovani', 'Jovanni', 'Juan', 'Judah', 'Jude', 'Julian', 'Julien', 'Julio', 'Julius', 'Junior', 'Justice', 'Justin', 'Justus', 'Kade', 'Kaden', 'Kadyn', 'Kaeden', 'Kael', 'Kai', 'Kaiden', 'Kale', 'Kaleb', 'Kamari', 'Kamden', 'Kameron', 'Kamron', 'Kamryn', 'Kane', 'Kareem', 'Karl', 'Karson', 'Karter', 'Kasen', 'Kash', 'Kason', 'Kayden', 'Kayson', 'Keagan', 'Keaton', 'Keegan', 'Keenan', 'Keith', 'Kellan', 'Kellen', 'Kelly', 'Kelvin', 'Kendall', 'Kendrick', 'Kenneth', 'Kenny', 'Keon', 'Kerry', 'Kevin', 'Keyon', 'Khalil', 'Kian', 'Kieran', 'Killian', 'King', 'Kingsley', 'Kingston', 'Kirk', 'Knox', 'Kobe', 'Kody', 'Koen', 'Kolby', 'Kole', 'Kolten', 'Kolton', 'Konner', 'Konnor', 'Korbin', 'Krish', 'Kristian', 'Kristopher', 'Kurt', 'Kylan', 'Kyle', 'Kyler', 'Kymani', 'Kyron', 'Kyson', 'Lamar', 'Lamont', 'Lance', 'Landen', 'Landon', 'Landry', 'Landyn', 'Lane', 'Larry', 'Lathan', 'Lawrence', 'Lawson', 'Layne', 'Layton', 'Leandro', 'Lee', 'Legend', 'Leighton', 'Leland', 'Lennon', 'Lennox', 'Leo', 'Leon', 'Leonard', 'Leonardo', 'Leonel', 'Leonidas', 'Leroy', 'Levi', 'Lewis', 'Liam', 'Lincoln', 'Lionel', 'Logan', 'London', 'Lonnie', 'Lorenzo', 'Louis', 'Luca', 'Lucas', 'Lucian', 'Luciano', 'Luis', 'Luka', 'Lukas', 'Luke', 'Lyric', 'Madden', 'Maddox', 'Major', 'Makai', 'Makhi', 'Malachi', 'Malakai', 'Malaki', 'Malcolm', 'Malik', 'Manuel', 'Marc', 'Marcel', 'Marcelo', 'Marco', 'Marcos', 'Marcus', 'Mario', 'Mark', 'Markus', 'Marley', 'Marlon', 'Marquis', 'Marshall', 'Martin', 'Marvin', 'Mason', 'Mateo', 'Mathew', 'Mathias', 'Matias', 'Matteo', 'Matthew', 'Matthias', 'Maurice', 'Mauricio', 'Maverick', 'Max', 'Maxim', 'Maximilian', 'Maximiliano', 'Maximo', 'Maximus', 'Maxwell', 'Maxx', 'Mayson', 'Mekhi', 'Melvin', 'Memphis', 'Menachem', 'Messiah', 'Micah', 'Michael', 'Micheal', 'Miguel', 'Mike', 'Miles', 'Milo', 'Misael', 'Mitchell', 'Mohamed', 'Mohammad', 'Mohammed', 'Moises', 'Morgan', 'Moses', 'Moshe', 'Muhammad', 'Myles', 'Nash', 'Nasir', 'Nathan', 'Nathanael', 'Nathaniel', 'Nehemiah', 'Neil', 'Nelson', 'Nicholas', 'Nickolas', 'Nico', 'Nicolas', 'Nigel', 'Niko', 'Nikolai', 'Nikolas', 'Noah', 'Noe', 'Noel', 'Nolan', 'Norman', 'Octavio', 'Odin', 'Oliver', 'Omar', 'Omari', 'Orion', 'Orlando', 'Oscar', 'Osvaldo', 'Owen', 'Pablo', 'Parker', 'Patrick', 'Paul', 'Paxton', 'Payton', 'Pedro', 'Peter', 'Peyton', 'Philip', 'Phillip', 'Phoenix', 'Pierce', 'Pierre', 'Porter', 'Pranav', 'Preston', 'Prince', 'Quentin', 'Quincy', 'Quinn', 'Quinten', 'Quintin', 'Quinton', 'Rafael', 'Raiden', 'Ralph', 'Ramiro', 'Ramon', 'Randall', 'Randy', 'Raphael', 'Rashad', 'Raul', 'Ray', 'Rayan', 'Rayden', 'Raylan', 'Raymond', 'Reagan', 'Reece', 'Reed', 'Reese', 'Reginald', 'Reid', 'Remington', 'Remy', 'Rene', 'Rex', 'Rey', 'Rhett', 'Rhys', 'Ricardo', 'Richard', 'Ricky', 'Riley', 'River', 'Robert', 'Roberto', 'Rocco', 'Roderick', 'Rodney', 'Rodolfo', 'Rodrigo', 'Rogelio', 'Roger', 'Rohan', 'Roland', 'Rolando', 'Roman', 'Romeo', 'Ronald', 'Ronaldo', 'Ronan', 'Ronin', 'Ronnie', 'Rory', 'Ross', 'Rowan', 'Roy', 'Royce', 'Ruben', 'Rudy', 'Russell', 'Ryan', 'Ryder', 'Ryker', 'Rylan', 'Ryland', 'Rylee', 'Sage', 'Salvador', 'Salvatore', 'Sam', 'Samir', 'Samson', 'Samuel', 'Santiago', 'Santino', 'Santos', 'Saul', 'Sawyer', 'Scott', 'Seamus', 'Sean', 'Sebastian', 'Semaj', 'Sergio', 'Seth', 'Shane', 'Shannon', 'Shaun', 'Shawn', 'Sidney', 'Silas', 'Simon', 'Sincere', 'Skylar', 'Skyler', 'Solomon', 'Sonny', 'Soren', 'Spencer', 'Stacy', 'Stanley', 'Stefan', 'Stephen', 'Sterling', 'Steve', 'Steven', 'Stuart', 'Sullivan', 'Sylas', 'Talan', 'Talon', 'Tanner', 'Tate', 'Tatum', 'Taylor', 'Teagan', 'Terrance', 'Terrell', 'Terrence', 'Terry', 'Theo', 'Theodore', 'Thomas', 'Timothy', 'Titus', 'Tobias', 'Toby', 'Todd', 'Tomas', 'Tommy', 'Tony', 'Trace', 'Tracy', 'Travis', 'Trent', 'Trenton', 'Trevon', 'Trevor', 'Trey', 'Tripp', 'Tristan', 'Tristen', 'Tristian', 'Tristin', 'Triston', 'Troy', 'Trystan', 'Tucker', 'Ty', 'Tyler', 'Tyree', 'Tyrell', 'Tyrese', 'Tyrone', 'Tyson', 'Uriah', 'Uriel', 'Urijah', 'Valentin', 'Valentino', 'Van', 'Vance', 'Vaughn', 'Vernon', 'Vicente', 'Victor', 'Vincent', 'Vincenzo', 'Wade', 'Walker', 'Walter', 'Warren', 'Waylon', 'Wayne', 'Wesley', 'Westin', 'Weston', 'Will', 'William', 'Willie', 'Wilson', 'Winston', 'Wyatt', 'Xander', 'Xavi', 'Xavier', 'Xzavier', 'Yadiel', 'Yael', 'Yahir', 'Yair', 'Yandel', 'Yehuda', 'Yosef', 'Yusuf', 'Zachariah', 'Zachary', 'Zachery', 'Zack', 'Zackary', 'Zackery', 'Zaid', 'Zaiden', 'Zain', 'Zaire', 'Zander', 'Zane', 'Zavier', 'Zayden', 'Zayne', 'Zechariah', 'Zion']
var surNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson', 'White', 'Harris', 'Sanchez', 'Clark', 'Ramirez', 'Lewis', 'Robinson', 'Walker', 'Young', 'Allen', 'King', 'Wright', 'Scott', 'Torres', 'Nguyen', 'Hill', 'Flores', 'Green', 'Adams', 'Nelson', 'Baker', 'Hall', 'Rivera', 'Campbell', 'Mitchell', 'Carter', 'Roberts', 'Gomez', 'Phillips', 'Evans', 'Turner', 'Diaz', 'Parker', 'Cruz', 'Edwards', 'Collins', 'Reyes', 'Stewart', 'Morris', 'Morales', 'Murphy', 'Cook', 'Rogers', 'Gutierrez', 'Ortiz', 'Morgan', 'Cooper', 'Peterson', 'Bailey', 'Reed', 'Kelly', 'Howard', 'Ramos', 'Kim', 'Cox', 'Ward', 'Richardson', 'Watson', 'Brooks', 'Chavez', 'Wood', 'James', 'Bennett', 'Gray', 'Mendoza', 'Ruiz', 'Hughes', 'Price', 'Alvarez', 'Castillo', 'Sanders', 'Patel', 'Myers', 'Long', 'Ross', 'Foster', 'Jimenez', 'Powell', 'Jenkins', 'Perry', 'Russell', 'Sullivan', 'Bell', 'Coleman', 'Butler', 'Henderson', 'Barnes', 'Gonzales', 'Fisher', 'Vasquez', 'Simmons', 'Romero', 'Jordan', 'Patterson', 'Alexander', 'Hamilton', 'Graham', 'Reynolds', 'Griffin', 'Wallace', 'Moreno', 'West', 'Cole', 'Hayes', 'Bryant', 'Herrera', 'Gibson', 'Ellis', 'Tran', 'Medina', 'Aguilar', 'Stevens', 'Murray', 'Ford', 'Castro', 'Marshall', 'Owens', 'Harrison', 'Fernandez', 'Mcdonald', 'Woods', 'Washington', 'Kennedy', 'Wells', 'Vargas', 'Henry', 'Chen', 'Freeman', 'Webb', 'Tucker', 'Guzman', 'Burns', 'Crawford', 'Olson', 'Simpson', 'Porter', 'Hunter', 'Gordon', 'Mendez', 'Silva', 'Shaw', 'Snyder', 'Mason', 'Dixon', 'Munoz', 'Hunt', 'Hicks', 'Holmes', 'Palmer', 'Wagner', 'Black', 'Robertson', 'Boyd', 'Rose', 'Stone', 'Salazar', 'Fox', 'Warren', 'Mills', 'Meyer', 'Rice', 'Schmidt', 'Garza', 'Daniels', 'Ferguson', 'Nichols', 'Stephens', 'Soto', 'Weaver', 'Ryan', 'Gardner', 'Payne', 'Grant', 'Dunn', 'Kelley', 'Spencer', 'Hawkins', 'Arnold', 'Pierce', 'Vazquez', 'Hansen', 'Peters', 'Santos', 'Hart', 'Bradley', 'Knight', 'Elliott', 'Cunningham', 'Duncan', 'Armstrong', 'Hudson', 'Carroll', 'Lane', 'Riley', 'Andrews', 'Alvarado', 'Ray', 'Delgado', 'Berry', 'Perkins', 'Hoffman', 'Johnston', 'Matthews', 'Pena', 'Richards', 'Contreras', 'Willis', 'Carpenter', 'Lawrence', 'Sandoval', 'Guerrero', 'George', 'Chapman', 'Rios', 'Estrada', 'Ortega', 'Watkins', 'Greene', 'Nunez', 'Wheeler', 'Valdez', 'Harper', 'Burke', 'Larson', 'Santiago', 'Maldonado', 'Morrison', 'Franklin', 'Carlson', 'Austin', 'Dominguez', 'Carr', 'Lawson', 'Jacobs', 'Obrien', 'Lynch', 'Singh', 'Vega', 'Bishop', 'Montgomery', 'Oliver', 'Jensen', 'Harvey', 'Williamson', 'Gilbert', 'Dean', 'Sims', 'Espinoza', 'Howell', 'Li', 'Wong', 'Reid', 'Hanson', 'Le', 'Mccoy', 'Garrett', 'Burton', 'Fuller', 'Wang', 'Weber', 'Welch', 'Rojas', 'Lucas', 'Marquez', 'Fields', 'Park', 'Yang', 'Little', 'Banks', 'Padilla', 'Day', 'Walsh', 'Bowman', 'Schultz', 'Luna', 'Fowler', 'Mejia', 'Davidson', 'Acosta', 'Brewer', 'May', 'Holland', 'Juarez', 'Newman', 'Pearson', 'Curtis', 'Cortez', 'Douglas', 'Schneider', 'Joseph', 'Barrett', 'Navarro', 'Figueroa', 'Keller', 'Avila', 'Wade', 'Molina', 'Stanley', 'Hopkins', 'Campos', 'Barnett', 'Bates', 'Chambers', 'Caldwell', 'Beck', 'Lambert', 'Miranda', 'Byrd', 'Craig', 'Ayala', 'Lowe', 'Frazier', 'Powers', 'Neal', 'Leonard', 'Gregory', 'Carrillo', 'Sutton', 'Fleming', 'Rhodes', 'Shelton', 'Schwartz', 'Norris', 'Jennings', 'Watts', 'Duran', 'Walters', 'Cohen', 'Mcdaniel', 'Moran', 'Parks', 'Steele', 'Vaughn', 'Becker', 'Holt', 'Deleon', 'Barker', 'Terry', 'Hale', 'Leon', 'Hail', 'Benson', 'Haynes', 'Horton', 'Miles', 'Lyons', 'Pham', 'Graves', 'Bush', 'Thornton', 'Wolfe', 'Warner', 'Cabrera', 'Mckinney', 'Mann', 'Zimmerman', 'Dawson', 'Lara', 'Fletcher', 'Page', 'Mccarthy', 'Love', 'Robles', 'Cervantes', 'Solis', 'Erickson', 'Reeves', 'Chang', 'Klein', 'Salinas', 'Fuentes', 'Baldwin', 'Daniel', 'Simon', 'Velasquez', 'Hardy', 'Higgins', 'Aguirre', 'Lin', 'Cummings', 'Chandler', 'Sharp', 'Barber', 'Bowen', 'Ochoa', 'Dennis', 'Robbins', 'Liu', 'Ramsey', 'Francis', 'Griffith', 'Paul', 'Blair', 'Oconnor', 'Cardenas', 'Pacheco', 'Cross', 'Calderon', 'Quinn', 'Moss', 'Swanson', 'Chan', 'Rivas', 'Khan', 'Rodgers', 'Serrano', 'Fitzgerald', 'Rosales', 'Stevenson', 'Christensen', 'Manning', 'Gill', 'Curry', 'Mclaughlin', 'Harmon', 'Mcgee', 'Gross', 'Doyle', 'Garner', 'Newton', 'Burgess', 'Reese', 'Walton', 'Blake', 'Trujillo', 'Adkins', 'Brady', 'Goodman', 'Roman', 'Webster', 'Goodwin', 'Fischer', 'Huang', 'Potter', 'Delacruz', 'Montoya', 'Todd', 'Wu', 'Hines', 'Mullins', 'Castaneda', 'Malone', 'Cannon', 'Tate', 'Mack', 'Sherman', 'Hubbard', 'Hodges', 'Zhang', 'Guerra', 'Wolf', 'Valencia', 'Saunders', 'Franco', 'Rowe', 'Gallagher', 'Farmer', 'Hammond', 'Hampton', 'Townsend', 'Ingram', 'Wise', 'Gallegos', 'Clarke', 'Barton', 'Schroeder', 'Maxwell', 'Waters', 'Logan', 'Camacho', 'Strickland', 'Norman', 'Person', 'Colon', 'Parsons', 'Frank', 'Harrington', 'Glover', 'Osborne', 'Buchanan', 'Casey', 'Floyd', 'Patton', 'Ibarra', 'Ball', 'Tyler', 'Suarez', 'Bowers', 'Orozco', 'Salas', 'Cobb', 'Gibbs', 'Andrade', 'Bauer', 'Conner', 'Moody', 'Escobar', 'Mcguire', 'Lloyd', 'Mueller', 'Hartman', 'French', 'Kramer', 'Mcbride', 'Pope', 'Lindsey', 'Velazquez', 'Norton', 'Mccormick', 'Sparks', 'Flynn', 'Yates', 'Hogan', 'Marsh', 'Macias', 'Villanueva', 'Zamora', 'Pratt', 'Stokes', 'Owen', 'Ballard', 'Lang', 'Brock', 'Villarreal', 'Charles', 'Drake', 'Barrera', 'Cain', 'Patrick', 'Pineda', 'Burnett', 'Mercado', 'Santana', 'Shepherd', 'Bautista', 'Ali', 'Shaffer', 'Lamb', 'Trevino', 'Mckenzie', 'Hess', 'Beil', 'Olsen', 'Cochran', 'Morton', 'Nash', 'Wilkins', 'Petersen', 'Briggs', 'Shah', 'Roth', 'Nicholson', 'Holloway', 'Lozano', 'Rangel', 'Flowers', 'Hoover', 'Short', 'Arias', 'Mora', 'Valenzuela', 'Bryan', 'Meyers', 'Weiss', 'Underwood', 'Bass', 'Greer', 'Summers', 'Houston', 'Carson', 'Morrow', 'Clayton', 'Whitaker', 'Decker', 'Yoder', 'Collier', 'Zuniga', 'Carey', 'Wilcox', 'Melendez', 'Poole', 'Roberson', 'Larsen', 'Conley', 'Davenport', 'Copeland', 'Massey', 'Lam', 'Huff', 'Rocha', 'Cameron', 'Jefferson', 'Hood', 'Monroe', 'Anthony', 'Pittman', 'Huynh', 'Randall', 'Singleton', 'Kirk', 'Combs', 'Mathis', 'Christian', 'Skinner', 'Bradford', 'Richard', 'Galvan', 'Wall', 'Boone', 'Kirby', 'Wilkinson', 'Bridges', 'Bruce', 'Atkinson', 'Velez', 'Meza', 'Roy', 'Vincent', 'York', 'Hodge', 'Villa', 'Abbott', 'Allison', 'Tapia', 'Gates', 'Chase', 'Sosa', 'Sweeney', 'Farrell', 'Wyatt', 'Dalton', 'Horn', 'Barron', 'Phelps', 'Yu', 'Dickerson', 'Heath', 'Foley', 'Atkins', 'Mathews', 'Bonilla', 'Acevedo', 'Benitez', 'Zavala', 'Hensley', 'Glenn', 'Cisneros', 'Harrell', 'Shields', 'Rubio', 'Huffman', 'Choi', 'Boyer', 'Garrison', 'Arroyo', 'Bond', 'Kane', 'Hancock', 'Callahan', 'Dillon', 'Cline', 'Wiggins', 'Grimes', 'Arellano', 'Melton', 'Oneill', 'Savage', 'Ho', 'Beltran', 'Pitts', 'Parrish', 'Ponce', 'Rich', 'Booth', 'Koch', 'Golden', 'Ware', 'Brennan', 'Mcdowell', 'Marks', 'Cantu', 'Humphrey', 'Baxter', 'Sawyer', 'Clay', 'Tanner', 'Hutchinson', 'Kaur', 'Berg', 'Wiley', 'Gilmore', 'Russo', 'Villegas', 'Hobbs', 'Keith', 'Wilkerson', 'Ahmed', 'Beard', 'Mcclain', 'Montes', 'Mata', 'Rosario', 'Vang', 'Walter', 'Henson', 'Oneal', 'Mosley', 'Mcclure', 'Beasley', 'Stephenson', 'Snow', 'Huerta', 'Preston', 'Vance', 'Barry', 'Johns', 'Eaton', 'Blackwell', 'Dyer', 'Prince', 'Macdonald', 'Solomon', 'Guevara', 'Stafford', 'English', 'Hurst', 'Woodard', 'Cortes', 'Shannon', 'Kemp', 'Nolan', 'Mccullough', 'Merritt', 'Murillo', 'Moon', 'Salgado', 'Strong', 'Kline', 'Cordova', 'Barajas', 'Roach', 'Rosas', 'Winters', 'Jacobson', 'Lester', 'Knox', 'Bullock', 'Kerr', 'Leach', 'Meadows', 'Orr', 'Davila', 'Whitehead', 'Pruitt', 'Kent', 'Conway', 'Mckee', 'Barr', 'David', 'Dejesus', 'Marin', 'Berger', 'Mcintyre', 'Blankenship', 'Gaines', 'Palacios', 'Cuevas', 'Bartlett', 'Durham', 'Dorsey', 'Mccall', 'Odonnell', 'Stein', 'Browning', 'Stout', 'Lowery', 'Sloan', 'Mclean', 'Hendricks', 'Calhoun', 'Sexton', 'Chung', 'Gentry', 'Hull', 'Duarte', 'Ellison', 'Nielsen', 'Gillespie', 'Buck', 'Middleton', 'Sellers', 'Leblanc', 'Esparza', 'Hardin', 'Bradshaw', 'Mcintosh', 'Howe', 'Livingston', 'Frost', 'Glass', 'Morse', 'Knapp', 'Herman', 'Stark', 'Bravo', 'Noble', 'Spears', 'Weeks', 'Corona', 'Frederick', 'Buckley', 'Mcfarland', 'Hebert', 'Enriquez', 'Hickman', 'Quintero', 'Randolph', 'Schaefer', 'Walls', 'Trejo', 'House', 'Reilly', 'Pennington', 'Michael', 'Conrad', 'Giles', 'Benjamin', 'Crosby', 'Fitzpatrick', 'Donovan', 'Mays', 'Mahoney', 'Valentine', 'Raymond', 'Medrano', 'Hahn', 'Mcmillan', 'Small', 'Bentley', 'Felix', 'Peck', 'Lucero', 'Boyle', 'Hanna', 'Pace', 'Rush', 'Hurley', 'Harding', 'Mcconnell', 'Bernal', 'Nava', 'Ayers', 'Everett', 'Ventura', 'Avery', 'Pugh', 'Mayer', 'Bender', 'Shepard', 'Mcmahon', 'Landry', 'Case', 'Sampson', 'Moses', 'Magana', 'Blackburn', 'Dunlap', 'Gould', 'Duffy', 'Vaughan', 'Herring', 'Mckay', 'Espinosa', 'Rivers', 'Farley', 'Bernard', 'Ashley', 'Friedman', 'Potts', 'Truong', 'Costa', 'Correa', 'Blevins', 'Nixon', 'Clements', 'Fry', 'Delarosa', 'Best', 'Benton', 'Lugo', 'Portillo', 'Dougherty', 'Crane', 'Haley', 'Phan', 'Villalobos', 'Blanchard', 'Horne', 'Finley', 'Quintana', 'Lynn', 'Esquivel', 'Bean', 'Dodson', 'Mullen', 'Xiong', 'Hayden', 'Cano', 'Levy', 'Huber', 'Richmond', 'Moyer', 'Lim', 'Frye', 'Sheppard', 'Mccarty', 'Avalos', 'Booker', 'Waller', 'Parra', 'Woodward', 'Jaramillo', 'Krueger', 'Rasmussen', 'Brandt', 'Peralta', 'Donaldson', 'Stuart', 'Faulkner', 'Maynard', 'Galindo', 'Coffey', 'Estes', 'Sanford', 'Burch', 'Maddox', 'Vo', 'Oconnell', 'Vu', 'Andersen', 'Spence', 'Mcpherson', 'Church', 'Schmitt', 'Stanton', 'Leal', 'Cherry', 'Compton', 'Dudley', 'Sierra', 'Pollard', 'Alfaro', 'Hester', 'Proctor', 'Lu', 'Hinton', 'Novak', 'Good', 'Madden', 'Mccann', 'Terrell', 'Jarvis', 'Dickson', 'Reyna', 'Cantrell', 'Mayo', 'Branch', 'Hendrix', 'Rollins', 'Rowland', 'Whitney', 'Duke', 'Odom', 'Daugherty', 'Travis', 'Tang', 'Archer', 'Haas', 'Galloway', 'Bray', 'Nieves', 'Petty', 'Mcgrath', 'Kaufman', 'Holden', 'Krause', 'Baird', 'Riggs', 'Braun', 'Werner', 'Quinones', 'Saldana', 'Mercer', 'Hatfield', 'Mcneil', 'Irwin', 'Hooper', 'Hays', 'Joyce', 'Mcknight', 'Gamble', 'Downs', 'Pierre', 'Haney', 'Forbes', 'Saenz', 'Davies', 'Vera', 'Levine', 'Mooney', 'John', 'Rosa', 'Riddle', 'Key', 'Cho', 'Kaiser', 'Holder', 'Bird', 'Bonner', 'Ferrell', 'Cotton', 'Dotson', 'Mcgowan', 'Barlow', 'Shea', 'Ewing', 'Bright', 'Becerra', 'Lindsay', 'Ritter', 'Cooley', 'Fritz', 'Cooke', 'Delaney', 'Amaya', 'Chaney', 'Kidd', 'Velasco', 'Ngo', 'Cheng', 'Newell', 'Frey', 'Carney', 'Barrios', 'Bolton', 'Holman', 'Tovar', 'Cardona', 'Dailey', 'Merrill', 'Cowan', 'Slater', 'Albert', 'Justice', 'Osborn', 'Carver', 'Lancaster', 'Goff', 'Zapata', 'Fulton', 'Kang', 'Sears', 'Lehman', 'Byers', 'Snider', 'Law', 'Tan', 'Lake', 'Lutz', 'Costello', 'Gay', 'Guthrie', 'Gallardo', 'Workman', 'Mcfadden', 'Blanco', 'Gorman', 'Katz', 'Kuhn', 'Noel', 'Valle', 'Marino', 'Hong', 'Springer', 'Pickett', 'Aguilera', 'Witt', 'Carrasco', 'Donahue', 'Kinney', 'Donnelly', 'Britt', 'Craft', 'Odell', 'Daly', 'Winter', 'Abraham', 'Baez', 'Rodrigues', 'Wooten', 'Hartley', 'Ng', 'Kendall', 'Cleveland', 'Crowley', 'Pearce', 'Dillard', 'Wilder', 'Lange', 'Shoemaker', 'Flanagan', 'Bruno', 'Segura', 'Beach', 'Castellanos', 'Tillman', 'Alford', 'Finch', 'Mcleod', 'Mackey', 'Dodd', 'Emerson', 'Minor', 'Muniz', 'Alston', 'Maloney', 'Childers', 'Mcdermott', 'Moser', 'Vogel', 'Mccabe', 'Dang', 'Alonso', 'Saucedo', 'Starr', 'Do', 'Hurtado', 'Kirkland', 'Hendrickson', 'Holley', 'Cordero', 'Franks', 'Guillen', 'Welsh', 'Ratliff', 'Sweet', 'Talley', 'Whitfield', 'Crowe', 'Goldstein', 'England', 'Pereira', 'Ly', 'Joyner', 'Richter', 'Farris', 'Tracy', 'Bacon', 'Han', 'Gibbons', 'Mayfield', 'Hoang', 'Elder', 'Lau', 'Dale', 'Camp', 'Connolly', 'Hewitt', 'Cramer', 'Goldberg', 'Morin', 'Sutherland', 'Kaplan', 'Mcallister', 'Byrne', 'Osorio', 'Cash', 'Haines', 'Meeks', 'Wynn', 'Gilliam', 'Vigil', 'Hickey', 'Connor', 'Pate', 'Zepeda', 'Hatcher', 'Escobedo', 'Arredondo', 'Hyde', 'Christopher', 'Mobley', 'Kessler', 'Britton', 'Ritchie', 'Romano', 'Oneil', 'Tyson', 'Bui', 'Hilton', 'Caballero', 'Downing', 'Sharpe', 'Guy', 'Holcomb', 'Rankin', 'Godfrey', 'Chamberlain', 'Fink', 'Hollis', 'Foreman', 'Carranza', 'Sharma', 'Kern', 'Chu', 'Knowles', 'Ma', 'Madison', 'Childs', 'Belcher', 'Wills', 'Womack', 'Dye', 'Arthur', 'Grace', 'Baca', 'Rutherford', 'Sorensen', 'Mccray', 'Hastings', 'Pierson', 'Chacon', 'Renteria', 'Mohamed', 'Nicholas', 'Kendrick', 'Ferreira', 'Lockhart', 'Boggs', 'Pryor', 'Doherty', 'Sargent', 'Kenney', 'Tuttle', 'Denton', 'Magee', 'Jamison', 'Lyon', 'Locke', 'Puckett', 'Coronado', 'Olvera', 'Sykes', 'Manuel', 'Burks', 'Chin', 'Quiroz', 'Hopper', 'Mcgill', 'Dolan', 'Mckenna', 'Head', 'Montano', 'Paredes', 'Delatorre', 'Langley', 'Sinclair', 'Dwyer', 'Shirley', 'Muller', 'Courtney', 'Slaughter', 'Polk', 'Lemus', 'Covington', 'Madrigal', 'Clemons', 'Rosado', 'Broussard', 'Mcginnis', 'Hatch', 'Sheehan', 'Rutledge', 'Corbin', 'Dempsey', 'Garland', 'Carmona', 'Bowling', 'Burris', 'Whitley', 'Hamm', 'Bland', 'Bermudez', 'Stinson', 'Pike', 'Orellana', 'Downey', 'Varela', 'Harden', 'Couch', 'Dickinson', 'Cassidy', 'Rucker', 'Gabriel', 'Herron', 'Mcnamara', 'Rouse', 'Burt', 'Battle', 'Gustafson', 'Herbert', 'Dunbar', 'Webber', 'Boyce', 'Dewitt', 'Rosenberg', 'Simms', 'Woodruff', 'Brandon', 'Romo', 'Hutchins', 'Kirkpatrick', 'Corbett', 'Granados', 'Rossi', 'Goss', 'Lott', 'Leyva', 'Hinojosa', 'Gil', 'Crabtree', 'Grady', 'Mcclellan', 'Kumar', 'Fraser', 'Rico', 'Bingham', 'Soriano', 'Sterling', 'Fonseca', 'Madrid', 'Emery', 'Singer', 'Aragon', 'Aquino', 'Elmore', 'Worley', 'Simons', 'Quezada', 'Ott', 'Ocampo', 'Aviles', 'Nieto', 'Ervin', 'Gore', 'Shafer', 'Weston', 'Xu', 'Plummer', 'Michel', 'Paz', 'Yanez', 'Gregg', 'Abrams', 'Smart', 'Beatty', 'Serna', 'Meier', 'Robison', 'Swartz', 'Seymour', 'Gleason', 'Vela', 'Padgett', 'Ackerman', 'Heller', 'Ziegler', 'Vinson', 'Eldridge', 'Pina', 'Schumacher', 'Akers', 'Roe', 'Tomlinson', 'Mayes', 'Zheng', 'Albright']

var tenArray = [1,2,3,4,5,6,7,8,9,10]
var tenWeightScale = [1,1,2,2,5,6,7,8,9,1];
var gayWeightScale = [1,7,4,2,3,3,8,10,30,1];

function textLogPrefix() {
    var pref = ("Year " + thisYear() + ", day " + (counter%365) + ", ");
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
        "<div class='row charcard' id='npc"+id+"'><div class='col-8'>Name: <a href='javascript:;' data-npcid='"+id+"' onclick='modalFunction(" + id + ", "+'"full"' +")' class='charname'><span id='npcname" + id + "'>" + npc[id].fullName() + "<strong><a href='javascript:;'></strong></span></a> (<span id='npcgender" + id + "'>" + upCase(npc[id].genderFunc()) + "</span>)<br>" +
            "Age: <span id='npcyears" + id + "'></span><br>" +
            "Happiness: <span id='npchappy" +id+"'></span><br>" +
            "<span id='npcactivity"+id+"'></span><br>" +
            '<a href="javascript:;" class="npcrelationships" data-id="' + id + '" data-toggle="popover" data-container="body" data-offset="5" data-html="true" title="Relationships" data-content="No friends yet." id="npcrel' + id + '" onclick="modalFunction(' + id + ', ' + "'rel'" + ')" >Relationships</a> | ' +
            '<a href="javascript:;" class="npcinteractions" data-toggle="popover" data-container="body" data-id="' + id + '" data-offset="5" data-html="true" title="Interactions" data-content="Nothing to report." id="npcinteract' + id + '">Snapshot</a></div>' +
            "<div class='col-4'>Beauty: <span id='npcbeauty" + id + "'>" + npc[id].beauty + "</span><br>Athletics: <span id='npcathletics"+id+"'></span>" + npc[id].athletics + "<br>Intellect: <span id='npcintellect"+id+"'>" + npc[id].intellect + "</span><br>Social: <span id='npcsocial"+id+"'>" + npc[id].social + "</span><br>" + 
            '<a href="javascript:;" data-toggle="popover" data-container="body" data-trigger="hover" data-offset="5" data-html="true" title="Description" data-content="' + describeCharacter(npc[id]) + '" id="npcdesc' + id + '">Description</a>' + 
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

// BIR BIRTH section

function findRelatives(parent, newb) {
    for (var k=0;k<parent.relatives.length;k++) {
        if (parent.relatives[k] != undefined && npc[k] != undefined) {
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

function killCharacter(char) {
    //console.log("killing" + char.firstName);
    textLog.push([counter, (char.firstName + " died at age " + char.ageInYears() + ". The community mourns.")]);
    charPanels[npc.indexOf(char)] = undefined;
    var char2=char;
    char.alive = 0;
    char.deathday = counter;
    var livelen = liveNPC.length;
    for (var i=0;i<livelen;i++) {
        if (char.rTwo[liveNPC[i]] != undefined) {
            if (npc[liveNPC[i]].rTwo[npc.indexOf(char)] != undefined) {
                npc[liveNPC[i]].happiness -= npc[liveNPC[i]].rTwo[npc.indexOf(char)].friendship;
                //console.log(npc[i].firstName + " mourns " + npc[i].rTwo[npc.indexOf(char)].friendship);
            }
            if (char.rTwo[liveNPC[i]].commitment == 1 && npc[liveNPC[i]].rTwo[npc.indexOf(char)] != undefined) {
                npc[liveNPC[i]].rTwo[npc.indexOf(char)].commitment = 0;
                npc[liveNPC[i]].rTwo[npc.indexOf(char)].happiness -= 10000; // why isn't this making an error?
                npc[liveNPC[i]].happiness -= 10000;
                //console.log("breaking up the dead");
            }
            if (npc[liveNPC[i]].relatives[npc.indexOf(char)] == 1 && npc[liveNPC[i]].rTwo[npc.indexOf(char)] != undefined) {
                npc[liveNPC[i]].happiness -= 1000;
            }
        }
    }
    liveNPCo = liveNPC.splice(liveNPC.indexOf(char.oIndex),1);
    $("#npc"+char.oIndex).next().remove();
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
    $("#dashpanel").append("<hr>");
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
        $("#dashpanel").append("<hr>");
        $("#dashpanel").append($divs[i]);
    }
    $("#dashpanel").append("<hr>");
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

function modalHistory() {
    $("[data-toggle='popover']").popover('hide');
    $("#modaltitle").html("The History of the Community");
    var texttext = "";
    for (var i=0;i<textLog.length;i++) {
        texttext += ("Year " + Math.floor(textLog[i][0]/365) + ", Day " + (textLog[i][0]%365) + ": " + textLog[i][1] + "<br>");
    }
    $("#modalbody").html(texttext);
    $('#exampleModal').modal('show');
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

}