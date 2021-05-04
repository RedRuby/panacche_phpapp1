<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MyProject extends Model
{
    // SELECT id, parent_design_id,updated_at, created_at, (JSON_EXTRACT(metafield, '$.collection_type ' )= "my_projects") as type from my_projects having type=1 UNION SELECT id,parent_design_id,updated_at,created_at, (JSON_EXTRACT(metafield, '$.collection_type ' )= "design_guide") as type from my_projects WHERE parent_design_id not in (SELECT parent_design_id from my_projects where (JSON_EXTRACT(metafield, '$.collection_type ' )= "my_projects") = 1) having type = 1 order by  created_at desc, updated_at desc

    public function getMyProjects() {
        $myProjects = DB::table("my_projects")
                    ->select("*", DB::raw("(JSON_EXTRACT(metafield, '$.collection_type ' )= 'my_projects') as type"))
                    ->having('type', 1);



        $combinedProjects = DB::table("my_projects")
                    ->select("*", DB::raw("(JSON_EXTRACT(metafield, '$.collection_type ' )= 'design_guide') as type"))
                    ->whereNotIn('parent_design_id',function($query){
                        $query->select('parent_design_id')->from('my_projects')
                        ->where(DB::raw("(JSON_EXTRACT(metafield, '$.collection_type ' )= 'my_projects')"), 1);
                     })

                    ->having('type', 1)
                    ->union($myProjects)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->pluck('my_projects.my_project_collection_id')->toArray();

        return $combinedProjects;
    }

}
