<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorRouteReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        drop   view if exists distributor_route_report ;
create  view  distributor_route_report as (
SELECT
 dr.name,
 u.name as user_name,
 u.id as user_id,
 dr.trip_counts,
 count(ti.id) trip_invertory_count,
 # 	c.name,
 SUBSTRING_INDEX(
   GROUP_CONCAT(
     ti.created_at
     ORDER BY
       ti.id asc
   ),
   ',',
   1
 ) AS start_at,
 SUBSTRING_INDEX(
   GROUP_CONCAT(
     ti.created_at
     ORDER BY
       ti.id desc
   ),
   ',',
   1
 ) AS last_trip_at,
 sum(if(ti.type = 'accept', 1, 0)) as accept_count,
 sum(if(ti.type = 'refuse', 1, 0)) as refuse_count,
 dr.id AS dr_id,
 rt.round AS tr_round,
 dr.round AS dr_round,
 count(rtr.id) route_trip_report_count,
 GROUP_CONCAT(rtr.id) AS route_trip_report_ids,
 sum(rtr.total_money) total_money,
 waiting_trips,
 rr.id as finish_report_id,
 `rr`.`created_at` AS `end_at`

FROM
 trip_inventories ti
 LEFT JOIN route_trips rt ON ti.trip_id = rt.id
 LEFT JOIN (
   select
     *,
     (
       select
         count(id)
       from
         route_trips
       where
         route_id = distributor_routes.id
     ) as trip_counts,
     (
       select
         count(id)
       from
         route_trips
       where
         route_id = distributor_routes.id
         and route_trips.round != distributor_routes.round
     ) as waiting_trips
   from
     distributor_routes
 ) dr ON route_id = dr.id
 LEFT JOIN users u ON dr.user_id = u.id
 LEFT JOIN route_reports rr on dr.id = rr.route_id  and ti.round = rr.round
 LEFT JOIN route_trip_reports rtr ON rtr.route_trip_id = ti.trip_id
 AND ti.round = rtr.round
 LEFT JOIN clients c ON c.id = rt.client_id
group by
 ti.round,
 dr.id
order by
 c.name asc,
 ti.round desc)
       ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_route_reports');
    }
}
