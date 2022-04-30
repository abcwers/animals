Gyvūnų prieglaudos puslapis
projekto laikas 2022.04.18-2022.04.29

užduotis
Funkciniai reikalavimai
Naudotojai ir rolės
Administratorius – atsakingas už aplikacijos nustatymus.
Vartotojai – turi teisę naudotis aplikacija.

FR0. Administratorius gali valdyti vartotojus ir gyvūnų kategorijas*
Gyvūnų kategorijas galima:
1. Sukurti – nurodant pavadinimą (pvz. Roplys, Katė, Šuo ir t.t.)
2. Redaguoti
3. Šalinti.

Vartotojus galima:
1. Sukurti (vartotojo vardas, el. paštas, slaptažodis)
2. Redaguoti
3. Šalinti.

FR1. Vartotojai gali prisijungti prie aplikacijos*
Aplikacijoje yra galimybė:
1. Registruotis (vartotojo vardas, el. paštas, slaptažodis)
2. Prisijungti (el.paštas, slaptažodis)

FR2. Vartotojas gali suvesti gyvūnėlius
1. Suvesti naują gyvūną - nurodant vardą, kategoriją, amžių dokumentacijos buvimą.
2. Redaguoti savo suvestus gyvūnus*

FR3. Vartotojas gali matyti ir filtruoti gyvūnų sąrašą
1. Matyti visų gyvūnų sąrašą
2. Ieškoti gyvūnų pagal kategoriją
3. Ieškoti gyvūnų pagal vardą ir amžių*

FR4. Vartotojas gali eksportuoti visų gyvūnų sąrašą CSV formatu.

Nefunkciniai reikalavimai
NFR1. Sistemos duomenys saugomi reliacinėje duomenų bazėje
NFR2. Visi veiksmai sistemoje kaupiami įvykių žurnale*
Visi veiksmai sistemoje kaupiami įvykių žurnale. Kiekvienas įvykis turi registruoti įvykio laiką, įvykį ir reikalingą susijusią informaciją.

NFR3. Kartu su sistema pateikiama sistemos diegimo ir naudojimo dokumentacijos
1. Naudojimo dokumentacija aprašo pagrindinių sistemos funkcijų panaudojimą
2. Diegimo dokumentacija aprašo, kaip įdiegti ir paleisti sistemą

NFR4. Visi veiksmai sistemoje turi atsakyti greičiau nei per 2 sekundes
Reikalavimas taikomas laikantis prielaidos, kad sistemoje yra iki 1000 gyvūnėlių įrašų.
