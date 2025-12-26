<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `vw_sys_mf_mod_group` AS with recursive `mod_group` (`mod_group_id`,`mod_group_name`,`parent_mod_group_id`,`parent_mod_group_name`,`level`,`seq`) as (select `a`.`id` AS `mod_group_id`,`a`.`name` AS `mod_group_name`,0 AS `parent_mod_group_id`,`a`.`name` AS `parent_mod_group_name`,1 AS `level`,cast(`a`.`seq` as char charset utf8mb4) AS `seq` from `fyd_collectimate`.`tb_sys_mf_mod_group` `a` where (`a`.`parent_mod_group_id` is null) union all select `a`.`id` AS `mod_group_id`,`a`.`name` AS `mod_group_name`,`a`.`parent_mod_group_id` AS `parent_mod_group_id`,`b`.`mod_group_name` AS `parent_mod_group_name`,(`b`.`level` + 1) AS `level`,concat(cast(`b`.`seq` as char charset utf8mb4),cast(`a`.`seq` as char charset utf8mb4)) AS `seq` from (`fyd_collectimate`.`tb_sys_mf_mod_group` `a` join `mod_group` `b` on((`a`.`parent_mod_group_id` = `b`.`mod_group_id`)))) select `mod_group`.`mod_group_id` AS `mod_group_id`,`mod_group`.`mod_group_name` AS `mod_group_name`,`mod_group`.`parent_mod_group_id` AS `parent_mod_group_id`,`mod_group`.`parent_mod_group_name` AS `parent_mod_group_name`,`mod_group`.`level` AS `level`,`mod_group`.`seq` AS `seq` from `mod_group` order by `mod_group`.`seq`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_sys_mf_mod_group`");
    }
};
