// Fade-in on scroll
const faders = document.querySelectorAll('.fade-in');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add('visible');
  });
});
faders.forEach(fader => observer.observe(fader));

// Gallery click → open modal & carousel
document.querySelectorAll('.img-card').forEach((card, index) => {
  card.addEventListener('click', () => {
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    const carousel = document.querySelector('#modalCarousel');
    const bsCarousel = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel);
    bsCarousel.to(index);
    modal.show();
  });
});

// Back to top button
const topBtn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  topBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
});
topBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
