<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaystackWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verify the signature from Paystack to ensure the request is legitimate
        $signature = $request->header('x-paystack-signature');
        $secretKey = env('PAYSTACK_KEY'); // Your Paystack secret key

        if ($this->isValidSignature($request->getContent(), $signature, $secretKey)) {
            // Handle the webhook event based on Paystack's documentation
            $event = json_decode($request->getContent());

            // You can access the event data using $event->data

            // Example: Log the event
            \Log::info('Received Paystack webhook event: ' . $event->event);

            // Example: Update your database or perform other actions based on the event

            return response()->json(['message' => 'Webhook received'], 200);
        }

        // If the signature is not valid, reject the request
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    private function isValidSignature($payload, $signature, $secretKey)
    {
        $expected = hash_hmac('sha512', $payload, $secretKey);

        return hash_equals($expected, $signature);
    }
}
