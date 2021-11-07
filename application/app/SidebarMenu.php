<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidebarMenu extends Model
{
    public function self_menu() {
        return $this->hasMany(SidebarMenu::class,'preference','id');
    }
}
