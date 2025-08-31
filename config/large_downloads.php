<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Large Download Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for handling large file downloads in the admin dashboard
    |
    */

    // Size threshold in GB for showing warnings
    'warning_threshold_gb' => 5,
    
    // Size threshold in GB for automatically using streaming download
    'streaming_threshold_gb' => 10,
    
    // Size threshold in GB for suggesting background job processing
    'background_job_threshold_gb' => 20,
    
    // Memory limits for different file sizes
    'memory_limits' => [
        'small' => '512M',    // < 1GB
        'medium' => '1G',     // 1-5GB
        'large' => '2G',      // 5-10GB
        'xlarge' => '4G',     // 10GB+
    ],
    
    // Batch size for processing files (number of files to process at once)
    'batch_size' => 20,
    
    // Progress flush interval (flush output every N files)
    'flush_interval' => 50,
    
    // Chunk size for streaming downloads (in bytes)
    'stream_chunk_size' => 8192, // 8KB
    
    // Auto-cleanup of old download files (in hours)
    'auto_cleanup_hours' => 24,
    
];
