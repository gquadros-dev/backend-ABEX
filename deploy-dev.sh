# docker compose down --remove-orphans
# docker compose build --pull --no-cache
# docker compose up --wait
#yarn encore prod

docker compose down
docker compose up -d
yarn encore dev --watch
