---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_41d2f7697c6118f36f8b676e5bd19ea0 -->
## Login using the given user ID / email.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_dusk/login/1/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_dusk/login/1/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET _dusk/login/{userId}/{guard?}`


<!-- END_41d2f7697c6118f36f8b676e5bd19ea0 -->

<!-- START_6375e7300024aae0f6af283b4a72cb1b -->
## Log the user out of the application.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_dusk/logout/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_dusk/logout/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET _dusk/logout/{guard?}`


<!-- END_6375e7300024aae0f6af283b4a72cb1b -->

<!-- START_09dcf3e9a9b6585fa40e4ead6c3c858a -->
## Retrieve the authenticated user identifier and class name.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_dusk/user/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_dusk/user/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET _dusk/user/{guard?}`


<!-- END_09dcf3e9a9b6585fa40e4ead6c3c858a -->

<!-- START_3499153408f5cb79f34cd38ecd35b91c -->
## api/generate-products
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/generate-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/generate-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/generate-products`


<!-- END_3499153408f5cb79f34cd38ecd35b91c -->

<!-- START_02405f27245a96c303f8ac423c5225a4 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/settings`


<!-- END_02405f27245a96c303f8ac423c5225a4 -->

<!-- START_b0eb233385cf807da01ff25ac855512a -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/settings`


<!-- END_b0eb233385cf807da01ff25ac855512a -->

<!-- START_4027949c1e6f63ccf14ba041af421b86 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/brands`


<!-- END_4027949c1e6f63ccf14ba041af421b86 -->

<!-- START_86af2db86d286a385f0c177e2ef525a2 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/reports" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/reports"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/reports`


<!-- END_86af2db86d286a385f0c177e2ef525a2 -->

<!-- START_85bd9da640ee7e09ba5d4ef8b434628b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/products`


<!-- END_85bd9da640ee7e09ba5d4ef8b434628b -->

<!-- START_bc41c5abcf8a679b8a059c689ea8ac0c -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/products`


<!-- END_bc41c5abcf8a679b8a059c689ea8ac0c -->

<!-- START_9332e51c1fdec8d85b3840fcb9237a92 -->
## api/admin/products/{product}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/products/{product}`


<!-- END_9332e51c1fdec8d85b3840fcb9237a92 -->

<!-- START_15064cc3389a4b7af179b4a8951e7af4 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/products/{product}`

`PATCH api/admin/products/{product}`


<!-- END_15064cc3389a4b7af179b4a8951e7af4 -->

<!-- START_b691df95f44afd2bb49d599df958f848 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/products/{product}`


<!-- END_b691df95f44afd2bb49d599df958f848 -->

<!-- START_b2b5cf242eb0e975c3eeb3369bba05ad -->
## api/admin/products/{id}/{key}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/products/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/products/{id}/{key}`


<!-- END_b2b5cf242eb0e975c3eeb3369bba05ad -->

<!-- START_ece80ac3ae6f1194daa101a61044b1e8 -->
## api/admin/products/main-image-upload/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/products/main-image-upload/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/main-image-upload/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/products/main-image-upload/{id}`


<!-- END_ece80ac3ae6f1194daa101a61044b1e8 -->

<!-- START_6584b60d72b74e3a0c2e1bc0e443cb82 -->
## api/admin/products/image-gallery-upload/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/products/image-gallery-upload/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/products/image-gallery-upload/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/products/image-gallery-upload/{id}`


<!-- END_6584b60d72b74e3a0c2e1bc0e443cb82 -->

<!-- START_ecf5825d7b90c0e9e3ae70b9f7e9476a -->
## api/admin/product-variation/{productId}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/product-variation/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/product-variation/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/product-variation/{productId}`


<!-- END_ecf5825d7b90c0e9e3ae70b9f7e9476a -->

<!-- START_e01d653c564ad18f13182311b80e8fb9 -->
## api/admin/product-variation/{id}/{productId}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/product-variation/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/product-variation/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/product-variation/{id}/{productId}`


<!-- END_e01d653c564ad18f13182311b80e8fb9 -->

<!-- START_be0256ab4da0776a067c6c014f1a408e -->
## api/admin/product-variation/{id}/{productId}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/product-variation/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/product-variation/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/product-variation/{id}/{productId}`


<!-- END_be0256ab4da0776a067c6c014f1a408e -->

<!-- START_f7828fe70326ce6166fdba9c0c9d80ed -->
## api/search
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/search`


<!-- END_f7828fe70326ce6166fdba9c0c9d80ed -->

<!-- START_e0cc7781f77aa50d54a15c7851b36d0b -->
## api/contact-us
> Example request:

```bash
curl -X POST \
    "http://localhost/api/contact-us" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/contact-us"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/contact-us`


