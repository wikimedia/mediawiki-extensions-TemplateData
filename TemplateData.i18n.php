<?php
$messages = array();

/** English
 * @author Timo Tijhof
 */
$messages['en'] = array(

	// Special:Version
	'templatedata-desc' => 'Implement data storage for template parameters (using JSON)',

	// Page output for <templatedata>
	'templatedata-doc-desc-empty' => 'No description.',
	'templatedata-doc-params' => 'Template parameters',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Default',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'no description',

	// Error message for edit page
	'templatedata-invalid-parse' => 'Syntax error in JSON.',
	'templatedata-invalid-type' => 'Property "$1" is expected to be of type "$2".',
	'templatedata-invalid-missing' => 'Required property "$1" not found.',
	'templatedata-invalid-unknown' => 'Unexpected property "$1".',
	'templatedata-invalid-value' => 'Invalid value for property "$1".',
	'templatedata-invalid-length' => 'Data too large to save ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|limit is}} {{formatnum:$2}})',
);

/** Message documentation (Message documentation)
 * @author Shirayuki
 * @author Timo Tijhof
 */
$messages['qqq'] = array(
	'templatedata-desc' => '{{desc|name=Template Data|url=http://www.mediawiki.org/wiki/Extension:TemplateData}}',
	'templatedata-doc-desc-empty' => 'Displayed when a template has no description (should be a valid sentence).',
	'templatedata-doc-params' => 'Used as caption for the table which has the following headings:
* {{msg-mw|Templatedata-doc-param-name}}
* {{msg-mw|Templatedata-doc-param-desc}}
* {{msg-mw|Templatedata-doc-param-default}}
* {{msg-mw|Templatedata-doc-param-status}}
{{Identical|Template parameter}}',
	'templatedata-doc-param-name' => 'Used as column heading in the table.
{{Related|Templatedata-doc-param}}
{{Identical|Parameter}}',
	'templatedata-doc-param-desc' => 'Used as column heading in the table.
{{Related|Templatedata-doc-param}}
{{Identical|Description}}',
	'templatedata-doc-param-type' => '{{Identical|Type}}',
	'templatedata-doc-param-default' => 'Used as column heading in the table.
{{Related|Templatedata-doc-param}}
{{Identical|Default}}',
	'templatedata-doc-param-status' => 'Used as column heading in the table.
{{Related|Templatedata-doc-param}}
{{Identical|Status}}',
	'templatedata-doc-param-desc-empty' => 'Displayed when a template parameter has no description (should be not be a full sentence, used in a table cell).',
	'templatedata-invalid-parse' => 'Error message when there is a syntax error in JSON.',
	'templatedata-invalid-type' => 'Error message when a property is of the wrong type.
* $1 - name of property. e.g. "params.1.required"
* $2 - expected type of property. e.g. "boolean"',
	'templatedata-invalid-missing' => 'Error message when a required property is not found.
* $1 - name of property. e.g. "params"
* $2 - type of property (Unused)',
	'templatedata-invalid-unknown' => 'Error message when an unknown property is found.
* $1 - name of property. e.g. "params.1.foobar"',
	'templatedata-invalid-value' => 'Error message when a property that cannot contain free-form text has an invalid value.
* $1 - name of property. e.g. "params.1.type"',
	'templatedata-invalid-length' => "Error message when generated JSON's length exceed database limits.
* $1 - length of generated JSON
* $2 - maximal allowed length",
);

/** Arabic (العربية)
 * @author زكريا
 */
$messages['ar'] = array(
	'templatedata-desc' => 'تخزين بيانات وسائط القالب',
	'templatedata-doc-params' => 'وسائط القالب',
	'templatedata-doc-param-name' => 'وسيط',
	'templatedata-doc-param-desc' => 'وصف',
	'templatedata-doc-param-type' => 'نوع',
	'templatedata-doc-param-default' => 'غيابي',
	'templatedata-doc-param-status' => 'حالة',
	'templatedata-invalid-parse' => 'خطأ نحوي',
	'templatedata-invalid-type' => 'خاصية "$1" من نوع "$2".',
	'templatedata-invalid-missing' => 'خاصية "$1" ضرورية.',
	'templatedata-invalid-unknown' => 'خاصية "$1" غير متوقعة.',
	'templatedata-invalid-value' => 'قيمة خاصية "$1" غير صالحة.',
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'templatedata-desc' => "Permite l'almacenamientu de datos pa los parámetros de plantíes (usando JSON)",
	'templatedata-doc-params' => 'Parámetros de la plantía',
	'templatedata-doc-param-name' => 'Parámetru',
	'templatedata-doc-param-desc' => 'Descripción',
	'templatedata-doc-param-type' => 'Triba',
	'templatedata-doc-param-default' => 'Predetermináu',
	'templatedata-doc-param-status' => 'Estáu',
	'templatedata-invalid-parse' => 'Error de sintaxis en JSON.',
	'templatedata-invalid-type' => 'Esperabase que la propiedá «$1» fuera de tipu «$2».',
	'templatedata-invalid-missing' => "Nun s'alcontró la propiedá requerida «$1».",
	'templatedata-invalid-unknown' => 'Propiedá inesperada «$1».',
	'templatedata-invalid-value' => 'Valor inválidu pa la propiedá «$1».',
	'templatedata-invalid-length' => 'Los datos son demasiao grandes pa guardar ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|la llende ye}} {{formatnum:$2}})',
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'templatedata-desc' => 'Рэалізацыя сховішча зьвестак для парамэтраў шаблёнаў (праз JSON)',
	'templatedata-doc-params' => 'Парамэтры шаблёнаў',
	'templatedata-doc-param-name' => 'Парамэтар',
	'templatedata-doc-param-desc' => 'Апісаньне',
	'templatedata-doc-param-type' => 'Тып',
	'templatedata-doc-param-default' => 'Перадвызначана',
	'templatedata-doc-param-status' => 'Стан',
	'templatedata-invalid-parse' => 'Памылка сынтаксу ў JSON.',
	'templatedata-invalid-type' => 'Уласьцівасьць «$1» вымагае тыпу «$2».',
	'templatedata-invalid-missing' => 'Абавязковая ўласьцівасьць «$1» ня знойдзеная.',
	'templatedata-invalid-unknown' => 'Нечаканая ўласьцівасьць «$1».',
	'templatedata-invalid-value' => 'Няслушнае значэньне для ўласьцівасьці «$1».',
	'templatedata-invalid-length' => 'Завялікі для захаваньня памер зьвестак ({{formatnum:$1}} {{PLURAL:$1|байт|байта|байтаў}}, {{PLURAL:$2|абмежавана}} да {{formatnum:$2}})',
);

/** Bengali (বাংলা)
 * @author Aftab1995
 * @author Leemon2010
 */
$messages['bn'] = array(
	'templatedata-doc-params' => 'টেমপ্লেট প্যারামিটার',
	'templatedata-doc-param-name' => 'প্যারামিটার',
	'templatedata-doc-param-desc' => 'বিবরণ',
	'templatedata-doc-param-type' => 'ধরন',
	'templatedata-doc-param-default' => 'ডিফল্ট',
	'templatedata-doc-param-status' => 'অবস্থা',
	'templatedata-invalid-parse' => 'জেএসওএন-এর মধ্যে বাক্যগঠনে ত্রুটি।',
	'templatedata-invalid-length' => 'সংরক্ষণ করার জন্য ডেটা খুব বড় ({{formatnum:$1}} {{PLURAL:$1|বাইট}}, {{PLURAL:$2|সর্বোচ্চ সীমা}} {{formatnum:$2}})',
);

/** Breton (brezhoneg)
 * @author Y-M D
 */
$messages['br'] = array(
	'templatedata-doc-param-name' => 'Anv', # Fuzzy
	'templatedata-doc-param-desc' => 'Deskrivadur',
	'templatedata-doc-param-default' => 'Dre ziouer',
	'templatedata-doc-param-status' => 'Statud',
	'templatedata-invalid-parse' => 'Fazi ereadurezh e JSON.',
);

/** Bosnian (bosanski)
 * @author DzWiki
 */
$messages['bs'] = array(
	'templatedata-doc-params' => 'Parametri šablona',
	'templatedata-doc-param-name' => 'Parametar',
	'templatedata-doc-param-desc' => 'Opis',
	'templatedata-doc-param-type' => 'Vrsta',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Sintaksna greška u JSON-u.',
	'templatedata-invalid-type' => 'Svojstvo "$1" bi trebalo da je od "$2" vrste.',
	'templatedata-invalid-unknown' => 'Neočekivano svojstvo "$1".',
	'templatedata-invalid-value' => 'Neispravna vrijednost za svojstvo "$1"',
);

/** Catalan (català)
 * @author Luckas
 */
$messages['ca'] = array(
	'templatedata-doc-param-desc' => 'Descripció',
);

/** Chechen (нохчийн)
 * @author Умар
 */
$messages['ce'] = array(
	'templatedata-doc-param-desc' => 'Цуьнах лаьцна',
	'templatedata-doc-param-default' => 'Iад йитарца',
);

/** Czech (česky)
 * @author Littledogboy
 * @author Mormegil
 */
$messages['cs'] = array(
	'templatedata-desc' => 'Implementuje datové úložiště pro parametry šablon (pomocí JSON)',
	'templatedata-doc-params' => 'Parametry šablony',
	'templatedata-doc-param-name' => 'Parametr',
	'templatedata-doc-param-desc' => 'Popis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Výchozí hodnota',
	'templatedata-doc-param-status' => 'Stav',
	'templatedata-doc-param-desc-empty' => 'prázdné',
	'templatedata-invalid-parse' => 'Syntaktická chyba v JSON.',
	'templatedata-invalid-type' => 'Očekávaný typ vlastnosti „$1“ je „$2“.',
	'templatedata-invalid-missing' => 'Nenalezena vyžadovaná vlastnost „$1“.',
	'templatedata-invalid-unknown' => 'Neočekávaná vlastnost „$1“.',
	'templatedata-invalid-value' => 'Chybná hodnota vlastnosti „$1“.',
);

/** Welsh (Cymraeg)
 * @author Lloffiwr
 */
$messages['cy'] = array(
	'templatedata-doc-params' => "Paramedrau'r nodyn",
	'templatedata-doc-param-name' => 'Paramedr',
	'templatedata-doc-param-desc' => 'Disgrifiad',
	'templatedata-doc-param-type' => 'Math',
	'templatedata-doc-param-default' => 'Yn ddiofyn',
	'templatedata-doc-param-status' => 'Statws',
	'templatedata-invalid-parse' => 'Gwall cystrawen yn JSON.',
);

/** German (Deutsch)
 * @author Metalhead64
 */
