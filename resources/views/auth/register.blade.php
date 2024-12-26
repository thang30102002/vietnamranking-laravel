<x-notification />
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registerUser">
        @csrf
        {{-- type  --}}
        <div class="mt-4">
            <x-input-label for="role" :value="__('Bạn là cơ thủ hay đơn vị tổ chức giải?')" />
            <x-radio.list :value="old('rank')" />
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <x-input-label id="name" for="name" :value="__('Tên')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- sex -->
        <div id="sex" class="mt-4">
            <x-input-label for="sex" :value="__('Giới tính')" />
            <input type="radio" id="nam" name="sex" value="Nam"
                {{ old('sex') == 'Nam' ? 'checked' : '' }}>
            <label required class=" text-white" for="nam">Nam</label><br>
            <input type="radio" id="nu" name="sex" value="Nữ"
                {{ old('sex') == 'Nữ' ? 'checked' : '' }}>
            <label required class=" text-white" for="nu">Nữ</label><br>
            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
        </div>

        {{-- rank  --}}
        <div id="playerRank" class="mt-4  ">
            <x-input-label for="role" :value="__('Hạng')" />
            <x-radio.list-ranks />
            <x-input-error :messages="$errors->get('rank')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Số điện thoại')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!-- information -->
        <div class="mt-4 hidden" id="info">
            <x-input-label for="info" :value="__('Giới thiệu về đơn vị tổ chức')" />
            <textarea id="info"
                class=" p-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                type="text" name="info" :value="old('info')" autofocus autocomplete="info">{{ old('info') }}</textarea>
            <x-input-error :messages="$errors->get('info')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Xác nhận lại mật khẩu')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Bạn đã đăng ký?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Đăng ký') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const radios = document.querySelectorAll('input[name="user_type"]');
        const input_rank = document.getElementById('playerRank');
        const info = document.getElementById('info');
        const sex = document.getElementById('sex');
        const name = document.getElementById('name');

        // Kiểm tra giá trị radio khi tải trang
        const selectedRadio = document.querySelector('input[name="user_type"]:checked');
        if (selectedRadio) {
            toggleFields(selectedRadio.value);
        }

        // Lắng nghe sự kiện thay đổi giá trị radio
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleFields(this.value);
            });
        });

        // Hàm hiển thị/ẩn các thành phần
        function toggleFields(user_type) {
            if (user_type == 2) {
                input_rank.classList.remove('hidden');
                info.classList.add('hidden');
                sex.classList.remove('hidden');
            } else {
                input_rank.classList.add('hidden');
                info.classList.remove('hidden');
                sex.classList.add('hidden');
            }
        }
    });
</script>
