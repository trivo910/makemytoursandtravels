<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingEnquiryRequest;
use App\Mail\BookingEnquiryReceived;
use App\Models\BookingEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class BookingEnquiryController extends Controller
{
    public function store(StoreBookingEnquiryRequest $request): RedirectResponse
    {
        $enquiry = BookingEnquiry::query()->create([
            ...$request->safe()->except('website'),
            'status' => BookingEnquiry::STATUS_NEW,
        ]);

        try {
            Mail::to(config('mail.booking_to'))->send(new BookingEnquiryReceived($enquiry));
        } catch (TransportExceptionInterface $exception) {
            Log::error('Booking enquiry notification could not be delivered.', [
                'booking_enquiry_id' => $enquiry->id,
                'exception_class' => $exception::class,
                'exception_code' => $exception->getCode(),
            ]);

            return redirect()->to(route('home').'#booking-form')
                ->withInput()
                ->with('booking_error', 'Your enquiry was saved, but we could not send the email notification. Please call us to confirm your request.')
                ->with('booking_saved', true);
        }

        return redirect()->to(route('home').'#booking-form')
            ->with('booking_success', 'Thank you. Your trip enquiry has been received, and our team will contact you shortly.');
    }
}
