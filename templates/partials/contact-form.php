<form method="POST" action="<?php echo BASE_PATH; ?>/contact" class="space-y-6">
    <input type="hidden" name="csrf_token" value="<?php echo e(get_csrf_token()); ?>">

    <div>
        <label for="name" class="block text-sm font-medium text-gray-dark mb-2">
            Name <span class="text-red-500">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent">
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-dark mb-2">
            Email <span class="text-red-500">*</span>
        </label>
        <input type="email"
               id="email"
               name="email"
               required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent">
    </div>

    <div>
        <label for="message" class="block text-sm font-medium text-gray-dark mb-2">
            Message <span class="text-red-500">*</span>
        </label>
        <textarea id="message"
                  name="message"
                  rows="5"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-transparent"></textarea>
    </div>

    <div>
        <button type="submit"
                class="w-full bg-primary-green text-white font-semibold py-3 px-6 rounded-lg hover:bg-dark-green transition-colors">
            Send Message
        </button>
    </div>
</form>