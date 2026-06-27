# Add PHP to PATH
$env:Path = "C:\tools\php80;$env:Path"

# Start MySQL if not running
$mysqlProcess = Get-Process mysqld -ErrorAction SilentlyContinue
if (-not $mysqlProcess) {
    Write-Host "Starting MySQL..."
    Start-Process -FilePath "C:\xampp\mysql\bin\mysqld.exe" -WorkingDirectory "C:\xampp\mysql\bin" -WindowStyle Hidden
    Start-Sleep -Seconds 3
}

# Start Laravel dev server
Write-Host "Starting Laravel development server..."
Write-Host "Site will be available at: http://localhost:8000"
php artisan serve --host=localhost --port=8000
