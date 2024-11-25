<?php
namespace App\Services;
 
use App\Interfaces\StockInterface;
use App\Models\User;
use App\Models\Product; 
use App\Models\Stock;
use Illuminate\Pagination\LengthAwarePaginator;
    


class StockService implements StockInterface {
    public const PAGE_COUNT = 22;
    public function showStockAll() {
        return Stock::available()->orderBy('id','DESC')->paginate(self::PAGE_COUNT);
    }
    public function showStockOne($slug) : Stock {
        return Stock::available()
        ->where('slug', $slug)
        ->firstOrFail();
    }
    public function showStockProduct(Stock $stock) {
        return $stock->products()
            // ->onlyCurrLang()
            ->published()
            ->paginate(self::PAGE_COUNT);
    }
}

?>