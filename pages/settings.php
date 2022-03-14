<?php
$form = rex_config_form::factory('sachspende');
$form->addFieldset('Einstellungen');

$field = $form->addTextField('email_me');
$field->setLabel('E-Mail Adressen des Betreibers');
$field->setNotice('<code>rex_config::get(\'sachspende\',\'email_me\')</code>. Mehrere Adressen durch Komma trennen. An diese E-Mail Adressen werden die Infomails geschickt.');

$field = $form->addLinkmapField('confirmation_page');
$field->setLabel('E-Mail-Link Bestätigungsseite');
$field->setNotice('Wenn der Bestätigungslink aufgerufen wird, wird diese Seite angezeigt: <code>rex_config::get(\'sachspende\',\'confirmation_page\')</code>.');

// ==== E-Mail

$form->addFieldset('Bestätigungen / E-Mail');

$res = rex_sql::factory()->getArray('SELECT name FROM '.rex::getTable('yform_email_template'));
$options = array_column($res, 'name');

$field = $form->addSelectField('email_template_customer');
$field->setLabel('E-Mail Template Spender');
$select = $field->getSelect();
$select->addOptions($options,true);
$field->setNotice('<code>rex_config::get("sachspende","email_template_customer")</code>');

$field = $form->addSelectField('email_template_owner');
$field->setLabel('E-Mail Template Betreiber');
$select = $field->getSelect();
$select->addOptions($options,true);
$field->setNotice('<code>rex_config::get("sachspende","email_template_owner")</code>');


$content = $form->get();

$fragment = new rex_fragment();
$fragment->setVar('title', 'Einstellungen');
$fragment->setVar('body', $content, false);
$content = $fragment->parse('core/page/section.php');

echo $content;
