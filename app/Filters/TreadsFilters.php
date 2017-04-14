<?php

 namespace App\Filters;

 use App\User;


 class TreadsFilters extends Filters {


     protected $filters = ['by', 'popular'];
     /**
      * Filter the query by a given username
      * @param $username
      * @r eturn mixed
      * @internal param $builder
      */
     protected function by($username)
     {
         $user = User::where('name', $username)->firstOrFail();

         return $this->builder->where('user_id', $user->id);
     }


     /**
      *
      */
     public function popular()
     {
         $this->builder->getQuery()->orders = [];
         return $this->builder->orderBy('replies_count', 'desc');
     }

 }