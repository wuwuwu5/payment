<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $array = [];
        \DB::listen(function (\Illuminate\Database\Events\QueryExecuted $query) use ($array) {

            $sqlWithPlaceholders = str_replace(['%', '?'], ['%%', '%s'], $query->sql);

            $bindings = $query->connection->prepareBindings($query->bindings);
            $pdo = $query->connection->getPdo();

            $sql = vsprintf($sqlWithPlaceholders, array_map([$pdo, 'quote'], $bindings));

            $array['SQL语句'] = $sql;

            info($array);
        });
    }
}
