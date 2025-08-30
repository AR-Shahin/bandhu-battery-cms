@extends("layouts.front_app")

@section("title","Donate")
@section("master_content")

<main>
    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Donate</h3>
                        <ol>
                            <li><a class="text-light" href="/">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Donate</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-04">
        <div class="container text-center">
        <p class="text-justify">
            আমাদের সমাজের প্রত্যেকটি মানুষের কল্যাণের জন্য কাজ করছি। আপনার সাহায্যে আমরা শীতবস্ত্র, খাদ্য, শিক্ষা, এবং স্বাস্থ্যসেবার মাধ্যমে অগণিত মানুষের জীবনকে স্পর্শ করতে পারি। দান করে আজই আমাদের মানবিক প্রচেষ্টায় যোগ দিন এবং একটি ভালো আগামী তৈরি করতে সাহায্য করুন। আপনার দান সমাজের পরিবর্তনের একটি মাইলফলক হতে পারে।
        </p>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="" class="text-left">
                            <x-form.input label="Name" type="text" name="name" placeholder="Enter your name" id="name"/>
                            <x-form.input label="Email" type="email" name="email" placeholder="Enter your email" id="email"/>
                            <x-form.input label="Phone" type="phone" name="phone" placeholder="Enter your phone" id="phone"/>
                            <x-form.input label="Address" type="text" name="address" placeholder="Enter your address" id="address"/>
                            <x-form.input label="Amount" type="number" name="amount" placeholder="Enter your amount" id="amount"/>
                            <x-form.submit text="Pay Now"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </section>
</main>
@stop
