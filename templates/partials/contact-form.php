<form method="POST" action="<?php echo BASE_PATH; ?>/contact" class="space-y-6">
    <input type="hidden" name="csrf_token" value="<?php echo e(get_csrf_token()); ?>">

    <div>
        <label for="name" class="contact-label block text-sm mb-2">
            Name <span class="required-indicator">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               required
               placeholder="Your full name"
               class="contact-input w-full">
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
        <label for="message" class="contact-label block text-sm mb-2">
            Message <span class="required-indicator">*</span>
        </label>
        <textarea id="message"
                  name="message"
                  rows="5"
                  required
                  placeholder="Tell me about your project..."
                  class="contact-textarea w-full"></textarea>
    </div>

    <div>
        <button type="submit"
                class="contact-submit w-full">
            Send Message
        </button>
    </div>
</form>