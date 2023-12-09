FROM golang:1.18

WORKDIR /go/src/app
COPY ./sync-stations /go/src/app
RUN go get -u gorm.io/gorm
RUN go build -o main cmd/main.go
EXPOSE 8080
CMD ["./main"]