import 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    setupThemeToggle();
    setupRevealAnimations();
    setupHeroPills();
    setupContactHelpers();
    setupPasswordToggle();
    setupSignupJobs();
    setupCounters();
});

/**
 * Persists theme selection in localStorage and toggles data-theme attribute.
 */
function setupThemeToggle() {
    const btn = document.getElementById('theme-toggle-btn');
    const thumb = document.querySelector('[data-theme-thumb]');
    const label = document.querySelector('[data-theme-label]');
    if (!btn || !thumb || !label) return;

    const apply = (theme) => {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('pff-theme', theme);
        thumb.textContent = theme === 'dark' ? '🌙' : '☀️';
        label.textContent = theme === 'dark' ? 'Dark' : 'Light';
    };

    apply(localStorage.getItem('pff-theme') || 'dark');
    btn.addEventListener('click', () => apply(document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'));
}

/**
 * Handles fade-in animations as elements enter the viewport.
 */
function setupRevealAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active', 'is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
}

/**
 * Fills the hero search input when a popular category pill is clicked.
 */
function setupHeroPills() {
    const input = document.querySelector('[data-hero-query]');
    document.querySelectorAll('[data-hero-pill]').forEach(pill => {
        pill.addEventListener('click', () => input.value = pill.dataset.heroPill || '');
    });
}

/**
 * Manages character counts and dynamic hints in the contact form.
 */
function setupContactHelpers() {
    const input = document.querySelector('[data-message-input]');
    const count = document.querySelector('[data-message-count]');
    if (input && count) {
        const update = () => count.textContent = input.value.length;
        input.addEventListener('input', update);
        update();
    }

    const select = document.querySelector('[data-contact-subject]');
    const hint = document.querySelector('[data-contact-hint]');
    const metaScript = document.getElementById('contact-subject-meta');
    if (select && hint && metaScript) {
        const meta = JSON.parse(metaScript.textContent);
        select.addEventListener('change', () => {
            const data = meta[select.value];
            hint.style.display = data ? 'flex' : 'none';
            if (data) {
                hint.style.setProperty('--hint-color', data.color);
                hint.querySelector('[data-contact-hint-dot]').style.background = data.color;
                hint.querySelector('[data-contact-hint-text]').textContent = data.hint;
            }
        });
    }
}

/**
 * Toggles visibility of password fields.
 */
function setupPasswordToggle() {
    const toggle = document.querySelector('[data-password-toggle]');
    const input = document.querySelector('[data-password-input]');
    const icon = document.querySelector('[data-password-toggle-icon]');
    if (toggle && input && icon) {
        toggle.addEventListener('click', () => {
            const isPass = input.type === 'password';
            input.type = isPass ? 'text' : 'password';
            icon.textContent = isPass ? '🙈' : '👁';
        });
    }
}

/**
 * Manages dynamic job selection and hidden inputs in the signup form.
 */
function setupSignupJobs() {
    const toggle = document.querySelector('[data-travailleur-toggle]');
    const panel = document.querySelector('[data-jobs-panel]');
    const select = document.querySelector('[data-job-select]');
    const addBtn = document.querySelector('[data-job-add]');
    const customWrap = document.querySelector('[data-custom-job-wrap]');
    const customInput = document.querySelector('[data-custom-job-input]');
    const listWrap = document.querySelector('[data-selected-jobs]');
    const hiddenWrap = document.querySelector('[data-hidden-jobs]');
    const dataEl = document.getElementById('signup-jobs-data');
    if (!toggle || !panel || !dataEl) return;

    let jobs = JSON.parse(dataEl.textContent || '[]');

    const render = () => {
        listWrap.innerHTML = '';
        hiddenWrap.innerHTML = '';
        jobs.forEach(job => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = `${job} <span>×</span>`;
            btn.onclick = () => { jobs = jobs.filter(j => j !== job); render(); };
            listWrap.appendChild(btn);
            const hidden = document.createElement('input');
            hidden.type = 'hidden'; hidden.name = 'jobs[]'; hidden.value = job;
            hiddenWrap.appendChild(hidden);
        });
    };

    toggle.onchange = () => panel.style.display = toggle.checked ? 'flex' : 'none';
    select.onchange = () => customWrap.style.display = select.value === '__custom__' ? 'block' : 'none';
    addBtn.onclick = () => {
        const val = (select.value === '__custom__' ? customInput.value : select.value).trim();
        if (val && !jobs.includes(val)) { jobs.push(val); render(); }
    };
    render();
}

/**
 * Animates numeric counters as they scroll into view.
 */
function setupCounters() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = +el.dataset.target;
            const duration = 1800;
            const start = performance.now();
            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const ease = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(ease * target).toLocaleString() + (el.dataset.suffix || '');
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
            observer.unobserve(el);
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('[data-counter]').forEach(c => observer.observe(c));
}
