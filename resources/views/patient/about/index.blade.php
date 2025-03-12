@extends('layouts.patient')

@section('title', 'About Us')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>About Us</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Our Story</h3>
                    <p class="card-text">
                        Founded in 2010, our clinic has been providing quality healthcare services to our community for over a decade. 
                        We believe in patient-centered care and strive to make healthcare accessible and comfortable for everyone.
                    </p>
                    <p class="card-text">
                        Our team of experienced doctors and healthcare professionals are committed to excellence in medical care. 
                        We use the latest medical technologies and practices to ensure the best outcomes for our patients.
                    </p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Our Mission</h3>
                    <p class="card-text">
                        Our mission is to provide compassionate, high-quality healthcare services to improve the health and well-being of our patients.
                        We are dedicated to treating each patient with respect, dignity, and personalized attention.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Our Values</h3>
                    <ul class="list-unstyled">
                        <li><strong>Excellence:</strong> We strive for excellence in all aspects of our service.</li>
                        <li><strong>Compassion:</strong> We treat each patient with care and empathy.</li>
                        <li><strong>Integrity:</strong> We uphold the highest ethical standards in our practice.</li>
                        <li><strong>Innovation:</strong> We continuously seek to improve and adopt new medical advancements.</li>
                        <li><strong>Accessibility:</strong> We ensure our services are accessible to all members of our community.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Contact Us</h3>
                </div>
                <div class="card-body">
                    <h5>Clinic Address</h5>
                    <p>
                        123 Healthcare Avenue<br>
                        Medical District, City<br>
                        Country, 12345
                    </p>

                    <h5>Phone</h5>
                    <p>
                        <i class="fas fa-phone-alt"></i> (123) 456-7890<br>
                        <i class="fas fa-fax"></i> (123) 456-7891
                    </p>

                    <h5>Email</h5>
                    <p>
                        <i class="fas fa-envelope"></i> info@yourclinic.com<br>
                        <i class="fas fa-envelope"></i> support@yourclinic.com
                    </p>

                    <h5>Hours of Operation</h5>
                    <p>
                        Monday - Friday: 8:00 AM - 6:00 PM<br>
                        Saturday: 9:00 AM - 2:00 PM<br>
                        Sunday: Closed
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Emergency Contact</h5>
                    <p class="card-text">
                        For medical emergencies, please call:<br>
                        <strong class="text-danger">(123) 999-9999</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection