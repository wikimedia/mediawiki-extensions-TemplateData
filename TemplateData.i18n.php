<?php
$messages = array();

/** English
 * @author Timo Tijhof
 */
$messages['en'] = array(

	// Special:Version
	'templatedata-desc' => 'Implement data storage for template parameters (using JSON)',

	// Page output for <templatedata>
	'templatedata-doc-params' => 'Template parameters',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Default',
	'templatedata-doc-param-status' => 'Status',

	// Error message for edit page
	'templatedata-invalid-parse' => 'Syntax error in JSON.',
	'templatedata-invalid-type' => 'Property "$1" is expected to be of type "$2".',
	'templatedata-invalid-missing' => 'Required property "$1" not found.',
	'templatedata-invalid-unknown' => 'Unexpected property "$1".',
	'templatedata-invalid-value' => 'Invalid value for property "$1".',
);

/** Message documentation (Message documentation)
 * @author Shirayuki
 * @author Timo Tijhof
 */
$messages['qqq'] = array(
	'templatedata-desc' => '{{desc|name=Template Data|url=http://www.mediawiki.org/wiki/Extension:TemplateData}}',
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
);

/** Bengali (বাংলা)
 * @author Leemon2010
 */
$messages['bn'] = array(
	'templatedata-doc-params' => 'টেমপ্লেট পরামিতি',
	'templatedata-doc-param-name' => 'নাম', # Fuzzy
	'templatedata-doc-param-desc' => 'বিবরণ',
	'templatedata-doc-param-default' => 'ডিফল্ট',
	'templatedata-doc-param-status' => 'অবস্থা',
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
 * @author Mormegil
 */
$messages['cs'] = array(
	'templatedata-desc' => 'Implementuje datové úložiště pro parametry šablon (pomocí JSON)',
	'templatedata-doc-params' => 'Parametry šablony',
	'templatedata-doc-param-name' => 'Parametr',
	'templatedata-doc-param-desc' => 'Popis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Implicitní',
	'templatedata-doc-param-status' => 'Stav',
	'templatedata-invalid-parse' => 'Syntaktická chyba v JSON.',
	'templatedata-invalid-type' => 'Očekávaný typ vlastnosti „$1“ je „$2“.',
	'templatedata-invalid-missing' => 'Nenalezena vyžadovaná vlastnost „$1“.',
	'templatedata-invalid-unknown' => 'Neočekávaná vlastnost „$1“.',
	'templatedata-invalid-value' => 'Chybná hodnota vlastnosti „$1“.',
);

/** German (Deutsch)
 * @author Metalhead64
 */
$messages['de'] = array(
	'templatedata-desc' => 'Ermöglicht mithilfe von JSON die Implementierung der Datenspeicherung für Vorlagenparameter',
	'templatedata-doc-params' => 'Vorlagenparameter',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschreibung',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaxfehler in JSON.',
	'templatedata-invalid-type' => 'Für den Typ „$2” wird die Eigenschaft „$1” erwartet.',
	'templatedata-invalid-missing' => 'Die erforderliche Eigenschaft „$1” wurde nicht gefunden.',
	'templatedata-invalid-unknown' => 'Unerwartete Eigenschaft „$1”.',
	'templatedata-invalid-value' => 'Ungültiger Wert für die Eigenschaft „$1”.',
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
 * @author Metroitendo
 * @author Peter17
 */
$messages['fr'] = array(
	'templatedata-desc' => 'Mettre en œuvre un stockage de données pour les paramètres du modèle (en utilisant JSON)',
	'templatedata-doc-params' => 'Paramètres du modèle',
	'templatedata-doc-param-name' => 'Paramètre',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Par défaut',
	'templatedata-doc-param-status' => 'Statut',
	'templatedata-invalid-parse' => 'Erreur de syntaxe dans JSON.',
	'templatedata-invalid-type' => 'La propriété « $1 » doit être de type « $2 ».',
	'templatedata-invalid-missing' => 'Propriété « $1 » obligatoire non trouvée.',
	'templatedata-invalid-unknown' => 'Propriété « $1 » non attendue.',
	'templatedata-invalid-value' => 'Valeur non valide pour la propriété « $1 ».',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'templatedata-desc' => 'Inclúe un almacenamento de datos para os parámetros do modelo (mediante JSON)',
	'templatedata-doc-params' => 'Parámetros do modelo',
	'templatedata-doc-param-name' => 'Parámetro',
	'templatedata-doc-param-desc' => 'Descrición',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Predeterminado',
	'templatedata-doc-param-status' => 'Estado',
	'templatedata-invalid-parse' => 'Erro de sintaxe en JSON.',
	'templatedata-invalid-type' => 'A propiedade "$1" agárdase que sexa de tipo "$2".',
	'templatedata-invalid-missing' => 'Non se atopou a propiedade obrigatoria "$1".',
	'templatedata-invalid-unknown' => 'Propiedade "$1" inesperada.',
	'templatedata-invalid-value' => 'Valor non válido para a propiedade "$1".',
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
	'templatedata-invalid-type' => 'מאפיין "$1" צפוי להיות מסוג "$2".',
	'templatedata-invalid-missing' => 'המאפיין הדרוש "$1" לא נמצא.',
	'templatedata-invalid-unknown' => 'מאפיין בלתי־צפוי "$1".',
	'templatedata-invalid-value' => 'ערך בלתי־תקין למאפיין "$1".',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'templatedata-desc' => 'Datowe składowanje za předłohowe parametry implementować (z pomocu JSON)',
	'templatedata-doc-params' => 'Předłohowe parametry',
	'templatedata-doc-param-name' => 'Mjeno', # Fuzzy
	'templatedata-doc-param-desc' => 'Wopisanje',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaksowy zmylk w JSON.',
	'templatedata-invalid-type' => 'Za kajkosć "$1" so typ "$2" wočakuje.',
	'templatedata-invalid-missing' => 'Trěbna kajkosć "$1" njeje so namakała.',
	'templatedata-invalid-unknown' => 'Njewočakowana kajkosć "$1".',
	'templatedata-invalid-value' => 'Njepłaćiwa hódnota za kajkosć "$1".',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'templatedata-desc' => 'Implementa la memorizzazione dei dati per i parametri dei template (utilizzando JSON)',
	'templatedata-doc-params' => 'Parametri template',
	'templatedata-doc-param-name' => 'Parametro',
	'templatedata-doc-param-desc' => 'Descrizione',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Predefinito',
	'templatedata-doc-param-status' => 'Stato',
	'templatedata-invalid-parse' => 'Errore di sintassi in JSON.',
	'templatedata-invalid-type' => 'La proprietà "$1" dovrebbe essere di tipo "$2".',
	'templatedata-invalid-missing' => 'Proprietà obbligatoria "$1" non trovata.',
	'templatedata-invalid-unknown' => 'Proprietà "$1" non prevista.',
	'templatedata-invalid-value' => 'Valore non valido per la proprietà "$1".',
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
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'templatedata-doc-params' => 'Parameter vun der Schabloun',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschreiwung',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaxfeeler am JSON.',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'templatedata-desc' => 'Овозможува складирање на податоци за шаблонски параметри (користејќи JSON)',
	'templatedata-doc-params' => 'Шаблонски параметри',
	'templatedata-doc-param-name' => 'Параметар',
	'templatedata-doc-param-desc' => 'Опис',
	'templatedata-doc-param-type' => 'Тип',
	'templatedata-doc-param-default' => 'По основно',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-invalid-parse' => 'Синтаксна грешка во JSON.',
	'templatedata-invalid-type' => 'Се очекува својството „$1“ да биде од типот „$2“.',
	'templatedata-invalid-missing' => 'Бараното својство „$1“ не е пронајдено.',
	'templatedata-invalid-unknown' => 'Неочекувано својство „$1“.',
	'templatedata-invalid-value' => 'Неисправна вредност за својството „$1“.',
);

/** Malayalam (മലയാളം)
 * @author Santhosh.thottingal
 */
$messages['ml'] = array(
	'templatedata-doc-params' => 'ഫലകത്തിനുള്ള ചരങ്ങൾ',
	'templatedata-doc-param-name' => 'പേര്‌', # Fuzzy
	'templatedata-doc-param-status' => 'സ്ഥിതി',
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
 */
$messages['nl'] = array(
	'templatedata-desc' => 'Implementeert gegevensopslag voor sjabloonparameters (met behulp van JSON)',
	'templatedata-doc-params' => 'Sjabloonparameters',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beschrijving',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Standaard',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-invalid-parse' => 'Syntaxisfout in JSON.',
	'templatedata-invalid-type' => 'De verwachting is dat eigenschap "$1" van het type "$2" is.',
	'templatedata-invalid-missing' => 'Vereiste eigenschap "$1" niet gevonden.',
	'templatedata-invalid-unknown' => 'Onverwachte eigenschap "$1".',
	'templatedata-invalid-value' => 'Ongeldige waarde voor de eigenschap "$1".',
);

/** Polish (polski)
 * @author Chrumps
 */
$messages['pl'] = array(
	'templatedata-doc-params' => 'Parametry szablonu',
	'templatedata-doc-param-desc' => 'Opis',
	'templatedata-invalid-parse' => 'Błąd składni w JSON.',
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

/** Serbian (Cyrillic script) (српски (ћирилица)‎)
 * @author Milicevic01
 * @author Милан Јелисавчић
 */
$messages['sr-ec'] = array(
	'templatedata-doc-params' => 'Параметри шаблона',
	'templatedata-doc-param-name' => 'Име', # Fuzzy
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

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'templatedata-desc' => 'Lưu trữ dữ liệu cho tham số bản mẫu (qua JSON)',
	'templatedata-doc-params' => 'Tham số bản mẫu',
	'templatedata-doc-param-name' => 'Tham số',
	'templatedata-doc-param-desc' => 'Miêu tả',
	'templatedata-doc-param-type' => 'Kiểu',
	'templatedata-doc-param-default' => 'Mặc định',
	'templatedata-doc-param-status' => 'Trạng thái',
	'templatedata-invalid-parse' => 'Lỗi cú pháp JSON.',
	'templatedata-invalid-type' => 'Mong đợi kiểu “$2” cho giá trị thuộc tính “$1”.',
	'templatedata-invalid-missing' => 'Không tìm thấy thuộc tính bắt buộc “$1”.',
	'templatedata-invalid-unknown' => 'Thuộc tính bất ngờ “$1”.',
	'templatedata-invalid-value' => 'Giá trị thuộc tính “$1” là không hợp lệ.',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'templatedata-desc' => '为模板参数实现数据存储（使用JSON）',
	'templatedata-doc-params' => '模板参数',
	'templatedata-doc-param-name' => '名称', # Fuzzy
	'templatedata-doc-param-desc' => '描述',
	'templatedata-doc-param-default' => '默认',
	'templatedata-doc-param-status' => '状态',
	'templatedata-invalid-parse' => 'JSON中语法错误。',
	'templatedata-invalid-type' => '属性“$1”预期为“$2”类型。',
	'templatedata-invalid-missing' => '请求的属性“$1”未找到。',
	'templatedata-invalid-unknown' => '意外的属性“$1”。',
	'templatedata-invalid-value' => '属性“$1”的值无效。',
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
