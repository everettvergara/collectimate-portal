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
        DB::statement("CREATE VIEW `vw_sys_mf_mod_group_hierarchy` AS with recursive `cte_sys_mod_mf_group` (`parent_mod_group_id`,`id`,`name`,`level`,`seq`) as (select `a`.`parent_mod_group_id` AS `parent_mod_group_id`,`a`.`id` AS `id`,`a`.`name` AS `name`,ifnull(`a`.`seq`,0) AS `level`,cast(ifnull(`a`.`seq`,0) as char(100) charset utf8mb4) AS `seq` from `tb_sys_mf_mod_group` `a` where (`a`.`parent_mod_group_id` is null) union all select `b`.`parent_mod_group_id` AS `parent_mod_group_id`,`b`.`id` AS `id`,`b`.`name` AS `name`,(`a`.`level` + 1) AS `level`,concat(`a`.`seq`,cast(ifnull((`b`.`seq` + 1),0) as char charset utf8mb4)) AS `seq` from (`cte_sys_mod_mf_group` `a` join `tb_sys_mf_mod_group` `b` on((`a`.`id` = `b`.`parent_mod_group_id`)))) select `cte_sys_mod_mf_group`.`parent_mod_group_id` AS `parent_mod_group_id`,`cte_sys_mod_mf_group`.`id` AS `id`,`cte_sys_mod_mf_group`.`name` AS `name`,`cte_sys_mod_mf_group`.`level` AS `level`,`cte_sys_mod_mf_group`.`seq` AS `seq` from `cte_sys_mod_mf_group`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_sys_mf_mod_group_hierarchy`");
    }
};
