<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CompareInterface;
class CompareController extends Controller
{
    private $compare;
    public function __construct(CompareInterface $compare) {
        $this->compare = $compare;
    }

    public function __invoke() {
        $products = $this->compare->getCompare();
        $attrs = $this->compare->attrProduct($products);
        return view('compare.compare',['products'=>$products,'attrs'=>$attrs]);
    }
    public function add(Request $request) {
        $compare = $this->compare->addCompare($request->id);
        if($compare == true) {
            $message = $this->compare->isMessageSuccess();
        } else {
            $message = $this->compare->isMessageFail();
        }
        return ["mess"=>$message];
    }
    public function delete($id) {
        return  $this->compare->deleteProductCompare($id);
    }
    public function count() {
        return ["count"=>$this->compare->countCompare()];
    }
}
