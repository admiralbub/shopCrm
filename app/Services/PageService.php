<?php
namespace App\Services;
 
use App\Interfaces\PageInterface;

use App\Models\Page; 
use App\Models\Product; 

class PageService implements PageInterface {
    public function getPage($slug) : Page {
        return Page::where('url',$slug)->available()->first() 
            ? Page::where('url',$slug)->available()->first() 
            : abort(404) ;
    }
}

?>