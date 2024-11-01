<?php
namespace App\Interfaces;
use App\Models\Product;
use App\Models\User;

use App\Models\Category;
interface CompareInterface {
    public function addCompare(int $productId);
    public function getCompare();
    public function countCompare();
    public function deleteProductCompare($id);
    static public function isMessageSuccess();
    static public function isMessageFail();
    public function attrProduct($products);
}
?>