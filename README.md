# Medlemssystem
IS-115 (2021) - Prosjektgruppe 25
Medlemmer:
-Erik Daniel Staalesen Castberg
-Steffen Tendvall Abrahamsen

Github: 
https://github.com/Hanemor/Medlemssystem.git

Url til forsiden: 
https://localhost/medlemssystem/www/index.php
(Derfra vil bruker bruker automatisk sendes til innloggingssiden)

Logg på som bruker med id 1 eller 2 for å bli merket som "admin" på siden. Andre brukere får logge inn
men er ikke gitt tilgang til all funksjonalitet som finnes på nettsiden. 

Login   (1): post@mail.com 
Passord (1): qwerty

Login   (2): post1@mail.com
Passord (2): qwerty

Andre mailadresser kan benyttes. Passordene er satt etter medlemmenes id'er:
id = 1-3: qwerty
id = 4-6: password
id = 7-9: 123

Funksjonalitet for å sende mail i systemet, vil kun fungere dersom de gjeldende mail-adressene byttes
ut med "ekte" mailadresser. Dette kan gjøres i "Endre medlem" siden.


Medlemmer og aktiviteter får en id automatisk vha. autoincrement i databasen. 
Poststed + aktuelle interesser, aktiviteter, og roller til et medlem, lagres i separate tabeller i database. 
Databasen er vedlagt i innleveringen med path: Medlemssystem/private/database/klubbdb.sql

