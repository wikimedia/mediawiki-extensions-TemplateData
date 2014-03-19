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
	'templatedata-doc-param-default-empty' => 'empty',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'deprecated',
	'templatedata-doc-param-status-optional' => 'optional',
	'templatedata-doc-param-status-required' => 'required',
	'templatedata-doc-param-desc-empty' => 'no description',

	// Error message for edit page
	'templatedata-invalid-duplicate-value' => 'Property "$1" ("$3") is a duplicate of "$2".',
	'templatedata-invalid-parse' => 'Syntax error in JSON.',
	'templatedata-invalid-type' => 'Property "$1" is expected to be of type "$2".',
	'templatedata-invalid-missing' => 'Required property "$1" not found.',
	'templatedata-invalid-empty-array' => 'Property "$1" must have at least one value in its array.',
	'templatedata-invalid-unknown' => 'Unexpected property "$1".',
	'templatedata-invalid-value' => 'Invalid value for property "$1".',
	'templatedata-invalid-length' => 'Data too large to save ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|limit is}} {{formatnum:$2}})',

	// TemplateData generator GUI:
	'templatedata-editbutton' => 'Manage template documentation',
	'templatedata-errormsg-jsonbadformat' => 'Bad JSON format. Either correct it, or delete the current <templatedata> tags and try again.',
	'templatedata-modal-button-addparam' => 'Add parameter',
	'templatedata-modal-button-apply' => 'Apply',
	'templatedata-modal-button-cancel' => 'Cancel',
	'templatedata-modal-button-delparam' => 'Delete parameter',
	'templatedata-modal-button-importParams' => 'Import parameters',
	'templatedata-modal-errormsg' => 'Errors found. Please make sure there are no empty or duplicate parameter names, and that the parameter name does not include "$1", "$2" or "$3".',
	'templatedata-modal-errormsg-import-noparams' => 'No new parameters found during import.',
	'templatedata-modal-notice-import-numparams' => '$1 new {{PLURAL:$1|parameter was|parameters were}} imported.',
	'templatedata-modal-table-param-actions' => 'Actions',
	'templatedata-modal-table-param-aliases' => 'Aliases (comma separated)',
	'templatedata-modal-table-param-default' => 'Default',
	'templatedata-modal-table-param-desc' => 'Description',
	'templatedata-modal-table-param-label' => 'Label',
	'templatedata-modal-table-param-name' => 'Name',
	'templatedata-modal-table-param-required' => 'Required',
	'templatedata-modal-table-param-type' => 'Type',
	'templatedata-modal-table-param-type-number' => 'Number',
	'templatedata-modal-table-param-type-page' => 'Page',
	'templatedata-modal-table-param-type-string' => 'String',
	'templatedata-modal-table-param-type-undefined' => 'Undefined',
	'templatedata-modal-table-param-type-user' => 'User',
	'templatedata-modal-title' => 'Template documentation editor',
	'templatedata-modal-title-templatedesc' => 'Template description',
	'templatedata-modal-title-templateparams' => 'Template parameters',
);

/** Message documentation (Message documentation)
 * @author Sethladan
 * @author Shirayuki
 * @author Timo Tijhof
 */
$messages['qqq'] = array(
	'templatedata-desc' => '{{desc|name=Template Data|url=http://www.mediawiki.org/wiki/Extension:TemplateData}}',
	'templatedata-doc-desc-empty' => 'Displayed when a template has no description (should be a valid sentence).
{{Identical|No description}}',
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
	'templatedata-doc-param-default-empty' => 'Displayed when a template parameter has no default value (should not be a full sentence, used in a table).
{{Identical|Empty}}',
	'templatedata-doc-param-status' => 'Used as column heading in the table.
{{Related|Templatedata-doc-param}}
{{Identical|Status}}',
	'templatedata-doc-param-status-deprecated' => 'Displayed when a template parameter is deprecated (should not be a full sentence, used in a table).
{{Identical|Deprecated}}',
	'templatedata-doc-param-status-optional' => 'Displayed when a template parameter is optional (should not be a full sentence, used in a table).
{{Identical|Optional}}',
	'templatedata-doc-param-status-required' => 'Displayed when a template parameter is required (should not be a full sentence, used in a table).
{{Identical|Required}}',
	'templatedata-doc-param-desc-empty' => 'Displayed when a template parameter has no description (should not be a full sentence, used in a table cell).
{{Identical|No description}}',
	'templatedata-invalid-duplicate-value' => 'Displayed when an array that must only contain unique values contains a duplicate.
* $1 - name of property containing the duplicate
* $2 - name of property with first occurrence of value
* $3 - the value being duplicated',
	'templatedata-invalid-parse' => 'Error message when there is a syntax error in JSON.',
	'templatedata-invalid-type' => 'Error message when a property is of the wrong type.
* $1 - name of property. e.g. "params.1.required"
* $2 - expected type of property. e.g. "boolean"',
	'templatedata-invalid-missing' => 'Error message when a required property is not found.
* $1 - name of property. e.g. "params"
* $2 - type of property (Unused)',
	'templatedata-invalid-empty-array' => 'Error message when a property that must be non-empty is empty. Parameters:
* $1 - property name ("paramOrder" or "sets.{$setNr}.params")',
	'templatedata-invalid-unknown' => 'Error message when an unknown property is found.
* $1 - name of property. e.g. "params.1.foobar"',
	'templatedata-invalid-value' => 'Error message when a property that cannot contain free-form text has an invalid value.
* $1 - name of property. e.g. "params.1.type"',
	'templatedata-invalid-length' => "Error message when generated JSON's length exceed database limits.
* $1 - length of generated JSON
* $2 - maximal allowed length",
	'templatedata-editbutton' => 'The label of the button to manage templatedata, appearing above the editor field.',
	'templatedata-errormsg-jsonbadformat' => 'Error message that appears in case the JSON string is not possible to parse. The user is asked to either correct the json syntax or delete the values between the &lt;templatedata&gt; tags and try again.',
	'templatedata-modal-button-addparam' => 'Button to add a parameter.
{{Identical|Add parameter}}',
	'templatedata-modal-button-apply' => 'Label of the apply button.
{{Identical|Apply}}',
	'templatedata-modal-button-cancel' => 'Label of the cancel button.
{{Identical|Cancel}}',
	'templatedata-modal-button-delparam' => 'Button to delete a parameter',
	'templatedata-modal-button-importParams' => 'Label of the import button',
	'templatedata-modal-errormsg' => 'Error message that appears in the TemplateData generator GUI in case there are empty, duplicate or invalid parameter names.

Invalid characters are supplied as parameters to avoid parsing errors in translation strings.

Parameters:
* $1 - pipe (<code>|</code>)
* $2 - equal sign (<code>=</code>)
* $3 - double curly brackets (<code><nowiki>}}</nowiki></code>)',
	'templatedata-modal-errormsg-import-noparams' => 'message that appears in the TemplateData generator GUI in case no template parameters were found during the import attempt.',
	'templatedata-modal-notice-import-numparams' => 'message that appears in the TemplateData generator GUI showing how many new parameters were imported into the GUI from an existing template.',
	'templatedata-modal-table-param-actions' => 'Label for a table heading: Parameter actions in the table',
	'templatedata-modal-table-param-aliases' => 'Label for a table heading: Aliases of the parameter, instruct the user to separate aliases with commas.',
	'templatedata-modal-table-param-default' => 'Label for a table heading: Default value of the parameter.
{{Identical|Default}}',
	'templatedata-modal-table-param-desc' => 'Label for a table heading: Description of the parameter',
	'templatedata-modal-table-param-label' => 'Label for a table heading: Label of the parameter',
	'templatedata-modal-table-param-name' => 'Label for a table heading: Name of the parameter',
	'templatedata-modal-table-param-required' => 'Label for a table heading: Required status of the parameter',
	'templatedata-modal-table-param-type' => 'Label for a table heading: Type of the parameter',
	'templatedata-modal-table-param-type-number' => 'A possible parameter type: Number',
	'templatedata-modal-table-param-type-page' => 'A possible parameter type: Page',
	'templatedata-modal-table-param-type-string' => 'A possible parameter type: String',
	'templatedata-modal-table-param-type-undefined' => 'A possible parameter type: Undefined',
	'templatedata-modal-table-param-type-user' => 'A possible parameter type: User',
	'templatedata-modal-title' => 'Title of the modal popup.',
	'templatedata-modal-title-templatedesc' => 'The title for the template description textbox',
	'templatedata-modal-title-templateparams' => 'The title for the template parameters table',
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
	'templatedata-doc-desc-empty' => 'Ensin descripción.',
	'templatedata-doc-params' => 'Parámetros de la plantía',
	'templatedata-doc-param-name' => 'Parámetru',
	'templatedata-doc-param-desc' => 'Descripción',
	'templatedata-doc-param-type' => 'Triba',
	'templatedata-doc-param-default' => 'Predetermináu',
	'templatedata-doc-param-default-empty' => 'baleru',
	'templatedata-doc-param-status' => 'Estáu',
	'templatedata-doc-param-status-deprecated' => 'desusáu',
	'templatedata-doc-param-status-optional' => 'opcional',
	'templatedata-doc-param-status-required' => 'obligatoriu',
	'templatedata-doc-param-desc-empty' => 'ensin descripción',
	'templatedata-invalid-duplicate-value' => 'La propiedá "$1" ("$3") ye un duplicáu de "$2".',
	'templatedata-invalid-parse' => 'Error de sintaxis en JSON.',
	'templatedata-invalid-type' => 'Esperabase que la propiedá «$1» fuera de tipu «$2».',
	'templatedata-invalid-missing' => "Nun s'alcontró la propiedá requerida «$1».",
	'templatedata-invalid-empty-array' => 'La propiedá "$1" tien de tener polo menos un valor nesta matríz.',
	'templatedata-invalid-unknown' => 'Propiedá inesperada «$1».',
	'templatedata-invalid-value' => 'Valor inválidu pa la propiedá «$1».',
	'templatedata-invalid-length' => 'Los datos son demasiao grandes pa guardar ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|la llende ye}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Alministrar la documentación de plantía',
	'templatedata-errormsg-jsonbadformat' => 'Formatu JSON incorreutu. Corríxalu o desanicie les etiquetes <templatedata> actuales y vuelva a intentalo.',
	'templatedata-modal-button-addparam' => 'Amestar parámetru',
	'templatedata-modal-button-apply' => 'Aplicar',
	'templatedata-modal-button-cancel' => 'Encaboxar',
	'templatedata-modal-button-delparam' => 'Desaniciar parámetru',
	'templatedata-modal-button-importParams' => 'Importar parámetros',
	'templatedata-modal-errormsg' => 'Atopáronse errores. Compruebe que nun hai nomes de parámetru baleros o duplicaos, y que\'l nome del parámetru nun incluye "$1", "$2" o "$3".',
	'templatedata-modal-errormsg-import-noparams' => "Nun s'alcontraron parámetros nuevos demientres la importación.",
	'templatedata-modal-notice-import-numparams' => '{{PLURAL:$1|Importóse|Importáronse}} $1 {{PLURAL:$1|parámetru nuevu|parámetros nuevos}}.',
	'templatedata-modal-table-param-actions' => 'Aiciones',
	'templatedata-modal-table-param-aliases' => 'Alcuños (separaos por comes)',
	'templatedata-modal-table-param-default' => 'Predetermináu',
	'templatedata-modal-table-param-desc' => 'Descripción',
	'templatedata-modal-table-param-label' => 'Etiqueta',
	'templatedata-modal-table-param-name' => 'Nome',
	'templatedata-modal-table-param-required' => 'Requeríu',
	'templatedata-modal-table-param-type' => 'Triba',
	'templatedata-modal-table-param-type-number' => 'Númberu',
	'templatedata-modal-table-param-type-page' => 'Páxina',
	'templatedata-modal-table-param-type-string' => 'Cadena',
	'templatedata-modal-table-param-type-undefined' => 'Non definíu',
	'templatedata-modal-table-param-type-user' => 'Usuariu',
	'templatedata-modal-title' => 'Editor de documentación de plantía',
	'templatedata-modal-title-templatedesc' => 'Descripción de la plantía',
	'templatedata-modal-title-templateparams' => 'Parámetros de la plantía',
);

/** Azerbaijani (azərbaycanca)
 * @author Eminn
 */
