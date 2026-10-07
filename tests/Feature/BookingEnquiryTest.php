<?php

namespace Tests\Feature;

use App\Mail\BookingEnquiryReceived;
use App\Models\BookingEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Exception\TransportException;
use Tests\TestCase;

class BookingEnquiryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('mail.booking_to', 'bookings@example.test');
        Mail::fake();
    }

    public function test_valid_trip_enquiry_is_stored_and_notification_is_sent(): void
    {
        $this->from('/')
            ->post(route('booking-enquiries.store'), $this->validEnquiry())
            ->assertRedirect(route('home').'#booking-form')
            ->assertSessionHas('booking_success');

        $this->assertDatabaseCount('booking_enquiries', 1);
        $this->assertDatabaseHas('booking_enquiries', [
            'name' => 'Asha Rao',
            'phone' => '+91 98765 43210',
            'pickup_location' => 'Mumbai Central',
            'destination' => 'Gateway of India',
            'passenger_count' => 8,
            'vehicle_type' => 'tempo_traveller',
            'status' => BookingEnquiry::STATUS_NEW,
        ]);

        Mail::assertSent(BookingEnquiryReceived::class, function (BookingEnquiryReceived $mail): bool {
            return $mail->hasTo('bookings@example.test')
                && $mail->enquiry->name === 'Asha Rao'
                && $mail->enquiry->vehicle_type === 'tempo_traveller';
        });
    }

    public function test_invalid_and_empty_submissions_are_not_stored_or_emailed(): void
    {
        $this->from('/')
            ->post(route('booking-enquiries.store'), [
                ...$this->validEnquiry(),
                'travel_date' => now()->subDay()->toDateString(),
                'passenger_count' => 0,
                'phone' => 'not a phone number',
                'vehicle_type' => 'unlisted_vehicle',
            ])
            ->assertRedirect('/')
            ->assertSessionHasErrors(['travel_date', 'passenger_count', 'phone', 'vehicle_type']);

        $this->from('/')
            ->post(route('booking-enquiries.store'), [])
            ->assertRedirect('/')
            ->assertSessionHasErrors(['name', 'phone', 'pickup_location', 'destination', 'travel_date', 'passenger_count']);

        $this->assertDatabaseCount('booking_enquiries', 0);
        Mail::assertNothingSent();
    }

    public function test_honeypot_rejects_automated_submission_without_persisting_or_emailing(): void
    {
        $this->from('/')
            ->post(route('booking-enquiries.store'), [...$this->validEnquiry(), 'website' => 'spam'])
            ->assertRedirect('/')
            ->assertSessionHasErrors('website');

        $this->assertDatabaseCount('booking_enquiries', 0);
        Mail::assertNothingSent();
    }

    public function test_rate_limit_rejects_excess_submissions(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('booking-enquiries.store'), $this->validEnquiry())->assertRedirect(route('home').'#booking-form');
        }

        $this->post(route('booking-enquiries.store'), $this->validEnquiry())->assertTooManyRequests();
        $this->assertDatabaseCount('booking_enquiries', 5);
        Mail::assertSent(BookingEnquiryReceived::class, 5);
    }

    public function test_notification_delivery_failure_is_reported_without_losing_the_saved_enquiry(): void
    {
        Mail::shouldReceive('to')
            ->once()
            ->with('bookings@example.test')
            ->andThrow(new TransportException('Mail transport unavailable.'));

        $this->post(route('booking-enquiries.store'), $this->validEnquiry())
            ->assertRedirect(route('home').'#booking-form')
            ->assertSessionHas('booking_saved', true)
            ->assertSessionHas('booking_error');

        $this->assertDatabaseCount('booking_enquiries', 1);
    }

    public function test_booking_form_has_csrf_field_and_post_route_uses_web_middleware(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('name="_token"', false)
            ->assertSee('name="phone"', false)
            ->assertSee('required', false)
            ->assertSee('name="website"', false);

        $middleware = Route::getRoutes()->getByName('booking-enquiries.store')->gatherMiddleware();
        $this->assertContains('web', $middleware);
        $this->assertContains('throttle:5,10', $middleware);
    }

    /**
     * @return array<string, int|string>
     */
    private function validEnquiry(): array
    {
        return [
            'name' => 'Asha Rao',
            'phone' => '+91 98765 43210',
            'email' => 'asha@example.test',
            'pickup_location' => 'Mumbai Central',
            'destination' => 'Gateway of India',
            'travel_date' => now()->addDays(5)->toDateString(),
            'pickup_time' => '09:30',
            'passenger_count' => 8,
            'vehicle_type' => 'tempo_traveller',
            'message' => 'One luggage stop requested.',
        ];
    }
}
