- klónozzuk a repót egy tetszőleges könyvtárba
git clone git@github.com:safipeti/laravel-http-client.git


- hozzunk létre egy mysql adatbázist (pl. rick)

- hozzunk létre egy .env fájlt

- a .env fájlban konfiguráljuk az adatbázis kapcsolatot

példa:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rick
DB_USERNAME=root
DB_PASSWORD=

- telepítsük a szükséges csomagokat

composer update




A könyvtárban, ahol az alkalmazás van, command line-ban adjuk ki a következő parancsokat:

**php artisan migrate**

**php artisan apiseeding**



VAGY

**php artisan migrate --seed**



Az első opció esetén az első parancs létrehozza az adatbázis táblákat, majd a második parancs meghívja a megfelelő seedereket, és
feltölti adatokkal, azaz, lekéri párhuzamos hívásokkal az api adatait és létrehozza a rekordokat.
A második opció egy parancsban csinálja meg ugyanezt: lérehozza a táblákat, azonban a DatabaseSeeder hívja meg a EpisodeSeeder és
CharacterSeeder seedereket, egy lépésben


**apiseeding command**

https://github.com/safipeti/laravel-http-client/blob/master/app/Console/Commands/ApiSeeding.php
- feltöltés előtt kitakarítja az adatbázis táblákból az adatokat

seeders:
https://github.com/safipeti/laravel-http-client/tree/master/database/seeders

- indítsuk el az alklamazást a következő paranccsal


**php artisan serve**


- nyissuk meg a böngészőben az alkalmazást:

**http://127.0.0.1:8000/** 

(az elérési út eltérhet)


Az oldalon megjelenek az epizódok, egy oldalon 10, lapozni lehet, a users ikonra kattintva modal-ban megjelennek az adott epizódhoz tartozó
karakterek, fényképpel, névvel

A lapozó lapozáskor a szűrt eredményekben lapoz, megtartva a szűrőket minden oldalon





