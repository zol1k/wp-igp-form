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

    PRE-FORMULAR: /kalkulacia-klimatizacia-pre-formular
    - simple vylistovanie formulara zadefinovaneho cez acf na danej page ako nizsie na klasickom formulari
    - 

    FORMULAR: /kalkulacia-klimatizacia-formular
    - obrazky - zadanie/klimatizacia/formular
    - navigacna cast formulara - kroky (vrch stranky) bude genericka (cez parameter sa posunu potrebne  info)

    - na zadefinovanie formulara a fieldov, som vytvoril acf strukturu kde si to zadefinujem a ty to len vykreslis
    ACF name "build-your-form"
        - je to repeater na definiciu Kroku(acf name "step" type repeater) a knemu prisluchajucemu ID (acf name "identification")
        - Krok obsauje subfieldy: 
            - "question" type of text - toto sluzi na vypisanie otazky
            - "value" type of repeater - toto sluzi na vypisanie moznych moznosti na zakliknutie
            - "identification" type of text - ID na dany node (moze byt pouzity v classe, alebo niekde inde ako sa bude robit nejake custom rozsirenie tak sa to zide)
            - "ishidden" type of true/false - zapnutie/vypnutie tejto casti na frontende (moze sa pouzit aj pri zbierani dat do session/ zadania formulara)
        - Value obsahuju subfieldy (podla poctu budes vediet ake bootstrap classy budes pouzivat aby to bolo vzdy rovnomerne rozhodene do riadku - dbaj aj na mobilny web):
            - "identification" type of text - ID na dany node (moze byt pouzity v classe, alebo niekde inde ako sa bude robit nejake custom rozsirenie tak sa to zide)
            - "label" type of WISYWIG editor- html zobrazenie danej moznosti.. bude sa tam pouzivat bold, tooltipy atd.. tak nech to tam je
            - "icon" type of Image - toto bude ako ikonka nad text
            - "ishidden" type of true/false - zapnutie/vypnutie tejto casti na frontende (moze sa pouzit aj pri zbierani dat do session/ zadania formulara)
            - "multiselect" type of true/false - if false, len jeden field v ramci otazky vie byt zakliknuty, ak true tak viacero

    - krok1 
        - obrazky: krok1-byt-collapsed.png, krok1-byt-field-shown-after-selection.png
        - tu sa vylistuje to co na screenshote stym ze ak sa selectne byt, zobrazi sa dodatocny field na zadanie poschodia

    - krok2
        - obrazky: krok2-additional fields-jedna miestnost.png, krok2-dve a viac-extended fields.png
        - tu vidiet nejake conditional fields ked sa klikne jedna miestnost.. (na to vykreslenie mozes pouzit ID ktore je dostupne v acf rozpisanom vyssie. Na rozsirenie sprav nejaku genericku funkciu ktora sa da vyuzit na viacerych miestach)
        - taktiez aj dve a viac miestnosti

    - krok 3 krok3.png
        - zobrazi podla zadania z acf

    - krok 4 krok4.png
        - zobrazi podla zadania z acf

    - krok 5 krok5.png
        - zobrazi danu klimu ktoru si na zaciatku selectol
        - po kliknuti na "Chcem spracovat presnu kalkulaciu" presmeruje na:

    predstavujem si to tak ze do session sa vlozi:

    key-value
    question-id : answer-id

    na zaklade toho sa vysklada potom mail na zaver


    VYHODNOTENIE: /kalkulacia-klimatizacia-vyhodnotenie
    - zadanie\klimatizacia\vyhodnotenie\summary after button click.png
    - tu sa vyzbieraju submitnute data a odosle sa email
    - data do formulara sa budu tahat zo sessionStorage

