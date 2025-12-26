<?php

namespace App\Providers;

use App\Models\tb_sys_mf_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $lev = 0;
            $stack = array();
            $instructions = array();
            $pop = array();
            $results = [];
            if (Auth::check()) {
                if (DB::connection()->getDriverName() == 'mysql') {
                    $results = DB::select(DB::raw("call sp_call_mod_user_access (?)"), [Auth::id()]);
                } else {
                    $results = DB::select(DB::raw("exec sp_call_mod_user_access ?"), [Auth::id()]);
                }
                // Log::debug($results);
                foreach ($results as $result) {
                    if ($result->level > $lev) {
                        if (!empty($instructions)) {
                            $pop = array_pop($instructions);
                            $pop['class'] = 'sub';
                            array_push($instructions, $pop);
                        }
                        array_push($stack, ['ul']);
                        array_push($stack, ['li']);
                        if (empty($instructions))
                            array_push($instructions, ['dom' => 'ul', 'class' => 'first']);
                        else
                            array_push($instructions, ['dom' => 'ul']);
                        array_push($instructions, ['dom' => 'li', 'menu_name' => ($result->mod_id > 0 ? $result->mod_name : $result->mod_group_name), 'mod_id' => $result->mod_id, 'url' => $result->url]);
                        ++$lev;
                    } else if ($result->level == $lev) {
                        $pop = array_pop($stack);
                        array_push($instructions, ['dom' => '/li']);
                        array_push($stack, ['li']);
                        array_push($instructions, ['dom' => 'li', 'menu_name' => ($result->mod_id > 0 ? $result->mod_name : $result->mod_group_name), 'mod_id' => $result->mod_id, 'url' => $result->url]);
                    } else {
                        while ($result->level < $lev) {
                            $pop = array_pop($stack);
                            if ($pop['0'] == "ul") {
                                array_push($instructions, ['dom' => '/ul']);
                                --$lev;
                            } else {
                                array_push($instructions, ['dom' => '/li']);
                            }
                        }
                        array_pop($stack);
                        array_push($instructions, ['dom' => '/li']);
                        array_push($stack, ['li']);
                        array_push($instructions, ['dom' => 'li', 'menu_name' => ($result->mod_id > 0 ? $result->mod_name : $result->mod_group_name), 'mod_id' => $result->mod_id, 'url' => $result->url]);
                    }
                }
                while ($lev != 0) {
                    $pop = array_pop($stack);
                    array_push($instructions, ['dom' => '/' . $pop['0']]);
                    if ($pop['0'] == "ul")
                        --$lev;
                }
            }
            return $view->with('instructions', $instructions, 'nonce', csp_nonce());
        });
    }
}
