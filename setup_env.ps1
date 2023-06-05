Copy-Item -Path deploy/Dockerfile -Destination .
Copy-Item -Path deploy/docker-compose-example.yml -Destination docker-compose.yml
Copy-Item -Path deploy/credentials -Destination .credentials

Write-Host "Follow the instruction to setup your take-eir website easily"

$root_password = Read-Host -Prompt "Enter the root password for MySQL"
$user_password = Read-Host -Prompt "Enter the local user password for MySQL"

$email = Read-Host -Prompt "Enter the email address you wish to use [empty for none]"
$email_passwd = Read-Host -Prompt "Enter the password for the email [empty for none]"

(Get-Content docker-compose.yml) -replace 'your_root_password', $root_password | Set-Content docker-compose.yml
(Get-Content docker-compose.yml) -replace 'your_password', $user_password | Set-Content docker-compose.yml
(Get-Content .credentials) -replace 'super_password', $user_password | Set-Content .credentials

(Get-Content .credentials) -replace 'super_email', $email | Set-Content .credentials
(Get-Content .credentials) -replace 'super_key', $email_passwd | Set-Content .credentials

Read-Host "Credentials are all setup, the script will now create the docker containers (press Enter to continue)"

docker-compose up
