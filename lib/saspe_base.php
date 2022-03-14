<?php
class saspe_base {
    public static function remember_vars ($form) {
        $vars = array_merge(
            rex_session('saspe_form_vars','array'),
            $form->params['value_pool']['email']
        );
        $vars['order_text'] = '';
        // 0-Anzahl Spenden raus.
        foreach ($vars as $k=>$v) {
            preg_match('/spende_([\d.*?])/',$k,$matches);
            if ($matches && isset($matches[1]) && $matches[1]) {
                if (!$v) {
                    unset($vars[$k]);
                }
            }
        }

        rex_set_session('saspe_form_vars',$vars);
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

    /**
     * prüft, ob überhaupt eine Spende ausgewählt wurde
     */
    public static function form_not_empty ($p1,$p2,$p3,$p4) {
        $values = $p4->params['values'];
        foreach ($values as $val) {
            $name = $val->name;
            preg_match('/spende_([\d.*?])/',$name,$matches);
            if ($matches && isset($matches[1]) && $matches[1]) {
                if ($val->value) {
                    return false;
                }
            }
        }
        return true;
    }




}