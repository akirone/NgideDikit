@extends('layouts.user.app')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="home" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="hero-wrapper">
                    <div class="container">
                        <div class="row align-items-center g-4">

                            <!-- Kiri: Teks + Tombol + Statistik -->
                            <div class="col-lg-7">
                                <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="content-header mb-4">
                                        <h1 class="display-5 fw-bold">Bosan? Coba Klik dan<br>Temukan Ide Seru!</h1>
                                        <p>Dapatkan ide kegiatan ringan, fun, dan spontan untuk mengusir waktu senggang
                                            tanpa tekanan.</p>
                                    </div>

                                    <div class="search-container mb-4" data-aos="fade-up" data-aos-delay="300">
                                        <div class="d-flex justify-content-center flex-wrap gap-4">
                                            <a class="btn btn-success btn-lg px-4 py-2 fw-semibold" href="/ide"
                                                role="button">Kasih Aku Ide!</a>
                                            <a class="btn btn-primary btn-lg px-4 py-2 fw-semibold"
                                                href="https://bored-api.appbrewery.com/" role="button">Lihat Contoh Ide</a>
                                        </div>
                                    </div>

                                    <div class="achievement-grid" data-aos="fade-up" data-aos-delay="300">
                                        <div class="achievement-item">
                                            <div class="achievement-number">
                                                <span data-purecounter-start="0" data-purecounter-end="1250"
                                                    data-purecounter-duration="1" class="purecounter"></span>+
                                            </div>
                                            <span class="achievement-text">Active Listings</span>
                                        </div>
                                        <div class="achievement-item">
                                            <div class="achievement-number">
                                                <span data-purecounter-start="0" data-purecounter-end="89"
                                                    data-purecounter-duration="1" class="purecounter"></span>+
                                            </div>
                                            <span class="achievement-text">Expert Agents</span>
                                        </div>
                                        <div class="achievement-item">
                                            <div class="achievement-number">
                                                <span data-purecounter-start="0" data-purecounter-end="96"
                                                    data-purecounter-duration="1" class="purecounter"></span>%
                                            </div>
                                            <span class="achievement-text">Success Rate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="hero-visual ps-lg-4" data-aos="fade-left" data-aos-delay="400"
                                    style="margin-left: 20px;">
                                    <div class="visual-container position-relative text-center">
                                        <div class="featured-property mb-3">
                                            <img src="user/img/blog/images.png" alt="Featured Property"
                                                class="img-fluid rounded shadow">
                                        </div>

                                        <div class="overlay-images position-absolute top-0 start-0 w-100 h-100">
                                            <div class="overlay-img overlay-1 position-absolute"
                                                style="top: 10%; left: -8%; width: 40%;">
                                                <img src="user/img/real-estate/property-interior-4.webp" alt="Interior View"
                                                    class="img-fluid rounded shadow">
                                            </div>
                                            <div class="overlay-img overlay-2 position-absolute"
                                                style="bottom: 10%; right: -8%; width: 40%;">
                                                <img src="user/img/real-estate/property-exterior-2.webp" alt="Exterior View"
                                                    class="img-fluid rounded shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Bagian Fitur Dipindah Ke Atas dan Didekatkan -->
                        <section class="features pt-4 pb-5 bg-light rounded shadow-sm" data-aos="fade-up"
                            data-aos-delay="300">
                            <div class="container-fluid px-5">
                                <h2 class="mb-5 fw-bold text-center">Kenapa NgideDikit?</h2>

                                <div class="row g-4 justify-content-center">
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                                        <div class="card h-100 shadow-sm" style="background-color: #fff6d6;">
                                            <div class="card-body text-center">
                                                <div class="mb-3" style="font-size: 40px;">💡</div>
                                                <h5 class="fw-bold">Ide Instan</h5>
                                                <p class="mt-2">Dapatkan ide cepat tanpa mikir</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                                        <div class="card h-100 shadow-sm" style="background-color: #e6f4ff;">
                                            <div class="card-body text-center">
                                                <div class="mb-3" style="font-size: 40px;">🎯</div>
                                                <h5 class="fw-bold">Sesuai Mood</h5>
                                                <p class="mt-2">Filter sesuai mood dan waktu luang</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="600">
                                        <div class="card h-100 shadow-sm" style="background-color: #fff2e6;">
                                            <div class="card-body text-center">
                                                <div class="mb-3" style="font-size: 40px;">📊</div>
                                                <h5 class="fw-bold">Lacak Aktivitas</h5>
                                                <p class="mt-2">Lihat history dan statistik sederhana</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>


            </div>

        </section>

        <!-- Home About Section -->
        <section id="tentang" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">

                    <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                        <div class="image-gallery">
                            <div class="primary-image">
                                <img src="user/img/real-estate/property-exterior-1.webp" alt="Modern Property"
                                    class="img-fluid">
                                {{-- <div class="experience-badge">
                                    <div class="badge-content">
                                        <div class="number"><span data-purecounter-start="0" data-purecounter-end="15"
                                                data-purecounter-duration="1" class="purecounter"></span>+</div>
                                        <div class="text">Years<br>Experience</div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="secondary-image">
                                <img src="user/img/real-estate/property-interior-4.webp" alt="Luxury Interior"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                        <div class="content">
                            <div class="section-header">
                                <span class="section-label">Tentang</span>
                                <h2 class="fw-bold">Apa itu Web NgideDikit?</h2>
                            </div>

                            <p>NgideDikit, sebuah web generator ide kegiatan ringan untuk pemuda yang sering bosan, berisi
                                penjelasan masalah scrolling tanpa tujuan,
                                solusi tombol “Kasih Aku Ide!”, filter kategori, history, favorit, dan statistik profil,
                                contoh ide, target pengguna, serta usulan teknologi Laravel, Blade, MySQL dengan tujuan
                                meningkatkan kreativitas dan mengurangi waktu pasif,
                                dokumen solid sebagai konsep awal tapi asumsi tentang penyebab kebosanan dan cara
                                mempertahankan pengguna belum divalidasi, jadi sebaiknya dimulai dengan MVP sederhana dan
                                pengujian pengguna.</p>

                            {{-- <div class="achievements-list">
                                <div class="achievement-item">
                                    <div class="achievement-icon">
                                        <i class="bi bi-house-door"></i>
                                    </div>
                                    <div class="achievement-content">
                                        <h4><span data-purecounter-start="0" data-purecounter-end="3200"
                                                data-purecounter-duration="2" class="purecounter"></span>+ Properties Sold
                                        </h4>
                                        <p>Successfully completed transactions</p>
                                    </div>
                                </div>
                                <div class="achievement-item">
                                    <div class="achievement-icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="achievement-content">
                                        <h4><span data-purecounter-start="0" data-purecounter-end="98"
                                                data-purecounter-duration="1" class="purecounter"></span>% Client
                                            Satisfaction</h4>
                                        <p>Happy customers recommend us</p>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="action-section">
                                <a href="#" class="btn-cta">
                                    <span>Discover Our Story</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                <div class="contact-info">
                                    <div class="contact-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <span>Call us today</span>
                                        <strong>+1 (555) 123-4567</strong>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Home About Section -->

        <!-- Call To Action Section -->
        <section class="call-to-action-1 call-to-action section" id="contact">
            <div class="cta-bg" style="background-image: url('user/img/real-estate/showcase-3.webp');"></div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">

                        <div class="cta-content text-center">
                            <h2>Hubungi Saja</h2>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p> --}}

                            <div class="cta-buttons">
                                <a href="#" class="btn btn-primary">Contact Us Today</a>
                                <a href="#" class="btn btn-outline">Schedule a Call</a>
                            </div>

                            <div class="cta-features">
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>Free Consultation</span>
                                </div>
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="250">
                                    <i class="bi bi-clock-fill"></i>
                                    <span>24/7 Support</span>
                                </div>
                                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-shield-check-fill"></i>
                                    <span>Trusted Experts</span>
                                </div>
                            </div>

                        </div><!-- End CTA Content -->

                    </div>
                </div>

            </div>
        </section><!-- /Call To Action Section -->

    </main>
@endsection
