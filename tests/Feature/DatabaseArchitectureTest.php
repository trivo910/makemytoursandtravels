<?php

namespace Tests\Feature;

use App\Http\Requests\StoreBookingEnquiryRequest;
use App\Http\Requests\StoreContactEnquiryRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BookingEnquiry;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Role;
use App\Models\Service;
use App\Models\SeoMetadata;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Vehicle;
use Database\Seeders\RoleSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class DatabaseArchitectureTest extends TestCase
{
    use RefreshDatabase;

    public function test_additive_migrations_create_the_content_and_operations_schema(): void
    {
        foreach ([
            'pages',
            'services',
            'vehicles',
            'service_vehicle',
            'testimonials',
            'faqs',
            'blog_categories',
            'blog_posts',
            'seo_metadata',
            'contact_enquiries',
            'booking_enquiries',
            'redirects',
            'roles',
            'role_user',
        ] as $table) {
            $this->assertDatabaseCount($table, 0);
        }

        $this->assertDatabaseHas('migrations', ['migration' => '0001_01_01_000000_create_users_table']);
    }

    public function test_content_relationships_publishing_scopes_and_role_assignment_work(): void
    {
        $page = Page::query()->create([
            'title' => 'About',
            'slug' => 'about',
            'body' => 'Page body',
            'is_published' => true,
        ]);
        $page->seoMetadata()->create([
            'title' => 'About the company',
            'schema_json' => ['@type' => 'AboutPage'],
        ]);
        $this->assertSame('AboutPage', $page->fresh()->seoMetadata->schema_json['@type']);

        $service = Service::query()->create(['name' => 'Bus hire', 'slug' => 'bus-hire']);
        $vehicle = Vehicle::query()->create(['name' => 'Coach', 'slug' => 'coach']);
        $service->vehicles()->attach($vehicle);
        $this->assertTrue($vehicle->services->contains($service));

        $faq = Faq::query()->create([
            'page_id' => $page->id,
            'service_id' => $service->id,
            'question' => 'How do I enquire?',
            'answer' => 'Contact the team.',
            'is_published' => true,
        ]);
        $this->assertTrue($page->faqs->contains($faq));
        $this->assertTrue($service->faqs->contains($faq));

        $this->assertSame(1, Page::published()->count());
        $this->assertSame(1, Faq::published()->count());
        $this->assertSame(0, Testimonial::published()->count());

        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::query()->where('slug', 'admin')->firstOrFail());
        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('editor'));
    }

    public function test_database_seeder_adds_role_catalogue_without_creating_a_default_login(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('roles', ['slug' => 'admin']);
        $this->assertDatabaseHas('roles', ['slug' => 'editor']);
        $this->assertDatabaseMissing('users', ['email' => 'test@example.com']);
    }

    public function test_blog_category_author_and_booking_vehicle_relationships_work(): void
    {
        $author = User::factory()->create();
        $category = BlogCategory::query()->create(['name' => 'Travel', 'slug' => 'travel']);
        $post = BlogPost::query()->create([
            'blog_category_id' => $category->id,
            'author_id' => $author->id,
            'title' => 'Mumbai guide',
            'slug' => 'mumbai-guide',
            'body' => 'Article body',
            'status' => BlogPost::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
        $vehicle = Vehicle::query()->create(['name' => 'Coach', 'slug' => 'coach']);
        $booking = BookingEnquiry::query()->create([
            'name' => 'Customer',
            'phone' => '+91 77180 36300',
            'pickup_location' => 'Mumbai',
            'destination' => 'Thane',
            'travel_date' => now()->addDay()->toDateString(),
            'passenger_count' => 12,
            'vehicle_id' => $vehicle->id,
        ]);

        $this->assertTrue($category->posts->contains($post));
        $this->assertTrue($post->author->is($author));
        $this->assertSame(1, BlogPost::published()->count());
        $this->assertTrue($booking->vehicle->is($vehicle));

        $vehicle->delete();
        $this->assertNull($booking->fresh()->vehicle_id);
    }

    public function test_enquiry_requests_require_valid_contact_and_trip_details(): void
    {
        $contact = Validator::make([], (new StoreContactEnquiryRequest)->rules());
        $this->assertTrue($contact->fails());
        $this->assertArrayHasKey('name', $contact->errors()->toArray());
        $this->assertArrayHasKey('email', $contact->errors()->toArray());

        $booking = Validator::make([
            'name' => 'Customer',
            'phone' => '+91 77180 36300',
            'pickup_location' => 'Mumbai',
            'destination' => 'Thane',
            'travel_date' => now()->addDay()->toDateString(),
            'passenger_count' => 12,
        ], (new StoreBookingEnquiryRequest)->rules());

        $this->assertTrue($booking->passes(), json_encode($booking->errors()->toArray()));

        $invalidBooking = Validator::make([
            'name' => 'Customer',
            'phone' => 'invalid',
            'pickup_location' => 'Mumbai',
            'destination' => 'Thane',
            'travel_date' => now()->subDay()->toDateString(),
            'passenger_count' => 0,
        ], (new StoreBookingEnquiryRequest)->rules());

        $this->assertTrue($invalidBooking->fails());
        $this->assertArrayHasKey('travel_date', $invalidBooking->errors()->toArray());
        $this->assertArrayHasKey('passenger_count', $invalidBooking->errors()->toArray());
        $this->assertArrayHasKey('phone', $invalidBooking->errors()->toArray());
    }
}
