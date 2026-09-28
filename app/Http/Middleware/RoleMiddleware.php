<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Maximum retry attempts for unauthorized access
     */
    const MAX_RETRY_ATTEMPTS = 3;
    
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Log unauthorized access attempt
            $this->logSecurityEvent('unauthenticated_access', [
                'ip' => $request->ip(),
                'path' => $request->path(),
                'method' => $request->method(),
                'user_agent' => $request->userAgent(),
            ]);
            
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // Validate user status
        if (!$user || is_null($user->role)) {
            Auth::logout();
            return redirect('/login')->with('error', 'Akun tidak valid. Silakan hubungi administrator.');
        }

        // Implement more granular permission checking
        $requiredPermission = $this->sanitizePermission($permission);
        
        // Admin bypass - but still log for audit
        if ($user->isAdmin()) {
            $this->logSecurityEvent('admin_access', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'permission' => $requiredPermission,
                'path' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
            
            return $next($request);
        }

        // Check if user has the required permission
        if (!$this->hasValidPermission($user, $requiredPermission)) {
            // Log unauthorized access attempt
            $this->logSecurityEvent('access_denied', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'role' => $user->role,
                'required_permission' => $requiredPermission,
                'path' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            // Check retry attempts
            $retryKey = 'auth_retry_' . $user->id . '_' . $request->ip();
            $retryCount = session()->get($retryKey, 0) + 1;
            session()->put($retryKey, $retryCount);
            
            // Excessive retry attempts
            if ($retryCount >= self::MAX_RETRY_ATTEMPTS) {
                // Log potential brute force attempt
                Log::warning('Potential brute force attempt detected', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'ip' => $request->ip(),
                    'retry_count' => $retryCount,
                    'path' => $request->path(),
                ]);
                
                // Consider implementing temporary ban or CAPTCHA here
            }
            
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Clear retry count on successful access
        $retryKey = 'auth_retry_' . $user->id . '_' . $request->ip();
        session()->forget($retryKey);

        return $next($request);
    }
    
    /**
     * Sanitize permission name to prevent injection
     */
    private function sanitizePermission(string $permission): string
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $permission);
    }
    
    /**
     * Validate permission with caching and additional checks
     */
    private function hasValidPermission($user, string $permission): bool
    {
        try {
            // Cache role permissions for performance
            $cacheKey = "role_permissions_{$user->role}";
            
            $userPermissions = cache()->remember($cacheKey, now()->addMinutes(30), function () use ($user) {
                return RolePermission::getPermissionsByRole($user->role);
            });
            
            return in_array($permission, $userPermissions);
        } catch (\Exception $e) {
            // Log error and deny access for safety
            Log::error('Permission check failed', [
                'user_id' => $user->id,
                'permission' => $permission,
                'error' => $e->getMessage(),
            ]);
            
            return false;
        }
    }
    
    /**
     * Log security events
     */
    private function logSecurityEvent(string $event, array $context): void
    {
        Log::info("Security Event: {$event}", $context);
    }
}

