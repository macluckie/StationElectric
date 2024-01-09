vcl 4.1;

backend default {
    .host = "ng";
    .port = "80";
}


sub vcl_recv {
    set req.grace = 6h;
    return (hash);
}

sub vcl_backend_response {
    # Varnish will cache the response
    return (deliver);
}