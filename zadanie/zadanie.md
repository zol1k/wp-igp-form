potrebujem spravit formular na vyhodnotenie vhodneho produktu pre zakaznika. 
-web kde to bude bezat bude wordpress. 
-Kazdy krok formulara bude mat zvlast URL. 
-Nadizajnovane to bude na page template stranke (sablone). 

Budu asi 3 nateraz.
- ROZCESTNIK - /kalkulacia
- FORMULAR: /kalkulacia-klimatizacia-formular
- VYHODNOTENIE: /kalkulacia-klimatizacia-vyhodnotenie submit stranka kde sa vyplnaju udaje zakaznika

Vsetko suvisiace s formularom bude ulozene pod child temou. 
template-cenova-ponuka-{nazov nazov kroku}. Neviem ci je lepsie formular rozdelit do jednodlivych sablon, alebo to mat v ramci jednej sablony dokopy.

chcem aby:
- stylovanie bude pouzitie bootstrap, bude sa hladiet aj na mobilnu verziu. Dodatocne genericke css(mimo bootstrap stylov) bude ulozene v css/form.css
- zakliknute moznosti uklada do sessionStorage (key-value). Predstavujem si ze v js/form.js budu generic funkcie na ukladanie storage, na kazdy input change. Zaroven pouzit console log na kazdu akciu zakaznika (ulozenie do session storage)
- po preklikavani medzi krokmi, chcem zobrazit vsetky sessionStorage values ako su ulozene key-value
- budem chciet odosielat google analitycs eventy 
-- mozno funkciu na  getGACookie a potom pouzit pri buildovani formulara   formData.append('ga_id', getGACookie());
- chcem aby kod bol prehladny, vsetko okomentovane
- chcem to testovat lokalne. Ak by sa dalo vytvor index co si viem otvorit v browsery a pozriet ako to je nadizajnovane



struktura:
HLAVNY ROZCESTNIK:
-obrazky - zadanie/rozcestnik/start-rozcestnik.png
- Najskor user ma možnosť vybrať z 3 kachličiek
- Ked klikne na TČ nech vyskoci info, že táto cast je v rekonštrukci a v prípade zaujmu nech vola 0918 973 772

KLIMATIZACIA
    ROZCESTNIK - /kalkulacia
        - obrazky - zadanie/klimatizacia/rozcestnik
        - 1-vyber-triedy.png
            - toto bude naplnene z acf fieldov ktore budu vyplnene na backende danej page:

            - dane triedy budu v repeater type acf : aircondproducts
            - ten obsahuje subfieldy:
                Označenie-ID_name-acf type
                1-Názov-title-Text
                2-Trieda-class-Text
                3-Ovládanie lamiel-control-Text
                4-Pokročilé filtre-filter-Text
                5-Moderný dizajn-design-Text
                6-Price-price-Text
                7-Priradiť produkt-related-Relationship(vylistovane objekty) return type: Post Object
                8-Populárna?-featured-True / False
            - ked sa klikne na mam zaujem >  vylistuju sa relevantne produkty ktore su priradene v "aircondproducts_related" vid 2-porovnanie.png
            - okrem tych co su vylistovane, bude jeden staticky stlpec na kalkulaciu individualnej ponuky. Tu bude zvlast "pre-formular"
            - na hover columnu sa odtien pozadia, vid screenshot

        - 2-porovnanie.png
            - tu po tom ako klikne na mam zaujem/vybrať tak sa vylistuju itemy ktore su vedene v acf fielde selectnutej triedy "related" subfield
            - ako obrazok tam bude featured image daneho itemu, nazov sa vezme Title danej page, cena z "form-price" resp/ "form-power", "form-class", "form-noise"
            - ked sa klikne na button "Mam zaujem" ktory je na screenshote pod cenou, tak sa ulozi do storage vsetky info (vyber-triedy, vyber-produktu) a nasledne prejde na /kalkulacia klimatizacia-formular

    FORMULAR: /kalkulacia-klimatizacia-pre-formular (v pripade vyberu individual)
    - simple vylistovanie formulara podla dizajnu ako hlavny formular. Toto bude one-page formular na konci s tlacitkom pokracovat ktory bude odkazovat na /kalkulacia-klimatizacia-formular. Predtym ale pouklada vsetko do session nech sa to vie spracovat pocas populacie emailu
    Rozmer miestnosti	
        - jedna miestnosť do 25m2	
        - jedna miestnosť 25 - 50m2	
        - viac uzavretých miestnosti (multisplit riešenie)
    Predpríprava	
        - nie nemám	
        - mám rozvody v stene (pošli fotku)	
    Filtrácia	
        - stačí základný filter	
        - som alergik astmatik	
    Farebné prevedenie	
        - Biela	
        - Čierna / tmavomodrá / strieborná / červená , ...	
    Využitie	
        - chladenie v lete / prikrurovanie v prechodnom období	
        - ako hlavný zdroj v zime	
    Prevedenie	
        - Základ (basic)	
        - Komfort (Comfort)	
        - Pokročilá (Advanced)

    VYHODNOTENIE: /kalkulacia-klimatizacia-vyhodnotenie
    - zadanie\klimatizacia\vyhodnotenie\summary after button click.png
    - tu sa vyzbieraju submitnute data a odosle sa email
    - data do formulara sa budu tahat zo sessionStorage

session key-value rob tak aby sa to nakonci dalo dobre listovat... neviem ci nejakym commandom vies vylistovat vsetky ulozene sessionStorages ktore sa zacinaju nejakym prefixom, ale sprav tot ak aby to slo pekne prehladne