<!-- END_e0cc7781f77aa50d54a15c7851b36d0b -->

<!-- START_316a4c3b4f6a4c4ff34e5893943cdebd -->
## api/countries
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/countries" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/countries"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/countries`


<!-- END_316a4c3b4f6a4c4ff34e5893943cdebd -->

<!-- START_aaf94cbe7f075785d0379ad533ac3fc7 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/featured" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/featured"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/featured`


<!-- END_aaf94cbe7f075785d0379ad533ac3fc7 -->

<!-- START_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/products`


<!-- END_86e0ac5d4f8ce9853bc22fd08f2a0109 -->

<!-- START_05b4383f00fd57c4828a831e7057e920 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/products`


<!-- END_05b4383f00fd57c4828a831e7057e920 -->

<!-- START_a285e63bc2d1a5b9428ae9aed745c779 -->
## api/products/{product}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/products/{product}`


<!-- END_a285e63bc2d1a5b9428ae9aed745c779 -->

<!-- START_b7842ce7893c09eb3c53713f82c2e12d -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/products/{product}`

`PATCH api/products/{product}`


<!-- END_b7842ce7893c09eb3c53713f82c2e12d -->

<!-- START_1d809ca5e8b10fa7fdc75d04506a55ea -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/products/{product}`


<!-- END_1d809ca5e8b10fa7fdc75d04506a55ea -->

<!-- START_f1b308e94b83a06708b6a17e494de97d -->
## api/filter-products/{gender}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/filter-products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/filter-products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/filter-products/{gender}`


<!-- END_f1b308e94b83a06708b6a17e494de97d -->

<!-- START_0cae6234beb77549d0183ce1b3c3b80d -->
## api/filter-all-products
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/filter-all-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/filter-all-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/filter-all-products`


<!-- END_0cae6234beb77549d0183ce1b3c3b80d -->

<!-- START_10633908636252dc838d3a5bd392f07c -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/settings`


<!-- END_10633908636252dc838d3a5bd392f07c -->

<!-- START_1e1aaba3a713ac3ce04a89d5f4ad0f2e -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/settings`


<!-- END_1e1aaba3a713ac3ce04a89d5f4ad0f2e -->

<!-- START_49314ee162f7e839596684af0fed40e9 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/brands`


<!-- END_49314ee162f7e839596684af0fed40e9 -->

<!-- START_657bc03edc12abbb56cd6cba090a5f5d -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/colors" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/colors"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/colors`


<!-- END_657bc03edc12abbb56cd6cba090a5f5d -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login
> Example request:

```bash
curl -X POST \
    "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## api/register
> Example request:

```bash
curl -X POST \
    "http://localhost/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## api/logout
> Example request:

```bash
curl -X POST \
    "http://localhost/api/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_2b6e5a4b188cb183c7e59558cce36cb6 -->
## api/user
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/user`


<!-- END_2b6e5a4b188cb183c7e59558cce36cb6 -->

<!-- START_e9aa8e9cecac4d07efa45f1b2d470efb -->
## api/admin/login
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/login`


<!-- END_e9aa8e9cecac4d07efa45f1b2d470efb -->

<!-- START_569bccc8050b19fc625e9810812a1d64 -->
## api/admin/register
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/register`


<!-- END_569bccc8050b19fc625e9810812a1d64 -->

<!-- START_66fec5572107b6fc8dc916471afde4c4 -->
## api/admin/logout
> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/logout`


<!-- END_66fec5572107b6fc8dc916471afde4c4 -->

<!-- START_b83d7cd7027ac246cb0f9cecb20c7bc4 -->
## api/admin/user
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/user`


<!-- END_b83d7cd7027ac246cb0f9cecb20c7bc4 -->

<!-- START_6c1682f4a40c1555254df708bf6b4a71 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/cart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/cart`


<!-- END_6c1682f4a40c1555254df708bf6b4a71 -->

<!-- START_ffc9879f3ac5b6304e7047c50762e044 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/cart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/cart`


<!-- END_ffc9879f3ac5b6304e7047c50762e044 -->

<!-- START_450335879308906ae82996981dec2c25 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/cart/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/cart/{productVariation}`


<!-- END_450335879308906ae82996981dec2c25 -->

<!-- START_29d54a345793642639c9f0b0a4f4fcc9 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/cart/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/cart/{productVariation}`


<!-- END_29d54a345793642639c9f0b0a4f4fcc9 -->

<!-- START_22d4b64e83809d8020568528bbd97bde -->
## api/addresses/{address}/shipping
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/addresses/1/shipping" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses/1/shipping"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/addresses/{address}/shipping`


