<?php
$items = saspe_things::get_query()->where('quantity',0,'>')->find();
$formvars = rex_session('saspe_form_vars','array');

?>

<h2>Liste der Spenden</h2>
<p>Bitte wählen Sie aus, was Sie spenden möchten.</p>

<?php
$yform = new rex_yform();
$yform->setObjectparams('form_action',rex_getUrl('','',['step'=>1]));
$yform->setObjectparams('form_name', 'sachspenden_form');
$yform->setObjectparams('form_wrap_id', 'sachspenden-form');
$yform->setObjectparams('form_ytemplate', 'uikit,bootstrap');
$yform->setObjectparams('submit_btn_label', 'Weiter');

$yform->setObjectparams('form_class', 'uk-form-stacked');
// $yform->setObjectparams('submit_btn_show', false);

$yform->setValueField('hidden',['step',1,'REQUEST']);

foreach ($items as $item) {
    if ($item->quantity == 1) {
        $yform->setValueField('checkbox',['spende_'.$item->id, $item->name_1, $formvars['spende_'.$item->id] ?? '0']);
        $yform->setValueField('html',['',$item->text_1]);
    } else {
        $yform->setValueField('text',['spende_'.$item->id,$item->name_1.' (max. '.$item->quantity.' '.$item->unit.')',$formvars['spende_'.$item->id] ?? '0','',['type'=>'number','max'=>$item->quantity]]);
        $yform->setValidateField('intfromto', ['spende_'.$item->id,"0", $item->quantity, "Der Wert muss zwischen 0 und ".$item->quantity." sein."]);
        $yform->setValueField('html',['',$item->text_1]);
    }
}

$yform->setValidateField('customfunction',['step','saspe_base::form_not_empty','','Bitte wählen Sie bei der gewünschten Spende eine Anzahl aus.']);

$yform->setActionField('callback',['saspe_base::remember_vars']);
$yform->setActionField('redirect',[rex_getUrl('','',['step'=>2])]);

?>

<?= $yform->getForm(); ?>