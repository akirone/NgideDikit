@extends('layouts.user.app')

@section('content')
    <section id="home" class="hero section position-relative text-white"
        style="background: url('user/img/fyu9.jpg') center/cover no-repeat;">

        <!-- Overlay lembut -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.25); z-index: 1;">
        </div>

        <div class="container position-relative z-2" style="min-height: 88vh; padding-top: 5rem; padding-bottom: 2rem;"
            data-aos="fade-up" data-aos-delay="100">

            <div class="hero-wrapper">
                <div class="row align-items-center g-4">

                    <!-- Kolom Kiri -->
                    <div class="col-lg-7">
                        <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                            <div class="content-header mb-4">
                                <h1 class="display-6 fw-bold text-light text-shadow">
                                    Bosan? Coba Klik dan<br>Temukan Ide Seru!
                                </h1>
                                <p class="lead text-light mb-4">
                                    Dapatkan ide kegiatan ringan, fun, dan spontan untuk mengusir waktu senggang tanpa
                                    tekanan.
                                </p>
                            </div>

                            <div class="search-container mb-3" data-aos="fade-up" data-aos-delay="300"
                                style="background-color: #2b4a2c; padding: 2rem; border-radius: 1rem;">
                                <div class="d-flex justify-content-center flex-wrap gap-3">
                                    <button type="button" id="btnGetIdeas"
                                        class="btn btn-success btn-lg px-4 py-2 fw-semibold shadow-lg hover-scale"
                                        data-aos="fade-right" data-aos-delay="400">
                                        <i class="bi bi-lightbulb"></i> Kasih Aku Ide!
                                    </button>
                                    <a href="/ide"
                                        class="btn btn-primary btn-lg px-4 py-2 fw-semibold shadow-lg hover-scale"
                                        role="button" data-aos="fade-left" data-aos-delay="450">
                                        <i class="bi bi-list-ul"></i> Lihat Contoh Ide
                                    </a>
                                </div>
                            </div>

                            <div class="achievement-grid d-flex flex-wrap justify-content-start gap-3 mt-4"
                                data-aos="fade-up" data-aos-delay="500">
                                <div
                                    class="achievement-item text-center bg-dark bg-opacity-25 p-4 rounded shadow-sm hover-lift">
                                    <div class="achievement-number fs-4 fw-bold text-white">
                                        <span data-purecounter-start="0" data-purecounter-end="1250"
                                            data-purecounter-duration="1" class="purecounter"></span>+
                                    </div>
                                    <span class="achievement-text text-light small">Active Listings</span>
                                </div>
                                <div
                                    class="achievement-item text-center bg-dark bg-opacity-25 p-4 rounded shadow-sm hover-lift">
                                    <div class="achievement-number fs-4 fw-bold text-white">
                                        <span data-purecounter-start="0" data-purecounter-end="89"
                                            data-purecounter-duration="1" class="purecounter"></span>+
                                    </div>
                                    <span class="achievement-text text-light small">Expert Agents</span>
                                </div>
                                <div
                                    class="achievement-item text-center bg-dark bg-opacity-25 p-4 rounded shadow-sm hover-lift">
                                    <div class="achievement-number fs-4 fw-bold text-white">
                                        <span data-purecounter-start="0" data-purecounter-end="96"
                                            data-purecounter-duration="1" class="purecounter"></span>%
                                    </div>
                                    <span class="achievement-text text-light small">Success Rate</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="400">
                        <div class="hero-visual ps-lg-4 mt-3" style="margin-left: 20px;">
                            <div
                                class="visual-container position-relative text-center hover-scale shadow-lg rounded-4 overflow-hidden">
                                <div class="featured-property mb-3">
                                    <img src="user/img/orang_mikir.jpg" alt="Featured Property"
                                        class="img-fluid rounded shadow hover-lift">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <style>
        .text-shadow {
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .hover-scale {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .hero {
            position: relative;
            overflow: hidden;
        }

        .z-2 {
            position: relative;
            z-index: 2;
        }

        /* Responsif padding */
        @media (max-width: 992px) {
            #home .container {
                min-height: 80vh;
                padding-top: 4rem;
            }
        }
    </style>
    <!-- About Section -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="text-center mb-5">
                <span class="badge bg-success-subtle text-success fw-semibold">Tentang</span>
                <h2 class="fw-bold mt-2">Apa itu & Kenapa Harus NgideDikit?</h2>
                <p class="text-secondary mt-2">
                    Platform ide sederhana yang membantu kamu menemukan kegiatan ringan dan seru kapan saja.
                </p>
            </div>

            <div class="row gy-5 align-items-center">
                <!-- Gambar -->
                <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                    <div class="image-gallery shadow-lg rounded overflow-hidden hover-scale position-relative">
                        <img src="user/img/orang_mikir2.jpg" alt="Modern Property" class="img-fluid rounded">
                    </div>
                </div>

                <!-- Konten utama -->
                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                    <div class="content bg-white p-4 rounded shadow-sm hover-lift">
                        <h3 class="fw-bold mb-3">NgideDikit</h3>
                        <p class="text-secondary">
                            NgideDikit adalah web generator ide kegiatan ringan untuk kamu yang sering bingung mau
                            ngapain.
                            Cukup tekan tombol <b>“Kasih Aku Ide!”</b> dan temukan inspirasi baru yang bisa dilakukan
                            kapan saja.
                            Dengan fitur favorit, history, dan statistik sederhana, kamu bisa melacak semua ide yang
                            pernah kamu coba.
                        </p>

                        <h5 class="fw-bold mt-4 mb-3">Kenapa NgideDikit?</h5>

                        <div class="row g-3">
                            <!-- Ide Instan -->
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="card feature-card h-100 border-0 shadow-sm rounded-4 text-center">
                                    <div class="card-body">
                                        <div class="mb-2" style="font-size: 36px;">💡</div>
                                        <h6 class="fw-bold">Ide Instan</h6>
                                        <p class="small text-secondary mt-1">Dapatkan ide cepat tanpa mikir panjang.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sesuai Mood -->
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="card feature-card h-100 border-0 shadow-sm rounded-4 text-center">
                                    <div class="card-body">
                                        <div class="mb-2" style="font-size: 36px;">🎯</div>
                                        <h6 class="fw-bold">Sesuai Mood</h6>
                                        <p class="small text-secondary mt-1">Filter ide berdasarkan suasana hati dan
                                            waktu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .hover-scale {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Call To Action Section -->
    <section class="call-to-action-1 call-to-action section" id="contact">
        <div class="cta-bg" style="background-image: url('user/img/real-estate/showcase-3.webp');"></div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">

                    <div class="cta-content text-center">
                        <h2>Hubungi Saja</h2>

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

                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Modal untuk menampilkan beberapa ide -->
    <div class="modal fade" id="ideasModal" tabindex="-1" aria-labelledby="ideasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="ideasModalLabel">
                        <i class="bi bi-lightbulb-fill"></i> Ide Seru Untukmu!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="ideasContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Mencari 5 ide seru untuk kamu...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" id="btnRefreshIdeas">
                        <i class="bi bi-arrow-repeat"></i> Muat Ide Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ideasModal = new bootstrap.Modal(document.getElementById('ideasModal'));
            const btnGetIdeas = document.getElementById('btnGetIdeas');
            const btnRefreshIdeas = document.getElementById('btnRefreshIdeas');

            // Event klik button "Kasih Aku Ide!"
            btnGetIdeas.addEventListener('click', function() {
                ideasModal.show();
                fetchMultipleIdeas();
            });

            // Event klik button refresh di modal
            btnRefreshIdeas.addEventListener('click', function() {
                fetchMultipleIdeas();
            });

            // Fungsi untuk fetch beberapa ide sekaligus dari Bored API
            function fetchMultipleIdeas() {
                showLoading();

                // Fetch dari route local kita (backend proxy)
                fetch('/api/bored-ideas')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayIdeas(data.ideas);
                        } else {
                            showError(data.message || 'Gagal mengambil ide dari Bored API');
                        }
                    })
                    .catch(error => {
                        showError('Gagal mengambil ide dari Bored API. Silakan coba lagi.');
                        console.error('Error:', error);
                    });
            }

            // Tampilkan loading
            function showLoading() {
                document.getElementById('ideasContent').innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Mencari 5 ide seru untuk kamu...</p>
                    </div>
                `;
            }

            // Tampilkan ide-ide
            function displayIdeas(ideas) {
                let html = '<div class="row g-3">';

                ideas.forEach((idea, index) => {
                    const priceLabel = getPriceLabel(idea.price);
                    const accessLabel = getAccessibilityLabel(idea.accessibility);
                    const typeIcon = getTypeIcon(idea.type);

                    html += `
                        <div class="col-12">
                            <div class="card shadow-sm hover-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">
                                            <span class="badge bg-success me-2">#${index + 1}</span>
                                            ${idea.activity_id || idea.activity}
                                        </h5>
                                        <span style="font-size: 1.5rem;">${typeIcon}</span>
                                    </div>
                                    ${idea.activity_id !== idea.activity ? `
                                            <div class="mb-2">
                                                <small class="text-muted fst-italic">Original: ${idea.activity}</small>
                                            </div>
                                        ` : ''}
                                    <div class="row g-2 mt-2">
                                        <div class="col-6 col-md-3">
                                            <small class="text-muted d-block">Kategori</small>
                                            <strong>${idea.type_id || capitalizeFirst(idea.type)}</strong>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <small class="text-muted d-block">Peserta</small>
                                            <strong>${idea.participants} orang</strong>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <small class="text-muted d-block">Harga</small>
                                            <strong>${priceLabel}</strong>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <small class="text-muted d-block">Aksesibilitas</small>
                                            <strong>${accessLabel}</strong>
                                        </div>
                                    </div>
                                    ${idea.link ? `
                                                <div class="mt-2">
                                                    <a href="${idea.link}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-link-45deg"></i> Info Lebih
                                                    </a>
                                                </div>
                                            ` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                });

                html += '</div>';
                document.getElementById('ideasContent').innerHTML = html;
            }

            // Tampilkan error
            function showError(message) {
                document.getElementById('ideasContent').innerHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                        <p class="mt-3 text-danger">${message}</p>
                    </div>
                `;
            }

            // Helper functions
            function capitalizeFirst(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            function getPriceLabel(price) {
                if (price === 0) return '💰 Gratis';
                if (price < 0.3) return '💰 Murah';
                if (price < 0.6) return '💰💰 Sedang';
                return '💰💰💰 Mahal';
            }

            function getAccessibilityLabel(accessibility) {
                if (accessibility < 0.3) return '⭐ Mudah';
                if (accessibility < 0.6) return '⭐⭐ Sedang';
                return '⭐⭐⭐ Sulit';
            }

            function getTypeIcon(type) {
                const icons = {
                    'education': '📚',
                    'recreational': '🎮',
                    'social': '👥',
                    'diy': '🔨',
                    'charity': '❤️',
                    'cooking': '🍳',
                    'relaxation': '🧘',
                    'music': '🎵',
                    'busywork': '📋'
                };
                return icons[type] || '✨';
            }
        });
    </script>

    <style>
        .hover-card {
            transition: all 0.3s ease;
            border-left: 4px solid #28a745;
        }

        .hover-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
            border-left-color: #20c997;
        }
    </style>

    </main>
@endsection