<!-- END_22d4b64e83809d8020568528bbd97bde -->

<!-- START_f62d434079dff3acd53aa774d160d2ad -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/addresses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/addresses`


<!-- END_f62d434079dff3acd53aa774d160d2ad -->

<!-- START_c8fad65a796e6206c26cb584c46221b7 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/addresses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/addresses`


<!-- END_c8fad65a796e6206c26cb584c46221b7 -->

<!-- START_25f4303d28e06d127578df97937cdb67 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/addresses/{address}`


<!-- END_25f4303d28e06d127578df97937cdb67 -->

<!-- START_8f97ba08be391bb75680a4b5a24c9f6d -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/addresses/{address}`

`PATCH api/addresses/{address}`


<!-- END_8f97ba08be391bb75680a4b5a24c9f6d -->

<!-- START_e5d3d7a19170fe1ef6901a6ddf8eaeae -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/addresses/{address}`


<!-- END_e5d3d7a19170fe1ef6901a6ddf8eaeae -->

<!-- START_f9301c03a9281c0847565f96e6f723de -->
## api/orders
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/orders`


<!-- END_f9301c03a9281c0847565f96e6f723de -->

<!-- START_285c87403b6cfdebe26bc357f22e870f -->
## api/orders
> Example request:

```bash
curl -X POST \
    "http://localhost/api/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/orders`


<!-- END_285c87403b6cfdebe26bc357f22e870f -->

<!-- START_7e6be1b9dd04564a7b1298dd260f3183 -->
## api/orders/{order}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/orders/{order}`


<!-- END_7e6be1b9dd04564a7b1298dd260f3183 -->

<!-- START_39a90a8aa21c67b84cb5193ceac96fc5 -->
## api/payment-methods
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/payment-methods" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/payment-methods"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/payment-methods`


<!-- END_39a90a8aa21c67b84cb5193ceac96fc5 -->

<!-- START_18e45ff776f2303b7e7a3bd75e252168 -->
## api/payment-methods
> Example request:

```bash
curl -X POST \
    "http://localhost/api/payment-methods" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/payment-methods"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/payment-methods`


<!-- END_18e45ff776f2303b7e7a3bd75e252168 -->

<!-- START_61d73d5071a3fd3402cae1a177681245 -->
## Show a list of entities.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/datatable/customers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/customers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/datatable/customers`


<!-- END_61d73d5071a3fd3402cae1a177681245 -->

<!-- START_418340502d3e78352c4e716a34268524 -->
## api/admin/datatable/customers/{customer}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/datatable/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/customers/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/datatable/customers/{customer}`

`PATCH api/admin/datatable/customers/{customer}`


<!-- END_418340502d3e78352c4e716a34268524 -->

<!-- START_b68e279579d2ce423544e8f2a5708d2a -->
## Delete an entity.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/datatable/customers/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/customers/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/datatable/customers/{customer}`


<!-- END_b68e279579d2ce423544e8f2a5708d2a -->

<!-- START_309b5a7c98ffed31827ce5defa666ad4 -->
## Show a list of entities.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/datatable/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/datatable/brands`


<!-- END_309b5a7c98ffed31827ce5defa666ad4 -->

<!-- START_435083ebf8a594fc66a023f8b55c7693 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/admin/datatable/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/admin/datatable/brands`


<!-- END_435083ebf8a594fc66a023f8b55c7693 -->

<!-- START_035f4f8d0d9c98a4f6dea9e5cad91485 -->
## api/admin/datatable/brands/{brand}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/datatable/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/datatable/brands/{brand}`

`PATCH api/admin/datatable/brands/{brand}`


<!-- END_035f4f8d0d9c98a4f6dea9e5cad91485 -->

<!-- START_34ba0a76ce18542ab1948a091c29bf1f -->
## Delete an entity.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/datatable/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/datatable/brands/{brand}`


<!-- END_34ba0a76ce18542ab1948a091c29bf1f -->

<!-- START_c37d90722efcacc1f7eaa1f0f29e0095 -->
## Show a list of entities.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/datatable/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/datatable/orders`


<!-- END_c37d90722efcacc1f7eaa1f0f29e0095 -->

<!-- START_c3e674f53c459c3eb37fb1dc98c4f91b -->
## api/admin/datatable/orders/{order}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/datatable/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/datatable/orders/{order}`

`PATCH api/admin/datatable/orders/{order}`


