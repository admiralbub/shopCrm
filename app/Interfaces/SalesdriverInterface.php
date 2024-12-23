<?php
namespace App\Interfaces;
use App\Models\Order;
interface SalesdriverInterface {
    public function addOrderinCrm($orderId);
}