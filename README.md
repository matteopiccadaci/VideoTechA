# Progetto Basi di Dati
## VideoTech-A
 _**Studenti:**_ Matteo Piccadaci [514430] e Antonino Mastronardo [513936]

Si vuole realizzare una base di dati per una videoteca, il cui locale fisico è accessibile dal lunedì al sabato, dalle ore 8:30 alle ore 19:30.
I contenuti messi a disposizione degli utenti sono Film e Album Musicali, di vario genere.
I contenuti vengono messi in vendita ad un prezzo di listino prestabilito, al quale possono essere applicati sconti se il cliente ha un card fedeltà o se la sua età è compresa tra i 16 e i 25 anni.
Il cliente può sottoscrivere la card fedeltà se ha compiuto almeno il 18° anno di età: nel caso si fosse a disposizione di tale card, si avrà diritto al 15% di sconto.
Se l’età del cliente rientra in quella vista sopra, avrà diritto al 10% di sconto su qualunque spesa.
I due sconti, tuttavia, non sono cumulabili: il cliente dovrà in ogni caso pagare la cifra minore.
I clienti, se hanno compiuto almeno il 16° di età, potranno autenticarsi tramite codice univoco e password al momento del login al sito. È invece previsto un altro pulsante d’accesso per gli amministratori dell’esercizio, i quali dovranno autenticarsi tramite credenziali. Essi potranno visualizzare gli articoli venduti e le scorte presenti in magazzino.
La somma dovuta dal cliente verrà pagata nel negozio fisico.
È anche previsto un accesso in modalità guest, senza alcun tipo di autenticazione, nella quale sarà possibile accedere solamente alle informazioni riguardo l’esercizio e al catalogo degli articoli.

&nbsp;
### Glossario:
| Termine | Descrizione |      Sinonimo      |             Collegamenti             |
|:---------------|    :----:   |:------------------:|:------------------------------------:|
| Superadmin     | Utente in possesso di tutti dei privilegi       |    Proprietario    |             Piattaforma              |
| Amministratore | Utente in possesso della maggior parte dei privilegi, che può gestire gli ordini        |       Admin        |             Piattaforma              |
| Carta Fedeltà  |Tessera su sottoscrizione che permette di accedere ad alcuni sconti|      Fidelity      |               Cliente                |
| Piattaforma    |Interfaccia utente del DBMS realizzato per l’esercizio|     Gestionale     |    Amministratore, Cliente, Guest    |
| Cliente        |Utente con possibilità di acquisto e noleggio| Utente Autenticato | Piattaforma, Carta Fedeltà, Acquisto |
| Guest          |Utente con limitate possibilità di navigazione all’interno della piattaforma|       Ospite       |             Piattaforma              |
| Film           |Articolo audiovisivo caratterizzato da alcuni attributi|      Articolo      |          Acquisto, Artista           |
| Album          |Articolo audio caratterizzato da alcuni attributi|      Articolo      |          Acquisto, Artista           |
| Regista        |Persona che ha realizzato un film|      Artista       |               Articolo               |
| Musicista      |Persona o gruppo di persone che hanno realizzato un album musicale|      Artista       |               Articolo               |


&nbsp;
## Lista delle operazioni:

- Login: In base al pulsante premuto, permette di autenticarsi come cliente o amministratore (Operazione effettuata molto frequentemente)

- Logout: Permette di abbandonare la pagina in maniera che per riaccedervi ci sia bisogno di autenticarsi nuovamente, per una maggiore sicurezza (Operazione effettuata molto frequentemente)

- Iscriviti al programma fedeltà: Permette di ricevere la card fedeltà (Operazione riservata ai clienti, realizzata frequentemente)

- Inserisci nuovo amministratore: Permette di inserire un nuovo admin (Operazione riservata ai super-admin, realizzata raramente)

- Elimina amministratore: Permette di eliminare un admin (Operazione riservata ai superadmin, realizzata raramente)

- Cambio password admin: Permette l’aggiornamento della password degli amministratori (Operazione riservata agli admin, realizzata raramente)

- Cambio password utente: Permette l’aggiornamento della password degli utenti (Operazione riservata al cliente stesso, realizzata raramente)

- Catalogo album e Catalogo film: In base alla modalità di accesso, permette di accedere alle informazioni riguardo la disponibilità di prodotti al negozio (Operazione realizzata frequentemente)

- Cronologia acquisti: Visualizza tutti gli acquisti di un utente o, nel caso degli amministratori, di tutti gli utenti (Operazione realizzata quotidianamente)

- Lista Registi e Musicisti: Visualizza tutti gli artisti presenti nel database (Operazione riservata agli amministratori, realizzata raramente)

- Inserisci nuovo Regista/Musicista: Permette di aggiornare la lista degli artisti (Operazione riservata agli amministratori, realizzata raramente)

- Inserisci nuovo album/film: Permette di aggiornare il catalogo dei prodotti inserendo un nuovo prodotto (Operazione riservata agli amministratori, realizzata circa 2 volte al mese)

- Modifica album/film: Permette di aggiornare manualmente le scorte dei prodotti (Operazione riservata agli amministratori, realizzata raramente)

- Acquista album/film: Permette di acquistare un prodotto. L’operazione inoltra aggiorna in automatico la quantità di quel prodotto in magazzino (Operazione riservata ai clienti, realizzata molto frequentemente)


&nbsp;
## Ristrutturazione schema ER:
Si è dapprima optato per delle valutazioni che aumentassero la qualità del DB, eliminando le eventuali ridondanze presenti.
Le tre generalizzazioni presenti sono state trattate accorpando il genitore delle generalizzazioni alle figlie.


&nbsp;
## Traduzione verso il modello relazionale:
- _Acquisti_album_ (<ins>**ID_Acquisto**</ins>, Data acquisto, **Cliente***, **Articolo***, Quantità)
- _Acquisti_film_ (<ins>**ID_Acquisto**</ins>, Data acquisto, **Cliente***, **Articolo***, Quantità)
- _Album_ (<ins>**ID_Album**</ins>, Nome album, Genere, Anno di pubblicazione, Quantità copie, Prezzo acquisto, Casa Discografica, **Musicista***)
- _Amministratori_ (<ins>**ID_Amministratore**</ins>, Nome, Cognome, Data di nascita, Mail, Password)
- _Clienti_ (<ins>**ID_Cliente**</ins>, Nome, Cognome, Data di nascita, Mail, Password)
- _Fedelta_ (<ins>**ID_Carta**</ins>, Data adesione, **Cliente***)
- _Film_ (<ins>**ID_Film**</ins>, Nome film, Genere, Anno di pubblicazione, Quantità copie, Prezzo acquisto, Produttore, **Regista***)
- _Musicisti_ (<ins>**ID_Musicista**</ins>, Nome musicista, N°componenti)
- _Registi_ (<ins>**ID_Regista**</ins>, Nome, Cognome)