<!-- END_c3e674f53c459c3eb37fb1dc98c4f91b -->

<!-- START_c6bf0ee7f32f00872349c554e7161be1 -->
## Delete an entity.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/datatable/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/datatable/orders/{order}`


<!-- END_c6bf0ee7f32f00872349c554e7161be1 -->

<!-- START_d86944a398161bfb32a9765835bcf4d1 -->
## api/admin/order/{orderID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/order/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/order/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/order/{orderID}`


<!-- END_d86944a398161bfb32a9765835bcf4d1 -->

<!-- START_e97552b704f6996e8ed93050d0c055f1 -->
## Show a list of entities.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/datatable/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/datatable/products`


<!-- END_e97552b704f6996e8ed93050d0c055f1 -->

<!-- START_303ec844fb9c2d1242d962e16cfbedd7 -->
## api/admin/datatable/products/{product}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/datatable/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/datatable/products/{product}`

`PATCH api/admin/datatable/products/{product}`


<!-- END_303ec844fb9c2d1242d962e16cfbedd7 -->

<!-- START_f64512699276ca4d332dd1862c1233d9 -->
## Delete an entity.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/datatable/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/datatable/products/{product}`


<!-- END_f64512699276ca4d332dd1862c1233d9 -->

<!-- START_470db8db8427bd7c75045de4474029dd -->
## Show a list of entities.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/admin/datatable/admin-user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/admin-user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/admin/datatable/admin-user`


<!-- END_470db8db8427bd7c75045de4474029dd -->

<!-- START_f1e6375766f6bb80ab3a6ce8dd754941 -->
## api/admin/datatable/admin-user/{admin_user}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/admin/datatable/admin-user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/admin-user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/admin/datatable/admin-user/{admin_user}`

`PATCH api/admin/datatable/admin-user/{admin_user}`


<!-- END_f1e6375766f6bb80ab3a6ce8dd754941 -->

<!-- START_8f3d3b838db98743799387a234038d3b -->
## Delete an entity.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/admin/datatable/admin-user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/admin/datatable/admin-user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/admin/datatable/admin-user/{admin_user}`


<!-- END_8f3d3b838db98743799387a234038d3b -->

<!-- START_1f593c1ebd4acd535c81d09d900be131 -->
## api/customer/change-password
> Example request:

```bash
curl -X POST \
    "http://localhost/api/customer/change-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/change-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/customer/change-password`


<!-- END_1f593c1ebd4acd535c81d09d900be131 -->

<!-- START_3bec08e13f3a1c3b5a638272a5b371b4 -->
## api/customer/edit-account
> Example request:

```bash
curl -X POST \
    "http://localhost/api/customer/edit-account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/edit-account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/customer/edit-account`


<!-- END_3bec08e13f3a1c3b5a638272a5b371b4 -->

<!-- START_01981fb54595d032066452b98762e293 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/customer/addresses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/addresses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/customer/addresses`


<!-- END_01981fb54595d032066452b98762e293 -->

<!-- START_e9a2e1e9bad63ba4d32f2f818fde7277 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/customer/addresses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/addresses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/customer/addresses`


<!-- END_e9a2e1e9bad63ba4d32f2f818fde7277 -->

<!-- START_6fcc48f3c7c70d15930066c160912da0 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/customer/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/customer/addresses/{address}`


<!-- END_6fcc48f3c7c70d15930066c160912da0 -->

<!-- START_cef6bc865841eed2fdd1af9d368ec02f -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/customer/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/customer/addresses/{address}`

`PATCH api/customer/addresses/{address}`


<!-- END_cef6bc865841eed2fdd1af9d368ec02f -->

<!-- START_d724a89d53c8e699a91341c9eb63f146 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/customer/addresses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/addresses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/customer/addresses/{address}`


<!-- END_d724a89d53c8e699a91341c9eb63f146 -->

<!-- START_f8b5c2646c6658d7a27768b5165037cc -->
## api/customer/orders
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/customer/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/customer/orders`


<!-- END_f8b5c2646c6658d7a27768b5165037cc -->

<!-- START_96e58d18c5b609d6b3f21e9f4b3b1634 -->
## api/customer/orders
> Example request:

```bash
curl -X POST \
    "http://localhost/api/customer/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/customer/orders`


<!-- END_96e58d18c5b609d6b3f21e9f4b3b1634 -->

<!-- START_9c7cc9cfaede88497403e49157239814 -->
## api/customer/orders/{order}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/customer/orders/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/customer/orders/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/customer/orders/{order}`


<!-- END_9c7cc9cfaede88497403e49157239814 -->


