# Medlemssystem
IS-115 - Prosjektgruppe 25

Logg paa som bruker med id 1 eller 2 for aa bli merket som "admin" paa siden. Andre brukere faar logge inn
men er ikke gitt tilgang til all funksjonalitet som finnes paa nettsiden. 

Login   (1): post@mail.com 
Passord (1): qwerty

Login   (2): post1@mail.com
Passord (2): qwerty

Andre mailadresser kan benyttes. Passordene er satt etter medlemmenes id'er:
id = 1-3: qwerty
id = 4-6: password
id = 7-9: 123

Funksjonalitet for aa sende mail i systemet, vil kun fungere dersom de gjeldende mail-adressene byttes
ut med "ekte" mailadresser. Dette kan gjores i "Endre medlem" siden.


Medlemmer og aktiviteter faar en id automatisk vha. autoincrement i databasen. 
Poststed + aktuelle interesser, aktiviteter, og roller til et medlem, lagres i separate tabeller i database. 
Databasen er vedlagt her: Medlemssystem/private/database/klubbdb.sql

