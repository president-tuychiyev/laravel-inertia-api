<h1 align="center">Laravel - Inertia(Vue), Tailwind, Api</h1>

[More information this project texchnology 🚀](https://www.youtube.com/watch?v=AwWepVU5uWM)

<img src="https://i.ibb.co/K0kGhtq/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/rkQSY9t/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/SyphRbP/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/M2BqbrQ/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/6XH2gZV/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/ZHs67wj/image.png" style="width: 80vw; border-radius: 10px"/>
<img src="https://i.ibb.co/jfM8kxL/image.png" style="width: 80vw; border-radius: 10px"/>

Import the <code>postman_collection.json</code> file into postman to see the api requests
<hr/>
Sure! Here’s a step-by-step guide to set up a Laravel 11 project using Docker Compose:

# Prerequisites
* Docker installed on your system.
* Docker Compose installed.

## Step 1: Start Docker Containers
Run the following command to start your Docker containers:
```
docker compose up -d --build
```

## Step 2: Access Your Laravel Application
Open your browser and navigate to http://localhost:8000 to see your Laravel application running.

## Additional Commands
### Stop containers: 
```
docker compose down
```
### Rebuild containers:
```
docker compose up -d --build
```
### View logs:
```
docker compose logs -f
```

## Docker commands for get in container
```
docker exec -u $UID:$GID -ti medol /bin/bash
```