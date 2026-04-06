<style>
    .service-hero,
    .location-hero { min-height: 420px; }
    .hero-image { object-fit: cover; position: absolute; inset: 0; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(110deg, rgba(7, 16, 34, 0.88), rgba(23, 77, 160, 0.55), rgba(8, 121, 152, 0.4)); }
    .hero-title { font-size: clamp(1.8rem, 3.5vw, 2.9rem); font-weight: 700; line-height: 1.2; }
    .hero-pill { background: linear-gradient(135deg, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0.14)); border: 1px solid rgba(255, 255, 255, 0.35); border-radius: 999px; padding: .48rem .9rem; font-size: .92rem; color: #fff; box-shadow: 0 6px 18px rgba(6, 10, 20, 0.22); backdrop-filter: blur(4px); }

    .content-card { background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%); border: 1px solid #e4ebf7; border-radius: 16px; padding: 1.5rem; box-shadow: 0 14px 34px rgba(20, 33, 61, 0.07); }
    .detail-wide { max-width: 1800px; padding-left: clamp(14px, 3vw, 48px); padding-right: clamp(14px, 3vw, 48px); }
    .section-title { font-size: clamp(1.25rem, 2vw, 1.6rem); font-weight: 700; color: #0f2343; letter-spacing: .2px; }
    .amenity-box { display: flex; align-items: center; gap: .55rem; padding: .8rem .85rem; border-radius: 12px; background: linear-gradient(135deg, #eef6ff, #f4fbff); border: 1px solid #d8e8ff; font-weight: 600; color: #15355b; box-shadow: inset 0 1px 0 rgba(255,255,255,0.8); }
    .amenity-box i { color: #0b66d0; font-size: 1rem; }

    .styled-list { list-style: none; padding: 0; margin: 0; }
    .styled-list li { position: relative; padding-left: 1.6rem; margin-bottom: .7rem; color: #344054; line-height: 1.65; }
    .styled-list li::before { content: ""; width: 8px; height: 8px; border-radius: 50%; background: #0d6efd; box-shadow: 0 0 0 3px #e7f0ff; position: absolute; left: .2rem; top: .62rem; }
    .styled-list-success li::before { background: #198754; }
    .styled-list-danger li::before { background: #dc3545; }

    .prose-content { color: #344054; font-size: 1.02rem; line-height: 1.85; }
    .prose-content h1, .prose-content h2, .prose-content h3, .prose-content h4 { color: #14213d; margin-top: 1.3rem; margin-bottom: .8rem; font-weight: 700; line-height: 1.35; }
    .prose-content p { margin-bottom: 1rem; }
    .prose-content ul, .prose-content ol { padding-left: 1.2rem; margin-bottom: 1rem; }
    .prose-content li { margin-bottom: .45rem; }
    .prose-content img { width: 100%; height: auto; border-radius: 12px; margin: .8rem 0; }

    .timeline-list { list-style: none; padding: 0; margin: 0; }
    .timeline-list li { position: relative; padding: 0 0 1rem 1.5rem; color: #344054; line-height: 1.7; }
    .timeline-list li::before { content: ""; position: absolute; left: .25rem; top: .4rem; width: 9px; height: 9px; border-radius: 50%; background: #fd7e14; }
    .timeline-list li::after { content: ""; position: absolute; left: .55rem; top: 1rem; bottom: 0; width: 1px; background: #e3e7ee; }
    .timeline-list li:last-child::after { display: none; }
    .timeline-badges .day-pill { display: inline-block; margin-right: .55rem; margin-bottom: .3rem; padding: .15rem .6rem; border-radius: 999px; background: #fff3e8; color: #c45808; font-weight: 600; font-size: .82rem; border: 1px solid #ffd9be; }

    .faq-accordion .accordion-item { border: 1px solid #e8edf7; border-radius: 10px; overflow: hidden; margin-bottom: .8rem; }
    .faq-accordion .accordion-button { font-weight: 600; color: #14213d; background: #fff; box-shadow: none; }
    .faq-accordion .accordion-button:not(.collapsed) { background: #f8fbff; color: #0d6efd; }
    .faq-accordion .accordion-body { color: #4b5563; line-height: 1.7; }

    .rec-item { display: flex; gap: .8rem; padding: .65rem; border-radius: 10px; border: 1px solid #edf1f7; margin-bottom: .65rem; transition: .2s; }
    .rec-item:hover { background: #f8fbff; border-color: #d8e7ff; }
    .rec-item img { width: 70px; height: 70px; object-fit: cover; border-radius: 8px; }
    .rec-item h6 { margin: 0 0 .2rem; color: #14213d; font-size: .96rem; }
    .rec-item small { color: #667085; }
    .service-card-slide { border: 1px solid #edf1f7; border-radius: 12px; overflow: hidden; background: #fff; height: 100%; }
    .service-card-slide img { width: 100%; height: 170px; object-fit: cover; }
    .service-card-slide h6 { margin: 0 0 .25rem; color: #14213d; font-size: .98rem; min-height: 46px; }
    .service-card-slide small { color: #667085; }
    #recommendedServicesCarousel .carousel-control-prev,
    #recommendedServicesCarousel .carousel-control-next { width: 42px; height: 42px; top: -52px; opacity: 1; border-radius: 50%; background: #0d6efd; }
    #recommendedServicesCarousel .carousel-control-prev { left: auto; right: 54px; }
    #recommendedServicesCarousel .carousel-control-next { right: 4px; }
    #recommendedServicesCarousel .carousel-control-prev-icon,
    #recommendedServicesCarousel .carousel-control-next-icon { width: 1rem; height: 1rem; }

    .static-showcase-img { width: 100%; height: 270px; object-fit: cover; border-radius: 16px; border: 1px solid #e9edf6; box-shadow: 0 8px 22px rgba(23, 33, 58, 0.08); }

    .location-link { display: flex; gap: .55rem; align-items: center; padding: .65rem .75rem; border: 1px solid #edf1f7; border-radius: 10px; margin-bottom: .55rem; color: #14213d; transition: .2s; }
    .location-link i { color: #0d6efd; }
    .location-link:hover { background: #f8fbff; border-color: #d8e7ff; }

    @media (max-width: 991.98px) {
        .service-card-slide img { height: 150px; }
        .static-showcase-img { height: 220px; }
    }
</style>
