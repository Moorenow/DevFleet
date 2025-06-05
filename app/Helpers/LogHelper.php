<?php

namespace App\Helpers;

use App\Models\Log;

class LogHelper{

    public static function createLog($sesion, $base, $module, $action, $before, $after)
    {
        $log = new Log();
        $log->user_id = $sesion;
        $log->dealer = $base;
        $log->modulo = $module;
        $log->accion = $action;
        $log->data_before = $before;
        $log->data_after = $after;
        $log->save();

        return true;
    }
}
