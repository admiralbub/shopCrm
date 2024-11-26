<?php

namespace App\Actions\Feedback;
use App\Models\Feedback;
class FeedbackAction
{
    /**
     * Create a new class instance.
     */
    public function execute($request,$id): Feedback
    {
        $feedback = Feedback::create([
            'user_name'=>$request->name,
            'email'=>$request->email,
            'product_id'=>$id,
            'comment'=>$request->comment,
            'rating'=>$request->rating,
        ]);
        
        return $feedback;
        
    }
}