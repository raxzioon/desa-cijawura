<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Changed from DENY to SAMEORIGIN for iframe compatibility

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Enable cross-site scripting protection (legacy, mostly deprecated)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Content Security Policy - More permissive for development, stricter for production
        if (app()->environment('production')) {
            // Production: Strict but functional CSP
            $csp = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://www.google.com https://www.gstatic.com https://cdn.tiny.cloud",
                "style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.tiny.cloud",
                "font-src 'self' https://fonts.bunny.net https://fonts.gstatic.com https://cdnjs.cloudflare.com data: https://cdn.tiny.cloud",
                "img-src 'self' data: blob: https:",
                "connect-src 'self' ws: wss:",
                "object-src 'none'",
                "media-src 'self' data: blob:",
                "frame-src 'self' https://www.google.com https://recaptcha.google.com https://maps.google.com http://googleusercontent.com",
                "frame-ancestors 'self'",
                "form-action 'self'",
            ];
            $response->headers->set('Content-Security-Policy', implode('; ', $csp));
        }

        // Strict Transport Security (HSTS) - Only in production with HTTPS
        if (app()->environment('production') && $request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Permissions Policy (Feature Policy) - More permissive for development
        if (app()->environment('production')) {
            $permissions = [
                'geolocation=()',
                'microphone=()',
                'camera=()',
                'payment=()',
                'usb=()',
                'magnetometer=()',
                'gyroscope=()',
                'accelerometer=()',
            ];
            $response->headers->set('Permissions-Policy', implode(', ', $permissions));
        }

        return $response;
    }
}
