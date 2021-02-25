$logFile = 'laravel.log';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);