$messages['de'] = array(
	'templatedata-desc' => 'Ermöglicht mithilfe von JSON die Implementierung der Datenspeicherung für Vorlagenparameter',
	'templatedata-doc-desc-empty' => 'Keine Beschreibung.',
	'templatedata-doc-params' => 'Vorlagenparameter',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschreibung',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'keine Beschreibung',
	'templatedata-invalid-parse' => 'Syntaxfehler in JSON.',
	'templatedata-invalid-type' => 'Für den Typ „$2” wird die Eigenschaft „$1” erwartet.',
	'templatedata-invalid-missing' => 'Die erforderliche Eigenschaft „$1” wurde nicht gefunden.',
	'templatedata-invalid-unknown' => 'Unerwartete Eigenschaft „$1”.',
	'templatedata-invalid-value' => 'Ungültiger Wert für die Eigenschaft „$1”.',
	'templatedata-invalid-length' => 'Die Daten sind zu groß zum Speichern ({{PLURAL:$1|Ein Byte|{{formatnum:$1}} Bytes}}, {{PLURAL:$2|die Grenze ist}} {{formatnum:$2}})',
);

/** Zazaki (Zazaki)
 * @author Mirzali
 */
$messages['diq'] = array(
	'templatedata-doc-param-status' => 'Weziyet',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'templatedata-desc' => 'Datowe składowanje za pśedłogowe parametry implementěrowaś (z pomocu JSON)',
	'templatedata-doc-params' => 'Pśedłogowe parametry',
	'templatedata-doc-param-name' => 'Mě', # Fuzzy
	'templatedata-doc-param-desc' => 'Wopisanje',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaksowa zmólka w JSON.',
	'templatedata-invalid-type' => 'Za kakosć "$1" se typ "$2" wótcakujo.',
	'templatedata-invalid-missing' => 'Trěbna kakosć "$1" njejo se namakała.',
	'templatedata-invalid-unknown' => 'Njewótcakana kakosć "$1".',
	'templatedata-invalid-value' => 'Njepłaśiwa gódnota za kakosć "$1".',
);

/** Esperanto (Esperanto)
 * @author Luckas
 */
$messages['eo'] = array(
	'templatedata-doc-param-desc' => 'Priskribo',
);

/** Spanish (español)
 * @author Fitoschido
 * @author Ovruni
 */
$messages['es'] = array(
	'templatedata-desc' => 'Implementa almacenamiento de datos para parámetros de plantillas (mediante JSON).',
	'templatedata-doc-desc-empty' => 'Sin descripción',
	'templatedata-doc-params' => 'Parámetros de la plantilla',
	'templatedata-doc-param-name' => 'Parámetro',
	'templatedata-doc-param-desc' => 'Descripción',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Predeterminado',
	'templatedata-doc-param-status' => 'Estado',
	'templatedata-doc-param-desc-empty' => 'sin descripción',
	'templatedata-invalid-parse' => 'Error de sintaxis en el JSON.',
	'templatedata-invalid-type' => 'Se espera que la propiedad «$1» sea del tipo «$2».',
	'templatedata-invalid-missing' => 'No se encontró la propiedad requerida «$1».',
	'templatedata-invalid-unknown' => 'Propiedad «$1» inesperada.',
	'templatedata-invalid-value' => 'Valor no válido para la propiedad «$1».',
);

/** Estonian (eesti)
 * @author Luckas
 */
$messages['et'] = array(
	'templatedata-doc-param-desc' => 'Kirjeldus',
);

/** Finnish (suomi)
 * @author Nike
 * @author Silvonen
 */
$messages['fi'] = array(
	'templatedata-doc-param-name' => 'Parametri',
	'templatedata-doc-param-desc' => 'Kuvaus',
	'templatedata-doc-param-type' => 'Tyyppi',
);

/** French (français)
 * @author Boniface
 * @author Gomoko
 * @author Guillom
 * @author Metroitendo
 * @author Peter17
 */
$messages['fr'] = array(
	'templatedata-desc' => 'Met en place un stockage de données pour les paramètres des modèles (en utilisant JSON)',
	'templatedata-doc-desc-empty' => 'Aucune description.',
	'templatedata-doc-params' => 'Paramètres du modèle',
	'templatedata-doc-param-name' => 'Paramètre',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Par défaut',
	'templatedata-doc-param-status' => 'Statut',
	'templatedata-doc-param-desc-empty' => 'aucune description',
	'templatedata-invalid-parse' => 'Erreur de syntaxe dans JSON.',
	'templatedata-invalid-type' => 'La propriété « $1 » doit être de type « $2 ».',
	'templatedata-invalid-missing' => 'Propriété « $1 » obligatoire non trouvée.',
	'templatedata-invalid-unknown' => 'Propriété « $1 » non attendue.',
	'templatedata-invalid-value' => 'Valeur non valide pour la propriété « $1 ».',
	'templatedata-invalid-length' => 'Données trop grosses pour être enregistrées ({{formatnum:$1}} {{PLURAL:$1|octet|octets}}, {{PLURAL:$2|la limite est}} {{formatnum:$2}})',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'templatedata-desc' => 'Inclúe un almacenamento de datos para os parámetros dos modelos (mediante JSON)',
	'templatedata-doc-desc-empty' => 'Sen descrición.',
	'templatedata-doc-params' => 'Parámetros do modelo',
	'templatedata-doc-param-name' => 'Parámetro',
	'templatedata-doc-param-desc' => 'Descrición',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Por defecto',
	'templatedata-doc-param-status' => 'Estado',
	'templatedata-doc-param-desc-empty' => 'sen descrición',
	'templatedata-invalid-parse' => 'Erro de sintaxe en JSON.',
	'templatedata-invalid-type' => 'A propiedade "$1" agárdase que sexa de tipo "$2".',
	'templatedata-invalid-missing' => 'Non se atopou a propiedade obrigatoria "$1".',
	'templatedata-invalid-unknown' => 'Propiedade "$1" inesperada.',
	'templatedata-invalid-value' => 'Valor non válido para a propiedade "$1".',
	'templatedata-invalid-length' => 'Dato longo de máis para podelo gardar ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}; {{PLURAL:$2|o límite é}} {{formatnum:$2}})',
);

