<?php
namespace App\Interfaces;
use App\Models\Page;
interface PageInterface {
   public function getPage($slug) : Page;

}

?>