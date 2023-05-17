# PDF Generate API

## Deployment

To deploy this project run

```sh
composer install
```

Create the symbolic link

```sh
php artisan storage:link
```


## API Reference

```http
URL https://pdf-generator.nalog.nl
```

| Endpoint | Type | Description |
| :--- | :--- | :--- |
| `/api/pdf-generate` | `POST` | Generate PDF |
| `/api/pdf-clear` | `POST` | Clear PDF folder on server |
| `/api/certificate` | `POST` | Generate Certificate |

### Generate PDF 

```http
POST /api/pdf-generate
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `html` | `string` | **Required**. Your html code |
| `css` | `string` | **Optinal**. Your css code |
| `name` | `string` | **Required**. Name of file (PDF) |
| `type` | `string` | **Required**. Type of pdf: `file` or `base64` |
| `token` | `string` | **Required**. Access token |

***Request***
----

Expamle request body (1)
```sh
{
    "html": "<div class='container color'>Hello PDF</div>",
    "css": ".container { text-align: center } .color { color: green; }",
    "token": "{{token}}",
    "name": "nameOfFile",
    "type": "file"
}
```

Expamle request body (2)
```sh
{
    "html": "<style>.container { text-align: center } .color { color: green; }</style><div class='container color'>Hello PDF</div>",
    "css": "",
    "token": "{{token}}",
    "name": "nameOfFile",
    "type": "file"
}
```

***Response***
----

The `code` attribute return `200` - OK or `400` - ERROR.

The `status` attribute describes if the transaction was successful or not.

The `message` attribute contains a message commonly used to indicate errors.

The `data` attribute contains url to PDF or base64 of PDF.

Response OK
```sh
{
    "code": 200,
    "status": "success",
    "message": null,
    "data": [
        "https://name.pdf"
    ]
}
```

Response Error
```sh
{
    "code": 400,
    "status": "error",
    "message": "Validation errors",
    "data": {
        "token": [
            "token is not valid"
        ]
        ...
    }
}
```
----

### Clear PDF folder from server storage

```http
POST /api/pdf-clear
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `delete_all` | `boolean` | **Required**. Delete all PDFs - `true` or only 10-days PDFs - `false` |
| `token` | `string` | **Required**. Access token |

***Request***
----

Expamle request body
```sh
{
    "token": "{{token}}",
    "delete_all": true
}
```

***Response***
----

The `code` attribute return `200` - OK or `400` - ERROR.

The `status` attribute describes if the transaction was successful or not.

The `message` attribute contains a message commonly used to indicate errors.

The `data` - null.

Response OK
```sh
{
    "code": 200,
    "status": "success",
    "message": null,
    "data": null
}
```

Response Error
```sh
{
    "code": 400,
    "status": "error",
    "message": "Validation errors",
    "data": {
        "token": [
            "token is not valid"
        ]
        ...
    }
}
```
----
### Generate Certificate 

```http
POST /api/certificate
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `fileName` | `string` | **Required**. File name |
| `certificateNumber` | `string` | **Required**. Certificate Number |
| `date` | `string` | **Required**. Valid until (05.17.2024) |
| `clientName` | `string` | **Required**. Client name (eng) |
| `employeeName` | `string` | **Required**. Employee who issued the coupon (eng) |
| `discount` | `string|number` | **Required**. Discount value (just a number, without currency) |
| `offer` | `array` | **Required**. Offer - associative array ["title" => "Offer Title", "link" => "link"]|
| `offer["title"]` | `string` | **Required**. Offer title |
| `offer["link"]` | `string` | **Optional**. Offer link |
| `image` | `boolean` | **Required**. If true -> body will contain a link to the image |
| `language` | `string` | **Required**. Language: `ua`, `en` or `ru` |
| `token` | `string` | **Required**. Access token |

***Request***
----

Expamle request body (1)
```sh
{
    "token": "{{token}}",
    "fileName": "fileName",
    "certificateNumber": "12WEd1",
    "date": "09.05.2024",
    "clientName": "Bill Afmig",
    "employeeName": "Maria Frost",
    "discount": "200",
    "language": "en",
    "image": true,
    "offer": {
            "title": "Opening of BV",
            "link": "https://www.nalog.nl/vse-uslugi/yuridiceskim-licam/registraciya-firm-2/registraciya-bv/"
        }
}
```

Expamle request body (2)
```sh
{
    {
    "token": "{{token}}",
    "fileName": "fileName",
    "certificateNumber": "12WEd1",
    "date": "09.05.2024",
    "clientName": "Bill Afmig",
    "employeeName": "Maria Frost",
    "discount": "200",
    "language": "ua",
    "image": false,
    "offer": {
            "title": "Opening of BV"
        }
}
}
```

***Response***
----

The `code` attribute return `200` - OK or `400` - ERROR.

The `status` attribute describes if the transaction was successful or not.

The `message` attribute contains a message commonly used to indicate errors.

The `data` attribute contains url to PDF (and to image, if 'image' = true).

Response OK
```sh
{
    "code": 200,
    "status": "success",
    "message": null,
    "data": [
        "https://name.pdf",
        "https://name.jpg"
    ]
}
```

Response Error
```sh
{
    "code": 400,
    "status": "error",
    "message": "Validation errors",
    "data": {
        "token": [
            "token is not valid"
        ]
        ...
    }
}
```
----
