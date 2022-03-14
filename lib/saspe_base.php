<?php
class saspe_base {
    public static function remember_vars ($form) {
        rex_set_session('saspe_form_vars',
            array_merge(
                rex_session('saspe_form_vars','array'),
                $form->params['value_pool']['email']
            )
        );
        return;
    }

    public static function get_spende_items () {
        $orderform = rex_session('saspe_form_vars','array');
        $query = saspe_things::get_query();
        $order = [];
        foreach ($orderform as $k=>$v) {
            preg_match('/spende_([\d.*?])/',$k,$matches);
            if ($matches) {
                $item = $query->resetWhere()->where('id',$matches[1])->findOne();
                if ($item) {
                    $item->order_count = $v;
                    $item->order_line = $v.' '.$item->unit.' '.$item->name_1;
                    $order[$item->id] = $item;
                }
            }
        }
        return $order;
    }




}