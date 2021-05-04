<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MyProjectsCollection extends Model
{
    protected $table = "my_projects_collections";

    public function getMyProjectCollections($custId, $collectionIds) {

        Log::info("MyProjectsCollection :: getMyProjectCollections custId :: ".print_r($custId, true));
        Log::info("MyProjectsCollection :: getMyProjectCollections collectionIds :: ".print_r($collectionIds, true));

        // SELECT my_projects.customer_id, my_projects.my_project_collection_id, my_projects_collections.* , my_projects.id as my_project_id, (JSON_EXTRACT(metafield, '$.collection_type ' )= "my_projects") as my_project_type, (JSON_EXTRACT(metafield, '$.collection_type ' )= "design_guide") as my_project_design_guide_type FROM `my_projects_collections` LEFT JOIN my_projects on my_projects.my_project_collection_id = my_projects_collections.id where my_projects_collections.id IN(265802612933, 266053943493, 265822535877, 265875095749, 266178363585, 265820897477) and my_projects.customer_id = 5180494938305 ORDER BY my_projects.created_at desc, my_projects.updated_at desc

        return MyProjectsCollection::select("my_projects.customer_id", "my_projects.my_project_collection_id", "my_projects_collections.*" , "my_projects.id as my_project_id", DB::raw("(JSON_EXTRACT(metafield, '$.collection_type ' )= 'my_projects') as my_project_type"), DB::raw("(JSON_EXTRACT(metafield, '$.collection_type ' )= 'design_guide') as my_project_design_guide_type"))
            ->leftJoin('my_projects', 'my_projects.my_project_collection_id', '=', 'my_projects_collections.id')
            ->where('my_projects.customer_id', '=', $custId)
            ->whereIn('my_projects_collections.id', $collectionIds)
            ->orderBy('my_projects.created_at', 'desc')
            ->orderBy('my_projects.updated_at', 'desc')
            ->get();
    }
}
