<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Interfaces\FeedbackInterface;
class FeedbackController extends Controller
{
    public $feedback;
    public function __construct(FeedbackInterface $feedback)
    {
        $this->feedback = $feedback;
    }
    public function store(FeedbackRequest $request,$id) {
        $this->feedback->addFeedback($request,$id);
        return response()->json([
            'success'=>  __('Thank you for your feedback. Your review will be published within this hour.'),
            'redirect' => route('product.view',['slug'=>$request->slug])
        ]);
    }
}