$messages['az'] = array(
	'templatedata-modal-button-cancel' => 'Ləğv et',
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
 * @author Tauhid16
 */
$messages['bn'] = array(
	'templatedata-doc-desc-empty' => 'বিবরণ নেই।',
	'templatedata-doc-params' => 'টেমপ্লেট প্যারামিটার',
	'templatedata-doc-param-name' => 'প্যারামিটার',
	'templatedata-doc-param-desc' => 'বিবরণ',
	'templatedata-doc-param-type' => 'ধরন',
	'templatedata-doc-param-default' => 'ডিফল্ট',
	'templatedata-doc-param-default-empty' => 'খালি',
	'templatedata-doc-param-status' => 'অবস্থা',
	'templatedata-doc-param-status-optional' => 'ঐচ্ছিক',
	'templatedata-doc-param-status-required' => 'প্রয়োজনীয়',
	'templatedata-doc-param-desc-empty' => 'বিবরণ নেই',
	'templatedata-invalid-parse' => 'জেএসওএন-এর মধ্যে বাক্যগঠনে ত্রুটি।',
	'templatedata-invalid-length' => 'সংরক্ষণ করার জন্য ডেটা খুব বড় ({{formatnum:$1}} {{PLURAL:$1|বাইট}}, {{PLURAL:$2|সর্বোচ্চ সীমা}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'নথিপত্র টেমপ্লেট পরিচালনা করুন',
	'templatedata-modal-button-addparam' => 'স্থিতিমাপ যোগ করুন',
	'templatedata-modal-button-apply' => 'প্রয়োগ',
	'templatedata-modal-button-cancel' => 'বাতিল',
	'templatedata-modal-button-delparam' => 'প্যারামিটার অপসারণ',
	'templatedata-modal-button-importParams' => 'প্যারামিটার আমদানি',
	'templatedata-modal-errormsg-import-noparams' => 'আমদানির সময় নতুন কোনো প্যারামিটার পাওয়া যায়নি।',
	'templatedata-modal-table-param-actions' => 'কার্যসমূহ',
	'templatedata-modal-table-param-default' => 'পূর্বনির্ধারিত',
	'templatedata-modal-table-param-desc' => 'বিবরণ',
	'templatedata-modal-table-param-label' => 'লেবেল',
	'templatedata-modal-table-param-name' => 'নাম',
	'templatedata-modal-table-param-required' => 'আবশ্যক',
	'templatedata-modal-table-param-type' => 'ধরন',
	'templatedata-modal-table-param-type-number' => 'সংখ্যা',
	'templatedata-modal-table-param-type-page' => 'পাতা',
	'templatedata-modal-table-param-type-string' => 'স্ট্রিং',
	'templatedata-modal-table-param-type-undefined' => 'অসংজ্ঞায়িত',
	'templatedata-modal-table-param-type-user' => 'ব্যবহারকারী',
	'templatedata-modal-title' => 'টেমপ্লেট নথিপত্র সম্পাদক',
	'templatedata-modal-title-templatedesc' => 'টেমপ্লেট বিবরণ',
	'templatedata-modal-title-templateparams' => 'টেমপ্লেট প্যারামিটার',
);

/** Breton (brezhoneg)
 * @author Y-M D
 */
$messages['br'] = array(
	'templatedata-doc-desc-empty' => 'Deskrivadur ebet.',
	'templatedata-doc-param-name' => 'Anv', # Fuzzy
	'templatedata-doc-param-desc' => 'Deskrivadur',
	'templatedata-doc-param-default' => 'Dre ziouer',
	'templatedata-doc-param-default-empty' => 'goullo',
	'templatedata-doc-param-status' => 'Statud',
	'templatedata-doc-param-status-deprecated' => 'dispredet',
	'templatedata-doc-param-status-optional' => 'diret',
	'templatedata-doc-param-status-required' => 'rekis',
	'templatedata-doc-param-desc-empty' => 'deskrivadur ebet',
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
 * @author Toniher
 * @author Vriullop
 */
$messages['ca'] = array(
	'templatedata-doc-params' => 'Paràmetres de la plantilla',
	'templatedata-doc-param-name' => 'Paràmetre',
	'templatedata-doc-param-desc' => 'Descripció',
	'templatedata-doc-param-type' => 'Tipus',
	'templatedata-doc-param-default' => 'Per defecte',
	'templatedata-doc-param-default-empty' => 'buit',
	'templatedata-doc-param-status' => 'Estat',
	'templatedata-doc-param-status-optional' => 'opcional',
	'templatedata-doc-param-status-required' => 'obligatori',
	'templatedata-modal-table-param-actions' => 'Accions',
	'templatedata-modal-table-param-default' => 'Per defecte',
	'templatedata-modal-table-param-required' => 'Obligatori',
	'templatedata-modal-table-param-type' => 'Tipus',
	'templatedata-modal-table-param-type-user' => 'Usuari',
);

/** Chechen (нохчийн)
 * @author Умар
 */
$messages['ce'] = array(
	'templatedata-desc' => 'Кепан парамнтраш лато меттиг кечйо (JSON гӀоьнца)',
	'templatedata-doc-params' => 'Кепан параметраш',
	'templatedata-doc-param-desc' => 'Цуьнах лаьцна',
	'templatedata-doc-param-default' => 'Iад йитарца',
	'templatedata-editbutton' => 'Кепашна документашна урхалладар',
	'templatedata-modal-button-addparam' => 'ТӀетоха параметр',
	'templatedata-modal-button-apply' => 'Кхочушде',
	'templatedata-modal-button-cancel' => 'Цаоьшу',
	'templatedata-modal-button-delparam' => 'ДӀаяккха параметр',
	'templatedata-modal-button-importParams' => 'Параметраш импорт ян',
	'templatedata-modal-errormsg-import-noparams' => 'Импорт ечу хенахь керла параметраш цакарий.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|керла параметр импорт йина|керла параметраш импорт йина}}.',
	'templatedata-modal-table-param-actions' => 'Дийраш',
	'templatedata-modal-table-param-default' => 'Iад йитарца',
	'templatedata-modal-table-param-desc' => 'Цуьнах лаьцна',
	'templatedata-modal-table-param-label' => 'Билгалдар',
	'templatedata-modal-table-param-name' => 'ЦӀе',
	'templatedata-modal-table-param-required' => 'Оьшу',
	'templatedata-modal-table-param-type' => 'Тайп',
	'templatedata-modal-table-param-type-number' => 'Терахь',
	'templatedata-modal-table-param-type-page' => 'АгӀо',
	'templatedata-modal-table-param-type-string' => 'МогӀа',
	'templatedata-modal-table-param-type-undefined' => 'Билгала ца йинарг',
	'templatedata-modal-table-param-type-user' => 'Декъашхо',
	'templatedata-modal-title' => 'Кепаш документаш тадераг',
	'templatedata-modal-title-templatedesc' => 'Кепах лаьцна',
	'templatedata-modal-title-templateparams' => 'Кепан параметраш',
);

/** Czech (čeština)
 * @author Littledogboy
 * @author Mormegil
 */
$messages['cs'] = array(
	'templatedata-desc' => 'Implementuje datové úložiště pro parametry šablon (pomocí JSON)',
	'templatedata-doc-desc-empty' => 'Bez popisu.',
	'templatedata-doc-params' => 'Parametry šablony',
	'templatedata-doc-param-name' => 'Parametr',
	'templatedata-doc-param-desc' => 'Popis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Výchozí hodnota',
	'templatedata-doc-param-default-empty' => 'prázdné',
	'templatedata-doc-param-status' => 'Stav',
	'templatedata-doc-param-status-deprecated' => 'zastaralý',
	'templatedata-doc-param-status-optional' => 'nepovinný',
	'templatedata-doc-param-status-required' => 'povinný',
	'templatedata-doc-param-desc-empty' => 'prázdné',
	'templatedata-invalid-duplicate-value' => 'Vlastnost „$1“ („$3“) je duplicita k „$2“.',
	'templatedata-invalid-parse' => 'Syntaktická chyba v JSON.',
	'templatedata-invalid-type' => 'Očekávaný typ vlastnosti „$1“ je „$2“.',
	'templatedata-invalid-missing' => 'Nenalezena vyžadovaná vlastnost „$1“.',
	'templatedata-invalid-empty-array' => 'Vlastnost „$1“ musí ve svém poli obsahovat alespoň jednu hodnotu.',
	'templatedata-invalid-unknown' => 'Neočekávaná vlastnost „$1“.',
	'templatedata-invalid-value' => 'Chybná hodnota vlastnosti „$1“.',
	'templatedata-invalid-length' => 'Takto velká data nelze uložit ({{formatnum:$1}} {{PLURAL:$1|bajt|bajty|bajtů}}, limit je {{formatnum:$2}} {{PLURAL:$2|bajt|bajty|bajtů}})',
);

/** Welsh (Cymraeg)
 * @author Lloffiwr
 */
$messages['cy'] = array(
	'templatedata-desc' => 'Gweithredu storio data ar gyfer paramedrau nodynnau (gan ddefnyddio JSON)',
	'templatedata-doc-desc-empty' => 'Dim disgrifiad.',
	'templatedata-doc-params' => "Paramedrau'r nodyn",
	'templatedata-doc-param-name' => 'Paramedr',
	'templatedata-doc-param-desc' => 'Disgrifiad',
	'templatedata-doc-param-type' => 'Math',
	'templatedata-doc-param-default' => 'Yn ddiofyn',
	'templatedata-doc-param-default-empty' => 'gwag',
	'templatedata-doc-param-status' => 'Statws',
	'templatedata-doc-param-status-deprecated' => 'anghymeradwyedig',
	'templatedata-doc-param-status-optional' => 'dewisol',
	'templatedata-doc-param-status-required' => 'angenrheidiol',
	'templatedata-doc-param-desc-empty' => 'dim disgrifiad',
	'templatedata-invalid-parse' => 'Gwall cystrawen yn JSON.',
	'templatedata-invalid-type' => 'Disgwylir i\'r briodwedd "$1" fod o\'r math "$2".',
	'templatedata-invalid-missing' => 'Ni ellir cael gafael ar y briodwedd angenrheidiol "$1".',
	'templatedata-invalid-empty-array' => 'Rhaid bod o leiaf un gwerth yn arae y briodwedd "$1".',
	'templatedata-invalid-unknown' => 'Priodwedd annisgwyl, "$1".',
	'templatedata-invalid-value' => 'Gwerth annilys i\'r briodwedd "$1".',
	'templatedata-invalid-length' => "Y data yn rhy fawr i'w roi ar gadw ({{formatnum:$1}} {{PLURAL:$1|beit|beit|feit|beit}}, {{formatnum:$2}}) yw'r {{PLURAL:$2|maint mwyaf}}",
);

/** German (Deutsch)
 * @author Flow
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
	'templatedata-doc-param-default-empty' => 'leer',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'veraltet',
	'templatedata-doc-param-status-optional' => 'optional',
	'templatedata-doc-param-status-required' => 'erforderlich',
	'templatedata-doc-param-desc-empty' => 'keine Beschreibung',
	'templatedata-invalid-duplicate-value' => '„$1“ („$3“) ist ein Duplikat von „$2“.',
	'templatedata-invalid-parse' => 'Syntaxfehler in JSON.',
	'templatedata-invalid-type' => 'Für den Typ „$2” wird die Eigenschaft „$1” erwartet.',
	'templatedata-invalid-missing' => 'Die erforderliche Eigenschaft „$1” wurde nicht gefunden.',
	'templatedata-invalid-empty-array' => 'Die Eigenschaft „$1“ muss mindestens einen Wert in ihrem Array haben.',
	'templatedata-invalid-unknown' => 'Unerwartete Eigenschaft „$1”.',
	'templatedata-invalid-value' => 'Ungültiger Wert für die Eigenschaft „$1”.',
	'templatedata-invalid-length' => 'Die Daten sind zu groß zum Speichern ({{PLURAL:$1|Ein Byte|{{formatnum:$1}} Bytes}}, {{PLURAL:$2|die Grenze ist}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Vorlagendokumentation verwalten',
	'templatedata-errormsg-jsonbadformat' => 'Ungültiges JSON-Format. Korrigiere es oder lösche die aktuellen <templatedata>-Tags und versuche es erneut.',
	'templatedata-modal-button-addparam' => 'Parameter hinzufügen',
	'templatedata-modal-button-apply' => 'Anwenden',
	'templatedata-modal-button-cancel' => 'Abbrechen',
	'templatedata-modal-button-delparam' => 'Parameter löschen',
	'templatedata-modal-button-importParams' => 'Parameter importieren',
	'templatedata-modal-errormsg' => 'Es wurden Fehler gefunden. Stelle bitte sicher, dass keine Parameternamen leer oder doppelt sind und der Parametername kein „$1“, „$2“ oder „$3“ enthält.',
	'templatedata-modal-errormsg-import-noparams' => 'Beim Importieren wurden keine neuen Parameter gefunden.',
	'templatedata-modal-notice-import-numparams' => 'Es {{PLURAL:$1|wurde ein neuer|wurden $1 neue}} Parameter importiert.',
	'templatedata-modal-table-param-actions' => 'Aktionen',
	'templatedata-modal-table-param-aliases' => 'Aliasse (durch Kommas getrennt)',
	'templatedata-modal-table-param-default' => 'Standard',
	'templatedata-modal-table-param-desc' => 'Beschreibung',
	'templatedata-modal-table-param-label' => 'Bezeichnung',
	'templatedata-modal-table-param-name' => 'Name',
	'templatedata-modal-table-param-required' => 'Erforderlich',
	'templatedata-modal-table-param-type' => 'Typ',
	'templatedata-modal-table-param-type-number' => 'Nummer',
	'templatedata-modal-table-param-type-page' => 'Seite',
	'templatedata-modal-table-param-type-string' => 'Zeichenfolge',
	'templatedata-modal-table-param-type-undefined' => 'Nicht definiert',
	'templatedata-modal-table-param-type-user' => 'Benutzer',
	'templatedata-modal-title' => 'Vorlagendokumentations-Editor',
	'templatedata-modal-title-templatedesc' => 'Vorlagenbeschreibung',
	'templatedata-modal-title-templateparams' => 'Vorlagenparameter',
);

/** Zazaki (Zazaki)
 * @author Marmase
 * @author Mirzali
 */
$messages['diq'] = array(
	'templatedata-doc-desc-empty' => 'Akerdenayış çıniyo',
	'templatedata-doc-params' => 'parametrey şablonan',
	'templatedata-doc-param-name' => 'Parametre',
	'templatedata-doc-param-desc' => 'Sılasnayış',
	'templatedata-doc-param-type' => 'Babet',
	'templatedata-doc-param-default' => 'Hesabiyaye',
	'templatedata-doc-param-default-empty' => 'veng',
	'templatedata-doc-param-status' => 'Weziyet',
	'templatedata-doc-param-status-optional' => 'opsiyonel',
	'templatedata-doc-param-status-required' => 'lazım',
	'templatedata-doc-param-desc-empty' => 'Akerdenayış çıniyo',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'templatedata-desc' => 'Datowe składowanje za pśedłogowe parametry implementěrowaś (z pomocu JSON)',
	'templatedata-doc-params' => 'Pśedłogowe parametry',
	'templatedata-doc-param-name' => 'Parameter',
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
 * @author Csbotero
 * @author Fitoschido
 * @author Ovruni
 * @author Sethladan
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
	'templatedata-modal-button-addparam' => 'Añadir parámetro',
	'templatedata-modal-button-apply' => 'Aplicar',
	'templatedata-modal-button-cancel' => 'Cancelar',
	'templatedata-modal-button-delparam' => 'Eliminar parámetro',
	'templatedata-modal-button-importParams' => 'Importar parámetros',
	'templatedata-modal-errormsg' => 'Se encontraron errores. Asegúrate de que no hay nombres de parámetros vacíos o duplicados, y de que estos no incluyen «$1», «$2» ni «$3».', # Fuzzy
	'templatedata-modal-errormsg-import-noparams' => 'No se hallaron parámetros nuevos durante la importación.',
	'templatedata-modal-table-param-actions' => 'Acciones',
	'templatedata-modal-table-param-default' => 'Predeterminado',
	'templatedata-modal-table-param-desc' => 'Descripción',
	'templatedata-modal-table-param-label' => 'Etiquetar',
	'templatedata-modal-table-param-name' => 'Nombre',
	'templatedata-modal-table-param-required' => 'Obligatorio',
	'templatedata-modal-table-param-type' => 'Tipo',
	'templatedata-modal-table-param-type-number' => 'Número',
	'templatedata-modal-table-param-type-page' => 'Página',
	'templatedata-modal-table-param-type-string' => 'Cadena',
	'templatedata-modal-table-param-type-undefined' => 'No definido',
	'templatedata-modal-table-param-type-user' => 'Usuario',
	'templatedata-modal-title' => 'Editor de documentación de plantilla',
	'templatedata-modal-title-templatedesc' => 'Descripción de la plantilla',
	'templatedata-modal-title-templateparams' => 'Parámetros de la plantilla',
);

/** Estonian (eesti)
 * @author Luckas
 * @author Pikne
 */
$messages['et'] = array(
	'templatedata-doc-desc-empty' => 'Kirjeldus puudub.',
	'templatedata-doc-params' => 'Malli parameetrid',
	'templatedata-doc-param-name' => 'Parameeter',
	'templatedata-doc-param-desc' => 'Kirjeldus',
	'templatedata-doc-param-type' => 'Tüüp',
	'templatedata-doc-param-default' => 'Vaikimisi',
	'templatedata-doc-param-default-empty' => 'tühi',
	'templatedata-doc-param-status' => 'Olek',
	'templatedata-doc-param-status-deprecated' => 'iganenud',
	'templatedata-doc-param-status-optional' => 'valikuline',
	'templatedata-doc-param-status-required' => 'nõutav',
	'templatedata-doc-param-desc-empty' => 'kirjeldus puudub',
);

/** Persian (فارسی)
 * @author Armin1392
 * @author Ebraminio
 * @author Fatemi127
 * @author Reza1615
 */
$messages['fa'] = array(
	'templatedata-desc' => 'پیاده‌سازی انبارهٔ داده‌ها برای پارامترهای الگو (با استفاده از جی‌سون)',
	'templatedata-doc-desc-empty' => 'بدون توصیف.',
	'templatedata-doc-params' => 'پارامترهای الگو',
	'templatedata-doc-param-name' => 'پارامتر',
	'templatedata-doc-param-desc' => 'توضیحات',
	'templatedata-doc-param-type' => 'نوع',
	'templatedata-doc-param-default' => 'پیش‌فرض',
	'templatedata-doc-param-default-empty' => 'خالی',
	'templatedata-doc-param-status' => 'وضعیت',
	'templatedata-doc-param-status-deprecated' => 'اعتراض',
	'templatedata-doc-param-status-optional' => 'اختیاری',
	'templatedata-doc-param-status-required' => 'ضروری',
	'templatedata-doc-param-desc-empty' => 'بدون توصیف',
	'templatedata-invalid-duplicate-value' => 'خاصیت "$1" ("$3") تکرار "$2" است.',
	'templatedata-invalid-parse' => 'خطای نحوی در جی‌سون.',
	'templatedata-invalid-type' => 'انتظار می‌رود ویژگی "$1" نوع "$2" بشود.',
	'templatedata-invalid-missing' => 'ویژگی مورد نیاز "$1" پیدا نشد.',
	'templatedata-invalid-empty-array' => 'ویژگی "$1" باید حداقل یک مقدار در این آرایه داشته باشد.',
	'templatedata-invalid-unknown' => 'ویژگی "$1" غیرمنتظره.',
	'templatedata-invalid-value' => 'مقدار برای ویژگی "$1" نامعتبر.',
	'templatedata-invalid-length' => 'داده‌های بسیار بزرگ برای ذخیره ({{formatnum:$1}} {{PLURAL:$1|بایت|بایت}}, {{PLURAL:$2|محدود است}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'مدیریت مستندات الگو',
	'templatedata-errormsg-jsonbadformat' => 'فرمت بد جی‌سون. یا آن را درست کنید، یا برچسب‌های فعلی <templatedata> را حذف کنید و دوباره امتحان کنید.',
	'templatedata-modal-button-addparam' => 'افزودن پارامتر',
	'templatedata-modal-button-apply' => 'اعمال',
	'templatedata-modal-button-cancel' => 'انصراف',
	'templatedata-modal-button-delparam' => 'زدودن پارامتر',
	'templatedata-modal-button-importParams' => 'واردکردن پارامترها',
	'templatedata-modal-errormsg' => 'خطاهایی پیدا شدند. لطفاً مطمئن شوید که هیچ نام پارامتری خالی یا تکراری نیست، و اینکه نام پارامتر شامل "$1", "$2" یا "$3" نیست.',
	'templatedata-modal-errormsg-import-noparams' => 'هیچ پارامتر جدیدی حین وارد کردن پیدا نشد.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|پارامتر|پارامتر}} جدید وارد شده.',
	'templatedata-modal-table-param-actions' => 'اقدامات',
	'templatedata-modal-table-param-aliases' => 'نام‌های عاریتی (با کاما جدا شده)',
	'templatedata-modal-table-param-default' => 'پیش‌فرض',
	'templatedata-modal-table-param-desc' => 'توضیحات',
	'templatedata-modal-table-param-label' => 'برچسب',
	'templatedata-modal-table-param-name' => 'نام',
	'templatedata-modal-table-param-required' => 'موردنیاز',
	'templatedata-modal-table-param-type' => 'نوع',
	'templatedata-modal-table-param-type-number' => 'شماره',
	'templatedata-modal-table-param-type-page' => 'صفحه',
	'templatedata-modal-table-param-type-string' => 'رشته',
	'templatedata-modal-table-param-type-undefined' => 'تعریف‌نشده',
	'templatedata-modal-table-param-type-user' => 'کاربر',
	'templatedata-modal-title' => 'ویرایشگر مستندات الگو',
	'templatedata-modal-title-templatedesc' => 'توضیحات قالب',
	'templatedata-modal-title-templateparams' => 'پارامترهای الگو',
);

/** Finnish (suomi)
 * @author Nike
 * @author Silvonen
 * @author Stryn
 */
$messages['fi'] = array(
	'templatedata-doc-desc-empty' => 'Ei kuvausta.',
	'templatedata-doc-params' => 'Mallineen parametrit',
	'templatedata-doc-param-name' => 'Parametri',
	'templatedata-doc-param-desc' => 'Kuvaus',
	'templatedata-doc-param-type' => 'Tyyppi',
	'templatedata-doc-param-default' => 'Oletus',
	'templatedata-doc-param-default-empty' => 'tyhjä',
	'templatedata-doc-param-status' => 'Tila',
	'templatedata-doc-param-status-deprecated' => 'vanhentunut',
	'templatedata-doc-param-status-optional' => 'valinnainen',
	'templatedata-doc-param-status-required' => 'pakollinen',
	'templatedata-doc-param-desc-empty' => 'ei kuvausta',
	'templatedata-invalid-parse' => 'Syntaksivirhe JSON:ssa',
);

/** French (français)
 * @author Boniface
 * @author Gomoko
 * @author Guillom
 * @author Metroitendo
 * @author Peter17
 * @author Verdy p
 */
$messages['fr'] = array(
	'templatedata-desc' => 'Met en place un stockage de données pour les paramètres des modèles (en utilisant JSON)',
	'templatedata-doc-desc-empty' => 'Aucune description.',
	'templatedata-doc-params' => 'Paramètres du modèle',
	'templatedata-doc-param-name' => 'Paramètre',
	'templatedata-doc-param-desc' => 'Description',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Par défaut',
	'templatedata-doc-param-default-empty' => 'vide',
	'templatedata-doc-param-status' => 'Statut',
	'templatedata-doc-param-status-deprecated' => 'obsolète',
	'templatedata-doc-param-status-optional' => 'facultatif',
	'templatedata-doc-param-status-required' => 'obligatoire',
	'templatedata-doc-param-desc-empty' => 'aucune description',
	'templatedata-invalid-duplicate-value' => 'La propriété « $1 » (« $3 ») est un doublon de « $2 ».',
	'templatedata-invalid-parse' => 'Erreur de syntaxe dans JSON.',
	'templatedata-invalid-type' => 'La propriété « $1 » doit être de type « $2 ».',
	'templatedata-invalid-missing' => 'Propriété « $1 » obligatoire non trouvée.',
	'templatedata-invalid-empty-array' => 'La propriété « $1 » doit avoir au moins une valeur dans son tableau.',
	'templatedata-invalid-unknown' => 'Propriété « $1 » non attendue.',
	'templatedata-invalid-value' => 'Valeur non valide pour la propriété « $1 ».',
	'templatedata-invalid-length' => 'Données trop grosses pour être enregistrées ({{formatnum:$1}} {{PLURAL:$1|octet|octets}}, {{PLURAL:$2|la limite est}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Gérer la documentation du modèle',
	'templatedata-errormsg-jsonbadformat' => 'Mauvais format JSON. Corrigez-le, ou supprimez les balises actuelles <templatedata> et réessayez.',
	'templatedata-modal-button-addparam' => 'Ajouter un paramètre',
	'templatedata-modal-button-apply' => 'Appliquer',
	'templatedata-modal-button-cancel' => 'Annuler',
	'templatedata-modal-button-delparam' => 'Supprimer le paramètre',
	'templatedata-modal-button-importParams' => 'Importer les paramètres',
	'templatedata-modal-errormsg' => 'Des erreurs ont été trouvées. Assurez-vous qu’il n’y a pas de noms de paramètre vides ou dupliqués, et que les noms de paramètres ne comprennent aucun « $1 », « $2 » ou « $3 ».',
	'templatedata-modal-errormsg-import-noparams' => 'Aucun nouveau paramètre trouvé lors de l’import.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|nouveau paramètre a été importé|nouveaux paramètres ont été importés}}.',
	'templatedata-modal-table-param-actions' => 'Actions',
	'templatedata-modal-table-param-aliases' => 'Alias (séparés par des virgules)',
	'templatedata-modal-table-param-default' => 'Par défaut',
	'templatedata-modal-table-param-desc' => 'Description',
	'templatedata-modal-table-param-label' => 'Libellé',
	'templatedata-modal-table-param-name' => 'Nom',
	'templatedata-modal-table-param-required' => 'Obligatoire',
	'templatedata-modal-table-param-type' => 'Type',
	'templatedata-modal-table-param-type-number' => 'Nombre',
	'templatedata-modal-table-param-type-page' => 'Page',
	'templatedata-modal-table-param-type-string' => 'Chaîne',
	'templatedata-modal-table-param-type-undefined' => 'Indéfini',
	'templatedata-modal-table-param-type-user' => 'Utilisateur',
	'templatedata-modal-title' => 'Éditeur de la documentation du modèle',
	'templatedata-modal-title-templatedesc' => 'Description du modèle',
	'templatedata-modal-title-templateparams' => 'Paramètres du modèle',
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
	'templatedata-doc-param-default-empty' => 'baleiro',
	'templatedata-doc-param-status' => 'Estado',
	'templatedata-doc-param-status-deprecated' => 'obsoleto',
	'templatedata-doc-param-status-optional' => 'opcional',
	'templatedata-doc-param-status-required' => 'obrigatorio',
	'templatedata-doc-param-desc-empty' => 'sen descrición',
	'templatedata-invalid-duplicate-value' => 'A propiedade "$1" ("$3") é un duplicado de "$2".',
	'templatedata-invalid-parse' => 'Erro de sintaxe en JSON.',
	'templatedata-invalid-type' => 'A propiedade "$1" agárdase que sexa de tipo "$2".',
	'templatedata-invalid-missing' => 'Non se atopou a propiedade obrigatoria "$1".',
	'templatedata-invalid-empty-array' => 'A propiedade "$1" debe ter, polo menos, un valor.',
	'templatedata-invalid-unknown' => 'Propiedade "$1" inesperada.',
	'templatedata-invalid-value' => 'Valor non válido para a propiedade "$1".',
	'templatedata-invalid-length' => 'Dato longo de máis para podelo gardar ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}; {{PLURAL:$2|o límite é}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Administrar a documentación do modelo',
	'templatedata-errormsg-jsonbadformat' => 'O formato JSON é incorrecto. Corríxao ou borre as etiquetas <templatedata> actuais e inténteo de novo.',
	'templatedata-modal-button-addparam' => 'Engadir o parámetro',
	'templatedata-modal-button-apply' => 'Aplicar',
	'templatedata-modal-button-cancel' => 'Cancelar',
	'templatedata-modal-button-delparam' => 'Borrar o parámetro',
	'templatedata-modal-button-importParams' => 'Importar os parámetros',
	'templatedata-modal-errormsg' => 'Producíronse varios erros. Asegúrese de que non hai nomes de parámetros baleiros ou duplicados e de que o nome do parámetro non inclúe os caracteres "$1", "$2" ou "$3".',
	'templatedata-modal-errormsg-import-noparams' => 'Non se atopou ningún parámetro novo durante a importación.',
	'templatedata-modal-notice-import-numparams' => '{{PLURAL:$1|Importouse $1 parámetro|Importáronse $1 parámetros}}.',
	'templatedata-modal-table-param-actions' => 'Accións',
	'templatedata-modal-table-param-aliases' => 'Pseudónimos (separados por comas)',
	'templatedata-modal-table-param-default' => 'Predeterminado',
	'templatedata-modal-table-param-desc' => 'Descrición',
	'templatedata-modal-table-param-label' => 'Etiqueta',
	'templatedata-modal-table-param-name' => 'Nome',
	'templatedata-modal-table-param-required' => 'Obrigatorio',
	'templatedata-modal-table-param-type' => 'Tipo',
	'templatedata-modal-table-param-type-number' => 'Número',
	'templatedata-modal-table-param-type-page' => 'Páxina',
	'templatedata-modal-table-param-type-string' => 'Cadea de caracteres',
	'templatedata-modal-table-param-type-undefined' => 'Sen definir',
	'templatedata-modal-table-param-type-user' => 'Usuario',
	'templatedata-modal-title' => 'Editor da documentación do modelo',
	'templatedata-modal-title-templatedesc' => 'Descrición do modelo',
	'templatedata-modal-title-templateparams' => 'Parámetros do modelo',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author Guycn2
 * @author תומר ט
 */
$messages['he'] = array(
	'templatedata-desc' => 'מימוש אחסון נתונים לפרמטרים של תבניות (באמצעות JSON)',
	'templatedata-doc-desc-empty' => 'אין תיאור.',
	'templatedata-doc-params' => 'פרמטרים של תבניות',
	'templatedata-doc-param-name' => 'פרמטר',
	'templatedata-doc-param-desc' => 'תיאור',
	'templatedata-doc-param-type' => 'סוג',
	'templatedata-doc-param-default' => 'ברירת מחדל',
	'templatedata-doc-param-default-empty' => 'ריק',
	'templatedata-doc-param-status' => 'מצב',
	'templatedata-doc-param-status-deprecated' => 'מיושן',
	'templatedata-doc-param-status-optional' => 'לא דרוש',
	'templatedata-doc-param-status-required' => 'דרוש',
	'templatedata-doc-param-desc-empty' => 'אין תיאור',
	'templatedata-invalid-duplicate-value' => 'המאפיין "$1" (ערך: "$3") זהה למאפיין "$2".',
	'templatedata-invalid-parse' => 'שגיאת תחביר ב־JSON.',
	'templatedata-invalid-type' => 'המאפיין "$1" אמור להיות מסוג "$2".',
	'templatedata-invalid-missing' => 'המאפיין הדרוש "$1" לא נמצא.',
	'templatedata-invalid-empty-array' => 'למאפיין "$1" צריך להיות לפחות ערך אחד במערך שלו.',
	'templatedata-invalid-unknown' => 'מאפיין בלתי־צפוי "$1".',
	'templatedata-invalid-value' => 'ערך בלתי־תקין למאפיין "$1".',
	'templatedata-invalid-length' => 'הנתונים גדולים מכדי לשמור ({{PLURAL:$1|בית אחד|{{formatnum:$1}} בתים}}, {{PLURAL:$2|המגבלה היא}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'יצירת נתוני תבנית',
	'templatedata-errormsg-jsonbadformat' => 'JSON בלתי־תקין. נא לתקן אותו או למחוק את הטקסט בין תגי <templatedata> ולנסות שוב.',
	'templatedata-modal-button-addparam' => 'הוספת פרמטר',
	'templatedata-modal-button-apply' => 'החלה',
	'templatedata-modal-button-cancel' => 'ביטול',
	'templatedata-modal-button-delparam' => 'מחיקת פרמטר',
	'templatedata-modal-button-importParams' => 'ייבוא פרמטרים',
	'templatedata-modal-errormsg' => 'נמצאו שגיאות. נא לוודא ששמות הפרמטרים אינם ריקים ואינם חוזרים על עצמם, ושבשמות הפרמטרים לא מופיעים התווים "$1", "$2" או "$3".',
	'templatedata-modal-errormsg-import-noparams' => 'לא נמצאו פרמטרים חדשים בעת הייבוא',
	'templatedata-modal-notice-import-numparams' => '{{PLURAL:$1|יובא פרמטר חדש אחד|יובאו $1 פרמטרים חדשים}}',
	'templatedata-modal-table-param-actions' => 'פעולות',
	'templatedata-modal-table-param-aliases' => 'כינויים (מופרדים בפסיק)',
	'templatedata-modal-table-param-default' => 'ערך התחלתי',
	'templatedata-modal-table-param-desc' => 'תיאור',
	'templatedata-modal-table-param-label' => 'תווית',
	'templatedata-modal-table-param-name' => 'שם',
	'templatedata-modal-table-param-required' => 'נדרש',
	'templatedata-modal-table-param-type' => 'סוג',
	'templatedata-modal-table-param-type-number' => 'מספר',
	'templatedata-modal-table-param-type-page' => 'דף',
	'templatedata-modal-table-param-type-string' => 'מחרוזת',
	'templatedata-modal-table-param-type-undefined' => 'בלתי־מוגדר',
	'templatedata-modal-table-param-type-user' => 'משתמש',
	'templatedata-modal-title' => 'מחולל נתוני תבנית',
	'templatedata-modal-title-templatedesc' => 'תיאור התבנית',
	'templatedata-modal-title-templateparams' => 'פרמטרי תבנית',
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

/** Hungarian (magyar)
 * @author Tacsipacsi
 */
$messages['hu'] = array(
	'templatedata-doc-desc-empty' => 'Nincs leírás.',
	'templatedata-doc-params' => 'Sablonparaméterek',
	'templatedata-doc-param-name' => 'Paraméter',
	'templatedata-doc-param-desc' => 'Leírás',
	'templatedata-doc-param-type' => 'Típus',
	'templatedata-doc-param-default' => 'Alapértelmezett',
	'templatedata-doc-param-default-empty' => 'üres',
	'templatedata-doc-param-status' => 'kötelező vagy opcionális?',
	'templatedata-doc-param-status-deprecated' => 'elavult',
	'templatedata-doc-param-status-optional' => 'opcionális',
	'templatedata-doc-param-status-required' => 'kötelező',
	'templatedata-doc-param-desc-empty' => 'nincs leírás',
	'templatedata-invalid-duplicate-value' => 'A(z) "$1" tulajdonság ("$3") a(z) "$2" tulajdonság duplikátuma.',
	'templatedata-invalid-parse' => 'Szintaktikai hiba a JSON-ban.',
	'templatedata-invalid-missing' => 'A(z) "$1" kötelező paraméter nincs megadva.',
	'templatedata-modal-button-addparam' => 'Paraméter hozzáadása',
	'templatedata-modal-button-apply' => 'Alkalmaz',
	'templatedata-modal-button-cancel' => 'Mégse',
	'templatedata-modal-button-delparam' => 'Paraméter eltávolítása',
	'templatedata-modal-button-importParams' => 'Paraméterek importálása',
	'templatedata-modal-errormsg-import-noparams' => 'Nem találtam új paramétereket az importálás során.',
	'templatedata-modal-notice-import-numparams' => '$1 új paramétert találtam.',
	'templatedata-modal-table-param-actions' => 'Műveletek',
	'templatedata-modal-table-param-aliases' => 'Alternatív paraméterek (vesszővel elválasztva)',
	'templatedata-modal-table-param-default' => 'Alapértelmezett',
	'templatedata-modal-table-param-desc' => 'Leírás',
	'templatedata-modal-table-param-label' => 'Címke',
	'templatedata-modal-table-param-name' => 'Név',
	'templatedata-modal-table-param-required' => 'Kötelező',
	'templatedata-modal-table-param-type' => 'Típus',
	'templatedata-modal-table-param-type-number' => 'Szám',
	'templatedata-modal-table-param-type-page' => 'Szócikk',
	'templatedata-modal-table-param-type-string' => 'Szöveg',
	'templatedata-modal-table-param-type-undefined' => 'Meghatározatlan',
	'templatedata-modal-table-param-type-user' => 'Szerkesztő',
	'templatedata-modal-title-templatedesc' => 'Sablon leírása',
	'templatedata-modal-title-templateparams' => 'Sablonparaméterek',
);

/** Armenian (Հայերեն)
 * @author Vadgt
 */
$messages['hy'] = array(
	'templatedata-modal-button-addparam' => 'Ավելացնել պարամետր',
	'templatedata-modal-button-apply' => 'Կիրառել',
	'templatedata-modal-button-cancel' => 'Չեղյալ',
	'templatedata-modal-button-delparam' => 'Հեռացնել պարամետրը',
	'templatedata-modal-table-param-default' => 'Լռությամբ',
	'templatedata-modal-table-param-label' => 'Պիտակ',
	'templatedata-modal-table-param-name' => 'Անունը',
	'templatedata-modal-table-param-type-number' => 'Թիվը',
	'templatedata-modal-table-param-type-page' => 'Էջ',
	'templatedata-modal-table-param-type-string' => 'Տող',
	'templatedata-modal-table-param-type-undefined' => 'Անորոշ',
	'templatedata-modal-table-param-type-user' => 'Մասնակից',
);

/** Iloko (Ilokano)
 * @author Lam-ang
 */
$messages['ilo'] = array(
	'templatedata-desc' => 'Isayangkatna ti pagipenpenan ti datos para kadagiti parametro ti plantilia (agaramat ti JSON)',
	'templatedata-doc-desc-empty' => 'Awan ti deskripsion.',
	'templatedata-doc-params' => 'Dagiti parametro ti plantilia',
	'templatedata-doc-param-name' => 'Parametro',
	'templatedata-doc-param-desc' => 'Deskripsion',
	'templatedata-doc-param-type' => 'Kita',
	'templatedata-doc-param-default' => 'Kasisigud',
	'templatedata-doc-param-default-empty' => 'awan ti nagyanna',
	'templatedata-doc-param-status' => 'Kasasaad',
	'templatedata-doc-param-status-deprecated' => 'naikkaten',
	'templatedata-doc-param-status-optional' => 'pagpilian',
	'templatedata-doc-param-status-required' => 'nasken',
	'templatedata-doc-param-desc-empty' => 'awan ti deskripsion',
	'templatedata-invalid-duplicate-value' => 'Ti tagikua ti "$1" ("$3") ket duplikado ti "$2".',
	'templatedata-invalid-parse' => 'Biddut ti eskritu iti JSON.',
	'templatedata-invalid-type' => 'Ti tagikua ti "$1" ket nanamnama a kita iti "$2".',
	'templatedata-invalid-missing' => 'Ti nasken a tagikua ti "$1" ket saan a nabirukan.',
	'templatedata-invalid-empty-array' => 'Ti tagikua ti "$1" ket nasken nga addaan iti saan a basbassit ngem maysa a pateg iti bukodna nakairamanan.',
	'templatedata-invalid-unknown' => 'Di nanamnama a tagikua ti "$1".',
	'templatedata-invalid-value' => 'Saan nga umiso a pateg para iti tagikua ti "$1".',
	'templatedata-invalid-length' => 'Ti datos ket dakkel unay a maidulin ({{formatnum:$1}} {{PLURAL:$1|byte|dagiti byte}}, {{PLURAL:$2|ti patingga ket}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Agtaripato ti dokumentasion ti plantilia',
	'templatedata-errormsg-jsonbadformat' => 'Madi a pormat ti JSON. Mabalin a pasayaatem, wenno ikkatem dagiti agdama nga etiketa ti <templatedata> ken padasen manen.',
	'templatedata-modal-button-addparam' => 'Agnayon ti parametro',
	'templatedata-modal-button-apply' => 'Ipakat',
	'templatedata-modal-button-cancel' => 'Ukasen',
	'templatedata-modal-button-delparam' => 'Ikkaten ti parametro',
	'templatedata-modal-button-importParams' => 'Agala kadagiti parametro',
	'templatedata-modal-errormsg' => 'Adda dagiti biddut a nabirukan. Pangngaasi a siguraduen nga awan dagiti awan linaon wenno duplikado a nagnagan ti parametro, ken ti nagan ti parametro ket saan a mangiraman ti "$1", "$2" wenno "$3".',
	'templatedata-modal-errormsg-import-noparams' => 'Awan dagiti baro a parametro a nabirukan idi las-ud ti panagala.',
	'templatedata-modal-notice-import-numparams' => '$1 a baro a {{PLURAL:$1|parametro ti|parametro dagiti}} naala idi.',
	'templatedata-modal-table-param-actions' => 'Dagiti aramid',
	'templatedata-modal-table-param-aliases' => 'Dagiti parbo a nagan (insina ti koma)',
	'templatedata-modal-table-param-default' => 'Kasisigud',
	'templatedata-modal-table-param-desc' => 'Deskripsion',
	'templatedata-modal-table-param-label' => 'Etiketa',
	'templatedata-modal-table-param-name' => 'Nagan',
	'templatedata-modal-table-param-required' => 'Nasken',
	'templatedata-modal-table-param-type' => 'Kita',
	'templatedata-modal-table-param-type-number' => 'Numero',
	'templatedata-modal-table-param-type-page' => 'Panid',
	'templatedata-modal-table-param-type-string' => 'Kuerdas',
	'templatedata-modal-table-param-type-undefined' => 'Saan a naipalpalawag',
	'templatedata-modal-table-param-type-user' => 'Agar-aramat',
	'templatedata-modal-title' => 'Editor ti dokumentasion ti plantilia',
	'templatedata-modal-title-templatedesc' => 'Deskripsion ti plantilia',
	'templatedata-modal-title-templateparams' => 'Dagiti parametro ti plantilia',
);

/** Icelandic (íslenska)
 * @author Snævar
 */
$messages['is'] = array(
	'templatedata-doc-desc-empty' => 'Engin lýsing',
	'templatedata-doc-params' => 'Gildi sniðsins',
	'templatedata-doc-param-name' => 'Gildi',
	'templatedata-doc-param-desc' => 'Lýsing',
	'templatedata-doc-param-type' => 'Gerð',
	'templatedata-doc-param-default' => 'Sjálfgefið',
	'templatedata-doc-param-default-empty' => 'tómt',
	'templatedata-doc-param-status' => 'Staða',
	'templatedata-doc-param-status-deprecated' => 'úrelt',
	'templatedata-doc-param-status-optional' => 'valfrjáls',
	'templatedata-doc-param-status-required' => 'nauðsynleg',
	'templatedata-doc-param-desc-empty' => 'engin lýsing',
	'templatedata-invalid-parse' => 'Villa í málskipan JSON.',
	'templatedata-invalid-type' => 'Bjóst við að eiginleikinn „$1” væri af gerðinni „$2”, en fékk eitthvað allt annað.',
	'templatedata-invalid-missing' => 'Nauðsynlegur eiginleiki „$1” fannst ekki.',
	'templatedata-invalid-empty-array' => 'Gildið „$1” verður að hafa í það minnsta eitt eigindargildi í fylkinu sínu.',
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
	'templatedata-doc-param-default-empty' => 'vuoto',
	'templatedata-doc-param-status' => 'Stato',
	'templatedata-doc-param-status-deprecated' => 'deprecato',
	'templatedata-doc-param-status-optional' => 'facoltativo',
	'templatedata-doc-param-status-required' => 'obbligatorio',
	'templatedata-doc-param-desc-empty' => 'nessuna descrizione',
	'templatedata-invalid-duplicate-value' => 'La proprietà "$1" ("$3") è un duplicato di "$2".',
	'templatedata-invalid-parse' => 'Errore di sintassi in JSON.',
	'templatedata-invalid-type' => 'La proprietà "$1" dovrebbe essere di tipo "$2".',
	'templatedata-invalid-missing' => 'Proprietà obbligatoria "$1" non trovata.',
	'templatedata-invalid-empty-array' => 'La proprietà "$1" deve avere almeno un valore nella sua matrice.',
	'templatedata-invalid-unknown' => 'Proprietà "$1" non prevista.',
	'templatedata-invalid-value' => 'Valore non valido per la proprietà "$1".',
	'templatedata-invalid-length' => 'Troppi dati da salvare ({{formatnum:$1}} {{PLURAL:$1|byte}}, {{PLURAL:$2|limite è}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Gestisci documentazione template',
	'templatedata-errormsg-jsonbadformat' => 'Formato JSON errato. Correggi o cancella il tag <templatedata> e riprova.',
	'templatedata-modal-button-addparam' => 'Aggiungi parametro',
	'templatedata-modal-button-apply' => 'Applica',
	'templatedata-modal-button-cancel' => 'Annulla',
	'templatedata-modal-button-delparam' => 'Cancella parametro',
	'templatedata-modal-button-importParams' => 'Importa parametri',
	'templatedata-modal-errormsg' => 'Sono stati trovati errori. Assicurati che non ci siano nomi dei parametri vuoti, duplicati, o che contengono "$1", "$2" o "$3".',
	'templatedata-modal-errormsg-import-noparams' => "Nessun nuovo parametro trovato durante l'importazione.",
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|nuovo parametro è stato|nuovi parametri sono stati}} importati.',
	'templatedata-modal-table-param-actions' => 'Azioni',
	'templatedata-modal-table-param-aliases' => 'Alias (separati da virgola)',
	'templatedata-modal-table-param-default' => 'Predefinito',
	'templatedata-modal-table-param-desc' => 'Descrizione',
	'templatedata-modal-table-param-label' => 'Etichetta',
	'templatedata-modal-table-param-name' => 'Nome',
	'templatedata-modal-table-param-required' => 'Obbligatorio',
	'templatedata-modal-table-param-type' => 'Tipo',
	'templatedata-modal-table-param-type-number' => 'Numero',
	'templatedata-modal-table-param-type-page' => 'Pagina',
	'templatedata-modal-table-param-type-string' => 'Stringa',
	'templatedata-modal-table-param-type-undefined' => 'Non definito',
	'templatedata-modal-table-param-type-user' => 'Utente',
	'templatedata-modal-title' => 'Editor della documentazione di template',
	'templatedata-modal-title-templatedesc' => 'Descrizione template',
	'templatedata-modal-title-templateparams' => 'Parametri template',
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Shirayuki
 */
$messages['ja'] = array(
	'templatedata-desc' => 'テンプレート引数のデータストレージを実装する (JSON を使用)',
	'templatedata-doc-desc-empty' => '説明はありません。',
	'templatedata-doc-params' => 'テンプレート引数',
	'templatedata-doc-param-name' => '引数',
	'templatedata-doc-param-desc' => '説明',
	'templatedata-doc-param-type' => '型',
	'templatedata-doc-param-default' => '既定',
	'templatedata-doc-param-default-empty' => '空',
	'templatedata-doc-param-status' => '状態',
	'templatedata-doc-param-status-deprecated' => '非推奨',
	'templatedata-doc-param-status-optional' => '省略可能',
	'templatedata-doc-param-status-required' => '必須',
	'templatedata-doc-param-desc-empty' => '説明なし',
	'templatedata-invalid-duplicate-value' => 'プロパティ「$1」(「$3」) は「$2」と重複しています。',
	'templatedata-invalid-parse' => 'JSON の構文エラーです。',
	'templatedata-invalid-type' => 'プロパティ「$1」には型「$2」の値を指定してください。',
	'templatedata-invalid-missing' => '必須のプロパティ「$1」がありません。',
	'templatedata-invalid-empty-array' => 'プロパティ「$1」は、その配列に少なくとも 1 つの値を入れてください。',
	'templatedata-invalid-unknown' => '予期しないプロパティ「$1」です。',
	'templatedata-invalid-value' => 'プロパティ「$1」の値が無効です。',
	'templatedata-invalid-length' => 'データが大きすぎるため保存できません ({{formatnum:$1}} {{PLURAL:$1|バイト}}、{{PLURAL:$2|上限は}} {{formatnum:$2}} バイト)',
	'templatedata-modal-button-addparam' => '引数を追加',
	'templatedata-modal-button-apply' => '適用',
	'templatedata-modal-button-cancel' => 'キャンセル',
	'templatedata-modal-button-delparam' => '引数を削除',
	'templatedata-modal-table-param-aliases' => '別名 (カンマ区切り)',
);

/** Lojban (Lojban)
 * @author Gleki
 */
$messages['jbo'] = array(
	'templatedata-modal-button-cancel' => 'naljetnygau',
);

/** Kazakh (Cyrillic script) (қазақша (кирил)‎)
 * @author Arystanbek
 */
$messages['kk-cyrl'] = array(
	'templatedata-doc-desc-empty' => 'Сипаттамасы жоқ.',
	'templatedata-doc-params' => 'Үлгі параметрлері',
	'templatedata-doc-param-name' => 'Параметрі',
	'templatedata-doc-param-desc' => 'Сипаттамасы',
	'templatedata-doc-param-type' => 'Түрі',
	'templatedata-doc-param-default' => 'Әдепкі',
	'templatedata-doc-param-default-empty' => 'бос',
	'templatedata-doc-param-status' => 'Статусы',
	'templatedata-doc-param-status-deprecated' => 'Ескірген',
	'templatedata-doc-param-status-optional' => 'міндетті емес',
	'templatedata-doc-param-status-required' => 'Міндетті',
	'templatedata-doc-param-desc-empty' => 'сипаттамасы жоқ',
	'templatedata-editbutton' => 'Үлгі құжаттамасын басқару',
	'templatedata-modal-button-addparam' => 'Параметр қосу',
	'templatedata-modal-button-apply' => 'Қолдану',
	'templatedata-modal-button-cancel' => 'Болдырмау',
	'templatedata-modal-button-delparam' => 'Параметрін жою',
	'templatedata-modal-button-importParams' => 'Парамерлерді импортау',
	'templatedata-modal-notice-import-numparams' => '$1 жаңа параметр импорталды.',
	'templatedata-modal-table-param-actions' => 'Әрекеттер',
	'templatedata-modal-table-param-default' => 'Әдепкі',
	'templatedata-modal-table-param-desc' => 'Сипаттамасы',
	'templatedata-modal-table-param-label' => 'Деңгей',
	'templatedata-modal-table-param-name' => 'Атауы',
	'templatedata-modal-table-param-required' => 'Міндетті',
	'templatedata-modal-table-param-type' => 'Түрі',
	'templatedata-modal-table-param-type-number' => 'Нөмері',
	'templatedata-modal-table-param-type-page' => 'Бет',
	'templatedata-modal-table-param-type-string' => 'Жол',
	'templatedata-modal-table-param-type-undefined' => 'Анықталмаған',
	'templatedata-modal-table-param-type-user' => 'Қатысушы',
	'templatedata-modal-title' => 'Үлгі құжаттамасын өңдеуші',
	'templatedata-modal-title-templatedesc' => 'Үлгі сипаттамасы',
	'templatedata-modal-title-templateparams' => 'Үлгі параметрлері',
);

/** Korean (한국어)
 * @author Kwj2772
 * @author Priviet
 * @author 아라
 */
$messages['ko'] = array(
	'templatedata-desc' => '(JSON을 사용하여) 틀 변수에 대한 데이터 저장소를 구현합니다',
	'templatedata-doc-desc-empty' => '설명이 없습니다.',
	'templatedata-doc-params' => '틀 변수',
	'templatedata-doc-param-name' => '변수',
	'templatedata-doc-param-desc' => '설명',
	'templatedata-doc-param-type' => '형식',
	'templatedata-doc-param-default' => '기본 값',
	'templatedata-doc-param-default-empty' => '비어 있음',
	'templatedata-doc-param-status' => '상태',
	'templatedata-doc-param-status-deprecated' => '사용되지 않음',
	'templatedata-doc-param-status-optional' => '선택',
	'templatedata-doc-param-status-required' => '필수',
	'templatedata-doc-param-desc-empty' => '설명 없음',
	'templatedata-invalid-duplicate-value' => '"$1" ("$3") 속성은 "$2" 속성과 중복됩니다.',
	'templatedata-invalid-parse' => 'JSON에 구문 오류가 있습니다.',
	'templatedata-invalid-type' => '"$1" 속성의 값이 예기치 않은 "$2" 형식입니다.',
	'templatedata-invalid-missing' => '필요한 "$1" 속성을 찾을 수 없습니다.',
	'templatedata-invalid-empty-array' => '속성 "$1"은 배열에서 적어도 하나 이상의 값을 갖고 있어야 합니다.',
	'templatedata-invalid-unknown' => '예기치 않은 "$1" 속성입니다.',
	'templatedata-invalid-value' => '"$1" 속성의 값이 잘못되었습니다.',
	'templatedata-invalid-length' => '저장하기에 데이터가 너무 큽니다 ({{formatnum:$1}} {{PLURAL:$1|바이드}}, {{PLURAL:$2|제한은}} {{formatnum:$2}})',
	'templatedata-editbutton' => '틀 문서 관리',
	'templatedata-errormsg-jsonbadformat' => '잘못된 JSON 형식입니다. 수정하거나 현재의 <templatedata> 태그를 삭제한 후 다시 시도해보세요.',
	'templatedata-modal-button-addparam' => '매개변수 추가',
	'templatedata-modal-button-apply' => '적용',
	'templatedata-modal-button-cancel' => '취소',
	'templatedata-modal-button-delparam' => '매개변수 삭제',
	'templatedata-modal-button-importParams' => '매개변수 가져오기',
	'templatedata-modal-errormsg' => '오류를 찾았습니다. 빠진 곳이 없는지 확인하거나 매개변수 이름을 복사하고 매개변수 이름에  "$1", "$2", "$3" 기호가 포함되지 않도록 하세요.',
	'templatedata-modal-errormsg-import-noparams' => '가져오는 중 새로운 매개변수를 찾지 못 했습니다.',
	'templatedata-modal-notice-import-numparams' => '$1 새로운 {{PLURAL:$1|매개변수}}를 가져왔습니다.',
	'templatedata-modal-table-param-actions' => '명령',
	'templatedata-modal-table-param-aliases' => '별명(쉼표로 구분)',
	'templatedata-modal-table-param-default' => '기본 값',
	'templatedata-modal-table-param-desc' => '설명',
	'templatedata-modal-table-param-label' => '레이블',
	'templatedata-modal-table-param-name' => '이름',
	'templatedata-modal-table-param-required' => '필수',
	'templatedata-modal-table-param-type' => '종류',
	'templatedata-modal-table-param-type-number' => '번호',
	'templatedata-modal-table-param-type-page' => '문서',
	'templatedata-modal-table-param-type-string' => '문자열',
	'templatedata-modal-table-param-type-undefined' => '정의되지 않음',
	'templatedata-modal-table-param-type-user' => '사용자',
	'templatedata-modal-title' => '템플릿 문서 편집기',
	'templatedata-modal-title-templatedesc' => '틀 설명',
	'templatedata-modal-title-templateparams' => '틀 매개변수',
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
	'templatedata-doc-param-default-empty' => 'eidel',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'vereelst',
	'templatedata-doc-param-status-optional' => 'fakultativ',
	'templatedata-doc-param-status-required' => 'obligatoresch',
	'templatedata-doc-param-desc-empty' => 'keng Beschreiwung',
	'templatedata-invalid-parse' => 'Syntaxfeeler am JSON.',
	'templatedata-modal-button-addparam' => 'Parameter derbäisetzen',
	'templatedata-modal-button-apply' => 'Uwenden',
	'templatedata-modal-button-cancel' => 'Ofbriechen',
	'templatedata-modal-button-delparam' => 'Parameter läschen',
	'templatedata-modal-button-importParams' => 'Parameteren importéieren',
	'templatedata-modal-errormsg-import-noparams' => 'Keng nei Parametere beim Import fonnt.',
	'templatedata-modal-notice-import-numparams' => '{{PLURAL:$1|Een neie Parameter gouf|$1 nei Parametere goufen}} importéiert.',
	'templatedata-modal-table-param-actions' => 'Aktiounen',
	'templatedata-modal-table-param-default' => 'Standard',
	'templatedata-modal-table-param-desc' => 'Beschreiwung',
	'templatedata-modal-table-param-label' => 'Etikett',
	'templatedata-modal-table-param-name' => 'Numm',
	'templatedata-modal-table-param-required' => 'Obligatoresch',
	'templatedata-modal-table-param-type' => 'Typ',
	'templatedata-modal-table-param-type-number' => 'Zuel',
	'templatedata-modal-table-param-type-page' => 'Säit',
	'templatedata-modal-table-param-type-undefined' => 'Ondefinéiert',
	'templatedata-modal-table-param-type-user' => 'Benotzer',
	'templatedata-modal-title-templatedesc' => 'Beschreiwung vun der Schabloun',
	'templatedata-modal-title-templateparams' => 'Parameter vun der Schabloun',
);

/** Latvian (latviešu)
 * @author Papuass
 */
$messages['lv'] = array(
	'templatedata-doc-param-default-empty' => 'tukšs',
	'templatedata-doc-param-status-deprecated' => 'novecojis',
	'templatedata-modal-button-addparam' => 'Pievienot parametru',
	'templatedata-modal-button-cancel' => 'Atcelt',
	'templatedata-modal-button-delparam' => 'Dzēst parametru',
	'templatedata-modal-button-importParams' => 'Importēt parametrus',
	'templatedata-modal-table-param-actions' => 'Darbības',
	'templatedata-modal-table-param-desc' => 'Apraksts',
	'templatedata-modal-table-param-type-page' => 'Lapa',
	'templatedata-modal-table-param-type-undefined' => 'Nav definēts',
	'templatedata-modal-table-param-type-user' => 'Lietotājs',
	'templatedata-modal-title-templatedesc' => 'Veidnes apraksts',
	'templatedata-modal-title-templateparams' => 'Veidnes parametri',
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
	'templatedata-doc-param-default-empty' => 'празно',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-doc-param-status-deprecated' => 'застарено',
	'templatedata-doc-param-status-optional' => 'незадолжително',
	'templatedata-doc-param-status-required' => 'задолжително',
	'templatedata-doc-param-desc-empty' => 'нема опис',
	'templatedata-invalid-duplicate-value' => 'Својството „$1“ („$3“) е дупликат на „$2“.',
	'templatedata-invalid-parse' => 'Синтаксна грешка во JSON.',
	'templatedata-invalid-type' => 'Се очекува својството „$1“ да биде од типот „$2“.',
	'templatedata-invalid-missing' => 'Бараното својство „$1“ не е пронајдено.',
	'templatedata-invalid-empty-array' => 'Својството „$1“ мора да има барем една вреднсот во стројот.',
	'templatedata-invalid-unknown' => 'Неочекувано својство „$1“.',
	'templatedata-invalid-value' => 'Неисправна вредност за својството „$1“.',
	'templatedata-invalid-length' => 'Податоците се преголеми за да се зачуваат ({{formatnum:$1}} {{PLURAL:$1|бајт|бајти}}, а {{PLURAL:$2|границата е}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Раководење со шаблонска документација',
	'templatedata-errormsg-jsonbadformat' => 'Неисправен JSON-формат. Исправете го или избришете ги тековните ознаки <templatedata> и обидете се повторно.',
	'templatedata-modal-button-addparam' => 'Додај параметар',
	'templatedata-modal-button-apply' => 'Примени',
	'templatedata-modal-button-cancel' => 'Откажи',
	'templatedata-modal-button-delparam' => 'Избриши параметар',
	'templatedata-modal-button-importParams' => 'Увези параметри',
	'templatedata-modal-errormsg' => 'Пронајдов грешки. Проверете да не имате празни или дуплирани називи на параметрите. Во нив не треба да се содржат знаците „$1“, „$2“ и „$3“.',
	'templatedata-modal-errormsg-import-noparams' => 'Не пронајдов нови параметри во увозот.',
	'templatedata-modal-notice-import-numparams' => 'Увезов {{PLURAL:$1|еден параметар|$1 параметри}}.',
	'templatedata-modal-table-param-actions' => 'Дејства',
	'templatedata-modal-table-param-aliases' => 'Алијаси (одделени со запирки)',
	'templatedata-modal-table-param-default' => 'По основно',
	'templatedata-modal-table-param-desc' => 'Опис',
	'templatedata-modal-table-param-label' => 'Натпис',
	'templatedata-modal-table-param-name' => 'Назив',
	'templatedata-modal-table-param-required' => 'Задолжително',
	'templatedata-modal-table-param-type' => 'Тип',
	'templatedata-modal-table-param-type-number' => 'Број',
	'templatedata-modal-table-param-type-page' => 'Страница',
	'templatedata-modal-table-param-type-string' => 'Низа',
	'templatedata-modal-table-param-type-undefined' => 'Неодреден',
	'templatedata-modal-table-param-type-user' => 'Корисник',
	'templatedata-modal-title' => 'Уредник на шаблонска документација',
	'templatedata-modal-title-templatedesc' => 'Опис на шаблонот',
	'templatedata-modal-title-templateparams' => 'Шаблонски параметри',
);

/** Malayalam (മലയാളം)
 * @author Praveenp
 * @author Santhosh.thottingal
 */
$messages['ml'] = array(
	'templatedata-desc' => 'ഫലകങ്ങളുടെ ചരങ്ങളിൽ ഡേറ്റ ശേഖരിച്ച് വെയ്ക്കൽ നടപ്പിലാക്കുക (ജെസൺ ഉപയോഗിച്ച്)',
	'templatedata-doc-desc-empty' => 'വിവരണമൊന്നുമില്ല.',
	'templatedata-doc-params' => 'ഫലകത്തിനുള്ള ചരങ്ങൾ',
	'templatedata-doc-param-name' => 'ചരം',
	'templatedata-doc-param-desc' => 'വിവരണം',
	'templatedata-doc-param-type' => 'തരം',
	'templatedata-doc-param-default' => 'സ്വതേ',
	'templatedata-doc-param-default-empty' => 'ശൂന്യം',
	'templatedata-doc-param-status' => 'സ്ഥിതി',
	'templatedata-doc-param-status-deprecated' => 'ഒഴിവാക്കി',
	'templatedata-doc-param-status-optional' => 'ഐച്ഛികം',
	'templatedata-doc-param-status-required' => 'ആവശ്യമാണ്',
	'templatedata-doc-param-desc-empty' => 'വിവരണമൊന്നുമില്ല',
	'templatedata-invalid-parse' => 'ജെസണിൽ എഴുത്ത് രീതിയിൽ പിഴവുണ്ടായി.',
	'templatedata-invalid-length' => 'ഡേറ്റ സേവ് ചെയ്യാൻ കഴിയുന്നതിലും വലുതാണ് ({{formatnum:$1}} {{PLURAL:$1|ബൈറ്റ്|ബൈറ്റുകൾ}}, {{PLURAL:$2|പരിധി}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'ഫലകത്തിന്റെ വിവരണം കൈകാര്യം ചെയ്യുക',
	'templatedata-modal-button-addparam' => 'ചരം ചേർക്കുക',
	'templatedata-modal-button-apply' => 'ബാധകമാക്കുക',
	'templatedata-modal-button-cancel' => 'റദ്ദാക്കുക',
	'templatedata-modal-button-delparam' => 'ചരം മായ്ക്കുക',
	'templatedata-modal-button-importParams' => 'ചരങ്ങൾ ഇറക്കുമതി ചെയ്യുക',
	'templatedata-modal-table-param-default' => 'സ്വതേ',
	'templatedata-modal-table-param-desc' => 'വിവരണം',
	'templatedata-modal-table-param-label' => 'തലക്കുറി',
	'templatedata-modal-table-param-name' => 'പേര്',
	'templatedata-modal-table-param-required' => 'ആവശ്യമാണ്',
	'templatedata-modal-table-param-type' => 'തരം',
	'templatedata-modal-table-param-type-number' => 'എണ്ണം',
	'templatedata-modal-table-param-type-page' => 'താൾ',
	'templatedata-modal-table-param-type-string' => 'പദം',
	'templatedata-modal-table-param-type-undefined' => 'നിർവ്വചിക്കപ്പെട്ടിട്ടില്ല',
	'templatedata-modal-table-param-type-user' => 'ഉപയോക്താവ്',
	'templatedata-modal-title' => 'ഫലകവിവരണ തിരുത്തൽ സൗകര്യം',
	'templatedata-modal-title-templatedesc' => 'ഫലകത്തിന്റെ വിവരണം',
	'templatedata-modal-title-templateparams' => 'ഫലകത്തിനുള്ള ചരങ്ങൾ',
);

/** Marathi (मराठी)
 * @author V.narsikar
 */
$messages['mr'] = array(
	'templatedata-invalid-length' => 'माहिती जतन करण्यास बरीच मोठी आहे({{formatnum:$1}} {{PLURAL:$1|बाईट|बाईट्स}}, {{PLURAL:$2|मर्यादा}} {{formatnum:$2}} आहे)',
	'templatedata-editbutton' => 'साचा दस्तऐवजीकरणाचे व्यवस्थापन',
	'templatedata-errormsg-jsonbadformat' => 'वाईट JSON प्रारुप.एकतर ते सुधरवा किंवा सध्याची <templatedata> खूणपताका वगळून पुन्हा प्रयत्न करा.',
	'templatedata-modal-button-addparam' => 'प्राचल (पॅरामीटर) जोडा',
	'templatedata-modal-button-apply' => 'लागू करा',
	'templatedata-modal-button-cancel' => 'रद्द करा',
	'templatedata-modal-button-delparam' => 'प्राचल (पॅरामीटर) काढून टाका',
	'templatedata-modal-button-importParams' => 'प्राचले (पॅरामिटर्स) आयात करा',
	'templatedata-modal-errormsg' => 'त्रूटी आढळली. याची कृपया खात्री करा कि यात रिकामे अथवा द्विरुक्त प्राचल नावे नाहीत व प्राचल नावात "$1", "$2" किंवा "$3" याचा अंतर्भाव नाही.',
	'templatedata-modal-errormsg-import-noparams' => 'आयाती दरम्यान काही नविन प्राचले(पॅरामिटर्स) सापडली नाहीत.',
	'templatedata-modal-notice-import-numparams' => '$1 नविन {{PLURAL:$1|प्राचल आयात केल्या गेले |आयात केल्या गेलीत}}.',
	'templatedata-modal-table-param-actions' => 'क्रिया',
	'templatedata-modal-table-param-aliases' => 'समधर्मी (स्वल्पविरामने वेगळे केलेले)',
	'templatedata-modal-table-param-default' => 'मूळ (अविचल)',
	'templatedata-modal-table-param-desc' => 'वर्णन',
	'templatedata-modal-table-param-label' => 'लेबल',
	'templatedata-modal-table-param-name' => 'नाव',
	'templatedata-modal-table-param-required' => 'आवश्यक',
	'templatedata-modal-table-param-type' => 'प्रकार',
	'templatedata-modal-table-param-type-number' => 'आकडा',
	'templatedata-modal-table-param-type-page' => 'पान',
	'templatedata-modal-table-param-type-string' => 'तंतू',
	'templatedata-modal-table-param-type-undefined' => 'अव्यक्त',
	'templatedata-modal-table-param-type-user' => 'सदस्य',
	'templatedata-modal-title' => 'साचा दस्ताऐवजीकरण संपादक',
	'templatedata-modal-title-templatedesc' => 'साचा वर्णन',
	'templatedata-modal-title-templateparams' => 'साचा प्राचल (पॅरामिटर्स)',
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
	'templatedata-modal-errormsg' => 'Ralat-ralat dijumpai. Sila pastikan tidak terdapat nama-nama parameter yang kosong atau berulang, malah nama parameter itu tidak mengandungi "$1", "$2" atau "$3".',
);

/** Norwegian Bokmål (norsk bokmål)
 * @author Danmichaelo
 */
$messages['nb'] = array(
	'templatedata-desc' => 'Implementerer datalager for malparametre (med JSON)',
	'templatedata-doc-desc-empty' => 'Ingen beskrivelse.',
	'templatedata-doc-params' => 'Malparametre',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beskrivelse',
	'templatedata-doc-param-type' => 'Type',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-default-empty' => 'tom',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'foreldet',
	'templatedata-doc-param-status-optional' => 'valgfri',
	'templatedata-doc-param-status-required' => 'påkrevd',
	'templatedata-doc-param-desc-empty' => 'ingen beskrivelse',
	'templatedata-invalid-duplicate-value' => 'Egenskapen «$1» («$3») er en duplikat av «$2».',
	'templatedata-invalid-parse' => 'Syntaksfeil i JSON.',
	'templatedata-invalid-type' => 'Egenskapen «$1» forventes å være av typen «$2».',
	'templatedata-invalid-missing' => 'Egenskapen «$1» er påkrevd, men ble ikke funnet.',
	'templatedata-invalid-empty-array' => 'Egenskapen «$1» må ha minst en verdi i listen sin.',
	'templatedata-invalid-unknown' => 'Uventet egenskap «$1».',
	'templatedata-invalid-value' => 'Ugyldig verdi for egenskapen «$1».',
	'templatedata-invalid-length' => 'JSON-data for stor til å kunne lagres ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|grensen er}} {{formatnum:$2}})',
);

/** Low German (Plattdüütsch)
 * @author Joachim Mos
 */
$messages['nds'] = array(
	'templatedata-doc-param-desc' => 'Beschrieven',
);

/** Dutch (Nederlands)
 * @author Basvb
 * @author Konovalov
 * @author SPQRobin
 * @author Siebrand
 * @author Sjoerddebruin
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
	'templatedata-doc-param-default-empty' => 'leeg',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'verouderd',
	'templatedata-doc-param-status-optional' => 'optioneel',
	'templatedata-doc-param-status-required' => 'vereist',
	'templatedata-doc-param-desc-empty' => 'geen beschrijving',
	'templatedata-invalid-duplicate-value' => 'Eigenschap "$1" ("$3") is een duplicaat van "$2".',
	'templatedata-invalid-parse' => 'Syntaxisfout in JSON.',
	'templatedata-invalid-type' => 'De verwachting is dat eigenschap "$1" van het type "$2" is.',
	'templatedata-invalid-missing' => 'Vereiste eigenschap "$1" niet gevonden.',
	'templatedata-invalid-empty-array' => 'Eigenschap "$1" moet ten minste één waarde in de verzameling hebben.',
	'templatedata-invalid-unknown' => 'Onverwachte eigenschap "$1".',
	'templatedata-invalid-value' => 'Ongeldige waarde voor de eigenschap "$1".',
	'templatedata-invalid-length' => 'Te veel gegevens om op te slaan ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}} opgegeven, de {{PLURAL:$2|limiet is}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Sjabloondocumentatie beheren',
	'templatedata-modal-button-addparam' => 'Parameter toevoegen',
	'templatedata-modal-button-apply' => 'Toepassen',
	'templatedata-modal-button-cancel' => 'Annuleren',
	'templatedata-modal-button-delparam' => 'Parameter verwijderen',
	'templatedata-modal-button-importParams' => 'Parameters importeren',
	'templatedata-modal-errormsg-import-noparams' => 'Geen nieuwe parameters gevonden tijdens het importeren.',
	'templatedata-modal-notice-import-numparams' => 'Er {{PLURAL:$1|is één nieuwe parameter|zijn $1 nieuwe parameters}} geïmporteerd.',
	'templatedata-modal-table-param-actions' => 'Handelingen',
	'templatedata-modal-table-param-aliases' => 'Aliassen (door komma gescheiden)',
	'templatedata-modal-table-param-default' => 'Standaard',
	'templatedata-modal-table-param-desc' => 'Beschrijving',
	'templatedata-modal-table-param-label' => 'Label',
	'templatedata-modal-table-param-name' => 'Naam',
	'templatedata-modal-table-param-required' => 'Vereist',
	'templatedata-modal-table-param-type' => 'Type',
	'templatedata-modal-table-param-type-number' => 'Getal',
	'templatedata-modal-table-param-type-page' => 'Pagina',
	'templatedata-modal-table-param-type-string' => 'Tekenreeks',
	'templatedata-modal-table-param-type-undefined' => 'Niet opgegeven',
	'templatedata-modal-table-param-type-user' => 'Gebruiker',
	'templatedata-modal-title-templatedesc' => 'Sjabloonbeschrijving',
	'templatedata-modal-title-templateparams' => 'Sjabloonparameters',
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
 * @author Dalis
 * @author Vuh
 * @author Woytecr
 */
$messages['pl'] = array(
	'templatedata-desc' => 'Dodaje możliwość przechowywania parametrów szablonu (poprzez JSON)',
	'templatedata-doc-desc-empty' => 'Brak opisu.',
	'templatedata-doc-params' => 'Parametry szablonu',
	'templatedata-doc-param-name' => 'Parametr',
	'templatedata-doc-param-desc' => 'Opis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Domyślne',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-desc-empty' => 'brak opisu',
	'templatedata-invalid-duplicate-value' => 'Właściwość "$1" ("$3") jest duplikatem "$2".',
	'templatedata-invalid-parse' => 'Błąd składni w JSON.',
	'templatedata-invalid-type' => 'Właściwość "$1" powinna mieć typ "$2".',
	'templatedata-invalid-missing' => 'Wymagana właściwość "$1" nie została znaleziona.',
	'templatedata-invalid-unknown' => 'Nieoczekiwane właściwość "$1".',
	'templatedata-invalid-value' => 'Nieprawidłowa wartość właściwości "$1".',
	'templatedata-modal-button-addparam' => 'Dodaj parametr',
	'templatedata-modal-button-apply' => 'Zastosuj',
	'templatedata-modal-button-cancel' => 'Anuluj',
	'templatedata-modal-button-delparam' => 'Usuń parametr',
	'templatedata-modal-errormsg' => 'Znaleziono błędy. Proszę, upewnij się, że nazwy parametrów nie są puste, nie są zduplikowane i nie zawierają «$1», «$2» lub «$3».',
	'templatedata-modal-table-param-default' => 'Domyślnie',
	'templatedata-modal-table-param-desc' => 'Opis',
	'templatedata-modal-table-param-label' => 'Etykieta',
	'templatedata-modal-table-param-name' => 'Nazwa',
	'templatedata-modal-table-param-required' => 'Wymagane',
	'templatedata-modal-table-param-type-page' => 'Strona',
	'templatedata-modal-title-templateparams' => 'Parametry szablonu',
);

/** Portuguese (português)
 * @author Helder.wiki
 * @author Imperadeiro98
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
	'templatedata-modal-errormsg' => 'Erros encontrados. Por favor, certifique-se de que não há nomes de parâmetros vazios ou duplicados e que estes não incluem o nome do parâmetro "$1", "$2" ou "$3".',
);

/** Brazilian Portuguese (português do Brasil)
 * @author Helder.wiki
 * @author Luckas
 * @author 555
 */
$messages['pt-br'] = array(
	'templatedata-desc' => 'Implementa o armazenamento de dados para os parâmetros das predefinições (em JSON)',
	'templatedata-doc-desc-empty' => 'Sem descrição.',
	'templatedata-doc-params' => 'Parâmetros da predefinição',
	'templatedata-doc-param-name' => 'Parâmetro',
	'templatedata-doc-param-desc' => 'Descrição',
	'templatedata-doc-param-type' => 'Tipo',
	'templatedata-doc-param-default' => 'Padrão',
	'templatedata-doc-param-default-empty' => 'em branco',
	'templatedata-doc-param-status' => 'Condição',
	'templatedata-doc-param-status-deprecated' => 'obsoleto',
	'templatedata-doc-param-status-optional' => 'opcional',
	'templatedata-doc-param-status-required' => 'obrigatório',
	'templatedata-doc-param-desc-empty' => 'sem descrição',
	'templatedata-invalid-parse' => 'Erro de sintaxe em JSON',
	'templatedata-invalid-type' => 'A propriedade "$1" deveria ser do tipo "$2"',
	'templatedata-invalid-missing' => 'A propriedade "$1" é requerida mas não foi encontrada.',
	'templatedata-invalid-unknown' => 'Propriedade inesperada: "$1".',
	'templatedata-invalid-value' => 'Valor inválido para a propriedade "$1".',
	'templatedata-invalid-length' => 'Quantia de dados muito grande para ser salva ({{formatnum:$1}} {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|e o limite é}} {{formatnum:$2}})',
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
 * @author Kaganer
 * @author Okras
 * @author Putnik
 */
$messages['ru'] = array(
	'templatedata-desc' => 'Реализация хранилища данных для параметров шаблона (с помощью JSON)',
	'templatedata-doc-desc-empty' => 'Нет описания.',
	'templatedata-doc-params' => 'Параметры шаблона',
	'templatedata-doc-param-name' => 'Параметр',
	'templatedata-doc-param-desc' => 'Описание',
	'templatedata-doc-param-type' => 'Тип',
	'templatedata-doc-param-default' => 'По умолчанию',
	'templatedata-doc-param-default-empty' => 'пусто',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-doc-param-status-deprecated' => 'устаревший',
	'templatedata-doc-param-status-optional' => 'необязательный',
	'templatedata-doc-param-status-required' => 'обязательный',
	'templatedata-doc-param-desc-empty' => 'без описания',
	'templatedata-invalid-duplicate-value' => 'Свойство «$1» («$3») является дубликатом «$2».',
	'templatedata-invalid-parse' => 'Синтаксическая ошибка в JSON.',
	'templatedata-invalid-type' => 'Для свойства «$1» ожидается тип «$2».',
	'templatedata-invalid-missing' => 'Обязательное свойство «$1» не найдено.',
	'templatedata-invalid-empty-array' => 'Свойство «$1» должно иметь по крайней мере одно значение в своём массиве.',
	'templatedata-invalid-unknown' => 'Неожиданное свойство «$1».',
	'templatedata-invalid-value' => 'Недопустимое значение для свойства «$1».',
	'templatedata-invalid-length' => 'Данные слишком велики для сохранения ({{formatnum:$1}} {{PLURAL:$1|байт|байтов|байта}}, {{PLURAL:$2|лимит:}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Управление шаблонами документации',
	'templatedata-errormsg-jsonbadformat' => 'Некорректный JSON-формат. Исправить его или удалите текущие теги <templatedata> и повторите попытку.',
	'templatedata-modal-button-addparam' => 'Добавить параметр',
	'templatedata-modal-button-apply' => 'Применить',
	'templatedata-modal-button-cancel' => 'Отмена',
	'templatedata-modal-button-delparam' => 'Удалить параметр',
	'templatedata-modal-button-importParams' => 'Импортировать параметры',
	'templatedata-modal-errormsg' => 'Были обнаружены ошибки. Пожалуйста, убедитесь, что имена параметров не являются пустыми, не дублируются и не содержат «$1», «$2» или «$3».',
	'templatedata-modal-errormsg-import-noparams' => 'Во время импорта новые параметры не найдены.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|новый параметр импортирован|новых параметров импортировано|новых параметра импортировано}}.',
	'templatedata-modal-table-param-actions' => 'Действия',
	'templatedata-modal-table-param-aliases' => 'Псевдонимы (через запятую)',
	'templatedata-modal-table-param-default' => 'По умолчанию',
	'templatedata-modal-table-param-desc' => 'Описание',
	'templatedata-modal-table-param-label' => 'Обозначение',
	'templatedata-modal-table-param-name' => 'Имя',
	'templatedata-modal-table-param-required' => 'Обязательное',
	'templatedata-modal-table-param-type' => 'Тип',
	'templatedata-modal-table-param-type-number' => 'Число',
	'templatedata-modal-table-param-type-page' => 'Страница',
	'templatedata-modal-table-param-type-string' => 'Строка',
	'templatedata-modal-table-param-type-undefined' => 'Неопределённый',
	'templatedata-modal-table-param-type-user' => 'Участник',
	'templatedata-modal-title' => 'Редактор шаблонов документов',
	'templatedata-modal-title-templatedesc' => 'Описание шаблона',
	'templatedata-modal-title-templateparams' => 'Параметры шаблона',
);

/** Scots (Scots)
 * @author John Reid
 */
$messages['sco'] = array(
	'templatedata-modal-errormsg' => 'Mistaks foond. Please mak sair thaur ar nae tuim or duplicate parameter names, n that the parameter name disna inclaed "$1", "$2" or "$3".',
);

/** Slovak (slovenčina)
 * @author Sudo77(new)
 */
$messages['sk'] = array(
	'templatedata-doc-desc-empty' => 'Bez popisu.',
	'templatedata-doc-params' => 'Parametre šablóny',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Popis',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Predvolené',
	'templatedata-doc-param-default-empty' => 'prázdne',
	'templatedata-doc-param-status' => 'Stav',
	'templatedata-doc-param-status-deprecated' => 'zastarané',
	'templatedata-doc-param-status-optional' => 'voliteľný',
	'templatedata-doc-param-status-required' => 'povinný',
	'templatedata-doc-param-desc-empty' => 'Bez popisu.',
	'templatedata-invalid-duplicate-value' => 'Vlastnosť „$1“ („$3“) je duplicitná k „$2“.',
	'templatedata-invalid-parse' => 'Syntaktická chyba v JSON.',
	'templatedata-invalid-type' => 'Očakávaný typ vlastnosti „$1“ je „$2“.',
	'templatedata-invalid-missing' => 'Požadovaná vlastnosť "$1" nebola nájdená.',
	'templatedata-invalid-empty-array' => 'Vlastnosť "$1" musí obsahovať aspoň jednu hodnotu.',
	'templatedata-invalid-unknown' => 'Neočakávaná vlastnosť "$1".',
	'templatedata-invalid-value' => 'Chybná hodnota vlastnosti "$1".',
	'templatedata-invalid-length' => 'Údaje nie je možné uložiť, sú príliš veľké ({{formatnum:$1}} {{PLURAL:$1|bajt|bajty|bajtov}}, limit je {{formatnum:$2}} {{PLURAL:$2|bajt|bajty|bajtov}})',
	'templatedata-modal-button-apply' => 'Použiť',
	'templatedata-modal-button-cancel' => 'Zrušiť',
	'templatedata-modal-button-delparam' => 'Odstrániť parameter',
	'templatedata-modal-button-importParams' => 'Importovať parametre',
	'templatedata-modal-table-param-aliases' => 'Prezývky (oddelené čiarkou)',
	'templatedata-modal-table-param-default' => 'Predvolené',
	'templatedata-modal-table-param-desc' => 'Popis',
	'templatedata-modal-table-param-label' => 'Štítok',
	'templatedata-modal-table-param-name' => 'Meno',
	'templatedata-modal-table-param-required' => 'Povinný',
	'templatedata-modal-table-param-type' => 'Typ',
	'templatedata-modal-table-param-type-number' => 'Číslo',
	'templatedata-modal-table-param-type-page' => 'Stránka',
	'templatedata-modal-table-param-type-string' => 'Reťazec',
	'templatedata-modal-table-param-type-undefined' => 'Nedefinovaná',
	'templatedata-modal-table-param-type-user' => 'Používateľ',
	'templatedata-modal-title-templatedesc' => 'Popis šablóny',
	'templatedata-modal-title-templateparams' => 'Parametre šablóny',
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
	'templatedata-modal-table-param-default' => 'Подразумевано',
);

/** Serbian (Latin script) (srpski (latinica)‎)
 * @author Milicevic01
 */
$messages['sr-el'] = array(
	'templatedata-doc-param-default' => 'Podrazumevano',
	'templatedata-modal-table-param-default' => 'Podrazumevano',
);

/** Swedish (svenska)
 * @author Jopparn
 * @author Lokal Profil
 * @author Skalman
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'templatedata-desc' => 'Lagrar data för mallparametrar (med JSON)',
	'templatedata-doc-desc-empty' => 'Ingen beskrivning.',
	'templatedata-doc-params' => 'Mallparametrar',
	'templatedata-doc-param-name' => 'Parameter',
	'templatedata-doc-param-desc' => 'Beskrivning',
	'templatedata-doc-param-type' => 'Typ',
	'templatedata-doc-param-default' => 'Standard',
	'templatedata-doc-param-default-empty' => 'tom',
	'templatedata-doc-param-status' => 'Status',
	'templatedata-doc-param-status-deprecated' => 'föråldrad',
	'templatedata-doc-param-status-optional' => 'valfri',
	'templatedata-doc-param-status-required' => 'obligatorisk',
	'templatedata-doc-param-desc-empty' => 'ingen beskrivning',
	'templatedata-invalid-duplicate-value' => 'Egenskapen "$1" ("$3") är en dubblett av "$2".',
	'templatedata-invalid-parse' => 'Syntaxfel i JSON.',
	'templatedata-invalid-type' => 'Egenskapen "$1" förväntas vara av typen "$2".',
	'templatedata-invalid-missing' => 'Egenskapen "$1" krävs, men hittades inte.',
	'templatedata-invalid-unknown' => 'Oväntad egenskap "$1".',
	'templatedata-invalid-value' => 'Ogiltigt värde för egenskapen "$1".',
	'templatedata-invalid-length' => 'Data för stor för att spara ({{formatnum:$1}}  {{PLURAL:$1|byte|bytes}}, {{PLURAL:$2|gränsen är}} {{formatnum: $2}})',
	'templatedata-editbutton' => 'Hantera malldokumentation',
	'templatedata-errormsg-jsonbadformat' => 'Ogiltigt JSON-format. Korrigera den eller radera de aktuella <templatedata>-taggarna och försök igen.',
	'templatedata-modal-button-addparam' => 'Lägg till parameter',
	'templatedata-modal-button-apply' => 'Verkställ',
	'templatedata-modal-button-cancel' => 'Avbryt',
	'templatedata-modal-button-delparam' => 'Radera parameter',
	'templatedata-modal-button-importParams' => 'Importera parametrar',
	'templatedata-modal-errormsg' => 'Fel hittades. Var god se till att det inte finns några tomma eller dubbla parameternamn, och att parameternamnet inte innehåller "$1", "$2" eller "$3".',
	'templatedata-modal-errormsg-import-noparams' => 'Inga nya parametrar hittades under import.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|ny parameter|nya parametrar}} importerades.',
	'templatedata-modal-table-param-actions' => 'Handlingar',
	'templatedata-modal-table-param-aliases' => 'Alias (kommaseparerade)',
	'templatedata-modal-table-param-default' => 'Standard',
	'templatedata-modal-table-param-desc' => 'Beskrivning',
	'templatedata-modal-table-param-label' => 'Etikett',
	'templatedata-modal-table-param-name' => 'Namn',
	'templatedata-modal-table-param-required' => 'Nödvändig',
	'templatedata-modal-table-param-type' => 'Typ',
	'templatedata-modal-table-param-type-number' => 'Siffra',
	'templatedata-modal-table-param-type-page' => 'Sida',
	'templatedata-modal-table-param-type-string' => 'Sträng',
	'templatedata-modal-table-param-type-undefined' => 'Odefinierad',
	'templatedata-modal-table-param-type-user' => 'Användare',
	'templatedata-modal-title' => 'Malldokumentationsredigerare',
	'templatedata-modal-title-templatedesc' => 'Mallbeskrivning',
	'templatedata-modal-title-templateparams' => 'Mallparametrar',
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

/** Turkish (Türkçe)
 * @author Trncmvsr
 */
$messages['tr'] = array(
	'templatedata-editbutton' => 'Şablon belgelerini yönetme',
	'templatedata-modal-button-addparam' => 'Değişken ekle',
	'templatedata-modal-button-apply' => 'Uygula',
	'templatedata-modal-button-cancel' => 'İptal',
	'templatedata-modal-button-importParams' => 'Değişkenleri içe aktar',
	'templatedata-modal-errormsg-import-noparams' => 'İçe aktarma sırasında yeni öznitelikler bulunamadı.',
	'templatedata-modal-table-param-actions' => 'Eylemler',
	'templatedata-modal-table-param-default' => 'Varsayılan',
	'templatedata-modal-table-param-desc' => 'Açıklama',
	'templatedata-modal-table-param-label' => 'Etiket',
	'templatedata-modal-table-param-name' => 'Ad',
	'templatedata-modal-table-param-type' => 'Tür',
	'templatedata-modal-table-param-type-number' => 'Sayı',
	'templatedata-modal-table-param-type-page' => 'Sayfa',
	'templatedata-modal-table-param-type-string' => 'Dize',
	'templatedata-modal-table-param-type-user' => 'Kullanıcı',
	'templatedata-modal-title' => 'Belge şablonu düzenleyicisi',
	'templatedata-modal-title-templatedesc' => 'Şablon açıklaması',
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
	'templatedata-doc-param-default-empty' => 'порожній',
	'templatedata-doc-param-status' => 'Статус',
	'templatedata-doc-param-status-deprecated' => 'застарілий',
	'templatedata-doc-param-status-optional' => "необов'язковий",
	'templatedata-doc-param-status-required' => "обов'язковий",
	'templatedata-doc-param-desc-empty' => 'немає опису',
	'templatedata-invalid-duplicate-value' => 'Властивість "$1" ("$3") дублює "$2".',
	'templatedata-invalid-parse' => 'Синтаксична помилка в JSON.',
	'templatedata-invalid-type' => 'Властивість "$1" має бути типу "$2".',
	'templatedata-invalid-missing' => 'Обов\'язкову властивість "$1" не знайдено.',
	'templatedata-invalid-empty-array' => 'Властивість «$1» повинна мати принаймні одне значення у своєму масиві.',
	'templatedata-invalid-unknown' => 'Неочікувана властивість "$1".',
	'templatedata-invalid-value' => 'Неприпустиме значення властивості "$1".',
	'templatedata-invalid-length' => 'Дані завеликі для збереження ({{formatnum:$1}} {{PLURAL:$1|байт|байти|байтів}}, {{PLURAL:$2|обмеження становить}} {{formatnum:$2}})',
	'templatedata-editbutton' => 'Управління документацією шаблону',
	'templatedata-errormsg-jsonbadformat' => 'Невірний JSON-формат. Виправте його або вилучіть поточні теги <templatedata> і повторіть спробу.',
	'templatedata-modal-button-addparam' => 'Додати параметр',
	'templatedata-modal-button-apply' => 'Застосовувати',
	'templatedata-modal-button-cancel' => 'Скасувати',
	'templatedata-modal-button-delparam' => 'Видалити параметр',
	'templatedata-modal-button-importParams' => 'Імпортувати параметри',
	'templatedata-modal-errormsg' => 'Виявлено помилки. Будь ласка, переконайтеся що імена параметрів не порожні або не дублюються і не містять «$1», «$2», або «$3».',
	'templatedata-modal-errormsg-import-noparams' => 'Не знайдено нових параметрів під час імпорту.',
	'templatedata-modal-notice-import-numparams' => '$1 {{PLURAL:$1|новий параметр імпортовано|нові параметри імпортовано|нових параметрів імпортовано}}.',
	'templatedata-modal-table-param-actions' => 'Дії',
	'templatedata-modal-table-param-aliases' => 'Псевдоніми (через кому)',
	'templatedata-modal-table-param-default' => 'Стандартно',
	'templatedata-modal-table-param-desc' => 'Опис',
	'templatedata-modal-table-param-label' => 'Позначення',
	'templatedata-modal-table-param-name' => "Ім'я",
	'templatedata-modal-table-param-required' => "Обов'язково",
	'templatedata-modal-table-param-type' => 'Тип',
	'templatedata-modal-table-param-type-number' => 'Число',
	'templatedata-modal-table-param-type-page' => 'Сторінка',
	'templatedata-modal-table-param-type-string' => 'Рядок',
	'templatedata-modal-table-param-type-undefined' => 'Невизначений',
	'templatedata-modal-table-param-type-user' => 'Користувач',
	'templatedata-modal-title' => 'Редактор шаблонів документації',
	'templatedata-modal-title-templatedesc' => 'Опис шаблону',
	'templatedata-modal-title-templateparams' => 'Параметри шаблону',
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
	'templatedata-doc-param-default-empty' => 'trống',
	'templatedata-doc-param-status' => 'Trạng thái',
	'templatedata-doc-param-status-deprecated' => 'bị phản đối',
	'templatedata-doc-param-status-optional' => 'tùy chọn',
	'templatedata-doc-param-status-required' => 'bắt buộc',
	'templatedata-doc-param-desc-empty' => 'không miêu tả',
	'templatedata-invalid-duplicate-value' => 'Thuộc tính “$1” (“$3”) là bản sao của “$2”.',
	'templatedata-invalid-parse' => 'Lỗi cú pháp JSON.',
	'templatedata-invalid-type' => 'Mong đợi kiểu “$2” cho giá trị thuộc tính “$1”.',
	'templatedata-invalid-missing' => 'Không tìm thấy thuộc tính bắt buộc “$1”.',
	'templatedata-invalid-empty-array' => 'Thuộc tính “$1” phải có ít nhất một giá trị trong mảng.',
	'templatedata-invalid-unknown' => 'Thuộc tính bất ngờ “$1”.',
	'templatedata-invalid-value' => 'Giá trị thuộc tính “$1” là không hợp lệ.',
	'templatedata-invalid-length' => 'Dữ liệu quá lớn để lưu ({{formatnum:$1}} byte, vượt quá hạn chế {{formatnum:$2}} byte)',
	'templatedata-editbutton' => 'Quản lý tài liệu bản mẫu',
	'templatedata-errormsg-jsonbadformat' => 'Mã JSON có lỗi cú pháp. Hãy sửa chữa nó hoặc xóa các thẻ <templatedata> hiện tại và thử lại.',
	'templatedata-modal-button-addparam' => 'Thêm tham số',
	'templatedata-modal-button-apply' => 'Áp dụng',
	'templatedata-modal-button-cancel' => 'Hủy bỏ',
	'templatedata-modal-button-delparam' => 'Xóa tham số',
	'templatedata-modal-button-importParams' => 'Nhập tham số',
	'templatedata-modal-errormsg' => 'Đã xuất hiện lỗi. Xin hãy chắc chắn rằng không có tên tham số để trống hoặc thừa và rằng tên tham số không có “$1”, “$2”, “$3”.',
	'templatedata-modal-errormsg-import-noparams' => 'Không tìm thấy tham số mới khi nhập.',
	'templatedata-modal-notice-import-numparams' => 'Đã nhập $1 tham số mới.',
	'templatedata-modal-table-param-actions' => 'Tác vụ',
	'templatedata-modal-table-param-aliases' => 'Biệt danh (phân tách bằng dấu phẩy)',
	'templatedata-modal-table-param-default' => 'Mặc định',
	'templatedata-modal-table-param-desc' => 'Miêu tả',
	'templatedata-modal-table-param-label' => 'Nhãn',
	'templatedata-modal-table-param-name' => 'Tên',
	'templatedata-modal-table-param-required' => 'Bắt buộc',
	'templatedata-modal-table-param-type' => 'Kiểu',
	'templatedata-modal-table-param-type-number' => 'Số',
	'templatedata-modal-table-param-type-page' => 'Trang',
	'templatedata-modal-table-param-type-string' => 'Chuỗi',
	'templatedata-modal-table-param-type-undefined' => 'Không định rõ',
	'templatedata-modal-table-param-type-user' => 'Người dùng',
	'templatedata-modal-title' => 'Trình soạn thảo tài liệu bản mẫu',
	'templatedata-modal-title-templatedesc' => 'Miêu tả bản mẫu',
	'templatedata-modal-title-templateparams' => 'Tham số bản mẫu',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Hzy980512
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
	'templatedata-doc-param-default-empty' => '空',
	'templatedata-doc-param-status' => '状态',
	'templatedata-doc-param-status-deprecated' => '弃用',
	'templatedata-doc-param-status-optional' => '可选',
	'templatedata-doc-param-status-required' => '必填',
	'templatedata-doc-param-desc-empty' => '没有说明',
	'templatedata-invalid-duplicate-value' => '属性“$1”（“$3”）与“$2”重复。',
	'templatedata-invalid-parse' => 'JSON中语法错误。',
	'templatedata-invalid-type' => '属性“$1”的预期类型为“$2”。',
	'templatedata-invalid-missing' => '未找到必需的属性“$1”。',
	'templatedata-invalid-empty-array' => '属性“$1”必须至少有一个值。',
	'templatedata-invalid-unknown' => '意外的属性“$1”。',
	'templatedata-invalid-value' => '属性“$1”的值无效。',
	'templatedata-invalid-length' => '数据过大，无法保存（{{formatnum:$1}}{{PLURAL:$1|字节}}，{{PLURAL:$2|限制是}}{{formatnum:$2}}）',
	'templatedata-editbutton' => '管理模板文档',
	'templatedata-errormsg-jsonbadformat' => '无效JSON格式。请将其改正或删除<templatedata>标签然后重试。',
	'templatedata-modal-button-addparam' => '添加参数',
	'templatedata-modal-button-apply' => '应用',
	'templatedata-modal-button-cancel' => '取消',
	'templatedata-modal-button-delparam' => '删除参数',
	'templatedata-modal-button-importParams' => '导入参数',
	'templatedata-modal-errormsg' => '找到错误。请确信这里没有空或重复的参数名称，并且它们不包括“$1”“$2”或“$3”。',
	'templatedata-modal-errormsg-import-noparams' => '导入过程中找不到新的参数。',
	'templatedata-modal-notice-import-numparams' => '$1个新参数已导入。',
	'templatedata-modal-table-param-actions' => '操作',
	'templatedata-modal-table-param-aliases' => '别名（逗号分隔）',
	'templatedata-modal-table-param-default' => '默认值',
	'templatedata-modal-table-param-desc' => '描述',
	'templatedata-modal-table-param-label' => '标签',
	'templatedata-modal-table-param-name' => '名称',
	'templatedata-modal-table-param-required' => '必填',
	'templatedata-modal-table-param-type' => '类型',
	'templatedata-modal-table-param-type-number' => '数值',
	'templatedata-modal-table-param-type-page' => '页面',
	'templatedata-modal-table-param-type-string' => '字符串',
	'templatedata-modal-table-param-type-undefined' => '未定义',
	'templatedata-modal-table-param-type-user' => '用户',
	'templatedata-modal-title' => '模板文档编辑器',
	'templatedata-modal-title-templatedesc' => '模板说明',
	'templatedata-modal-title-templateparams' => '模板参数',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author EagerLin
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
	'templatedata-editbutton' => '管理模板文檔',
	'templatedata-modal-button-addparam' => '添加參數',
	'templatedata-modal-button-apply' => '應用',
	'templatedata-modal-button-cancel' => '取消',
	'templatedata-modal-button-delparam' => '刪除參數',
	'templatedata-modal-button-importParams' => '導入參數',
	'templatedata-modal-errormsg-import-noparams' => '導入過程中找不到新的參數。',
	'templatedata-modal-table-param-actions' => '操作',
	'templatedata-modal-table-param-aliases' => '別名 (逗號分隔)',
	'templatedata-modal-table-param-default' => '預設值',
	'templatedata-modal-table-param-desc' => '描述',
	'templatedata-modal-table-param-label' => '標籤',
	'templatedata-modal-table-param-name' => '名稱',
	'templatedata-modal-table-param-required' => '必填',
	'templatedata-modal-table-param-type' => '類型',
	'templatedata-modal-table-param-type-number' => '數值',
	'templatedata-modal-table-param-type-page' => '頁面',
	'templatedata-modal-table-param-type-string' => '字串',
	'templatedata-modal-table-param-type-undefined' => '未定義',
	'templatedata-modal-table-param-type-user' => '使用者',
	'templatedata-modal-title' => '模板文檔編輯器',
	'templatedata-modal-title-templatedesc' => '模板描述',
	'templatedata-modal-title-templateparams' => '模版參數',
);
