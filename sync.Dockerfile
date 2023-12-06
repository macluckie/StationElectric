FROM golang:1.18

WORKDIR /go/src/app
COPY ./sync-stations /go/src/app
RUN go get -u gorm.io/gorm

EXPOSE 8080
CMD go run cmd/main.go
