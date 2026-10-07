<h1>New website trip enquiry</h1>

<p><strong>Enquiry reference:</strong> {{ $enquiry->id }}</p>
<p><strong>Name:</strong> {{ $enquiry->name }}</p>
<p><strong>Phone:</strong> {{ $enquiry->phone ?: 'Not provided' }}</p>
<p><strong>Email:</strong> {{ $enquiry->email ?: 'Not provided' }}</p>
<p><strong>Pickup:</strong> {{ $enquiry->pickup_location }}</p>
<p><strong>Destination:</strong> {{ $enquiry->destination }}</p>
<p><strong>Travel date:</strong> {{ $enquiry->travel_date->format('d M Y') }}</p>
<p><strong>Pickup time:</strong> {{ $enquiry->pickup_time?->format('H:i') ?? 'Not specified' }}</p>
<p><strong>Passengers:</strong> {{ $enquiry->passenger_count }}</p>
<p><strong>Vehicle preference:</strong> {{ $enquiry->vehicle_type ?: 'No preference specified' }}</p>
<p><strong>Additional details:</strong><br>{{ $enquiry->message ?: 'None' }}</p>
