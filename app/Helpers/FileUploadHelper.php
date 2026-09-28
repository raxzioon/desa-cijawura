<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileUploadHelper
{
    /**
     * Secure upload file with random filename
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string|null
     */
    public static function secureUpload(UploadedFile $file, string $directory, string $disk = 'public'): ?string
    {
        try {
            // Generate random filename with original extension
            $extension = strtolower($file->getClientOriginalExtension());
            
            // Validate extension for security
            $allowedExtensions = [
                'jpg', 'jpeg', 'png', 'gif', 'webp', // Images
                'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', // Documents
            ];
            
            if (!in_array($extension, $allowedExtensions)) {
                return null;
            }
            
            // Generate random filename (UUID + extension)
            $filename = Str::uuid() . '.' . $extension;
            
            // Store file with secure name
            $path = $file->storeAs($directory, $filename, $disk);
            
            return $path;
        } catch (\Exception $e) {
            // Log error if needed
            return null;
        }
    }
    
    /**
     * Secure delete file
     * 
     * @param string|null $path
     * @param string $disk
     * @return bool
     */
    public static function secureDelete(?string $path, string $disk = 'public'): bool
    {
        if (!$path || !Storage::disk($disk)->exists($path)) {
            return false;
        }
        
        try {
            return Storage::disk($disk)->delete($path);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Validate file MIME type and extension
     * 
     * @param UploadedFile $file
     * @param array $allowedMimes
     * @return bool
     */
    public static function validateFile(UploadedFile $file, array $allowedMimes): bool
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType = $file->getMimeType();
        
        // Check MIME type
        if (!in_array($mimeType, $allowedMimes)) {
            return false;
        }
        
        // Additional MIME type validation based on extension
        $mimeMap = [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'gif' => ['image/gif'],
            'webp' => ['image/webp'],
            'pdf' => ['application/pdf'],
            'doc' => ['application/msword'],
            'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'xls' => ['application/vnd.ms-excel'],
            'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
            'ppt' => ['application/vnd.ms-powerpoint'],
            'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            'txt' => ['text/plain'],
        ];
        
        if (isset($mimeMap[$extension])) {
            return in_array($mimeType, $mimeMap[$extension]);
        }
        
        return false;
    }
}
