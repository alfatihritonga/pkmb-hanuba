<x-layouts.app>
    <div class="space-y-6">

        {{-- Page Heading --}}
        <div>
            <h1 class="text-2xl font-bold">Profile Settings</h1>
            <p class="text-base-content/60 text-sm mt-1">Manage your name, email address, and account preferences.</p>
        </div>

        {{-- Update Profile Info --}}
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-base">Profile Information</h2>
                <p class="text-sm text-base-content/60 mb-4">Update your name and email address.</p>

                @if (session('status') === 'Profile updated successfully')
                    <div role="alert" class="alert alert-success mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    {{-- Name --}}
                    <div class="form-control">
                        <label class="label" for="name">
                            <span class="label-text font-medium">Full Name</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            required
                            autofocus
                            autocomplete="name"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            placeholder="Your full name"
                        />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text font-medium">Email Address</span>
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="username"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            placeholder="you@example.com"
                        />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 p-3 rounded-lg bg-warning/10 border border-warning/30 text-sm space-y-1">
                                <p class="text-warning font-medium">Email not verified.</p>
                                <p class="text-base-content/60">
                                    Check your inbox, or
                                    <button
                                        form="send-verification"
                                        class="link link-warning font-medium"
                                    >resend the verification email</button>.
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="text-success font-medium">A new verification link has been sent to your email.</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </form>

                {{-- Hidden form for email verification resend --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="hidden">
                        @csrf
                    </form>
                @endif
            </div>
        </div>

        {{-- Change Password --}}
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-base">Change Password</h2>
                <p class="text-sm text-base-content/60 mb-4">Make sure your account is using a strong password.</p>

                @if (session('status') === 'password-updated')
                    <div role="alert" class="alert alert-success mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Password updated successfully.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.password.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Current Password --}}
                    <div class="form-control">
                        <label class="label" for="current_password">
                            <span class="label-text font-medium">Current Password</span>
                        </label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            autocomplete="current-password"
                            class="input input-bordered w-full @error('current_password', 'updatePassword') input-error @enderror"
                            placeholder="Enter current password"
                        />
                        @error('current_password', 'updatePassword')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text font-medium">New Password</span>
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            class="input input-bordered w-full @error('password', 'updatePassword') input-error @enderror"
                            placeholder="Enter new password"
                        />
                        @error('password', 'updatePassword')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    {{-- Confirm New Password --}}
                    <div class="form-control">
                        <label class="label" for="password_confirmation">
                            <span class="label-text font-medium">Confirm New Password</span>
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            class="input input-bordered w-full @error('password_confirmation', 'updatePassword') input-error @enderror"
                            placeholder="Repeat new password"
                        />
                        @error('password_confirmation', 'updatePassword')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="btn btn-primary">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card bg-base-200 shadow-sm border border-error/20">
            <div class="card-body">
                <h2 class="card-title text-base text-error">Delete Account</h2>
                <p class="text-sm text-base-content/60 mb-4">
                    Once your account is deleted, all data will be permanently removed. This action cannot be undone.
                </p>

                <div class="flex justify-end">
                    <button
                        class="btn btn-error btn-outline"
                        onclick="document.getElementById('delete-account-modal').showModal()"
                    >
                        Delete Account
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- Delete Account Modal --}}
    <dialog id="delete-account-modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Are you absolutely sure?</h3>
            <p class="py-3 text-sm text-base-content/70">
                This will permanently delete your account and all associated data. Please enter your password to confirm.
            </p>

            <form method="POST" action="{{ route('settings.profile.destroy') }}" class="space-y-4 mt-2">
                @csrf
                @method('DELETE')

                <div class="form-control">
                    <label class="label" for="delete-password">
                        <span class="label-text font-medium">Password</span>
                    </label>
                    <input
                        id="delete-password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="input input-bordered input-error w-full @error('password', 'userDeletion') input-error @enderror"
                    />
                    @error('password', 'userDeletion')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="modal-action mt-4">
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('delete-account-modal').close()">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-error">
                        Yes, delete my account
                    </button>
                </div>
            </form>
        </div>

        {{-- Click outside to close --}}
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</x-layouts.app>