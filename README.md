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
