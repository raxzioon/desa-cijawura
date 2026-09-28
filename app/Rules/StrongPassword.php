<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $password = $value;

        // Minimum length
        if (strlen($password) < 12) {
            $fail('Password harus minimal 12 karakter.');
            return;
        }

        // Require at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            $fail('Password harus mengandung minimal 1 huruf besar.');
            return;
        }

        // Require at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            $fail('Password harus mengandung minimal 1 huruf kecil.');
            return;
        }

        // Require at least one number
        if (!preg_match('/[0-9]/', $password)) {
            $fail('Password harus mengandung minimal 1 angka.');
            return;
        }

        // Require at least one special character
        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>?]/', $password)) {
            $fail('Password harus mengandung minimal 1 karakter khusus (!@#$%^&*(),.?":{}|<>)');
            return;
        }

        // Prevent common patterns
        $commonPatterns = [
            '/^(?=.*[a-z])[\w\W]*[a-z]$/i', // all lowercase
            '/^(?=.*[A-Z])[\w\W]*[A-Z]$/i', // all uppercase
            '/^[0-9]+$/', // all numbers
        ];

        foreach ($commonPatterns as $pattern) {
            if (preg_match($pattern, $password)) {
                $fail('Password tidak boleh menggunakan pola yang terlalu sederhana.');
                return;
            }
        }

        // Prevent common passwords (basic check)
        $commonPasswords = [
            'password', '123456', '123456789', 'qwerty', 'abc123',
            'password123', 'admin', 'letmein', 'welcome', 'monkey',
            'password1', 'qwerty123', 'admin123', 'root'
        ];

        foreach ($commonPasswords as $common) {
            if (stripos($password, $common) !== false) {
                $fail('Password terlalu umum. Gunakan password yang lebih unik.');
                return;
            }
        }

        // Prevent repeating characters
        if (preg_match('/(.)\1{2,}/', $password)) {
            $fail('Password tidak boleh mengandung karakter yang berulang berturut-turut.');
            return;
        }
    }
}
