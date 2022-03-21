<div class="uk-box-shadow-medium uk-padding uk-container-small uk-container uk-background-muted rex-sachspenden">
<?php
$items = saspe_things::get_query()->where('quantity',0,'>')->find();
$formvars = rex_session('saspe_form_vars','array');

?>
<div class="uk-animation-scale-up uk-text-center">
<h2>Wir freuen uns über Ihre Spende</h2>
<p>Aktuell benötigen wir: </p>
</div>




<?php
$yform = new rex_yform();
$yform->setObjectparams('form_action',rex_getUrl('','',['step'=>1]));
$yform->setObjectparams('form_name', 'sachspenden_form');
$yform->setObjectparams('form_wrap_id', 'sachspenden-form');
$yform->setObjectparams('form_ytemplate', 'uikit3,bootstrap');
$yform->setObjectparams('submit_btn_label', 'Weiter');

$yform->setObjectparams('form_class', 'spenden-liste uk-form-horizontal');
// $yform->setObjectparams('submit_btn_show', false);

$yform->setValueField('hidden',['step',1,'REQUEST']);
$count = 0;
foreach ($items as $item) {
	
	$count++;
	
    if ($item->quantity == 100000) {
        $yform->setValueField('checkbox',['spende_'.$item->id, $item->name_1, $formvars['spende_'.$item->id] ?? '0']);
        $yform->setValueField('html',['',$item->text_1]);
    } else {

$info = '';		
if ($item->text_1 !='') 
{
		$info = '	
		<!-- This is an anchor toggling the modal -->
<br><a class="uk-text-small" href="#info'.$count.'" uk-toggle><span uk-icon="icon: question"></span> Mehr Informationen</a>

<!-- This is the modal -->
<div id="info'.$count.'" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
     
        '.$item->text_1.'
    </div>
</div>';
}
		
			$sfor = '';
		if($item->for!='')
		{
			$sfor = '<br><span style="font-weight: normal" class="uk-text-small">Für: '.$item->for.'</span>';
		}
	
		
		$yform->setValueField('text',['spende_'.$item->id,$item->name_1.' (noch: '.$item->quantity.' '.$item->unit.')'.$info,$formvars['spende_'.$item->id] ?? '0','',['type'=>'number','class'=>'sachspende-number uk-background-primary uk-light uk-input', 'min'=>'0','max'=>$item->quantity]]);
        $yform->setValidateField('intfromto', ['spende_'.$item->id,"0", $item->quantity, "Der Wert muss zwischen 0 und ".$item->quantity." sein."]);
		

		
		
		
	//	$yform->setValueField('html',['',$item->text_1]);
   // $yform->setValueField('html',['',$sfor]);
    }
}

$yform->setValidateField('customfunction',['step','saspe_base::form_not_empty','','Bitte wählen Sie bei der gewünschten Spende eine Anzahl aus.']);

$yform->setActionField('callback',['saspe_base::remember_vars']);
$yform->setActionField('redirect',[rex_getUrl('','',['step'=>2])]);

?>

<?= $yform->getForm(); ?>
</div>