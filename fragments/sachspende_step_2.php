<div class="uk-box-shadow-medium uk-padding uk-container-small uk-container uk-background-muted rex-sachspenden2">


<?php

$items = saspe_things::get_query()->where('quantity',0,'>')->find();

$formvars = rex_session('saspe_form_vars','array');
dump($formvars);
$order = saspe_base::get_spende_items();
$order_text = [];
?>
<div class="uk-animation-scale-up uk-padding-small">
<h2>Ihre Spende anmelden</h2>
	<p>Nachfolgend sehen Sie die von Ihnen ausgewählten Spenden:</p>
	</div>

<?php
$yform = new rex_yform();
$yform->setObjectparams('form_action',rex_getUrl('','',['step'=>2]));
$yform->setObjectparams('form_name', 'sachspenden_form');
$yform->setObjectparams('form_wrap_id', 'sachspenden-form');
$yform->setObjectparams('form_ytemplate', 'uikit3,bootstrap');
$yform->setObjectparams('form_class', 'spenden-liste uk-form-stacked');

// $yform->setObjectparams('debug', 1);

$yform->setValueField('hidden',['step',2,'REQUEST','no_db']);

$yform->setValueField('html',['','<div class="uk-padding-small uk-box-shadow-large uk-margin-bottom uk-background-primary uk-light"> <ul class="uk-list uk-list uk-list-striped uk-list-primary">']);
foreach ($order as $item) {
	
    $yform->setValueField('html',['','<li class="uk-padding-small">'.$item->order_line.'</li>']);
    $order_text[] = $item->order_line;
}
$yform->setValueField('html',['','</ul></div><div class="uk-margin-bottom"></div>']);

$yform->setValueField('hidden',['order_text',implode(PHP_EOL,$order_text)]);
$yform->setValueField('hidden',['key', md5('sachspenden_das_form'.uniqid((string) (random_int(0, getrandmax())), true))]);
$yform->setValueField('hidden',['created', date('Y-m-d H:i:s')]);

if (rex_addon::get('yform_spam_protection')->isAvailable()) {
    $yform->setValueField('spam_protection', array("honeypot", "Bitte nicht ausfüllen.", "Ihre Anfrage wurde als Spam erkannt und gelöscht. Bitte versuchen Sie es in einigen Minuten erneut oder wenden Sie sich persönlich an uns.", 0));
}

$yform->setValueField('text',['firstname','Vorname*']);
$yform->setValueField('text',['lastname','Nachname*']);
$yform->setValueField('text',['email','E-Mail*']);
$yform->setValueField('text',['phone','Telefon']);
$yform->setValueField('textarea',['notice','Bemerkung']);
$yform->setValueField('checkbox',['mentioned','Ich möchte als Spender mit Namen genannt werden.']);

$yform->setValueField('html',['','<hr>Die hier erfassten Daten werden nur für den Zweck der Spendenerfassung gespeichert und nicht weitergegeben. Weitere Informationen zur Datenerfassung auf unseren Seiten finden Sie in der <a href="/ueber-uns/datenschutz/">Datenschutzerklärung</a><hr>']);		
$yform->setValueField('checkbox',['privacy','Ich stimme der Datenerfassung zu']);
	
	
$yform->setValueField('html', ['', '<a href="' . rex_getUrl('','',['step'=>1]) . '" class="uk-button uk-button-default uk-margin-right">Zurück</a>&nbsp;&nbsp;&nbsp;']);
$yform->setValueField('submit', ['Submit', 'Absenden', 'no_db', '', '', 'uk-active']);

$yform->setValidateField('empty',['firstname','Bitte füllen Sie die markierten Felder aus.']);
$yform->setValidateField('empty',['lastname','Bitte füllen Sie die markierten Felder aus.']);
$yform->setValidateField('type',['email','email','Bitte geben Sie eine gültige E-Mail Adresse ein.']);
$yform->setValidateField('empty',['privacy','Bitte stimmen Sie der Datenerfassung zu']);

$yform->setActionField('tpl2email', [rex_config::get("sachspende","email_template_customer"), 'email']);
foreach (explode(',', rex_config::get('sachspende','email_me')) as $email) {
    $yform->setActionField('tpl2email', [rex_config::get("sachspende","email_template_owner"), trim($email)]);
}
	


$yform->setActionField('db',['rex_saspe_order']);

$yform->setActionField('callback', ['saspe_order::update_stock']);

$yform->setActionField('redirect',[rex_getUrl('','',['step'=>3])]);

?>

<?= $yform->getForm(); ?>
</div>