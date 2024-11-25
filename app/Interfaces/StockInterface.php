<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\Stock;
interface StockInterface {
    public function showStockAll();
    public function showStockOne($slug) : Stock;
    public function showStockProduct(Stock $stock);
}
?>