/** Hebrew (עברית)
 * @author Amire80
 */
$messages['he'] = array(
	'templatedata-desc' => 'מימוש אחסון נתונים לפרמטרים של תבניות (באמצעות JSON)',
	'templatedata-doc-params' => 'פרמטרים של תבניות',
	'templatedata-doc-param-name' => 'פרמטר',
	'templatedata-doc-param-desc' => 'תיאור',
	'templatedata-doc-param-type' => 'סוג',
	'templatedata-doc-param-default' => 'בררת מחדל',
	'templatedata-doc-param-status' => 'מצב',
	'templatedata-invalid-parse' => 'שגיאת תחביר ב־JSON.',
	'templatedata-invalid-type' => 'המאפיין "$1" צפוי להיות מסוג "$2".',
	'templatedata-invalid-missing' => 'המאפיין הדרוש "$1" לא נמצא.',
	'templatedata-invalid-unknown' => 'מאפיין בלתי־צפוי "$1".',
	'templatedata-invalid-value' => 'ערך בלתי־תקין למאפיין "$1".',
	'templatedata-invalid-length' => 'הנתונים גדולים מכדי לשמור ({{formatnum:$1}} {{PLURAL:$1|בית|בתים}}, {{PLURAL:$2|המגבלה היא}} {{formatnum:$2}})',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'templatedata-desc' => 'Datowe składowanje za předłohowe parametry implementować (z pomocu JSON)',
	'templatedata-doc-params' => 'Předłohowe parametry',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Wopisanje',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaksowy zmylk w JSON.',
	'templatedata-invalid-type' => 'Za kajkosć "$1" so typ "$2" wočakuje.',
	'templatedata-invalid-missing' => 'Trěbna kajkosć "$1" njeje so namakała.',
	'templatedata-invalid-unknown' => 'Njewočakowana kajkosć "$1".',
	'templatedata-invalid-value' => 'Njepłaćiwa hódnota za kajkosć "$1".',
);

/** Iloko (Ilokano)
 * @author Lam-ang
 */
$messages['ilo'] = array(
	'templatedata-desc' => 'Isayangkatna ti pagipenpenan ti datos para kadagiti parametro ti plantilia (agaramat ti JSON)',
	'templatedata-doc-params' => 'Dagiti parametro ti plantilia',
	'templatedata-doc-param-name' => 'Parametro',
	'templatedata-doc-param-desc' => 'Deskripsion',
	'templatedata-doc-param-type' => 'Kita',
	'templatedata-doc-param-default' => 'Kasisigud',
	'templatedata-doc-param-status' => 'Kasasaad',
	'templatedata-invalid-parse' => 'Biddut ti eskritu iti JSON.',
	'templatedata-invalid-type' => 'Ti tagikua ti "$1" ket nanamnama a kita iti "$2".',
	'templatedata-invalid-missing' => 'Ti nasken a tagikua ti "$1" ket saan a nabirukan.',
	'templatedata-invalid-unknown' => 'Di nanamnama a tagikua ti "$1".',
	'templatedata-invalid-value' => 'Saan nga umiso a pateg para iti tagikua ti "$1".',
	'templatedata-invalid-length' => 'Ti datos ket dakkel unay a maidulin ({{formatnum:$1}} {{PLURAL:$1|byte|dagiti byte}}, {{PLURAL:$2|ti patingga ket}} {{formatnum:$2}})',
);

/** Icelandic (íslenska)
 * @author Snævar
 */
