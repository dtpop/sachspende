<?php
class saspe_order extends rex_yform_manager_dataset {
    public static function get_query() {
        return self::query();
    }

    /**
     * Wird als yform Action aufgerufen
     */
    public static function update_stock ($form) {
        $orderform = rex_session('saspe_form_vars','array');
        $query = saspe_things::get_query();
        foreach ($orderform as $k=>$v) {
            preg_match('/spende_([\d].*?)$/',$k,$matches);
            if ($matches && isset($matches[1])) {
                $item = $query->resetWhere()->where('id',$matches[1])->findOne();
                $item->quantity -= $v;
               $item->save();
            }
        }
        rex_set_session('saspe_form_vars',[]);
    }
}
?>