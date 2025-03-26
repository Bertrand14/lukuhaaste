# Loppuraportti
<!-- TOC tocDepth:2..3 chapterDepth:2..6 -->

- [Sprintin aikataulu](#sprintin-aikataulu)
  - [Sprint 1](#sprint-1)
  - [Sprint 2](#sprint-2)
- [Toteutetut User Storyt](#toteutetut-user-storyt)
  - [**Pääkäyttäjänä:**](#pääkäyttäjänä)
  - [**Käyttäjänä**](#käyttäjänä)
  - [**Jäsenenä**](#jäsenenä)
- [Työmäärä](#työmäärä)
- [Tiimityöskentely](#tiimityöskentely)
- [Suunnittelu ja User Storyt](#suunnittelu-ja-user-storyt)
- [Aamupalaverit](#aamupalaverit)
- [Koodin laatu ja toimivuus](#koodin-laatu-ja-toimivuus)
- [Ongelmia ja niiden ratkaisut](#ongelmia-ja-niiden-ratkaisut)
- [Julkaistu versio ja testitunnukset](#julkaistu-versio-ja-testitunnukset)

<!-- /TOC -->
## Sprintin aikataulu
### Sprint 1
- **Alkoi:** 03.02.2025
- **Päättyi:** 28.02.2025

### Sprint 2
- **Alkoi:** 03.03.2025
- **Päättyi:** 18.03.2025

## Toteutetut User Storyt

### **Pääkäyttäjänä:**

#### **Haluan hallita lukutapahtumia, jotta voin hallita suunniteltuja haasteita**
- Kaikki haasteet tulee näkyä yhdellä sivulla🟢
- Jokaisen haasteen päivämäärät tulee olla näkyvillä🟢
- Haasteiden hallintasivun tulee olla helposti saavutettavissa hallintapaneelista🟢
- Uuden haasteen luonti🟢
- Olemassa olevan haasteen muokkaus🟡
- Vanhentuneiden haasteiden poistaminen🟢

#### **Haluan hallita rekisteröityneitä käyttäjiä, jotta voin hallita käyttäjätilien oikeuksia**
- Kaikki käyttäjät tulee näkyä yhdellä sivulla🟢
- Käyttäijen tiedot🟢
- Mahdollisuus myöntää admin-oikeudet olemassa olevalle käyttäjätilille🟢
- Käyttäjätilin poistaminen🟢

#### **Haluan hallita arvosteluja, jotta voin varmistaa niiden sääntöjenmukaisuuden**
- Kaikki arvostelut tulee näkyä yhdellä sivulla🟢
- Arvosteluiden tiedot
- Mahdollisuus poistaa asiattomia arvosteluja

#### **Haluan hallita kirjoja, jotta voin ylläpitää kirjatietokantaa**
- Kaikki kirjat tulee näkyä yhdellä sivulla🟢
- Kirjojen tiedot🟢
- Yksittäisen kirjan tietojen hallinta🔴

### **Käyttäjänä**

#### **Haluan selata kirjakokoelmaa, jotta löydän kiinnostavia kirjoja**
- Hakutoiminnot ja suodattimet🟢

#### **Haluan nähdä haasteet, jotta tiedän meneillään olevista ja tulevista haasteista**
- Etusivulla tulee olla selkeää tietoa haasteista🟢

#### **Haluan luoda käyttäjätilin, jotta voin osallistua haasteisiin**
- Rekisteröitymislomake🟢

### **Jäsenenä**

#### **Haluan kirjautua sisään, jotta voin hallita henkilökohtaisia tietojani**
- Kirjautumislomake🟢
- Hallintapaneeli näyttää omat tiedot🟢
- Mahdollisuus muokata tietoja🟢
- Mahdollisuus poistaa tili🟢
- Mahdollisuus poistaa arvostelut🟡

#### **Haluan nähdä ja hallita lukemiani kirjoja ja arvostelujani**
- Kaikki luetut kirjat näkyvät yhdellä sivulla🔴
- Kirjojen tiedot🔴
- Yksittäisen kirjan tarkastelu🔴
- Uuden kirjan lisääminen🟢

#### **Haluan nähdä edistymiseni haasteissa, jotta saan palautetta suorituksestani**
- Nykyisen haasteen edistyminen🟡
- Kaikkien haasteiden edistyminen🔴

## Työmäärä
- Työmäärä oli liian suuri, koska Laravel-frameworkin oppiminen vei vähintään kaksi viikkoa.
- Keskimääräinen työaika per henkilö sprintin aikana oli noin 130 tuntia.
- Eniten aikaa vei Laravelin ja tietokannan välisen yhteyden ymmärtäminen sekä projektin siirtäminen cPaneliin.
- Tehtävät jaettiin tasaisesti, mutta jotkut tehtävät olivat muita monimutkaisempia, mikä vaikutti aikatauluun.

## Tiimityöskentely
- **Mikä toimi hyvin:**
  - Tiimihenki oli erittäin hyvä, ja kommunikaatio oli avointa ja kannustavaa.
  - Kaikki tiesivät omat ja muiden tehtävät, mikä helpotti yhteistyötä.
  - GitHubin käyttö auttoi tehtävien jakamisessa ja työn hallinnassa.
  - Tiimityö sujui erinomaisesti, eikä kumpikaan osapuoli aiheuttanut ongelmia. Yhteistyö oli miellyttävää ja tehokasta.
- **Mikä ei toiminut hyvin:**
  - Tiedot olivat hajallaan eri paikoissa (Excel, GitHub, dokumenttikansiot), mikä vaikeutti tiedon löytämistä.
  - User Storyt tehtiin vasta kahden viikon jälkeen Laravelin oppimisen takia, mikä hidasti kehitystä alussa.

## Suunnittelu ja User Storyt
- Suunnittelua tehtiin jonkin verran ennen koodausta, mutta olisi voitu tehdä enemmän.
- User Storyt olivat aluksi epäselviä, mutta tarkentuivat projektin edetessä.
- Jatkossa voisi keskittää tiedot yhteen paikkaan, esimerkiksi GitHubin projektityökaluihin.

## Aamupalaverit
- Aamupalaverit tapahtuivat luonnollisesti ilman muodollista aikataulua.
- Katsottiin, mitä edellisenä päivänä oli tehty ja mitä päivän aikana piti tehdä.
- Ongelmia ja haasteita käsiteltiin yhdessä, mikä paransi etenemistä.

## Koodin laatu ja toimivuus
- Koodi toimii pääosin hyvin, mutta siinä on vielä parannettavaa.
- Suurimmat haasteet liittyivät tietokantayhteyksiin ja taulujen liitoksiin.
- Projektin loppuvaiheessa opimme jatkuvasti uutta ja jouduimme muuttamaan osia koodista.

## Ongelmia ja niiden ratkaisut
- **Laravelin ja tietokannan yhteydet** → Ratkaisu: Dokumentaation ja esimerkkien avulla ratkottu ongelmat.
- **Projektin siirto cPaneliin** → Ratkaisu: Useita yrityksiä ja virheenkorjauksia, kunnes kaikki toimi oikein.

## Julkaistu versio ja testitunnukset
- **Linkki julkaistuun versioon:** https://lukuhaaste.team25a.treok.io/
- **Pääkäyttäjän testitunnukset:**
  - **Sähköposti:** lukuhaaste-admin@team25a.treok.io
  - **Salasana:** Pxq8Xj&NC#^gz7H