document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const messageInput = document.getElementById('message');
  const popup = document.getElementById('successPopup');
  const closeBtn = document.getElementById('closePopup');

  // ✅ Your Formspree endpoint
  const endpoint = 'https://formspree.io/f/xwpaevwl';

  // 🧩 Form validation + submission
  form.addEventListener('submit', async function (e) {
    e.preventDefault(); // stop normal form submission
    let errors = [];

    // Validation
    if (nameInput.value.trim() === '') errors.push('Name is required.');
    if (emailInput.value.trim() === '') errors.push('Email is required.');
    else if (!/^\S+@\S+\.\S+$/.test(emailInput.value))
      errors.push('Email is invalid.');
    if (messageInput.value.trim() === '') errors.push('Message is required.');

    if (errors.length > 0) {
      alert(errors.join('\n'));
      return;
    }

    // Prepare data
    const formData = new FormData(form);

    try {
      const response = await fetch(endpoint, {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: formData,
      });

      if (response.ok) {
        // ✅ Show popup smoothly
        popup.style.display = 'block';
        setTimeout(() => popup.classList.add('show'), 50);

        // Reset form
        form.reset();
        document.getElementById('namePreview').innerText = '';

        // Auto-close popup after 3 seconds
        setTimeout(() => {
          popup.classList.remove('show');
          setTimeout(() => (popup.style.display = 'none'), 400);
        }, 3000);
      } else {
        alert('❌ Submission failed. Please try again.');
      }
    } catch (error) {
      alert('⚠️ Network error. Please try again later.');
      console.error(error);
    }
  });

  // 👀 Live name preview
  nameInput.addEventListener('keyup', function () {
    document.getElementById('namePreview').innerText = nameInput.value;
  });

  // ❌ Manual close button
  closeBtn.addEventListener('click', function () {
    popup.classList.remove('show');
    setTimeout(() => (popup.style.display = 'none'), 400);
  });
});
