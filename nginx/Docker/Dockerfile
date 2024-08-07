FROM nginx:1.25

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}
# Criação de um usuario para o diretório do projeto
RUN addgroup --system --gid ${GID} buzzvel
RUN adduser --system --home /bin/sh --no-create-home --uid ${UID} --ingroup buzzvel --disabled-login --disabled-password buzzvel
RUN sed -i 's/user  nginx/user buzzvel/g' /etc/nginx/nginx.conf

# Copiando o projeto para a pasta var/www/html
COPY . /var/www/html

# Definindo o usuario buzzvel como dono da pasta var/www/html
RUN chown -R ${UID}:${GID} /var/www/html
