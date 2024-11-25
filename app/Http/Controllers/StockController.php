<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\StockInterface;
use App\Models\Stock;
use App\Breadcrumbs\Breadcrumb;
class StockController extends Controller
{
    public $stock;
    public function __construct(StockInterface $stock, Breadcrumb $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->stock = $stock;
    }
    public function __invoke() {
        $stocks = $this->stock->showStockAll();
        $lang = "";    
        if(app()->getLocale() == 'ua') {
            $lang = 'uk';
        } elseif(app()->getLocale() == 'ru') { 
            $lang = 'ru';
        }


        $bread = [
            "name"=>__("Stocks"),
            "route"=>"stock.index"
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        return view('stock.index',[
            'stocks'=>$stocks,
            'lang'=>$lang,
            'breadcrumbs'=>$breadcrumbs,
        ]);
    }

    public function showStock($slug) {
        $stock = $this->stock->showStockOne($slug);
        $products = $this->stock->showStockProduct($stock);
        $bread = [
            "name"=>$stock->name,
            "slug"=>$stock->slug,
            "route"=>"stock.show",
            "parent" => [
                "name"=>__("Stocks"),
                "route"=>"stock.index"
            ],
            
            
        ];
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        $lang = "";    
        if(app()->getLocale() == 'ua') {
            $lang = 'uk';
        } elseif(app()->getLocale() == 'ru') { 
            $lang = 'ru';
        }
        return view('stock.show',[
            'stock'=>$stock,
            'lang'=>$lang,
            'products'=>$products,
            'breadcrumbs'=>$breadcrumbs,
        ]);
    }
}
