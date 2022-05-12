FROM nginx:1.18-alpine
# タイムゾーン(東京)
ENV TZ Asia/Tokyo

# nginxのconfigファイル(default.conf)をコピー
COPY ./docker/nginx/*.conf /etc/nginx/conf.d/
# このコンテナに入った時のカレントディレクトリ
WORKDIR /usr/share/nginx/html