<style>
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Pacifico&display=swap');

    body {
        font-size: 40px;
    }
    .container {
        background: url("./images/certificate_background_eng.jpg") no-repeat left center;
        width: 1280px;
        height: 905px;
        margin: 0;
        position: relative;
    }

    .text_1 {
        font-family: "caveat", cursive;
        font-size: 34px;
        color: #2B248E;
        text-align: center;
    }

    .footer {
        font-family: "montserrat", sans-serif;
        font-weight: 500;
        font-size: 16px;
        opacity: 0.7;

        width: 91%;
        position: absolute;
        bottom: 20px;
        left: 60px;
        color: white;
        text-align: center;
    }

    .number {
        width: 140px;
        height: 50px;
        position: absolute;
        bottom: 65px;
        left: 50px;
    }

    .valid_until {
        width: 170px;
        height: 50px;
        position: absolute;
        bottom: 65px;
        left: 225px;
    }

    .issued_by_employee {
        width: 350px;
        height: 50px;
        position: absolute;
        bottom: 65px;
        right: 70px;
    }

    .name {
        font-family: 'pacifico', cursive;
        font-size: 70px;
        text-align: center;

        width: 750px;
        height: 130px;
        position: absolute;
        top: 225px;
        left: 265px;
    }

    .offer-title {
        width: 650px;
        height: 35px;
        position: absolute;
        top: 355px;
        left: 315px;
    }

    .offer-point {
        width: 650px;
        height: 35px;
        position: absolute;
        left: 315px;
    }

    .underline {
        border-bottom: 1px solid #5E5E5E;
        font-size: 28px;
    }

    .link {
        text-decoration: none;
        color: #2B248E;
    }
</style>
<body class="container">
<div class="name">
    {{ $data["clientName"] }}
</div>
<div class="offer-title text_1 underline">
    For a {{ $data["discount"] }} discount on {{ count($data["offers"]) > 1 ? "services" : "service" }}:
</div>
@foreach($data["offers"] as $key => $offer)
    <div class="offer-point text_1 underline" style="top: {{355 + ($key + 1) * 40}}px">
        <a class="link" href="{{ $offer["link"] }}">
            {{ $offer["title"] }}
        </a>
    </div>
@endforeach
<div class="number text_1">
    {{ $data["number"] }}
</div>
<div class="valid_until text_1">
    {{ $data["date"] }}
</div>
<div class="issued_by_employee text_1">
    {{ $data["employeeName"] }}
</div>
<div class="footer">
    Certificate is valid until 05.05.2023. After this date, the certificate expires and is no longer accepted.
</div>
</body>
