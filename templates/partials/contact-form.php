<form method="POST" action="<?php echo BASE_PATH; ?>/contact" class="space-y-6" id="contact-form">
    <input type="hidden" name="csrf_token" value="<?php echo e(get_csrf_token()); ?>">

    <!-- Honeypot field (hidden from users, traps bots) -->
    <div style="position: absolute; left: -9999px;">
        <label for="website_url">Website URL (Leave empty)</label>
        <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
    </div>

    <div>
        <label for="name" class="contact-label block text-sm mb-2">
            Name <span class="required-indicator">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               required
               placeholder="Your full name"
               class="contact-input w-full"
               maxlength="100"
               minlength="2">
    </div>

    <div>
        <label for="email" class="contact-label block text-sm mb-2">
            Email <span class="required-indicator">*</span>
        </label>
        <input type="email"
               id="email"
               name="email"
               required
               placeholder="your@email.com"
               class="contact-input w-full">
    </div>

    <div>
        <label for="phone" class="contact-label block text-sm mb-2">
            Phone <span class="text-theme-secondary">(Optional)</span>
        </label>
        <input type="tel"
               id="phone"
               name="phone"
               placeholder="(555) 123-4567"
               class="contact-input w-full">
    </div>

    <div>
        <label for="subject" class="contact-label block text-sm mb-2">
            Subject
        </label>
        <select id="subject"
                name="subject"
                class="contact-input w-full">
            <option value="General Inquiry">General Inquiry</option>
            <option value="Fractional CTO Services">Fractional CTO Services</option>
            <option value="App Development">App Development</option>
            <option value="AI Integration">AI Integration</option>
            <option value="Emergency Support">Emergency Support</option>
            <option value="Security/Performance">Security/Performance Issues</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div>
        <label for="message" class="contact-label block text-sm mb-2">
            Message <span class="required-indicator">*</span>
        </label>
        <textarea id="message"
                  name="message"
                  rows="5"
                  required
                  placeholder="Tell me about your project or technical challenge..."
                  class="contact-textarea w-full"
                  maxlength="5000"
                  minlength="10"></textarea>
        <div class="text-xs text-theme-secondary mt-1">
            <span id="char-count">0</span> / 5000 characters
        </div>
    </div>

    <div>
        <button type="submit"
                class="contact-submit w-full"
                id="submit-btn">
            <span id="btn-text">Send Message</span>
            <span id="btn-loading" class="hidden">
                <i data-lucide="loader" class="inline-block w-4 h-4 animate-spin mr-2"></i>
                Sending...
            </span>
        </button>
    </div>
</form>

<script>
// Character counter
document.getElementById('message').addEventListener('input', function() {
    document.getElementById('char-count').textContent = this.value.length;
});

// Form submission handler
document.getElementById('contact-form').addEventListener('submit', function(e) {
    const btn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');

    btn.disabled = true;
    btnText.classList.add('hidden');
    btnLoading.classList.remove('hidden');
});
</script>