<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDesignerRating extends Model
{
    protected $table = "user_designer_ratings";


    public function getRecommendedDesignsByRatings() {

        // SELECT my_projects.parent_design_id , collections.* FROM `user_designer_ratings` left join my_projects on my_projects.customer_id = user_designer_ratings.customer_id AND my_projects.my_project_collection_id = user_designer_ratings.my_project_collection_id left join collections on collections.id = my_projects.parent_design_id GROUP BY user_designer_ratings.designer_id order by rating DESC


        return UserDesignerRating::select('collections.*', 'my_projects.parent_design_id')
            ->from('user_designer_ratings')
            ->leftJoin('my_projects', function($join) {
                $join->on('my_projects.customer_id', '=', 'user_designer_ratings.customer_id');
                $join->on('my_projects.my_project_collection_id','=', 'user_designer_ratings.my_project_collection_id');
            })
            ->leftJoin('collections', 'collections.id', '=', 'my_projects.parent_design_id')
            ->groupBy('user_designer_ratings.designer_id')->orderBy('user_designer_ratings.rating', 'desc')->limit(4)->get();
    }
}
