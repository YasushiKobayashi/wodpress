FROM wordpress:4.9.5-php7.2-apache

# RUN apt-get update && \
#   apt-get install -y wget && \
#   rm -rf /var/lib/apt/lists/*
#
# # setup nodejs
# ENV NODE_V=v8.1.0
# ENV PATH=/usr/local/node-${NODE_V}-linux-x64/bin:$PATH
# WORKDIR /usr/local
# RUN wget -O - https://nodejs.org/download/release/${NODE_V}/node-${NODE_V}-linux-x64.tar.gz | tar zxf - && \
#   npm i -g yarn
