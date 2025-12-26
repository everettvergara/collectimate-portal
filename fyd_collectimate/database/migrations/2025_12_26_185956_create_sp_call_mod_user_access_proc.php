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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_call_mod_user_access`(IN `user_id` BIGINT)
BEGIN
        WITH RECURSIVE tmp_modules as 
(
	select	distinct a.name as mod_name, a.id as mod_id, a.mod_group_id , a.url
	from 	tb_sys_mf_mod as a 
			
			inner join tb_sys_mf_mod_access_type as b on 
			a.id = b.mod_id 
			
			inner join tb_sys_mf_user_access_type as c on 
			b.access_type_id = c.access_type_id 
			
			inner join tb_sys_mf_user as d on 
			c.user_id = d.id 
			
	where 	d.id = user_id AND
			IFNULL(a.is_active, 0) = 1 and
			IFNULL(a.is_visible, 0) = 1 
),tmp_modules_copy as (
        select x.mod_name, x.mod_id, '' as mod_group_name,  y.level+1 as level, x.mod_group_id, concat(y.seq, y.level+1) as seq, x.url  
        from 	tmp_modules as x

                inner join vw_sys_mf_mod_group as y on
                x.mod_group_id = y.mod_group_id 

        union  
        select '' as mod_name, 0, c.mod_group_name, c.level, c.mod_group_id, c.seq, null as url
        from 	tmp_modules as a 

                inner join vw_sys_mf_mod_group as b on
                a.mod_group_id = b.mod_group_id 
                
                inner join vw_sys_mf_mod_group as c on 
                c.seq like concat(left(b.seq,1), '%')
    
)
SELECT * FROM tmp_modules_copy order by seq, mod_name;
END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_call_mod_user_access");
    }
};
