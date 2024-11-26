<?php
namespace App\Interfaces;
use App\Models\Feedback;
use App\Models\User;
interface FeedbackInterface {
    public function addFeedback($request,$id);
    public function listFeedback($id);
    
}
?>