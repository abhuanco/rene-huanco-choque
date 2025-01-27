upm:
	@HOST_INTERNAL='172.17.0.1' docker compose up -d --build --remove-orphans

up:
        @HOST_INTERNAL='host.docker.internal' docker compose up -d --build --remove-orphans

down:
	@HOST_INTERNAL='' docker compose down --rmi all

restart:
	@HOST_INTERNAL='' docker compose restart
