<?php
class saspe_things extends rex_yform_manager_dataset {
    public static function get_query() {
        return self::query()->orderBy('prio');
    }

}