<style>
    .content-section {
        background-color: #F9FBFD;
        padding: 40px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .ratings-row {
        display: flex;
        justify-content: space-around; /* লোগোগুলোর মাঝে সমান গ্যাপ রাখবে */
        align-items: center;
        flex-wrap: nowrap;
        gap: 20px;
    }

    .ratings-row > div {
        flex: 1;
        text-align: center;
    }

    .rating-logo {
        height: 80px; /* লোগোর হাইট কিছুটা স্ট্যান্ডার্ড করা হয়েছে */
        max-width: 100%;
        object-fit: contain;
        transition: all 0.3s ease;
        filter: grayscale(20%); /* স্লাইটলি প্রিমিয়াম লুকের জন্য */
    }

    .rating-logo:hover {
        transform: translateY(-5px); /* স্কেল না করে উপরে সামান্য ওঠার ইফেক্ট */
        filter: grayscale(0%);
    }

    /* -------- Mobile / Tablet -------- */
    @media (max-width: 768px) {
        .content-section {
            padding: 25px 0;
        }

        .ratings-row {
            gap: 10px;
            padding: 0 10px;
        }

        .rating-logo {
            height: 50px; /* মোবাইলে লোগো সাইজ অপ্টিমাইজড */
            width: auto;
        }
    }

    /* Extra small devices */
    @media (max-width: 480px) {
        .ratings-row {
            gap: 5px;
        }

        .rating-logo {
            height: 40px; /* খুব ছোট স্ক্রিনের জন্য */
        }
    }
</style>

<section class="content-section">
    <div class="container">
        <div class="ratings-row">

            <div>
                <a href="https://www.google.com/search?q=Boston+Express+Cab" target="_blank">
                    <img src="{{ asset('images/logo.png') }}" alt="Google Rating" class="rating-logo">
                </a>
            </div>

            <div>
                <a href="https://www.trustpilot.com/review/bostonexpresscab.com" target="_blank">
                    <img src="{{ asset('images/logo.png') }}" alt="Trustpilot" class="rating-logo">
                </a>
            </div>

            <div>
                <a href="https://limotrust.org/listing/boston-express-cab-60" target="_blank">
                    <img src="{{ asset('images/logo.png') }}" alt="Limotrust" class="rating-logo">
                </a>
            </div>

            <div>
                <a href="https://www.tripadvisor.com/Attraction_Review-g41948-d28108453-Reviews-Boston_Express_Cab-Woburn_Massachusetts.html" target="_blank">
                    <img src="{{ asset('images/logo.png') }}" alt="Tripadvisor" class="rating-logo">
                </a>
            </div>

        </div>
    </div>
</section>
