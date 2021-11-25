<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP VIEW IF EXISTS  distributors_sales");
        DB::unprepared("create view distributors_sales as (SELECT
        distributor_id,
        users.name,
        product_id,
        route_trip_id,
        client_id,
        stores.id AS store_id,
        `route_trip_reports`.`created_at`,
        attached_products.quantity,
        attached_products.price
    FROM
        attached_products
            JOIN
        route_trip_reports ON attached_products.model_id = route_trip_reports.id
            JOIN
        route_trips ON route_trip_id = route_trips.id
            JOIN
        stores ON store_id = stores.id
            JOIN
        users ON users.id = stores.distributor_id
            JOIN
        products ON products.id = attached_products.product_id
    WHERE
        model_type = 'App\\\\Models\\\\RouteTripReport')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP VIEW  IF EXISTS distributors_sales");
    }
}