$messages['is'] = array(
	'templatedata-doc-params' => 'Gildi sniðsins',
	'templatedata-doc-param-name' => 'Gildi',
	'templatedata-doc-param-desc' => 'Lýsing',
	'templatedata-doc-param-type' => 'Gerð',
	'templatedata-doc-param-default' => 'Sjálfgefið',
	'templatedata-doc-param-status' => 'Staða',
	'templatedata-invalid-parse' => 'Villa í málskipan JSON.',
	'templatedata-invalid-type' => 'Bjóst við að eiginleikinn „$1” væri af gerðinni „$2”, en fékk eitthvað allt annað.',
	'templatedata-invalid-missing' => 'Nauðsynlegur eiginleiki „$1” fannst ekki.',
	'templatedata-invalid-unknown' => 'Óvæntur eiginleiki „$1”.',
	'templatedata-invalid-value' => 'Ógilt eigindargildi fyrir eiginleikann „$1”.',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'templatedata-desc' => 'Implementa la memorizzazione dei dati per i parametri dei template (utilizzando JSON)',
	'templatedata-doc-desc-empty' => 'Nessuna descrizione.',
	'templatedata-doc-params' => 'Parametri template',
	'templatedata-doc-param-name' => 'Parametro',
	'templatedata-doc-param-desc' => 'Descrizione',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Predefinito',
	'templatedata-doc-param-status' => 'Stato',
	'templatedata-doc-param-desc-empty' => 'nessuna descrizione',
	'templatedata-invalid-parse' => 'Errore di sintassi in JSON.',
	'templatedata-invalid-type' => 'La proprietà "$1" dovrebbe essere di tipo "$2".',
	'templatedata-invalid-missing' => 'Proprietà obbligatoria "$1" non trovata.',
	'templatedata-invalid-unknown' => 'Proprietà "$1" non prevista.',
	'templatedata-invalid-value' => 'Valore non valido per la proprietà "$1".',
	'templatedata-invalid-length' => 'Troppi dati da salvare ({{formatnum:$1}} {{PLURAL:$1|byte}}, {{PLURAL:$2|limite è}} {{formatnum:$2}})',
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Shirayuki
 */
$messages['ja'] = array(
	'templatedata-desc' => 'テンプレート引数のデータストレージを実装する (JSON を使用)',
	'templatedata-doc-params' => 'テンプレート引数',
	'templatedata-doc-param-name' => '引数',
	'templatedata-doc-param-desc' => '説明',
	'templatedata-doc-param-type' => '型',
	'templatedata-doc-param-default' => '既定',
	'templatedata-doc-param-status' => '状態',
	'templatedata-invalid-parse' => 'JSON の構文エラーです。',
	'templatedata-invalid-type' => 'プロパティ「$1」には型「$2」の値を指定してください。',
	'templatedata-invalid-missing' => '必須のプロパティ「$1」がありません。',
	'templatedata-invalid-unknown' => '予期しないプロパティ「$1」です。',
	'templatedata-invalid-value' => 'プロパティ「$1」の値が無効です。',
	'templatedata-invalid-length' => 'データが大きすぎるため保存できません ({{formatnum:$1}} {{PLURAL:$1|バイト}}、{{PLURAL:$2|上限は}} {{formatnum:$2}} バイト)',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'templatedata-desc' => '(JSON을 사용하여) 틀 변수에 대한 데이터 저장소를 구현합니다',
	'templatedata-doc-params' => '틀 변수',
	'templatedata-doc-param-name' => '변수',
	'templatedata-doc-param-desc' => '설명',
	'templatedata-doc-param-type' => '형식',
	'templatedata-doc-param-default' => '기본값',
	'templatedata-doc-param-status' => '상태',
	'templatedata-invalid-parse' => 'JSON에 구문 오류가 있습니다.',
	'templatedata-invalid-type' => '"$1" 속성의 값이 예기치 않은 "$2" 형식입니다.',
	'templatedata-invalid-missing' => '필요한 "$1" 속성을 찾을 수 없습니다.',
	'templatedata-invalid-unknown' => '예기치 않은 "$1" 속성입니다.',
	'templatedata-invalid-value' => '"$1" 속성의 값이 잘못되었습니다.',
	'templatedata-invalid-length' => '저장하기에 데이터가 너무 큽니다 ({{formatnum:$1}} {{PLURAL:$1|바이드}}, {{PLURAL:$2|제한은}} {{formatnum:$2}})',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'templatedata-doc-desc-empty' => 'Keng Beschreiwung.',
	'templatedata-doc-params' => 'Parameter vun der Schabloun',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschreiwung',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'keng Beschreiwung',
	'templatedata-invalid-parse' => 'Syntaxfeeler am JSON.',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'templatedata-desc' => 'Овозможува складирање на податоци за шаблонски параметри (користејќи JSON)',
	'templatedata-doc-desc-empty' => 'Нема опис.',
	'templatedata-doc-params' => 'Шаблонски параметри',
	'templatedata-doc-param-name' => 'Параметар',
	'templatedata-doc-param-desc' => 'Опис',
	'templatedata-doc-param-type' => 'Тип',
	'templatedata-doc-param-default' => 'По основно',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-doc-param-desc-empty' => 'нема опис',
	'templatedata-invalid-parse' => 'Синтаксна грешка во JSON.',
	'templatedata-invalid-type' => 'Се очекува својството „$1“ да биде од типот „$2“.',
	'templatedata-invalid-missing' => 'Бараното својство „$1“ не е пронајдено.',
	'templatedata-invalid-unknown' => 'Неочекувано својство „$1“.',
	'templatedata-invalid-value' => 'Неисправна вредност за својството „$1“.',
	'templatedata-invalid-length' => 'Податоците се преголеми за да се зачуваат ({{formatnum:$1}} {{PLURAL:$1|бајт|бајти}}, а {{PLURAL:$2|границата е}} {{formatnum:$2}})',
);

/** Malayalam (മലയാളം)
 * @author Praveenp
 * @author Santhosh.thottingal
 */
$messages['ml'] = array(
	'templatedata-desc' => 'ഫലകങ്ങളുടെ ചരങ്ങളിൽ ഡേറ്റ ശേഖരിച്ച് വെയ്ക്കൽ നടപ്പിലാക്കുക (ജെസൺ ഉപയോഗിച്ച്)',
	'templatedata-doc-params' => 'ഫലകത്തിനുള്ള ചരങ്ങൾ',
	'templatedata-doc-param-name' => 'ചരം',
	'templatedata-doc-param-desc' => 'വിവരണം',
	'templatedata-doc-param-type' => 'തരം',
	'templatedata-doc-param-default' => 'സ്വതേ',
	'templatedata-doc-param-status' => 'സ്ഥിതി',
	'templatedata-invalid-parse' => 'ജെസണിൽ എഴുത്ത് രീതിയിൽ പിഴവുണ്ടായി.',
	'templatedata-invalid-length' => 'ഡേറ്റ സേവ് ചെയ്യാൻ കഴിയുന്നതിലും വലുതാണ് ({{formatnum:$1}} {{PLURAL:$1|ബൈറ്റ്|ബൈറ്റുകൾ}}, {{PLURAL:$2|പരിധി}} {{formatnum:$2}})',
);

/** Marathi (मराठी)
 * @author V.narsikar
 */
$messages['mr'] = array(
	'templatedata-invalid-length' => 'माहिती जतन करण्यास बरीच मोठी आहे({{formatnum:$1}} {{PLURAL:$1|बाईट|बाईट्स}}, {{PLURAL:$2|मर्यादा}} {{formatnum:$2}} आहे)',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'templatedata-desc' => 'Melaksanakan storan data bagi parameter templat (menggunakan JSON)',
	'templatedata-doc-params' => 'Parameter templat',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Keterangan',
	'templatedata-doc-param-type' => 'Jenis',
	'templatedata-doc-param-default' => 'Azali',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Ralat sintaks dalam JSON.',
	'templatedata-invalid-type' => 'Sifat "$1" dijangka jenis "$2".',
	'templatedata-invalid-missing' => 'Sifat "$1" yang dikehendaki tidak dijumpai.',
	'templatedata-invalid-unknown' => 'Sifat "$1" tidak dijangka.',
	'templatedata-invalid-value' => 'Nilai tidak sah untuk sifat "$1".',
	'templatedata-invalid-length' => 'Data terlalu besar untuk menyimpan ({{formatnum:$1}} {{PLURAL:$1|bait}}, {{PLURAL:$2|hadnya}} adalah {{formatnum:$2}})',
);

/** Low German (Plattdüütsch)
 * @author Joachim Mos
 */
$messages['nds'] = array(
	'templatedata-doc-param-desc' => 'Beschrieven',
);

/** Dutch (Nederlands)
 * @author Konovalov
 * @author Siebrand
 * @author Southparkfan
 */
$messages['nl'] = array(
	'templatedata-desc' => 'Implementeert gegevensopslag voor sjabloonparameters (met behulp van JSON)',
	'templatedata-doc-desc-empty' => 'Geen beschrijving.',
	'templatedata-doc-params' => 'Sjabloonparameters',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschrijving',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Standaard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'geen beschrijving',
	'templatedata-invalid-parse' => 'Syntaxisfout in JSON.',
	'templatedata-invalid-type' => 'De verwachting is dat eigenschap "$1" van het type "$2" is.',
	'templatedata-invalid-missing' => 'Vereiste eigenschap "$1" niet gevonden.',
	'templatedata-invalid-unknown' => 'Onverwachte eigenschap "$1".',
	'templatedata-invalid-value' => 'Ongeldige waarde voor de eigenschap "$1".',
	'templatedata-invalid-length' => 'Gegevens te groot om op te slaan ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|limiet is}} {{formatnum:$2}})',
);

/** Occitan (occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'templatedata-desc' => 'Met en place un emmagazinatge de donadas pels paramètres dels modèls (en utilizant JSON)',
	'templatedata-doc-params' => 'Paramètres del modèl',
	'templatedata-doc-param-name' => 'Paramètre',
	'templatedata-doc-param-desc' => 'Descripcion',
	'templatedata-doc-param-type' => 'Tipe',
	'templatedata-doc-param-default' => 'Per defaut',
	'templatedata-doc-param-status' => 'Estatut',
	'templatedata-invalid-parse' => 'Error de sintaxi dins JSON.',
	'templatedata-invalid-type' => 'La proprietat « $1 » deu èsser de tipe « $2 ».',
	'templatedata-invalid-missing' => 'Proprietat « $1 » obligatòria pas trobada.',
	'templatedata-invalid-unknown' => 'Proprietat « $1 » pas esperada.',
	'templatedata-invalid-value' => 'Valor invalida per la proprietat « $1 ».',
	'templatedata-invalid-length' => 'Donadas tròp gròssas per èsser enregistradas ({{formatnum:$1}} {{PLURAL:$1|octet|octets}}, {{PLURAL:$2|lo limit es}} {{formatnum:$2}})',
);

/** Punjabi (ਪੰਜਾਬੀ)
 * @author Babanwalia
 */
$messages['pa'] = array(
	'templatedata-doc-params' => 'ਫਰਮੇ ਦੇ ਮਾਪਦੰਡ',
	'templatedata-doc-param-name' => 'ਮਾਪਦੰਡ',
	'templatedata-doc-param-desc' => 'ਵੇਰਵਾ',
	'templatedata-doc-param-type' => 'ਕਿਸਮ',
	'templatedata-doc-param-default' => 'ਮੂਲ ਰੂਪ',
	'templatedata-doc-param-status' => 'ਦਰਜਾ',
	'templatedata-invalid-parse' => 'JSON ਵਿਚ ਵਾਕ-ਰਚਨਾ ਦੋਸ਼',
	'templatedata-invalid-missing' => 'ਲੋੜੀਂਦਾ ਮਲਕੀਅਤ "$1" ਨਹੀਂ ਲੱਭੀ।',
	'templatedata-invalid-value' => '"$1" ਮਲਕੀਅਤ ਲਈ ਗ਼ਲਤ ਮੁੱਲ',
);

/** Polish (polski)
 * @author Chrumps
 * @author Woytecr
 */
$messages['pl'] = array(
	'templatedata-desc' => 'Dodaje możliwość przechowywania parametrów szablonu (poprzez JSON)',
	'templatedata-doc-params' => 'Parametry szablonu',
	'templatedata-doc-param-name' => 'Parametr',
	'templatedata-doc-param-desc' => 'Opis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Domyślne',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Błąd składni w JSON.',
	'templatedata-invalid-type' => 'Właściwość "$1" powinna mieć typ "$2".',
	'templatedata-invalid-missing' => 'Wymagana właściwość "$1" nie została znaleziona.',
	'templatedata-invalid-unknown' => 'Nieoczekiwane właściwość "$1".',
	'templatedata-invalid-value' => 'Nieprawidłowa wartość właściwości "$1".',
);

/** Portuguese (português)
 * @author Helder.wiki
 */
$messages['pt'] = array(
	'templatedata-desc' => 'Implementa o armazenamento de dados para os parâmetros das predefinições (em JSON)',
	'templatedata-doc-params' => 'Parâmetros da predefinição',
	'templatedata-doc-param-name' => 'Parâmetro',
	'templatedata-doc-param-desc' => 'Descrição',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Padrão',
	'templatedata-doc-param-status' => 'Condição',
	'templatedata-invalid-parse' => 'Erro de sintaxe em JSON',
	'templatedata-invalid-type' => 'A propriedade "$1" deveria ser do tipo "$2"',
	'templatedata-invalid-missing' => 'A propriedade "$1" é requerida mas não foi fornecida.',
	'templatedata-invalid-unknown' => 'Propriedade "$1" inesperada.',
	'templatedata-invalid-value' => 'Valor inválido para a propriedade "$1".',
);

/** Brazilian Portuguese (português do Brasil)
 * @author Helder.wiki
 * @author Luckas
 */
$messages['pt-br'] = array(
	'templatedata-desc' => 'Implementa o armazenamento de dados para os parâmetros das predefinições (em JSON)',
	'templatedata-doc-desc-empty' => 'Sem descrição.',
	'templatedata-doc-params' => 'Parâmetros da predefinição',
	'templatedata-doc-param-name' => 'Parâmetro',
	'templatedata-doc-param-desc' => 'Descrição',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Padrão',
	'templatedata-doc-param-status' => 'Condição',
	'templatedata-doc-param-desc-empty' => 'sem descrição',
	'templatedata-invalid-parse' => 'Erro de sintaxe em JSON',
	'templatedata-invalid-type' => 'A propriedade "$1" deveria ser do tipo "$2"',
	'templatedata-invalid-missing' => 'A propriedade "$1" é requerida mas não foi fornecida.',
	'templatedata-invalid-unknown' => 'Propriedade "$1" inesperada.',
	'templatedata-invalid-value' => 'Valor inválido para a propriedade "$1".',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'templatedata-desc' => "'Mblemende 'nu majazzine de date pe le parametre d'u template (ausanne JSON)",
	'templatedata-doc-params' => "Parametre d'u template",
	'templatedata-doc-param-name' => 'Parametre',
	'templatedata-doc-param-desc' => 'Descrizione',
	'templatedata-doc-param-type' => 'Tipe',
	'templatedata-doc-param-default' => 'De base',
	'templatedata-doc-param-status' => 'State',
	'templatedata-invalid-parse' => "Errore de sindasse jndr'à JSON.",
	'templatedata-invalid-type' => 'S\'aspettave ca \'a probbietà "$1" ere de tipe "$2".',
	'templatedata-invalid-missing' => 'Probbietà richieste "$1" non acchiate.',
	'templatedata-invalid-unknown' => 'Probbietà inaspettate "$1".',
	'templatedata-invalid-value' => 'Valore invalide pa probbietà "$1".',
	'templatedata-invalid-length' => "Date troppe granne pe reggistrà ({{formatnum:$1}} {{PLURAL:$1|byte}}, 'u {{PLURAL:$2|limite jè}} {{formatnum:$2}})",
);

/** Russian (русский)
 * @author Putnik
 */
$messages['ru'] = array(
	'templatedata-desc' => 'Реализация хранилища данных для параметров шаблона (с помощью JSON)',
	'templatedata-doc-params' => 'Параметры шаблона',
	'templatedata-doc-param-name' => 'Параметр',
	'templatedata-doc-param-desc' => 'Описание',
	'templatedata-doc-param-type' => 'Тип',
	'templatedata-doc-param-default' => 'По умолчанию',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-invalid-parse' => 'Синтаксическая ошибка в JSON.',
	'templatedata-invalid-type' => 'Для свойства «$1» ожидается тип «$2».',
	'templatedata-invalid-missing' => 'Обязательное свойство «$1» не найдено.',
	'templatedata-invalid-unknown' => 'Неожиданное свойство «$1».',
	'templatedata-invalid-value' => 'Недопустимое значение для свойства «$1».',
);

/** Slovenian (slovenščina)
 * @author Eleassar
 */
$messages['sl'] = array(
	'templatedata-doc-desc-empty' => 'Nobenega opisa.',
	'templatedata-doc-param-desc-empty' => 'nobenega opisa',
);

/** Serbian (Cyrillic script) (српски (ћирилица)‎)
 * @author Milicevic01
 * @author Милан Јелисавчић
 */
$messages['sr-ec'] = array(
	'templatedata-doc-params' => 'Параметри шаблона',
	'templatedata-doc-param-name' => 'Параметар',
	'templatedata-doc-param-desc' => 'Опис',
	'templatedata-doc-param-type' => 'Врста',
	'templatedata-doc-param-default' => 'Подразумевано',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-invalid-parse' => 'Синтаксна грешка у JSON-у.',
	'templatedata-invalid-type' => 'Својство „$1“ би требало да је од „$2“ врсте.',
	'templatedata-invalid-missing' => 'Обавезно својство „$1“ није пронађено.',
	'templatedata-invalid-unknown' => 'Неочекивано својство „$1“.',
	'templatedata-invalid-value' => 'Неисправна вредност за својство „$1“.',
);

/** Swedish (svenska)
 * @author Jopparn
 * @author Lokal Profil
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'templatedata-doc-desc-empty' => 'Ingen beskrivning.',
	'templatedata-doc-params' => 'Mallparametrar',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beskrivning',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'ingen beskrivning',
	'templatedata-invalid-parse' => 'Syntaxfel i JSON.',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'templatedata-doc-params' => 'మూస పరామితులు',
	'templatedata-doc-param-name' => 'పేరు', # Fuzzy
	'templatedata-doc-param-desc' => 'వివరణ',
	'templatedata-doc-param-default' => 'అప్రమేయం',
	'templatedata-doc-param-status' => 'స్థితి',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'templatedata-desc' => 'Isakatuparan ang pag-iimbak ng dato para sa mga parametro ng padron (na ginagamit ang JSON)',
	'templatedata-doc-params' => 'Mga parametro ng padron',
	'templatedata-doc-param-name' => 'Pangalan', # Fuzzy
	'templatedata-doc-param-desc' => 'Paglalarawan',
	'templatedata-doc-param-default' => 'Likas na katakdaan',
	'templatedata-doc-param-status' => 'Katayuan',
	'templatedata-invalid-parse' => 'Kamalian ng palaugnayan sa JSON.',
	'templatedata-invalid-type' => 'Ang pag-aaring "$1" ay inaasahan na maging ng uring "$2".',
	'templatedata-invalid-missing' => 'Hindi natagpuan ang kailangang pag-aari na "$1".',
	'templatedata-invalid-unknown' => 'Hindi inaasahang pag-aari na "$1".',
	'templatedata-invalid-value' => 'Hindi katanggap-tanggap na halaga para sa pag-aaring "$1".',
);

/** Ukrainian (українська)
 * @author Andriykopanytsia
 */
$messages['uk'] = array(
	'templatedata-desc' => 'Реалізація сховища даних для параметрів шаблону (JSON)',
	'templatedata-doc-desc-empty' => 'Немає опису.',
	'templatedata-doc-params' => 'Параметри шаблону',
	'templatedata-doc-param-name' => 'Параметр',
	'templatedata-doc-param-desc' => 'Опис',
	'templatedata-doc-param-type' => 'Тип',
	'templatedata-doc-param-default' => 'Стандартно',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-doc-param-desc-empty' => 'немає опису',
	'templatedata-invalid-parse' => 'Синтаксична помилка в JSON.',
	'templatedata-invalid-type' => 'Властивість "$1" має бути типу "$2".',
	'templatedata-invalid-missing' => 'Обов\'язкову властивість "$1" не знайдено.',
	'templatedata-invalid-unknown' => 'Неочікувана властивість "$1".',
	'templatedata-invalid-value' => 'Неприпустиме значення властивості "$1".',
	'templatedata-invalid-length' => 'Дані завеликі для збереження ({{formatnum:$1}} {{PLURAL:$1|байт|байти|байтів}}, {{PLURAL:$2|обмеження становить}} {{formatnum:$2}})',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'templatedata-desc' => 'Lưu trữ dữ liệu cho tham số bản mẫu (qua JSON)',
	'templatedata-doc-desc-empty' => 'Không có miêu tả.',
	'templatedata-doc-params' => 'Tham số bản mẫu',
	'templatedata-doc-param-name' => 'Tham số',
	'templatedata-doc-param-desc' => 'Miêu tả',
	'templatedata-doc-param-type' => 'Kiểu',
	'templatedata-doc-param-default' => 'Mặc định',
	'templatedata-doc-param-status' => 'Trạng thái',
	'templatedata-doc-param-desc-empty' => 'không miêu tả',
	'templatedata-invalid-parse' => 'Lỗi cú pháp JSON.',
	'templatedata-invalid-type' => 'Mong đợi kiểu “$2” cho giá trị thuộc tính “$1”.',
	'templatedata-invalid-missing' => 'Không tìm thấy thuộc tính bắt buộc “$1”.',
	'templatedata-invalid-unknown' => 'Thuộc tính bất ngờ “$1”.',
	'templatedata-invalid-value' => 'Giá trị thuộc tính “$1” là không hợp lệ.',
	'templatedata-invalid-length' => 'Dữ liệu quá lớn để lưu ({{formatnum:$1}} byte, vượt quá hạn chế {{formatnum:$2}} byte)',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Liuxinyu970226
 * @author Shizhao
 * @author Xiaomingyan
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'templatedata-desc' => '实现模板参数的数据存储（使用JSON）',
	'templatedata-doc-desc-empty' => '没有说明。',
	'templatedata-doc-params' => '模板参数',
	'templatedata-doc-param-name' => '参数',
	'templatedata-doc-param-desc' => '说明',
	'templatedata-doc-param-type' => '类型',
	'templatedata-doc-param-default' => '默认值',
	'templatedata-doc-param-status' => '状态',
	'templatedata-doc-param-desc-empty' => '没有说明',
	'templatedata-invalid-parse' => 'JSON中语法错误。',
	'templatedata-invalid-type' => '属性“$1”的预期类型为“$2”。',
	'templatedata-invalid-missing' => '未找到必需的属性“$1”。',
	'templatedata-invalid-unknown' => '意外的属性“$1”。',
	'templatedata-invalid-value' => '属性“$1”的值无效。',
	'templatedata-invalid-length' => '数据过大，无法保存（{{formatnum:$1}}{{PLURAL:$1|字节}}，{{PLURAL:$2|限制是}}{{formatnum:$2}}）',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author Simon Shek
 */
$messages['zh-hant'] = array(
	'templatedata-desc' => '為模板參數實現數據存儲（使用JSON）',
	'templatedata-doc-params' => '模版參數',
	'templatedata-doc-param-name' => '參數',
	'templatedata-doc-param-desc' => '描述',
	'templatedata-doc-param-type' => '類型',
	'templatedata-doc-param-default' => '預設',
	'templatedata-doc-param-status' => '狀態',
	'templatedata-invalid-parse' => 'JSON中語法錯誤。',
	'templatedata-invalid-type' => '屬性「$1」預期為類型「$2」。',
	'templatedata-invalid-missing' => '找不到必須的屬性「$1」。',
	'templatedata-invalid-unknown' => '意外的屬性「$1」。',
	'templatedata-invalid-value' => '屬性「$1」的值無效。',
);
