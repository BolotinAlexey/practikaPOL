# practikaPOL

Technikum dla Młodzieży 
“Cosinus” w Łodzi 
Kwalifikacyjny Kurs Zawodowy 


Kierunek: Technik informatyk 
Tytuł projektu: Zadanie nr 1 – Strona hotelu “Szalony dom”



Autor projektu: Oleksii Bolotin
Kierunek INF 03 grupa 2B 

Założenia projektu

•	Zaprojektowanie strony dla hotelu wraz z systemem rezerwacja;

•	Przygotowanie projektu bazy danych wraz z zaznaczonymi relacjami między tabelamy bazy w postaci graficznego schematu oraz wyeksportowany plik bazy *.sql;

•	Przygotowanie instrukcji/dokumentacji z informacjami niezbędnymi do uruchomienia strony m.in. nazwą bazy danych, loginamy i hasłami, jeśli takie w projekcie występują;

•	Zaprojektowanie systemu rezerwacji, który będzie umożliwiał wyświetlenie dostępności pokoi oraz dokonywanie rezerwacji prez pracownika hotelu;

•	Projekt powinien wykorzystywać język PHP, HTML, CSS, jeśli to będzie uzasadnienie powinien też wykorzystywać język programowania Java Script.  



Projekt bazy
 
Baza danych hoteli oparta jest na czterech tabelach.

W tym tabela "Employee" (Pracownik) zawiera dane pracowników hotelu, takie jak: "employee_name" (imię i nazwisko pracownika), "job_title" (stanowisko), "department" (dział), "hire_date" (data zatrudnienia), "login" (nazwa użytkownika) i "password" (hasło).
Pole "login" i "password" nie jest wartością NULL tylko dla pracowników, którzy mają dostęp do administracji bazy danych.
 
Tabela "Room" zawiera pola: "room_number" (numer pokoju), "room_type" (typ pokoju), "room_price" (cena pokoju), "max_occupancy" (maksymalna liczba gości), "available" (dostępność), "floor" (piętro) i "img" (nazwa pliku zdjęcia pokoju). Pole "img" zawiera nazwę pliku zdjęcia odpowiedniego pokoju. Wszystkie pliki znajdują się w folderze pokoi projektu.

Tabela "Rezervation" (Rezerwacja) zawiera zapisy przyszłych rezerwacji dla gości, w tym pola: "reservation_id" (numer rezerwacji), "room" (numer pokoju), "name" (imię i nazwisko gościa), "phone_number" (numer telefonu), "check_in_date" (data zameldowania) i "check_out_date" (data wymeldowania).
 
Tabela "Guests" "(Goście) zawiera dane o gościach hotelowych, w tym pola: "guest_id" (identyfikator gościa), "guest_name" (imię i nazwisko gościa), "guest_email" (adres e-mail gościa), "phone_number" (numer telefonu), "adress" (adres zamieszkania), "room" (numer pokoju), "check_in_date" (data zameldowania) i "check_out_date" (data wymeldowania).	
 
Relacje między tabelami Imeyote są następującym widokiem:



Projekt strony

Główna część strony hotelu "Szalony Dom" została stworzona na bazie natywnego CSS3 z wykorzystaniem Flaxbox. Do podłączenia czcionek użyto Google Fonts z jego frontami:  „Indie Flower”

Po wejściu na stronę użytkownik widzi pełną listę pokojów hotelowych w formie wygodnej listy z wymienionymi w niej pokojami, wraz z numerem pokoju, jego typem, pojemnością, ceną i dostępnością. 

Dla wygody użytkownikowi udostępniona jest możliwość wyboru wyświetlania pokoi w postaci zdjęcia, wybierając flagę zdjęcia i naciskając filtr przeglądu. 

Filtry przeglądu są również wykonane dla wygody użytkownika i pozwalają przeglądać wszystkie pokoje w hotelu, tylko dostępne lub tylko zajęte.

Projekt strony jest adaptacyjny i responsywny. Oznacza to, że strona będzie wygodnie użytkowana zarówno na komputerze, tablecie, jak i na urządzeniu mobilnym. Ponadto, projekt zostanie omówiony poniżej.



Instrukcja uruchomienia 

1.Instalacja pakietu XAMP w wersji kompilacji 8.1.6
 

2.Uruchomienie programu w tym start serwera APACHE oraz serwera MYSQL. 
 
Instrukcja uruchomienia
3. Przed zaimportowaniem bazy danych należy utworzyć pustą bazę danych o nazwie „hotel” w XAMPP: 

4.Import bazy danych według ścieżki pliku.  
XAMPP>htdocs>projekt>hotel.sql
 
 5. Import bazy hotel.sql znajdującej się w folderze projektCosinus w aplikacji XAMP.               
 
6. Widok strony, gdy użytkownik na nią wchodzi. Na stronie znajduje się lista wszystkich pokoi w postaci tabeli.
 
7. W razie potrzeby użytkownik może wybrać opcję przeglądania ze zdjęciami pokoi z opisem pokoju, który jest dla niego wygodny.
 
8.  Możliwość korzystania z filtrów dostępności.
 
9. Pracownicy hotelu mają możliwość przejścia na stronę logowania i wprowadzenia danych: loginu i hasła.

10. Administrator trafia na stronę „Check-in”, gdzie może dodać do listy gości, którzy wcześniej zarezerwowali pokoje
 
11. Jeżeli administrator kliknie w przycisk  „Reservatio” (Rezerwacja), wchodzi do menu rezerwacji pokoju. 

12. Klikając na przycisk „Wyzwolenie” administrator wchodzi w menu usuwania wpisów gości przy ich wyjeździe oraz kasowania rezerwacji, jeśli z jakiegoś powodu rezerwacja została anulowana.

 

Podsumowanie 

Projekt stronu hotelu wykonano w oparciu o flexbox.
Dla zaprojektowania oraz testowania bazy danych skorzystano z programu XAMP.
Zdjęcia wykorzystane w projekcie pochodzą ze strony:
 https://pixabay.com/ru/images/search/room                                                      i są plikami ogólnie dostępnymi i darmowymi.
Na potrzeby tworzenia kodu skorzystano z programu VISUAL STUDIO CODE.
Dla funkcjonalności całego projektu użyto skryptów zarówno PHP oraz JS.
Działanie całego systemu w tym strony, formularzy, bazy zostało przetestowane pod kontem działania celem wyeliminowania błędów. 
Strona można również wyświetlić na bezpłatnym hostingu: http://f0795832.xsph.ru

