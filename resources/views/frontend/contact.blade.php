@extends('frontend.layout')

@section('title', 'Contact US')
@section('content')

<div class="container mt-5">
    <h1>Contact Us</h1>
    <p class="mb-4">Have a question or need assistance? Reach out to us using the form below or the contact details provided.</p>

    <div class="row">
        <!-- Contact Info -->
        <div class="col-md-6 mb-4">
            <h4>Our Office</h4>
            <p><strong>Car Rental Service Ltd.</strong></p>
            <p>123 Main Street, Dhaka 1000, Bangladesh</p>
            <p>Phone: +880 1234-567890</p>
            <p>Email: support@carrental.com</p>
            <p>Opening Hours: Mon - Sat: 9am - 6pm</p>
        </div>

        <!-- Contact Form -->
        <div class="col-md-6">
            <h4>Send a Message</h4>
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Type your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
