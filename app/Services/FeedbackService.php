<?php
namespace App\Services;
 
use App\Interfaces\FeedbackInterface;
use App\Models\Feedback;
use App\Actions\Feedback\FeedbackAction;


class FeedbackService implements FeedbackInterface {
    public function addFeedback($request,$id) {
        return (new FeedbackAction())->execute($request,$id);
    }
    public function listFeedback($id) {
        return Feedback::where('product_id',$id)->available()->get();
    }
  

}