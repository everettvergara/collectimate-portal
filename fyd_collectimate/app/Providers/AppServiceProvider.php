<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Spatie\Csp\Csp;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.alerts', 'alerts');
        Blade::aliasComponent('components.checkbox', 'checkbox');
        Blade::aliasComponent('components.datefield', 'datefield');
        Blade::aliasComponent('components.datetimefield', 'datetimefield');
        Blade::aliasComponent('components.datetimefield-js', 'datetimefieldjs');
        Blade::aliasComponent('components.email', 'email');
        Blade::aliasComponent('components.password', 'password');
        Blade::aliasComponent('components.password-js', 'passwordjs');
        Blade::aliasComponent('components.profile-image', 'profileimage');
        Blade::aliasComponent('components.text', 'text');
        Blade::aliasComponent('components.hidden', 'hidden');
        Blade::aliasComponent('components.image', 'image');
        Blade::aliasComponent('components.textarea', 'textarea');
        Blade::aliasComponent('components.select', 'select');
        Blade::aliasComponent('components.uploader', 'uploader');
        Blade::aliasComponent('components.select2-head', 'select2head');
        Blade::aliasComponent('components.select2-js', 'select2js');
        Blade::aliasComponent('components.detail-index', 'dindex');
        Blade::aliasComponent('components.detail-attachment', 'dattachment');
        Blade::aliasComponent('components.detail-img-style', 'dimgstyle');
        Blade::aliasComponent('components.sm-text', 'sm_text');
        Blade::aliasComponent('components.sm-select', 'sm_select');
        Blade::aliasComponent('components.sm-datetimefield', 'sm_datetimefield');
        Blade::aliasComponent('components.sm-textarea', 'sm_textarea');
        Blade::aliasComponent('components.category.category', 'category');
        Blade::aliasComponent('components.radio', 'radio');
        Blade::aliasComponent('layouts.nav', 'nav');
        Blade::aliasComponent('layouts.footer', 'footer');

        // BUTTONS
        Blade::aliasComponent('components.btn-index-view', 'btn_index_view');
        Blade::aliasComponent('components.btn-index-create', 'btn_index_create');
        Blade::aliasComponent('components.btn-index-edit', 'btn_index_edit');
        Blade::aliasComponent('components.btn-index-delete', 'btn_index_delete');

        Blade::aliasComponent('components.btn-form-edit', 'btn_form_edit');
        Blade::aliasComponent('components.btn-form-submit', 'btn_form_submit');

        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
    }
}
