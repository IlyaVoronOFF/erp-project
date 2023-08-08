<?php

namespace App\Filters;

class ObjectFilter extends QueryFilter
{
   public function status_id($id = null)
   {
      return $this->builder->when($id, function ($query) use ($id) {
         $query->whereIn('archive', $this->paramToArray($id));
      });
   }
}