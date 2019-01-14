FROM ubuntu:18.04
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt install wget fontconfig fontconfig-config fonts-dejavu-core libbsd0 libexpat1 libfontconfig1 libfontenc1 libfreetype6 libjpeg-turbo8 libpng16-16 libx11-6 libx11-data libxau6 libxcb1 libxdmcp6 libxext6 libxrender1 multiarch-support ucf x11-common xfonts-75dpi xfonts-base xfonts-encodings xfonts-utils -y
RUN apt install php libapache2-mod-php -y
RUN apt install fonts-wqy-microhei ttf-wqy-microhei fonts-wqy-zenhei ttf-wqy-zenhei -y
RUN wget https://downloads.wkhtmltopdf.org/0.12/0.12.5/wkhtmltox_0.12.5-1.bionic_amd64.deb && dpkg -i wkhtmltox_0.12.5-1.bionic_amd64.deb && rm -rf wkhtmltox_0.12.5-1.bionic_amd64.deb
COPY index.php /var/www/html/
WORKDIR /var/www/html
ENTRYPOINT ["php", "-S", "0.0.0.0:80"]
EXPOSE 80
