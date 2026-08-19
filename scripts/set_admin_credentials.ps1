# Creed Tech - Interactive Admin Credential Setup Wrapper (PowerShell)

[Console]::ResetColor()
Write-Host "=======================================================" -ForegroundColor Cyan
Write-Host "   CREED TECH - SECURE ADMIN CREDENTIAL SETUP (CLI)    " -ForegroundColor Cyan
Write-Host "=======================================================" -ForegroundColor Cyan
Write-Host ""

$email = Read-Host "Enter New Admin Email"
$email = $email.Trim()

if ([string]::IsNullOrWhiteSpace($email)) {
    Write-Error "Admin email cannot be empty."
    exit 1
}

$secPass = Read-Host -AsSecureString "Enter New Admin Password (min 14 chars)"
$secConfirm = Read-Host -AsSecureString "Confirm New Admin Password"

if ($null -eq $secPass -or $null -eq $secConfirm) {
    Write-Error "Password input cannot be empty."
    exit 1
}

$bstrPass = [System.IntPtr]::Zero
$bstrConfirm = [System.IntPtr]::Zero
$plainPass = $null
$plainConfirm = $null

try {
    $bstrPass = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($secPass)
    $plainPass = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto($bstrPass)

    $bstrConfirm = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($secConfirm)
    $plainConfirm = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto($bstrConfirm)

    if ($plainPass.Length -lt 14) {
        Write-Error "Password must be at least 14 characters in length."
        exit 1
    }

    if ($plainPass -ne $plainConfirm) {
        Write-Error "Password and Confirmation do not match."
        exit 1
    }

    $payload = @{
        email = $email
        password = $plainPass
        confirm = $plainConfirm
    } | ConvertTo-Json -Compress

    $phpExe = "C:\php\php.exe"
    if (-not (Test-Path $phpExe)) {
        Write-Error "PHP executable not found at $phpExe"
        exit 1
    }

    $scriptPath = Join-Path $PSScriptRoot "set_admin_credentials.php"

    # Pipe payload strictly via STDIN to PHP backend
    $processInfo = New-Object System.Diagnostics.ProcessStartInfo
    $processInfo.FileName = $phpExe
    $processInfo.Arguments = "`"$scriptPath`""
    $processInfo.RedirectStandardInput = $true
    $processInfo.RedirectStandardOutput = $true
    $processInfo.RedirectStandardError = $true
    $processInfo.UseShellExecute = $false
    $processInfo.CreateNoWindow = $true

    $process = [System.Diagnostics.Process]::Start($processInfo)
    $process.StandardInput.WriteLine($payload)
    $process.StandardInput.Close()

    $stdOut = $process.StandardOutput.ReadToEnd()
    $stdErr = $process.StandardError.ReadToEnd()
    $process.WaitForExit()

    if ($process.ExitCode -eq 0) {
        Write-Host ""
        Write-Host "-------------------------------------------------------" -ForegroundColor Green
        Write-Host $stdOut -ForegroundColor Green
        Write-Host "-------------------------------------------------------" -ForegroundColor Green
        Write-Host "Owner may now log in securely via:" -ForegroundColor Cyan
        Write-Host "-> http://localhost:3000/login.php" -ForegroundColor Yellow
        Write-Host ""
    } else {
        Write-Host ""
        Write-Host "Setup Failed:" -ForegroundColor Red
        if ($stdErr) { Write-Host $stdErr -ForegroundColor Red }
        if ($stdOut) { Write-Host $stdOut -ForegroundColor Yellow }
        exit $process.ExitCode
    }
}
finally {
    # Free BSTR and clear temporary strings from memory
    if ($bstrPass -ne [System.IntPtr]::Zero) {
        [System.Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstrPass)
    }
    if ($bstrConfirm -ne [System.IntPtr]::Zero) {
        [System.Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstrConfirm)
    }
    $plainPass = $null
    $plainConfirm = $null
    $payload = $null
    [System.GC]::Collect()
}
