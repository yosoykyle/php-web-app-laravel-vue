<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

// =================================================================================================
// Handler.php (The "Complaint Department" or "Customer Service")
// =================================================================================================
//
// ANALOGY:
// When something goes wrong (an "Exception" is thrown), the application doesn't just crash.
// It sends the problem here. This file decides how to explain the problem to the user
// (e.g., showing a 404 page vs. a 500 server error).
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * ANALOGY: "Redacted Information"
     * When a form fails (e.g., wrong password), we send the user back to the form.
     * But we NEVER want to send back the sensitive stuff they typed (like passwords).
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
