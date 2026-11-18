<?php

use App\Http\Controllers\Api\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::apiResource('feedbacks', FeedbackController::class);