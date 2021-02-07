## Laravel development environment in Docker Containers for Builder

### Docker

We want to use docker to have a consistent dev env for all devs.

### With docker compose

* This docker-compose is targeted for [theme-builder](https://github.com/pagevamp/theme-builder)
* It has external dependencies of mysql, nginx-proxy containers which runs as service. Start required service from [docker-dev/services](https://github.com/pagevamp/docker-dev/tree/master/services) with command:
`$ docker-compose up`

In the root folder do the following:

* Add `build.pagevamp.pv` to `/etc/hosts` with `sudo echo '127.0.0.1 build.pagevamp.pv' >> /etc/hosts` or do in it with a text editor. 

**OR**

* Start compose by `$ docker-compose up`. If you want to run it on background, run `$ docker-compose up -d`
* Run npm command easy as `dnodejs npm install`.
* Browse the builder site from [build.pagevamp.pv](http://build.pagevamp.pv) which runs behind an nginx reverse proxy
* Access [build.pagevamp.pv/healthz](http://build.pagevamp.pv/healthz) to confirm health pass. It should respond 200.
*To go inside the running container run `docker exec -it build.pagevamp.pv /bin/bash`
