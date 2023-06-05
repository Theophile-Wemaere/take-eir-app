# Take-eir website

## What is it ?

This repository contains the entire codebase for the website of the fictionnal medical start-up "TAKE-EIR". 

It allows users to discover the product of TAKE-EIR and also manage their owns devices by login into the website, to preview sensors datas, interact with the website administrators, and more !

You can find a working version of this code here -> https://take-eir.fr/

## How to install

For the sake of simplicity, I have created a ready to run docker image to have your version of the take-eir website running in no time on your machine.

Docker is cross platform and widelly used, so you can install it on almost any devices. 

You can find the corresponding version [here](https://docs.docker.com/get-docker/) <br>
-> https://docs.docker.com/get-docker/

When you have installed Docker, you can clone the repository :
```sh
git clone https://github.com/Theophile-Wemaere/take-eir-app.git
cd take-eir-app
```

Then you need to create the correspondings containers for this website.
For this, there are 2 ways :

**Automatically :**

You can configure everything manually with a setup script :

### Linux 

Just run this command :

```sh
bash setup_env.sh
```

And follow the instructions

### Windows (powershell or cmd)
```ps1
powershell .\setup_env.ps1
```


**Manually :**

You can configure the website manually with the followings command :

### Linux / MacOS

```sh
cp deploy/docker-compose-example.yml docker-compose.yml
cp deploy/credentials .credentials
```

### Windows (powershell)
```sh
Copy-Item -Path deploy/docker-compose-example.yml -Destination docker-compose.yml
Copy-Item -Path deploy/credentials -Destination .credentials
```

Then edit the file `.credentials` with your favorite text editor (for example vim, nano for linux, notepad for windows).

And just replace the fields with the wanted value :
(You can left empty the email fiels but you won't be able to use emails functions)
```json
{
  "mysql_host":"mysql",
  "mysql_dbname":"take_eir",
  "mysql_user":"take_eir_user",
  "mysql_password":"super_password", # change this
  "email_username":"super_email", # change this or left empty
  "email_password":"super_key" # change this or left empty
}
``` 

Also edit the file `docker-compose.yml` and change the value of theses fields :
```
- MYSQL_ROOT_PASSWORD=your_root_password # change this
- MYSQL_DATABASE=take_eir
- MYSQL_USER=take_eir_user
- MYSQL_PASSWORD=your_password  # change this
```

Then just run the command :
```
docker-compose up
```

This will create the containers and the servers will be up and running

## Informations 

The database come fully prepared with FAQ (in French for now) and somes default value in each tables :

the default user is also the website administrator :
```
username : admin@take-eir.fr
password : n0TmYp@sSwOr*D 
```

Don't forget to [change the default password](https://owasp.org/Top10/A07_2021-Identification_and_Authentication_Failures/) once connected.

Also the website come with emails functions such as reset password, confirm device and contact.

We use Google SMTP server via gmail account. For this, you can [add an application password to your google account](https://support.google.com/accounts/answer/185833?)
Then you just need to input the email and the password in the file `.credentials` manually or via the scripts.
